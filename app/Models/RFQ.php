<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model {
    use HasFactory;
    protected $table = 'request_for_quotations';
    protected $fillable = [
        'project_purpose',
        'rfq_number',
        'attachment_one',
        'aproved_budget',
        'standard_unit',
        'target_delivery_date',
        'classification',
        'creator',
        'remarks',
    ];

    public function items() {
        return $this->hasMany(RFQItem::class, 'rfq_id');
    }
}
