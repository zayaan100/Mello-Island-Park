<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityBooking;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityBookingController extends Controller
{
    /**
     * Show activity booking form dynamically.
     */
    public function showForm($activityName)
    {
        $decodedName = urldecode($activityName);

        $activity = Activity::where('name', $decodedName)->firstOrFail();

        return view('bookings.activities', [
            'activity'     => $activity,
            'activityName' => $activity->name,
            'price'        => $activity->price,
        ]);
    }

    /**
     * Confirm booking before saving.
     */
    public function confirm(Request $request, $activityName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $decodedName = urldecode($activityName);

        $activity = Activity::where('name', $decodedName)->firstOrFail();

        $data = $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'people' => 'required|integer|min:1|max:6',
        ]);

        // -------------------------------
        // 🔥 VALIDATE AGAINST ROOM STAY
        // -------------------------------
        $roomBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->latest()
            ->first();

        if ($roomBooking) {
            $checkIn  = strtotime($roomBooking->check_in);
            $checkOut = strtotime($roomBooking->check_out);
            $activityDate = strtotime($data['date']);

            if ($activityDate < $checkIn || $activityDate > $checkOut) {
                return redirect()->back()
                    ->withErrors([
                        'date' => "You can only book activities between your stay: {$roomBooking->check_in} to {$roomBooking->check_out}."
                    ])
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->withErrors([
                    'date' => "You must book a room first before booking activities."
                ])
                ->withInput();
        }

        $price = $activity->price;
        $total = $price * $data['people'];

        $hidden = $data + [
            'price' => $price,
            'total' => $total,
        ];

        $details = [
            'Activity' => $activity->name,
            'Date'     => $data['date'],
            'Guests'   => $data['people'],
            'Price'    => '$' . $price . ' / person',
            'Total'    => '$' . $total,
        ];

        return view('bookings.confirmation', [
            'title'      => 'Confirm Activity Booking',
            'itemName'   => $activity->name,
            'details'    => $details,
            'hidden'     => $hidden,
            'storeRoute' => route('activity.book.store', ['activityName' => $activity->name]),
        ]);
    }

    /**
     * Save confirmed booking.
     */
    public function store(Request $request, $activityName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $decodedName = urldecode($activityName);

        $activity = Activity::where('name', $decodedName)->firstOrFail();

        $request->validate([
            'date' => 'required|date',
        ]);

        // -------------------------------
        // 🔥 VALIDATE AGAIN BEFORE SAVE
        // -------------------------------
        $roomBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->latest()
            ->first();

        if ($roomBooking) {
            $checkIn  = strtotime($roomBooking->check_in);
            $checkOut = strtotime($roomBooking->check_out);
            $activityDate = strtotime($request->date);

            if ($activityDate < $checkIn || $activityDate > $checkOut) {
                return redirect()->route('customer.dashboard')
                    ->with('error', "Cannot book activity outside your stay dates ({$roomBooking->check_in} to {$roomBooking->check_out}).");
            }
        } else {
            return redirect()->route('customer.dashboard')
                ->with('error', "You must book a room before booking activities.");
        }

        ActivityBooking::create([
            'user_id'       => Auth::id(),
            'activity_name' => $activity->name,
            'date'          => $request->date,
            'status'        => 'booked',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your activity booking has been confirmed.');
    }

    /**
     * CUSTOMER — Cancel their activity booking
     */
    public function cancel($id)
    {
        $booking = ActivityBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your activity booking has been cancelled.');
    }
}
