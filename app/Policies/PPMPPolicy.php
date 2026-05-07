<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PPMPPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update($ppmp) {
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == "admin") {
            return true;
        }
        return Auth::user()->id == $ppmp->creator?true: abort('419', 'Unauthorized Action');
    }
    
    public function remove($ppmp) {
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == "admin") {
            return true;
        }
        return Auth::user()->id == $ppmp->creator?true: abort('419', 'Unauthorized Action');
    }
}
