<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index(){
        if (!Gate::allows('supplier-view-view')) {
            abort('403', 'Unauthorized Action');
        }
        return view('admin.supplier.index');
    }

    public function create(){
        if (!Gate::allows('supplier-view-view')) {
            abort('403', 'Unauthorized Action');
        }
        return view('admin.supplier.create');
    }
    
}
