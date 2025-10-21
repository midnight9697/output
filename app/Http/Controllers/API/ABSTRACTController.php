<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AbstractModel;
use App\Models\AbstractModelItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ABSTRACTController extends Controller {
    
    public function fetch_by_page(Request $request) {
        $abs = AbstractModel::orderBy('created_at', 'desc');
        return encryptIds($abs);
    }

    public function create(Request $request) {
        return $request;
        // foreach ($request->items as $item) {
           
        //     foreach ($item->bidders as $bidder) {
        //         $aitem = [
        //             'rfq_id' => $item->rfq_id,
        //             'rfq_item_id' => $item->id,
        //             'abstract_id' => $abstract->id,
        //             'supplier_id' => $item->rfq_id,
        //             'item_number' => $item->rfq_id,
        //             'unit_cost' => $item->rfq_id,
        //             'total_cost' => $item->rfq_id,
        //         ];
        //         AbstractModelItems::create($item);
        //     }
        // }
        // $new = AbstractModel::create([
        //     'ref' => $request->ref,
        //     'purpose' => $request->purpose,
        //     'filename' => $request->filename,
        //     'origin' => $request->origin,
        //     'filetype' => $request->filetype,
        //     'creator' => Auth::user()->id,
        // ]);
    }
}
