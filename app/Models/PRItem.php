<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_number',
        'unit',
        'item_description',
        'quantity',
        'unit_cost',
        'total_cost',
        'purchase_request_id'
    ];
}
