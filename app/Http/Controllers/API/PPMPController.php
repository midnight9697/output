<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PPMP;
use Illuminate\Http\Request;

class PPMPController extends Controller {
    public function fetch_by_page(Request $request) {
        $ppmps = PPMP::orderBy('created_at', 'desc');
        return encryptIds($ppmps);
    }
}
