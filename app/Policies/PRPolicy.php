<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\PurchaseRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PRPolicy {
    use HandlesAuthorization;

    public function processView(User $user, $pr) {
        $pr = PurchaseRequest::orderBy('id','desc')->whereHas('lastTransaction', function($query) use($pr) {
            return $query->whereHas('lastRecepient', function($q) use($pr) {
                return $q->where('purchase_request_id', $pr->id);
            });
        });
        return $pr->first()->lastTransaction->lastRecepient->receiver_id == $user->id;
    }
    
    public function fileViewer(User $user, $id) {
        $pr = PurchaseRequest::orderBy('id','desc')->whereHas('members', function($query) use($id) {

            return $query->where('members.user_id', Auth::user()->id)
                        ->where('purchase_request_id', $id);
        })->orWhereHas('lastTransaction', function($query) use($id) {
            return $query->whereHas('lastRecepient', function($q) use($id) {
                return $q->where('receiver_id', Auth::user()->id)->where('purchase_request_id', $id);
            });
        });
        return $pr->exists();
    }

    public function userView(User $user) {
        // return Member::where('user_id', $user->id)->exists();
        return true;
    }
    
    public function updateView(User $user, PurchaseRequest $pr) {
        $members = Member::where('user_id', Auth::user()->id)->where('purchase_request_id', $pr->id)->exists();
        $transactions = Transaction::orderBy('id', 'desc')->with('recepient')->first();
        // return ($user->role == "admin"?true:($transactions->recepient->receiver_id?true:$members));
        return ($transactions->recepient->receiver_id == $user->id?true:($members && $pr->approval != '1'));
    }
    
    public function delete_pr(User $user, PurchaseRequest $pr) {
        return $user->id == $pr->created_by;
    }
}
