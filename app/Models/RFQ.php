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
        'pr_id',
    ];

    public function items() {
        return $this->hasMany(RFQItem::class, 'rfq_id');
    }

    public function rfqItems() {
        return $this->hasMany(RFQItem::class, 'rfq_id');
    }

    public function abstract() {
        $user = $this->hasOne(AbstractModel::class, 'rfq_id', 'id');
        return $user;
    }

    public function created_by() {
        $user = $this->hasOne(User::class, 'id', 'creator');
        return $user;
    }

    public function purchase_requst() {
        $user = $this->hasOne(PurchaseRequest::class, 'id', 'pr_id');
        return $user;
    }
}
