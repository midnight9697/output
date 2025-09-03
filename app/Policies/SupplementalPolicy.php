<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplementalPolicy
{
    use HandlesAuthorization;

    public function supplementalDownlod(User $user, $spl) {
        if (!$spl->whereHas('supplemental', function($query) use($user){
            return $query->where('supplementaries.user_id', $user->id);
        })) {
            abort('404', 'Not Found');
        }
        return ($spl->first()->user_id == $user->id);
    }
}
