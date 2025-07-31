<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'division_id',
        'section_id',
        'user_id',
        'position',
        'status',
        'position',
        'bac',
        'inspector',
    ];

    public function user() {
        $user = $this->hasOne(User::class, 'id', 'user_id');
        return $user;
    }

    public function getDateAttribute(): string {
        return "Shit";
    }

    public function division() {
        $division = $this->belongsTo(Division::class, 'division_id');
        return $division;
    }

    public function section() {
        $section = $this->belongsTo(Section::class, 'section_id');
        return $section;
    }
}
