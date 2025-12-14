<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_name',
        'check_in',
        'check_out',
        'guests',
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
     * Optional: Link to the Room model (by room name)
     * You can remove if not needed.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_name', 'name');
    }
}
