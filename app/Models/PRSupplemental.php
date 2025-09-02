<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRSupplemental extends Model
{
    use HasFactory;

    protected $table = "pr_supplemental";

    protected $fillable = [
        'supplemental_id',
        'purchase_request_id',
        'transaction_id'
    ];

    public function supplemental() {
        return $this->hasOne(Supplementary::class, 'id', 'supplemental_id');
    }
}
