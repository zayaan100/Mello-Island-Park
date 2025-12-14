<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',   // MUST match your DB column
        'date',
        'status',
    ];

    /**
     * Relationship: Booking belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Booking belongs to Activity  
     * You are storing the activity NAME (string), not activity_id.  
     * So we map: Activity.name → ActivityBooking.activity_name
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_name', 'name');
    }
}
