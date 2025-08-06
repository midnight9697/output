<?php

namespace App\Http\Controllers\PR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller {
    
    public function prView(Request $request) {
        return view('admin.pr.purchase_request');
    }

    public function createView() {
        return view('admin.pr.create');
    }
}
