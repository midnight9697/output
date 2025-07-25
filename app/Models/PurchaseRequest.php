<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        'date',
        'responsibility_center_code',
        'purpose',
        'approver',
        'requester'
    ];
}
