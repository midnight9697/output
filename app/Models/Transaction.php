<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_request_id',
        'sender_id',
        'action',
        'body',
    ];

    public function recepients() {
        return $this->hasMany(Recepient::class);
    }

    public function sender() {
        return $this->belongsTo(Profile::class, 'sender_id', 'user_id');
    }

    public function act() {
        return $this->hasOne(Alternative::class, 'id', 'action');
    }

    public function recepient() {
        return $this->hasOne(Recepient::class, 'transaction_id')->orderBy('id', 'desc')->with('profile');
    }

    public function firstRecepient() {
        return $this->hasOne(Recepient::class, 'transaction_id')->orderBy('id', 'asc');
    }

    public function lastRecepient() {
        return $this->hasOne(Recepient::class, 'transaction_id')->orderBy('id', 'desc');    //GET THE LAST TRANSACTION FOR THE LAST RECEPIENT
    }
    
    public function spl() {
        return $this->hasMany(PRSupplemental::class, 'transaction_id')->with('supplemental')->orderBy('transaction_id', 'desc');
    }

    public function attachments() {
        return $this->hasMany(Attachment::class, 'transaction_id')->orderBy('created_at', 'desc');
    }

    public function purchase_request() {
        return $this->hasOne(PurchaseRequest::class, 'purchase_request_id');
    }

    public function getReplaceAttribute() {
        return $this->spl->id = encryptUrlSafe($this->spl->id);
    }
}
