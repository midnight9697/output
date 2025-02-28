<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function sections() {
        $sections = $this->hasMany(Section::class, 'division_id');
        return $sections;
    }
}
