<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRMonitor extends Model {
    use HasFactory;
    protected $fillable = [
        'pr_id',
        'canvass',
        'abstract',
        'opening',
        'winner',
        'award_date',
        'order_date'
    ];

}
