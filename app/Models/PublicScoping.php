<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicScoping extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentative_date_and_time'.
        'public_scoping_location'.
        'project_name'.
        'project_proponent'.
        'project_location'.
        'project_description'
    ];
}
