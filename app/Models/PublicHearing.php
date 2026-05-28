<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicHearing extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'tentative_date_and_time',
        'public_hearing_location',
        'project_name',
        'project_proponent',
        'project_location',
        'project_description'
    ];
}
