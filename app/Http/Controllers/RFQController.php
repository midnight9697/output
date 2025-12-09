<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RFQ;
use App\Services\ParaphraserService;
use App\Services\WkhtmltoimageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PhpOffice\PhpWord\IOFactory;
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

    public function rfqFormCreate($type, $pr_id) {
        $pr = PurchaseRequest::where('id', decryptUrlSafe($pr_id))->whereHas('transactions', function($query) {
            return $query->where('action', 12);
        });
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
}
