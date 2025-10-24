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
                if (!in_array($abstract_item->supplier->id, $supplier_ids)) {
                    $supplier_ids[] = $abstract_item->supplier->id;
                    $suppliers[] = $abstract_item->supplier;
                }
            }
        }
        
        return ['items' => $rfq_t_bidders, 'suppliers' => $suppliers];
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
