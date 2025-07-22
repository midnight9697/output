<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller {
    
    public function fetchUsers() {
        $users = User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->orderBy('created_at', 'desc')->paginate(10);
        
        return $users;
    }

    public function fetchAllUsers() {
        $users = User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->orderBy('created_at', 'desc')->get();
        return $users;
    }
    
    public function insertUser(StoreUserRequest $request, User $user) {
        // $this->authorize('update', $user, "Diri Pwede");
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
            'middlename' => ($request->middlename==""?'waived':$request->middlename),
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'position' => $request->position
        ]);

        return User::where('id', $new_user->id)->with('profile')->first();
    }

    public function updateUser(Request $request, User $user) {

        $this->authorize('update', $user, "Diri Pwede");
        return 'authorize';
        $new_user = User::where('id', $request->user_id)->update([
            'email' => $request->email,
        ]);

        $new_profile = Profile::where('user_id', $request->user_id)->update([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'position' => $request->position
        ]);

        return User::with('user_profile')->find($request->user_id);
    }


}
