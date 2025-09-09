<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'filename',
        'origin',
        'filetype',
        'user_id',
        'transaction_id'
    ];
}
