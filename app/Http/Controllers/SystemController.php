<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SystemController extends Controller {
    
    public function getSections(Request $request) {
        $sections = Section::where('division_id', $request->division_id)->get();
        return $sections;
    }
}
