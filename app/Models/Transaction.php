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

    public function sender() {
        return $this->belongsTo(Profile::class, 'sender_id', 'user_id');
    }

    public function act() {
        return $this->hasOne(Alternative::class, 'id', 'action');
    }

    public function recepient() {
        return $this->hasOne(Recepient::class, 'transaction_id')->orderBy('id', 'desc');
    }
}
