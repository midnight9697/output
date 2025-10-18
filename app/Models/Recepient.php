<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepient extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'receiver_id',
        'received'
    ];

    public function profile() {
        return $this->hasOne(Profile::class,  'user_id', 'receiver_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class,  'id', 'transaction_id');
    }
}