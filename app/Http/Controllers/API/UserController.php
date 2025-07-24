<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
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

    public function fetchAll() {
        $users = User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->orderBy('created_at', 'desc')->get();
        return $users;
    }

    public function insertUser(CreateUserRequest $request, User $user) {
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

    public function updateUser(EditUserRequest $request, User $user) {

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
