<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryID extends Model
{
    use HasFactory;

    /**
     * Table name (explicit for clarity)
     */
    protected $table = 'ferry_ids';

    /**
     * Allow mass assignment of Ferry ID code
     */
    protected $fillable = [
        'code', // e.g. FID0001
    ];

    /**
     * Get users (customers) who registered using this Ferry ID
     */
    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'ferry_code', 'code');
    }
}
