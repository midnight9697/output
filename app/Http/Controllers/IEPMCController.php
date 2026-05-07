<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IEPMCController extends Controller {
    
    public function mainView() {
        return view('iepmc.index');
    }
    
}