<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AbstractModel;
use App\Models\AbstractModelItems;
use App\Models\RFQ;
use App\Models\RFQItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ABSTRACTController extends Controller {
    
    public function fetch_rfq_bidders(Request $request) {
        $request->merge(['ids' => $request->rfq_id]);
        $rfq_from_rfq = app(RFQController::class)->fetch_rfq($request);
        $supplier_ids = [];
        $suppliers = [];
        foreach ($rfq_from_rfq as $rfqitem) {
            $rfq_item = $rfqitem;
            $rfq_item->abstract_items = encryptMany(AbstractModelItems::where('rfq_item_id', (decryptUrlSafe($rfqitem->id)))->with('supplier')->get());
            $rfq_t_bidders[] = $rfq_item;
            foreach ($rfq_item->abstract_items as $abstract_item) {
                if (!in_array($abstract_item->supplier->name, $supplier_ids)) {
                    $supplier_ids[] = $abstract_item->supplier->name;
                    $suppliers[] = $abstract_item->supplier;
                }
            }
        }
        
        return ['items' => $rfq_t_bidders, 'suppliers' => $suppliers, 'all_supplier_lists' => encryptMany(Supplier::get())];
    }

    public function fetch_by_page(Request $request) {
        $abs = AbstractModel::orderBy('created_at', 'desc');
        return encryptIds($abs);
    }

    public function create(Request $request) {
        if (AbstractModel::where('rfq_id', decryptUrlSafe($request->rfq_ids[0]))->exists()) {
            $abstract = AbstractModel::where('rfq_id', decryptUrlSafe($request->rfq_ids[0]))->update([
                'purpose' => $request->purpose,
            ]);
            $abstract = AbstractModel::where('rfq_id', decryptUrlSafe($request->rfq_ids[0]))->first();
        }
        else {
            $abstract = AbstractModel::create([
                'rfq_id' => decryptUrlSafe($request->rfq_ids[0]),
                'purpose' => $request->purpose,
                'creator' => Auth::user()->id,
            ]);
        }
        
        foreach ($request->items as $item) {
            $item = (object) $item;
            $bidders = $item->abstract_items;
            AbstractModelItems::where('rfq_item_id', decryptUrlSafe($item->id))->update(['winning_bidder' => '0']);
            foreach ($bidders as $bidder) {
                $bidder = (object) $bidder;
                $supplier = (object) $bidder->supplier;
                $aitem = [
                    'rfq_id' => decryptUrlSafe($item->rfq_id),  
                    'rfq_item_id' => decryptUrlSafe($item->id),
                    'abstract_id' => $abstract->id,
                    'supplier_id' => decryptUrlSafe($supplier->id),
                    'item_number' => 0,
                    'unit_cost' => $bidder->unit_cost,
                    'total_cost' => $bidder->total_cost,
                    'winning_bidder' => $bidder->winning_bidder
                ];

                $abstractItemExist = AbstractModelItems::where('rfq_item_id', decryptUrlSafe($item->id))->where('supplier_id', decryptUrlSafe($supplier->id));
               
                if ($abstractItemExist->exists()) {
                   
                    AbstractModelItems::where('rfq_id', decryptUrlSafe($item->id))->where('supplier_id', decryptUrlSafe($supplier->id))->update($aitem);
                }
                else {
                    AbstractModelItems::create($aitem);
                }
            }
            
        }
        return ['success'];
    }
}
