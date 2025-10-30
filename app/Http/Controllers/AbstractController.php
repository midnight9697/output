<?php

namespace App\Http\Controllers;

use App\Models\AbstractModel;
use App\Models\RFQ;
use App\Models\RFQItem;
use App\Models\TemporaryImages;
use App\Services\WkhtmltoimageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Browsershot\Browsershot;
use Intervention\Image\ImageManagerStatic as Image;
use mikehaertl\wkhtmlto\Pdf as WkhtmltoPdf;

class MyClass {
    public $property1;

    public function method1() {
        return "This is a method.";
    }
}

class AbstractController extends Controller {

    protected WkhtmltoimageService $service;
    
    public function __construct(WkhtmltoimageService $service) {
        $this->service = $service;
    }

    public function index(){
        return view('admin.abstract.index');
    }

    public function create($id = false){
        $rfq = RFQ::where('id', ($id?decryptUrlSafe($id):null));
        if (!$rfq->exists()) {
            $rfq = (object)[
                'purpose' => '',
                'id' => encryptUrlSafe($id),
            ];
        }
        else {
            $rfq = encryptSingle($rfq->first());
        }
        return view('admin.abstract.create', [
            'rfq' => $rfq,
            'abstract' => AbstractModel::where('rfq_id', decryptUrlSafe($id))->first()
        ]);
    }

    public function update($id){
        $rfq = RFQ::where('id', decryptUrlSafe($id));
        if (!$rfq->exists()) {
            abort('404', 'Not Found');
        }
        
        return view('admin.abstract.create', [
            'rfq' => encryptSingle($rfq->first())
        ]);
    }

    public function preView($abstract_id) {
        $id = decryptUrlSafe($abstract_id);
        $abstract = AbstractModel::where('id', $id)->with('quotation')->with('abstract_items')->first();
        $rfq_items = RFQItem::where('rfq_id', $abstract->rfq_id)->with('abstract_items')->get();
        $suppliers = [];
        foreach ($abstract->abstract_items as $item) {
            $onTheList = array_filter($suppliers, function($supplier) use($item) {
                return $supplier->name == $item->supplier->name;
            });
            if (count($onTheList) == 0) {
                $suppliers[] = (object)$item->supplier;
            }
        }
        
        $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $abstract, 'suppliers' => $suppliers, 'items' => $rfq_items]);
        $html = view('admin.abstract.preview', [
            'data' => $data
        ])->render(); // or load your React build’s HTML
        return $this->service->GeneratePdf($html, $abstract->purpose);
    }
}
