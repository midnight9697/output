<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplementary extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'filename',
        'origin',
        'filetype',
        'user_id'
    ];

    public function uploader() {
        return $this->hasOne(Profile::class,  'user_id', 'user_id');
    }
}
