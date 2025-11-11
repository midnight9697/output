<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RFQController extends Controller {

    public function rfqView()  {
        return view('admin.rfq.index');
    }

    public function rfqFormCreate($type, $pr_id) {
        $pr = PurchaseRequest::where('id', decryptUrlSafe($pr_id))->whereHas('transactions', function($query) {
            return $query->where('action', 12);
        });
        if (!$pr->exists()) {
            return abort(401, 'Unauthorized Action');
        }

        if (RFQ::where('pr_id', $pr->first()->id)->exists()) {
            return redirect()->route('RFQ FORM UPDATE', ['id' => encryptUrlSafe(RFQ::where('pr_id', $pr->first()->id)->first()->id)]);
        }
        return view('admin.rfq.form-create', [
            'pr' => encryptSingle($pr->first())
        ]);
    }

    public function rfqFormUpdateView($rfq_id) {
        $id = decryptUrlSafe($rfq_id);
        if (!Gate::allows('rfq-update-view', $rfq_id)) {
            abort('403', 'Unauthorized Action');
        }
        $rfq = RFQ::where('id', $id);
        $pr = PurchaseRequest::where('id', ($rfq->first()->pr_id));

        if (!$pr->exists()) {
            return abort(404, 'Not Found');
        }
        return view('admin.rfq.form-update', [
            'rfq' => encryptSingle($rfq->first()),
            'pr' => encryptSingle($pr->first())
        ]);
    }
}
