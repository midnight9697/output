<?php

namespace App\Http\Controllers\Supplemental;

use App\Http\Controllers\Controller;
use App\Models\Supplementary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementalController extends Controller {

    public function supplementalView() {
        return view('admin.supplemental.supplemental', [
            'sup' => Supplementary::where('user_id', Auth::user()->id)
        ]);
    }
}
