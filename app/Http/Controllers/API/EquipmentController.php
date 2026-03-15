<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller {
    public function get_by_page() {
        $equipment = Equipment::orderByDesc('id');
        return encryptIds($equipment);
    }
}
