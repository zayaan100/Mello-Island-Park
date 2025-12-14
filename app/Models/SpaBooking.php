<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'treatment_name',
        'date',
        'people',      // number of guests
        'status',
    ];

    /**
     * The customer who made the booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optional: link to Spa model (if needed)
     */
    public function spa()
    {
        return $this->belongsTo(Spa::class, 'treatment_name', 'name');
    }
}
