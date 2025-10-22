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
        $abstract = AbstractModel::create([
            'rfq_id' => decryptUrlSafe($request->rfq_ids[0]),
            'purpose' => $request->purpose,
            'creator' => Auth::user()->id,
        ]);
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
                    'rfq_id' => $item->rfq_id,
                    'rfq_item_id' => decryptUrlSafe($item->id),
                    'abstract_id' => $abstract->id,
                    'supplier_id' => decryptUrlSafe($bidder->id),
                    'item_number' => 0,
                    'unit_cost' => $bidder_cost[array_keys($bidder_cost)[0]]['unit_cost'],//(count($bidder_cost ) > 0?:""),
                    'total_cost' => $bidder_price[array_keys($bidder_price)[0]]['unit_price'],//(count($bidder_price ) > 0?:""),
                ];
                AbstractModelItems::create($aitem);
            }
        }
        return ['success'];
    }
}
