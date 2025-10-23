<?php

namespace App\Http\Controllers;

use App\Models\AbstractModel;
use App\Models\RFQ;
use Illuminate\Http\Request;

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

}
