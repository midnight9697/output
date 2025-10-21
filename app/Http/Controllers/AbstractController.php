<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use Illuminate\Http\Request;

class AbstractController extends Controller
{
    public function index(){
        return view('admin.abstract.index');
    }

    public function create($id){
        $rfq = RFQ::where('id', decryptUrlSafe($id));
        if (!$rfq->exists()) {
            abort('404', 'Not Found');
        }
        return view('admin.abstract.create', [
            'rfq' => encryptSingle($rfq->first())
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
