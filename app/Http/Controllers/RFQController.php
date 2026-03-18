<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RFQ;
use App\Services\ParaphraserService;
use App\Services\WkhtmltoimageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Dompdf\Options;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Mpdf\Mpdf;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RFQController extends Controller {

    protected WkhtmltoimageService $service;
    protected ParaphraserService $pharService;

    public function __construct(WkhtmltoimageService $service, ParaphraserService $pharService) {
        $this->service = $service;
        $this->pharService = $pharService;
    }

    public function rfqView()  {
        return view('admin.rfq.index');
    }

    public function inboxView() {
        return view('admin.pr.status.inbox', [
            'status' => 'inbox',
            'name' => 'inbox'
        ]);
    }

    public function outboxView() {
        return view('admin.pr.status.inbox', [
            'status' => 'outbox',
            'name' => 'outbox'
        ]);
    }

    public function draftView() {
        return view('admin.pr.status.inbox', [
            'status' => 'personal',
            'name' => 'draft'
        ]);
    }

    public function approveView() {
        return view('admin.pr.status.inbox', [
            'status' => 'close',
            'name' => 'approved'
        ]);
    }

    public function rfqFormCreate($type, $pr_id) {
        // $pr = PurchaseRequest::where('id', decryptUrlSafe($pr_id))->whereHas('transactions', function($query) {
        //     return $query->where('action', 12);
        // });
        $pr = PurchaseRequest::where('id', decryptUrlSafe($pr_id));
        if (!$pr->exists()) {
            return abort(401, 'Unauthorized Action');
        }

        if (RFQ::where('pr_id', $pr->first()->id)->exists()) {
            return redirect()->route('RFQ FORM UPDATE', ['id' => encryptUrlSafe(RFQ::where('pr_id', $pr->first()->id)->first()->id)]);
        }
        return view('admin.rfq.form-create', [
            'pr' => encryptSingle($pr->first())
        ]);
    }

    public function rfqFormUpdateView($rfq_id) {
        $id = decryptUrlSafe($rfq_id);
        if (!Gate::allows('rfq-update-view', $rfq_id)) {
            abort('403', 'Unauthorized Action');
        }
        $rfq = RFQ::where('id', $id);
        $pr = PurchaseRequest::where('id', ($rfq->first()->pr_id));

        if (!$pr->exists()) {
            return abort(404, 'Not Found');
        }
        return view('admin.rfq.form-update', [
            'rfq' => encryptSingle($rfq->first()),
            'pr' => encryptSingle($pr->first())
        ]);
    }

    public function rfqPreview($rfq_id) {
        return $this->officeAction();
        return view('admin.rfq.preview');
        $data = [
            'css' => public_path('style.css'),
            'emb_logo' => public_path('denr-emb-logo.jpg'),
            'bp_logo' => public_path('Bagong_Pilipinas_logo.jpg'),
        ];
        $html = view('admin.rfq.preview_orig', [ 'data' =>  json_encode($data) ]);
        $mpdf = new Mpdf();
        
        $mpdf->WriteHTML($html);
    
        $mpdf->Output('invoice.pdf', 'I'); // 'I' for inline, 'D' for download
        return [];
        // $dompdf =  SnappyPdf::loadView('admin.rfq.preview_orig',[
        //     'data' =>  json_encode($data)
        // ]);
        // return $dompdf->inline();
        
        $template = new TemplateProcessor(resource_path('templates/test.docx'));
        // Replace placeholders
        $template->setValue('name', 'John Doe');
        $template->setValue('city', 'New York');
 
        // Save to storage
        $tempFile = tempnam(sys_get_temp_dir(), 'docx');
        $template->saveAs($tempFile);

        $phpWord = IOFactory::load($tempFile);

        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $tempHtml = tempnam(sys_get_temp_dir(), 'html');
        $htmlWriter->save($tempHtml);
        
        // $dompdf =  Pdf::loadHTML(file_get_contents($tempHtml))
        //             ->setOption('isHtml5ParserEnabled', true);  // Enables HTML5 support
        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();

       

        $id = decryptUrlSafe($rfq_id);
        $rfq = RFQ::where('id', $id)->with('purchase_requst')->first();
        $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $rfq, 'arrays' => rfqRules()]);
        $html = view('admin.rfq.preview', [
            'data' => $data
        ])->render(); // or load your React build’s HTML
        // $this->service->orientation = "landscape";
        return $this->service->GeneratePdf($html, 'nothingmore');
    }

    public function officeAction() {
        $phpWord = new PhpWord();

        // -------------------------------
        // 1. Create a section (needed for header)
        // -------------------------------
        $section = $phpWord->addSection();
        $html = view('admin.rfq.content');
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        
        Html::addHtml($section, $html, false, false);
        /* HEADER */
        $header = $section->addHeader();
    
        $headerHtml = '
        <header>
        <div class="header">
            <div class="header-text">
                <h3 class="header-three">Republic of the Philippines</h3>
                <h3 class="header-three">Department of Environment and Natural Resources</h3>
                <h3 class="header-three header-emb-line">ENVIRONMENTAL MANAGEMENT BUREAU</h3>
                <h3 class="header-three region-eight-line">Regional Office VIII</h3>
            </div>
        </div>
        <div class="blue-line"></div>
    </header>
        ';
    
        // Convert encoding to prevent errors
        $headerHtml = mb_convert_encoding($headerHtml, 'HTML-ENTITIES', 'UTF-8');
    
        // Add HTML to header
        Html::addHtml($header, $headerHtml, false, false);
    
        // -------------------------------
        // 3. Add the main section content from a Blade view
        // -------------------------------
        $html = view('admin.rfq.content', [
            'title' => 'Monthly Report',
            'users' => [
                ['name' => 'John Doe', 'age' => 25],
                ['name' => 'Jane Smith', 'age' => 30],
            ],
        ])->render();
    
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
    
        Html::addHtml($section, $html, false, false);
    
        // -------------------------------
        // 4. Save the Word document to disk
        // -------------------------------
        $filePath = public_path('report.docx');
        $phpWord->save($filePath, 'Word2007');
        $fileUrl = url('report.docx'); // public URL
        $viewerUrl = 'https://view.officeapps.live.com/op/view.aspx?src=' . ($fileUrl);
        return redirect($viewerUrl);
    }
}
