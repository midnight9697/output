<?php

namespace App\Http\Controllers;

use App\Models\AbstractModel;
use App\Models\RFQ;
use App\Models\RFQItem;
use App\Services\WkhtmltoimageService;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Browsershot\Browsershot;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function generate($abstract_id) {
        
        return env('WKHTMLTOIMAGE_PATH');
       
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
        // Where to save the image
        $imagePath = public_path('files/generated.png');

        // Generate the image
        // Browsershot::html($html)
        //     ->windowSize(800, 600)
        //     ->save($imagePath);
        // $imageData = Browsershot::html($html)
        // ->windowSize($contentWidth, $canvas->get_height())
        // ->fullPage()
        // ->screenshot(); // <- returns raw binary data
       
       
        $scaleX = $pageWidth / $contentWidth;
        // if ($scaleX < 1) {
            
            $scaleX = min(1, $pageWidth / $contentWidth);
            // return ['page' => $pageWidth, 'content' => $contentWidth, $scaleX." of content" => $contentWidth * $scaleX];
            $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $abstract, 'suppliers' => $suppliers, 'items' => $rfq_items, 'scaleX' => $scaleX]);
            $html = view('admin.abstract.preview', [
                'data' => $data
            ])->render();
            $imageData = Browsershot::html($html)
            ->windowSize($contentWidth, $canvas->get_height())  // viewport size
            ->fullPage()
            ->format('A4')           // optional, mainly used for PDF; can be skipped for images
            ->landscape(true)        // affects rendering if windowSize is set
            ->margins(10, 10, 10, 10) // not used in images, only PDF
            // ->screenshot()
            ->save('files/fullpage.png');
            $html = `
                <style>
                .fullpage {
                    width: 100%;
                    height: 100%;
                    background-size: cover;      /* fills page, maintains aspect ratio */
                    background-position: center;
                    background-repeat: no-repeat;
                }
                </style>
            `;
            $html .= '
                <img src="' . realpath('files/fullpage.png') . '" width="100%" height="'.($canvas->get_height() * $scaleX ).'">
            ';
            $pdf = Pdf::loadHTML($html)->setPaper('folio', 'landscape');
            return $pdf->stream();

            // return response($imageData)
            // ->header('Content-Type', 'image/png');
            $imageData = Browsershot::html($html)
            ->format('A4')        // Page size (optional)
            // ->margins(10, 10, 10, 10) // Top, right, bottom, left margins in mm
            ->landscape(true)    // Portrait by default
            ->pdf();              // Returns raw PDF data
            return response($imageData, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="document.pdf"');
            // $scaledHtml = view('admin.abstract.preview',['data' =>  $data])->render();
            // $scaledHtml = "
            //     {$scaledHtml}
            // ";

            // $pdf->set_paper(array(0,0,1000,2000)); //
            // $pdf->setOptions(['isRemoteEnabled' =>true, 'dpi' => 74]);
            $pdf = Pdf::loadHTML($scaledHtml)->setPaper('folio', 'landscape');
        // }
      
        // return $pdf->stream();
        // return view('admin.abstract.preview', [
        //     'data' => $data
        // ]);
        
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
        $pdf = Pdf::loadView('admin.abstract.preview', [
            'data' => $data
        ]);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        
        $canvas = $pdf->getDomPDF()->getCanvas();
        $pageWidth = $canvas->get_width();
        $contentWidth = (760 + (count($suppliers) * 240));
        $contentWidth = $contentWidth - ($pageWidth * 0.202991452991453);
        // After
        $scaleX = min(1, $pageWidth / $contentWidth);
        $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'abstract' => $abstract, 'suppliers' => $suppliers, 'items' => $rfq_items]);
        $html = view('admin.abstract.preview', [
            'data' => $data
        ])->render(); // or load your React build’s HTML
        $datetime = date('Y-m-d H:i:s');
        $number = strtotime($datetime);
        $outputPath = public_path('files/abstract/images/'.$number.'.png');
        $this->service->generateFromHtml($html, $outputPath, $contentWidth);

        $html = `
            <style>
            .fullpage {
                width: 100%;
                height: 100%;
                background-size: cover;      /* fills page, maintains aspect ratio */
                background-position: center;
                background-repeat: no-repeat;
            }
            </style>
        `;
        $imagePath = public_path('files/abstract/images/'.$number.'.png');
        $img = Image::make($imagePath);
        $width = $img->width();
        $height = $img->height();
        $pageHeight = 794;//$canvas->get_height();
        $numSlices = ceil($height / $pageHeight);
        // return ['image height' => $height, 'page height' => $pageHeight, 'slices' => $numSlices];
        // Approx A4 height in pixels at 96dpi
        
        $slices = [];
        
        for ($i = 0; $i < $numSlices; $i++) {
            $y = $i * $pageHeight;
            $sliceHeight = min($pageHeight, $height - $y);
            $sliceImg = clone $img;
            $slice = $sliceImg->crop((float)$width, (float)$sliceHeight, 0, (float)$y);

            // Save slice temporarily
            $slicePath = public_path("files/abstract/images/{$number}_{$i}.png");
            $slice->save($slicePath);

            $slices[] = (object)['file' => public_path("files/abstract/images/{$number}_{$i}.png"), 'height' => $sliceHeight];
        }

        // $html .= '
        //     <img src="' . realpath('files/abstract/images/'.$number.'.png') . '" width="100%" height="'.($canvas->get_height()).'">
        // ';
        $html = '';

        foreach ($slices as $key => $slice) {
            $maxHeight = ($key == 0?$slice->height - 93:$slice->height);
            $html .= '
                <img src="' . $slice->file . '" width="100%" height="'.($maxHeight).'">
               ';
        }
        $html .= '</body></html>';
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'landscape');
        return $pdf->stream();
        // return response()->file($outputPath);
    }
}
