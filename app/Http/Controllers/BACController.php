<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BACController extends Controller
{
    public function index(){
        return view('admin.bac.index');
    }
}
