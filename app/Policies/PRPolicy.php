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
        $pr = PurchaseRequest::orderBy('id','desc')->whereHas('lastTransaction', function($query) use($user) {
            return $query->whereHas('recepient', function($q) use($user) {
                return $q->where('receiver_id', $user->id);
            });
        });
        return $pr->exists();
    }
    
    public function fileViewer(User $user, $id) {
        $pr = PurchaseRequest::where('id', $id)->orderBy('id','desc')->whereHas('members', function($query) use($id, $user) {
            return $query->where('members.user_id', $user->id)
                        ->where('purchase_request_id', $id);
        })->orWhereHas('transactions', function($query) use($id, $user) {
            return $query->whereHas('recepient', function($q) use($id, $user) {
                return $q->where('receiver_id', $user->id);
            });
        });
        return $pr->exists();
    }

    public function userView(User $user) {
        // return Member::where('user_id', $user->id)->exists();
        return true;
    }
    
    public function trackView(User $user, $id) {
        $pr = PurchaseRequest::where('id', $id)->orderBy('id','desc')->whereHas('members', function($query) use($id, $user) {
            return $query->where('members.user_id', $user->id)
                        ->where('purchase_request_id', $id);
        })->orWhereHas('transactions', function($query) use($id, $user) {
            return $query->whereHas('recepient', function($q) use($id, $user) {
                return $q->where('receiver_id', $user->id);
            });
        });
        return $pr->exists();
    }

    public function updateView(User $user, PurchaseRequest $pr) {
        $members = Member::where('user_id', Auth::user()->id)->where('purchase_request_id', $pr->id)->exists();
        $transactions = Transaction::orderBy('id', 'desc')->with('recepient')->first();
        // return ($user->role == "admin"?true:($transactions->recepient->receiver_id?true:$members));
        return (($members && $pr->approval != '1'));
    }
    
    public function delete_pr(User $user, PurchaseRequest $pr) {
        return $user->id == $pr->created_by;
    }
}
