<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPMP extends Model {
    use HasFactory;

    protected $fillable = [
        'ref',
        'title',
        'filename',
        'origin',
        'filetype',
        'creator',
    ];
}
