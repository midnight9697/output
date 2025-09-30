<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbstractController extends Controller
{
    public function index(){
        return view('admin.abstract.index');
    }
}
