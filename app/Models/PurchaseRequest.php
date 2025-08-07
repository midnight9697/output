<?php

namespace App\Models;

use Database\Factories\PRFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected static function  newFactory() {
        return PRFactory::new();
    }

    protected $fillable = [
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        'responsibility_center_code',
        'purpose',
        'created_by'
    ];

    public function purchase_request_items() {
        return $this->hasMany(PRItem::class, 'purchase_request_id');
    }
}
