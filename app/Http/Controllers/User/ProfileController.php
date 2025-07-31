<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\EditUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller {
    
    public function userView() {
        if (!Gate::allows('user-view-page')) {
            abort('403', 'Unauthorized action');
        }
        return view('admin.settings.users.users');
    }
    
    public function userUpdateView($id) {
        $user = User::where('id', $id)->with('profile')->first();
        Gate::allows('user-update-view', $user);
        return view('admin.settings.users.update', [
            'user' => $user,
            'mates' => Profile::where('section_id', $user->profile->section_id)->with('user')->paginate(10)
        ]);
    }
}
