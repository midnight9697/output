<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function fetchByPage(Request $request) {
        return  User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->whereHas('profile')->orderBy('created_at', 'desc')->paginate(10);
    }
}
