<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplementary;
use Illuminate\Http\Request;

class SupplementalController extends Controller {
    
    public function fetch_by_page(Request $request) {
        return Supplementary::paginate(10);
    }
}
