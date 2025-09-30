<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RFQController extends Controller {

    public function rfqView()  {
        return view('admin.rfq.index');
    }
}
