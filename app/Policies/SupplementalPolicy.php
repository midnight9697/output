<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplementalPolicy
{
    use HandlesAuthorization;

    public function supplementalDownload(User $user, $spl) {
        if (!$spl->whereHas('supplemental', function($query) use($user){
            return $query->where('supplementaries.user_id', $user->id);
        })) {
            abort('404', 'Not Found');
        }
        $pr_id = $spl->first()->purchase_request_id;
        $pr = PurchaseRequest::where('id', $pr_id)->whereHas('transactions', function($query) use($user) {
            return $query->whereHas('recepient', function($q) use($user) {
                return $q->where('receiver_id', $user->id);
            });
        });
        if ($pr->count() == 0) {
            abort(403, 'Unauthorize action.');  //for tracking of PR
        }
        return true;//($spl->first()->user_id == $user->id);
    }
}
