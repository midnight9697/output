<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Mail\ForgotMail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
            ]]),
            'role' => $request->role,
        ]);
        
        $new_profile = Profile::create([
            'user_id' => $new_user->id,
            'firstname' => $request->firstname,
            'middlename' => ($request->middlename==""?'waived':$request->middlename),
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'position' => $request->position,
        ]);
        
        return User::where('id', $new_user->id)->with('profile')->first();
    }

    public function updateUser(EditUserRequest $request, $id) {
        $user = User::where('id', $id)->first();
        if (!Gate::allows('user-update-view', $user)) {
            abort('403', 'Unauthorized action');
        }

        $update_user = User::where('id', $id);
        $update_user->update([
            'email' => $request->email,
            'role' => $request->role,
        ]);

        Profile::where('user_id', $id)->update([
            'firstname' => $request->firstname,
            'middlename' => ($request->middlename==""?'waived':$request->middlename),
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'division_id' => $request->division,
            'section_id' => $request->section,
            'position' => $request->position,
            'unit_id' => $request->unit,
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
        $users = User::with('profile')->whereHas('profile', function($query) use($request, $columns) {
            $query->where('profiles.'.'firstname', 'LIKE', '%'. $request->q. '%')
                    ->orwhere('profiles.'.'middlename', 'LIKE', '%'. $request->q. '%')
                    ->orwhere('profiles.'.'lastname', 'LIKE', '%'. $request->q. '%')
                    ->orwhere('profiles.'.'suffix', 'LIKE', '%'. $request->q. '%')
                    ->orwhere('profiles.'.'position', 'LIKE', '%'. $request->q. '%');
            
        });
        return encryptIds($users);
    }

    public function send_forgot_password_link(Request $request) {
        $user = User::where('email', $request->email)->exists();
        if ($user) {
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = url('reset_password')."/".$selector."/".bin2hex($token);
    
            // $expired = date("U") + 1800;
            $expired = strtotime('+5 minutes');
            DB::delete('DELETE FROM password_resets WHERE email=?', [$request->email]);
            $hashtoken = password_hash($token, PASSWORD_DEFAULT);
            DB::table('password_resets')->insert( [
                    'email' => $request->email,
                    'token' => $hashtoken,
                    'selector' => $selector,
                    'expires_at' => $expired
                ]
            );

            Mail::to($request->email)
            ->send(new ForgotMail([
                'url' => $url
            ]));
            return response()->json(['message' => 'success', 'result' => 1]);
        }
        return response()->json(['message' => 'success', 'result' => 0]);
    }

    public function reset_password(PasswordResetRequest $request) {
        $user = User::where('email', $request->email);
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        DB::delete('DELETE FROM password_resets WHERE email=?', [$request->email]);
        return response()->json(['message' => 'success']);
    }

}