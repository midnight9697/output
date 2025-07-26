<?php

namespace App\Policies;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PRPolicy {
    use HandlesAuthorization;

    public function userView(User $user) {
        return PurchaseRequest::where('created_by', $user->id)->get();
    }

    public function updateView(User $user, PurchaseRequest $pr) {
        return ($user->id == $pr->created_by);
    }
}
