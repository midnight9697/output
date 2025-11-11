<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){
        return view('admin.purchase_order.index');
    }

    public function create(){
        return view('admin.purchase_order.create');
    }

    public function edit(){
        return view('admin.purchase_order.form-update');
    }

}
