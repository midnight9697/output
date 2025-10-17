<?php

namespace App\Policies;

use App\Models\RFQ;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RFQPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function updateView(User $user, $rfq_id) {
        $id = decryptUrlSafe($rfq_id);
        $rfq = RFQ::where('id', $id)->first();
        return $rfq->creator == $user->id;
    }
}
