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

class ABSTRACTOldController extends Controller {
    
    public function fetch_rfq_bidders(Request $request) {
        $rfq_id = decryptUrlSafe($request->rfq_id);
        $rfq = RFQ::where('id', $rfq_id)->with('abstract')->first();
        $rfq_bidders =  AbstractModelItems::where('abstract_id', ($rfq->abstract?$rfq->abstract->id:0))->with('supplier')->get();
        $rfq_suppliers = [];
        $rfq_t_bidders = [];
        foreach ($rfq_bidders as $rfq_bidder) {
            $bind_to_array = array_filter($rfq_suppliers, function($rfq_supplier) use($rfq_bidder) {
                return $rfq_bidder->supplier_id == $rfq_supplier->supplier_id;
            });
            $supplier = Supplier::where('id', $rfq_bidder->supplier_id)->first();
            if (count($bind_to_array) == 0) {
                $rfq_suppliers[] = $supplier;
            }
        }
        $request->merge(['ids' => $request->rfq_id]);
        $rfq_from_rfq = app(RFQController::class)->fetch_rfq($request);
        foreach ($rfq_from_rfq as $rfqitem) {
            $abstract_item = $rfqitem;
            $abstract_item->abstract_item = AbstractModelItems::where('rfq_item_id', (decryptUrlSafe($rfqitem->id)))->with('supplier')->first();
            $rfq_t_bidders[] = $abstract_item;
        }
        return ['rfq_bidders' => $rfq_bidders, 'suppliers' => $rfq_suppliers, 'items' => $rfq_t_bidders];
    }

    public function fetch_by_page(Request $request) {
        $abs = AbstractModel::orderBy('created_at', 'desc');
        return encryptIds($abs);
    }

    public function create(Request $request) {
        return $request;
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
        
        $unitprices = $request->unit_prices;
        $unitcosts = $request->unit_costs;
        foreach ($request->items as $item) {
            foreach ($item['bidders'] as $bidder) {
                $bidder = (object)$bidder;
                $bidder_price =array_filter($unitprices, function($price) use($bidder) {
                    $price = (object)$price;
                    return decryptUrlSafe($bidder->id) == decryptUrlSafe($price->bidder_id);
                });
                $bidder_cost = array_filter($unitcosts, function($cost) use($bidder) {
                    $cost = (object)$cost;
                    return decryptUrlSafe($bidder->id) == decryptUrlSafe($cost->bidder_id);
                });
                $item = (object)$item;
                $aitem = [
                    'rfq_id' => decryptUrlSafe($item->rfq_id),
                    'rfq_item_id' => decryptUrlSafe($item->id),
                    'abstract_id' => $abstract->id,
                    'supplier_id' => decryptUrlSafe($bidder->id),
                    'item_number' => 0,
                    'unit_cost' => $bidder_cost[array_keys($bidder_cost)[0]]['unit_cost'],//(count($bidder_cost ) > 0?:""),
                    'total_cost' => $bidder_price[array_keys($bidder_price)[0]]['unit_price'],//(count($bidder_price ) > 0?:""),
                ];
                $abstractItemExist = AbstractModelItems::where('rfq_item_id', decryptUrlSafe($item->id));
                if ($abstractItemExist->exists()) {
                    AbstractModelItems::where('rfq_id', decryptUrlSafe($item->id))->update($aitem);
                }
                else {
                    AbstractModelItems::create($aitem);
                }
            }
        }
        return ['success'];
    }
}
