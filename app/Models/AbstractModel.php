<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbstractModel extends Model {
    use HasFactory;

    protected $fillable = [
        'rfq_id',
        'purpose',
        'filename',
        'origin',
        'filetype',
        'creator',
    ];

    public function abstract_items() {
        $sections = $this->hasMany(AbstractModelItems::class, 'abstract_id')->with('item');
        return $sections;
    }

    public function quotation() {
        return $this->hasOne(RFQ::class, 'id', 'rfq_id')->with('purchase_requst');
    }

}
