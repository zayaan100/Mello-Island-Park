<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * VERY IMPORTANT → “role”, “dob”, “gender”, “nationality”, “ferry_code”
     * MUST be added here or they will NOT save.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dob',
        'gender',
        'nationality',
        'ferry_code',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    public function hasFerryID(): bool
    {
        return !empty($this->ferry_code);
    }
}
