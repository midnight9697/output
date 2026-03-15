<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller {
    
    public function mainView() {
        return view('equipment.index');
    }
}
