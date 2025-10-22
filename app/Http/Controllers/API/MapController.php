<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
    return response()->json(Supplier::all());
    }
}
