<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Member extends Model {
    use HasFactory;

    protected $fillable = [
        'purchase_request_id',
        'user_id',
        'role',
        'added_by',
    ];

    public function user() {
        $user = $this->hasOne(User::class, 'id', 'user_id')->with('profile');
        return $user;
    }

    public function addedBy() {
        $user = $this->hasOne(User::class, 'id', 'added_by')->with('profile');
        return $user;
    }
    
}