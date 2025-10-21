<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model {
    use HasFactory;

    protected $fillable = [
        'rfq_id',
        'purpose',
        'filename',
        'origin',
        'filetype',
        'creator',
    ];
}
