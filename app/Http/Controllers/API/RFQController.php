<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RFQController extends Controller {
    
    public function deleteRFQ(Request $request) {
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('rfq-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        return RFQ::where('id', $id)->delete();
    }
    
    public function update_rfq(Request $request) {
        $data = $request->input('contents');
        $remarks = $request->input('remarkks');
        $id = decryptUrlSafe($request->id);
        if (!Gate::allows('rfq-update-view', $request->id)) {
            abort('403', 'Unauthorized Action');
        }
        RFQ::where('id', $id)->update([
            'contents' => $data,
            'remarks' => $remarks
        ]);
        return ['success'];
    }
    
    public function create_rfq(Request $request) {
        $data = $request->input('contents');
        $remarks = $request->input('remarkks');
        $rfq = RFQ::create([
            'contents' => $data,
            'creator' => Auth::user()->id,
            'remarks' => $remarks
        ]);
        return ['success'];
    }

    public function fetch_rfq(Request $request) {
        $id = decryptUrlSafe($request->id);
        $rfq = RFQ::where('id', $id)->first();
        return encryptSingle($rfq);
    }

    public function fetch_by_page() {
        $rfqs = RFQ::where('creator', Auth::user()->id)->get();
        return encryptIds($rfqs);
    }
}
