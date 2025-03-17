<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller {
    
    public function fetchUsers() {
        $users = User::with('profile')->paginate();
        return $users;
    }

    public function insertUser(Request $request) {

        $request->validate([
            'email' => ['required', 'unique:users'],
            'password' => ['required', Password::min(8), 'confirmed'],
            'firstname' => 'required',
            'lastname' => 'required',
            'division' => 'required',
            'section' => 'required',
        ]);

        $new_user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'permit' => json_encode(['users' => [
                'c',
                'r',
                'u',
                'd'
            ]])
        ]);
        
        $new_profile = Profile::create([
            'user_id' => $new_user->id,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section
        ]);

        return User::where('id', $new_user->id)->with('profile')->first();
    }

    public function updateUser(Request $request) {
        // return "Shit";
        $request->validate([ 
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'division' => 'required',
            'section' => 'required',
        ]);
        
        $new_user = User::where('id', $request->user_id)->update([
            'email' => $request->email,
        ]);

        $new_profile = Profile::where('user_id', $request->user_id)->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section
        ]);

        return User::with('user_profile')->find($request->user_id);
    }


}
