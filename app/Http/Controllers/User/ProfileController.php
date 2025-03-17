<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    
    public function userView() {
        return view('admin.settings.users.users');
    }
}
