<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permit'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute() {
        $profile = Profile::where('user_id', $this->id)->whereHas('user')->first();
        $fullname = $profile->firstname." ".($profile->middlename == "waived"?"":strtoupper($profile->middlename).".")." ".$profile->lastname;
        return $fullname;
    }

    public function profile() {
        $user = $this->hasOne(Profile::class, 'user_id')->with('division')->with('section');
        return $user;
    }

    public function getDivisionNameAttribute() {
        $profile = Profile::where('user_id', $this->id)->with('division')->with('section')->first();
        return $profile->division->division;
    }

    public function getSectionNameAttribute() {
        $profile = Profile::where('user_id', $this->id)->with('division')->with('section')->first();
        return $profile->section->section;
    }
}
