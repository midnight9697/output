<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PRPolicy {
    use HandlesAuthorization;

    public function userView(User $user) {
        // return Member::where('user_id', $user->id)->exists();
        return true;
    }
    
    public function updateView(User $user, PurchaseRequest $pr) {
        return ($user->role == "admin"?true:Member::where('user_id', Auth::user()->id)->where('purchase_request_id', $pr->id)->exists());
    }

    public function delete_pr(User $user, PurchaseRequest $pr) {
        return $user->id == $pr->created_by;
    }
}
