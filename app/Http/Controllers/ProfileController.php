<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    
    public function fetchUsers() {
        $users = User::with('profile')->get();
        return $users;
    }

    public function insertUser(Request $request) {
        $new_user = User::create([
            'email' => $request->email
        ]);

        $new_profile = UserProfile::create([
            'user_id' => $new_user->id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastanme,
            'suffix' => $request->suffix
        ]);

        return User::where('id', $new_user->id)->with('user_profile')->first();
    }
}
