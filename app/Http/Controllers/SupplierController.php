<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        return view('admin.supplier.index');
    }

    public function create(){
        return view('admin.supplier.create');
    }
    
}
