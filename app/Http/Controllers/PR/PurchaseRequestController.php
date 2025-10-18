<?php

namespace App\Http\Controllers\PR;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PurchaseRequest;
use App\Models\Recepient;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class PurchaseRequestController extends Controller {
    
    public function processView($id) {
        $id = decryptUrlSafe($id);
        $pr = PurchaseRequest::where('id', $id)->with('purchase_request_items')->with('lastTransaction');
        
        if (!Gate::allows('pr-process-view', $pr->first())) {
            abort(403, 'Unauthorize action.');
        }
        
        if (!$pr->exists()) {
            abort(419, 'Unauthorized Access');
        }
        
        $tr = Transaction::where('purchase_request_id', $id)->first();
        Recepient::where('transaction_id', $tr->id)->where('receiver_id', Auth::user()->id)->update(['received' => '1']);
        
        return view('admin.pr.process', [
            'pr' => encryptSingle($pr->first())
        ]);
    }

    public function prView(Request $request) {
        return view('admin.pr.purchase_request');
    }
    
    public function createView() {
        return view('admin.pr.create');
    }
    
    public function updateView($id) {
        $id = decryptUrlSafe($id);
        $pr = PurchaseRequest::where('id', $id)->with('purchase_request_items')->first();
        if (!Gate::allows('pr-update-view', $pr)) {
            abort(403, 'Unauthorize action.');
        }

        $tr = Transaction::where('purchase_request_id', $id)->first();
        Recepient::where('transaction_id', $tr->id)->where('receiver_id', Auth::user()->id)->update(['received' => '1']);
        
        return view('admin.pr.edit', [
            'pr' => encryptSingle($pr)
        ]);
    }
    
    public function trackView($id) {
        $id = decryptUrlSafe($id);
        $pr = PurchaseRequest::where('id', $id)->with('purchase_request_items');

        if (!Gate::allows('pr-track-view', $pr->first()->id)) {
            abort(403, 'Unauthorize action.');  //for tracking of PR
        }
        
        if (!$pr->exists()) {
            abort(419, 'Unauthorized Access');
        }
        return view('admin.pr.tracking', [
            'pr' => encryptSingle($pr->first()),
            'amember' => Member::where('purchase_request_id', $id)->where('user_id', Auth::user()->id)->exists()
        ]);
    }

    public function viewPR($id) {
        $id = decryptUrlSafe($id);
        $pr = PurchaseRequest::where('id', $id)->with('purchase_request_items')->first();
        if (!Gate::allows('pr-file-view', $pr->id)) {
            abort(403, 'Unauthorize action.');
        }
        $data = json_encode((object)['data' => public_path(''), 'id' => $id, 'request' => $pr]);
        $pdf = Pdf::loadView('admin.pr.view', [
            'data' => $data
        ]);
        return $pdf->stream();
    }

    
}
