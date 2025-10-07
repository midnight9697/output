<?php

namespace App\Http\Controllers;

use App\Models\RFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RFQController extends Controller {

    public function rfqView()  {
        return view('admin.rfq.index');
    }

    public function rfqFormCreate() {
        return view('admin.rfq.form-create');
    }

    public function rfqFormUpdateView($rfq_id) {
        $id = decryptUrlSafe($rfq_id);
        if (!Gate::allows('rfq-update-view', $rfq_id)) {
            abort('403', 'Unauthorized Action');
        }
        
        return view('admin.rfq.form-update', [
            'rfq' => encryptSingle(RFQ::find($id))
        ]);
    }
}
