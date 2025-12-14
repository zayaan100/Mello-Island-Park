<?php

namespace App\Http\Controllers;

use App\Models\RoomBooking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomBookingController extends Controller
{
    /**
     * Show booking form for selected room
     */
    public function showForm($roomName)
    {
        $roomName = urldecode($roomName);

        $room = Room::where('name', $roomName)->firstOrFail();

        return view('bookings.rooms', [
            'room'     => $room,
            'roomName' => $room->name,
            'price'    => $room->price
        ]);
    }

    /**
     * Confirm booking before storing
     */
    public function confirm(Request $request, $roomName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $roomName = urldecode($roomName);

        $room = Room::where('name', $roomName)->firstOrFail();

        // Base validation
        $data = $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1|max:' . $room->capacity,
        ]);

        // -------------------------------------------------
        //  1. Prevent overlapping room stays
        // -------------------------------------------------
        $existingBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->orderBy('check_in')
            ->get();

        $newIn  = strtotime($data['check_in']);
        $newOut = strtotime($data['check_out']);

        foreach ($existingBooking as $b) {
            $oldIn  = strtotime($b->check_in);
            $oldOut = strtotime($b->check_out);

            if ($newIn < $oldOut && $newOut > $oldIn) {
                return redirect()->back()
                    ->withErrors([
                        'check_in' => "You already have an active stay from {$b->check_in} to {$b->check_out}. 
                        You cannot book overlapping room stays."
                    ])
                    ->withInput();
            }
        }

        // -------------------------------------------------
        //  2. Price calculation
        // -------------------------------------------------
        $pricePerNight = $room->price;

        $nights = Carbon::parse($data['check_in'])
            ->diffInDays(Carbon::parse($data['check_out'])) ?: 1;

        $total = $nights * $pricePerNight;

        return view('bookings.confirmation', [
            'title'    => 'Confirm Room Booking',
            'itemName' => $room->name,
            'details'  => [
                'Room'            => $room->name,
                'Check-in'        => $data['check_in'],
                'Check-out'       => $data['check_out'],
                'Guests'          => $data['guests'],
                'Price per night' => '$' . $pricePerNight,
                'Nights'          => $nights,
                'Total'           => '$' . $total,
            ],
            'hidden' => [
                'check_in'        => $data['check_in'],
                'check_out'       => $data['check_out'],
                'guests'          => $data['guests'],
                'price_per_night' => $pricePerNight,
                'nights'          => $nights,
                'total'           => $total,
            ],
            'storeRoute' => route('room.book.store', ['roomName' => $room->name]),
        ]);
    }

    /**
     * Store booking in database
     */
    public function store(Request $request, $roomName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $roomName = urldecode($roomName);

        $room = Room::where('name', $roomName)->firstOrFail();

        // Validate again
        $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1|max:' . $room->capacity,
        ]);

        // -------------------------------------------------
        //  DOUBLE CHECK AGAIN BEFORE SAVING
        // -------------------------------------------------
        $existingBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->orderBy('check_in')
            ->get();

        $newIn  = strtotime($request->check_in);
        $newOut = strtotime($request->check_out);

        foreach ($existingBooking as $b) {
            $oldIn  = strtotime($b->check_in);
            $oldOut = strtotime($b->check_out);

            if ($newIn < $oldOut && $newOut > $oldIn) {
                return redirect()->route('customer.dashboard')
                    ->with('error', "Cannot book a room overlapping your existing stay ({$b->check_in} to {$b->check_out}).");
            }
        }

        RoomBooking::create([
            'user_id'   => Auth::id(),
            'room_name' => $room->name,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'guests'    => $request->guests,
            'status'    => 'booked',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your room booking has been confirmed.');
    }

    /**
     * CUSTOMER — Cancel their room booking
     */
    public function cancel($id)
    {
        $booking = RoomBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your room booking has been cancelled.');
    }
}
