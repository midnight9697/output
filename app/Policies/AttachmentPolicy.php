<?php

namespace App\Policies;

use App\Models\PurchaseRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AttachmentPolicy {
    use HandlesAuthorization;
    
    public function creatorView(User $user, $att) {
        // $allowed = Transaction::where('id', $att->transaction_id)->where('sender_id',  $user->id)->orWhereHas('recepient', function($query) use($att, $user) {
        //     return $query->where('receiver_id', $user->id)
        //             ->where('transaction_id', $att->transaction_id);
        // })->exists();
        // purchase_request
        $transaction = Transaction::where('id', $att->transaction_id)->first();
        $allowed = PurchaseRequest::where('id', $transaction->purchase_request_id)->whereHas('transactions', function($query) {
            return $query->whereHas('recepients', function($q) {
                return $q->where('receiver_id', Auth::user()->id);
            });
        })->exists();
        return $allowed?true:abort('419', 'Unauthorized action');
    }
}
