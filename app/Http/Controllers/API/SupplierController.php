<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller {
    
    public function get_all_supplier(){
        $supplier = Supplier::select(
                '*',
                DB::raw("CONCAT(barangay, ', ', municipality, ', ', province) as specificaddress")
            )
            ->orderBy('created_at', 'desc');
            // ->get();
    
        return encryptIds($supplier);
    }
    

    public function create(Request $request) {
        $supplier = Supplier::create([
            'name' => $request->supplier_name,
            'province' => $request->supplier_province,
            'municipality' => $request->supplier_municipality,
            'barangay' => $request->supplier_barangay,
            'latitude' => $request->supplier_latitude,
            'longitude' => $request->supplier_longitude,
        ]);

        return ['success', $supplier];
    }

    public function remove(Request $request){
        $id = decryptUrlSafe($request->id);
        return Supplier::where('id', $id)->delete();
    }

    public function update(Request $request) {
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('supplier-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        $supplier = Supplier::where('id', $id)->update([
            'name' => $request->supplier_name,
            'province' => $request->supplier_province,
            'municipality' => $request->supplier_municipality,
            'barangay' => $request->supplier_barangay,
            'latitude' => $request->supplier_latitude,
            'longitude' => $request->supplier_longitude,
        ]);
        return ['success', $supplier];
    }
    

}
