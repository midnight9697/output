<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->role == "superadmin" || $user->role == "admin";
    }

    public function view(User $user) {
        return ($user->role == "superadmin" || $user->role == "admin")?true:false;
    }

    public function create(User $user) {
        //
    }

    public function update(User $model) {
        $user = Auth::user();
        return (($user->role == "superadmin" || $user->role == "admin")  || $model->id == $user->id)?true:abort('403', 'Unauthorized action');
    }
    
    public function delete(User $user, User $model) {
        //
    }

    public function restore(User $user, User $model) {
        //
    }

    public function forceDelete(User $user, User $model) {
        //
    }
}
