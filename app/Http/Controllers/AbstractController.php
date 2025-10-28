<?php

namespace App\Http\Controllers;

use App\Models\AbstractModel;
use App\Models\RFQ;
use App\Models\RFQItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MyClass {
    public $property1;

    public function method1() {
        return "This is a method.";
    }
}
class AbstractController extends Controller {
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
        $abstract = AbstractModel::where('id', $id)->with('abstract_items')->first();
        $rfq_items = RFQItem::where('rfq_id', $abstract->rfq_id)->with('abstract_items')->get();
        // if (!Gate::allows('pr-file-view', $abstract->id)) {
        //     abort(403, 'Unauthorize action.');
        // }
        $suppliers = [];
        foreach ($abstract->abstract_items as $item) {
            $onTheList = array_filter($suppliers, function($supplier) use($item) {
                return $supplier->name == $item->supplier->name;
            });
            if (count($onTheList) == 0) {
                $suppliers[] = (object)$item->supplier;
            }
        }
        // return ['abstract' => $abstract, 'suppliers' => $suppliers];
        $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $abstract, 'suppliers' => $suppliers, 'items' => $rfq_items]);
        $pdf = Pdf::loadView('admin.abstract.preview', [
            'data' => $data
        ]);
        $pdf->setPaper('folio', 'landscape');
        $pdf->render();
        
        $canvas = $pdf->getDomPDF()->getCanvas();
        $pageWidth = $canvas->get_width();
        $contentWidth = (760 + (count($suppliers) * 240));
        $contentWidth = $contentWidth - ($pageWidth * 0.202991452991453);
        $scaleX = $pageWidth / $contentWidth;
        if ($scaleX < 1) {
            $scaleX = min(1, $pageWidth / $contentWidth);
            // return ['page' => $pageWidth, 'content' => $contentWidth, $scaleX." of content" => $contentWidth * $scaleX];
            $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $abstract, 'suppliers' => $suppliers, 'items' => $rfq_items, 'scaleX' => $scaleX]);
            
            $scaledHtml = view('admin.abstract.preview',['data' =>  $data])->render();
            $scaledHtml = "
                {$scaledHtml}
            ";

            // $pdf->set_paper(array(0,0,1000,2000)); //
            // $pdf->setOptions(['isRemoteEnabled' =>true, 'dpi' => 74]);
            $pdf = Pdf::loadHTML($scaledHtml)->setPaper('folio', 'landscape');
        }
      
        return $pdf->stream();
        // return view('admin.abstract.preview', [
        //     'data' => $data
        // ]);
        
    }

}
