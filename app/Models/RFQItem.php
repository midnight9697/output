<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQItem extends Model {
    use HasFactory;
    protected $table = "quotation_items";
    protected $fillable = [
        'rfq_id',
        'specification',
        'bidder_specs',
        'quantity_unit',
        'unit_price',
        'total_price',
    ];

    public function quotation() {
        return $this->hasOne(RFQ::class, 'id', 'rfq_id');
    }

    public function abstract_items() {
        return $this->hasMany(AbstractModelItems::class, 'rfq_item_id')->with('supplier');
    }
}
