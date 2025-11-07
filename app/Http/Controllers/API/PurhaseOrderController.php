<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurhaseOrderController extends Controller
{
    public function fetch_purchase_order(Request $request) {
        $purchase_order = PurchaseOrder::orderByDesc('created_at');
        return encryptIds($purchase_order);
    }

    public function remove(Request $request){
        $id = decryptUrlSafe($request->id);
        return $id;
        // return PurchaseOrder::where('id', $id)->delete();
    }

    public function create(Request $request){
        return 'hello';
    }

    public function fetch_suppliers(){
        return Supplier::select('id', 'name')->get();
        // $supplier = Supplier::select('id', 'name')->get();
        // return encryptIds($supplier);
    }

    public function select_suppliers(Request $request){
        // $supplier = Supplier::select('id', 'name')->get();
        // return encryptIds($supplier);
        return Supplier::select('id', 'province', 'municipality', 'barangay')
        ->where('id', $request->id)
        ->get();
    
    }
}
