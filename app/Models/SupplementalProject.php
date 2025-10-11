<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementalProject extends Model {
    use HasFactory;

    protected $table = "supplemental_projects";

    protected $fillable = [
        'supplemental_id',
        'code',
        'procurement_project',
        'end_user',
        'early_procurement',
        'mode_of_procurement',
        'advertisement',
        'submission',
        'notice_of_award',
        'contract_signing',
        'source_of_funds',
        'total',
        'mooe',
        'co'
    ];
}
