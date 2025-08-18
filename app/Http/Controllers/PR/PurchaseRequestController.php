<?php

namespace App\Http\Controllers\PR;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PurchaseRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class PurchaseRequestController extends Controller {
    
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
        return view('admin.pr.edit', [
            'pr' => encryptSingle($pr)
        ]);
    }
}
