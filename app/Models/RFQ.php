<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model {
    use HasFactory;
    protected $table = 'request_for_quotations';
    protected $fillable = [
        'contents'
    ];
}
