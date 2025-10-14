<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller {
    
    public function get_all_supplier() {
        $supplier = Supplier::orderBy('created_at', 'desc');
        return encryptIds($supplier);
    }

    public function store_supplier(Request $request) {
        return $request;
    }

}
