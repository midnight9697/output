<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller {

    public function fetchByPage(Request $request) {
        $users = User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->whereHas('profile')->orderBy('created_at', 'desc')->paginate(10);
        foreach ($users as $user) {
            $user->full_name = $user->full_name;
            $user->division_name = $user->division_name;
            $user->section_name = $user->section_name;
            $user->date = date('M d, Y', strtotime($user->created_at));
        }
        return $users;
    }

    public function fetchAll() {
        $users = User::with('profile')->addSelect([
            'name' => Profile::select('firstname')
            ->whereColumn('user_id', 'users.id')
            ->limit(1)
        ])->whereHas('profile')->orderBy('created_at', 'desc')->get();
        foreach ($users as $user) {
            $user->full_name = $user->full_name;
        }
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

    public function updateUser(EditUserRequest $request, $id) {
        $user = User::where('id', $id)->first();
        Gate::allows('user-update-view', $user);

        $update_user = User::where('id', $id);
        $update_user->update([
            'email' => $request->email,
        ]);

        Profile::where('user_id', $id)->update([
            'firstname' => $request->firstname,
            'middlename' => ($request->middlename==""?'waived':$request->middlename),
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'position' => $request->position
        ]);

        if ($request->password) {
            $update_user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return response()->json(User::where('id', $id)->with('profile')->first());
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $user = \App\Models\User::find(1); 
            // Or if authenticated via Auth::user()
            $user = Auth::user(); 
            
            $token = $user->createToken('my-app-token')->plainTextToken;
            return ['token' => $token];
        }
        
        return response()->json(['UNAUTHENTICATED']);
    }

    public function search_user(Request $request) {
        $keyword = $request->input('query');
        $columns = [
            'firstname', 
            'middlename', 
            'lastname',
            'suffix', 
            'position',
        ];
        $result =  Profile::orWhere(function($q) use ($columns, $keyword) {
            foreach ($columns as $col) {
                $q->orWhere($col, 'like', '%'. $keyword . '%');
            }
        })->get('user_id')->toArray();
        $userids = array_column($result, 'user_id');

        $users = User::whereIn('id', $userids)->with('profile')->paginate(10);
        return $users;
    }
}