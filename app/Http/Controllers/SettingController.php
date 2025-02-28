<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class SettingController extends Controller {
    
    public function divisionsView(Request $request) {
        $divisions = Division::with('sections')->get();
        return view('admin.settings.divisions', ['divisions' => $divisions]);
    }
}