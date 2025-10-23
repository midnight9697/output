<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbstractModelItems extends Model {
    use HasFactory;

    protected $fillable = [
        'rfq_id',
        'rfq_item_id',
        'abstract_id',
        'supplier_id',
        'item_number',
        'unit_cost',
        'total_cost',
    ];

    public function supplier() {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}
