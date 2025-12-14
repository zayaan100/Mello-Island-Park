<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use App\Models\SpaBooking;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaBookingController extends Controller
{
    /**
     * Show spa booking form dynamically.
     */
    public function showForm($treatmentName)
    {
        $decodedName = urldecode($treatmentName);

        $spa = Spa::where('name', $decodedName)->firstOrFail();

        return view('bookings.spa', [
            'spa'           => $spa,
            'treatmentName' => $spa->name,
            'price'         => $spa->price,
        ]);
    }

    /**
     * Confirm booking before storing.
     */
    public function confirm(Request $request, $treatmentName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $decodedName = urldecode($treatmentName);

        $spa = Spa::where('name', $decodedName)->firstOrFail();

        $data = $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'people' => 'required|integer|min:1|max:4',
        ]);

        // -------------------------------------------------
        // 🔥 VALIDATE SPA DATE AGAINST USER ROOM BOOKING
        // -------------------------------------------------
        $roomBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->latest()
            ->first();

        if ($roomBooking) {
            $checkIn  = strtotime($roomBooking->check_in);
            $checkOut = strtotime($roomBooking->check_out);
            $spaDate  = strtotime($data['date']);

            if ($spaDate < $checkIn || $spaDate > $checkOut) {
                return redirect()->back()
                    ->withErrors([
                        'date' => "You can only book spa treatments during your stay ({$roomBooking->check_in} to {$roomBooking->check_out})."
                    ])
                    ->withInput();
            }
        } else {
            return redirect()->back()
                ->withErrors([
                    'date' => "You must book a room before booking spa services."
                ])
                ->withInput();
        }

        $price = $spa->price;
        $total = $price * $data['people'];

        $hidden = $data + [
            'price' => $price,
            'total' => $total,
        ];

        $details = [
            'Treatment' => $spa->name,
            'Date'      => $data['date'],
            'Guests'    => $data['people'],
            'Price'     => '$' . $price . ' / person',
            'Total'     => '$' . $total,
        ];

        return view('bookings.confirmation', [
            'title'      => 'Confirm Spa Booking',
            'itemName'   => $spa->name,
            'details'    => $details,
            'hidden'     => $hidden,
            'storeRoute' => route('spa.book.store', ['treatmentName' => $spa->name]),
        ]);
    }

    /**
     * Store confirmed booking.
     */
    public function store(Request $request, $treatmentName)
    {
        // 🔐 FINAL SAFETY CHECK — MUST HAVE FERRY ID
        if (!Auth::user()->hasFerryID()) {
            return redirect()->route('ferry.required');
        }

        $decodedName = urldecode($treatmentName);

        $spa = Spa::where('name', $decodedName)->firstOrFail();

        $request->validate([
            'date' => 'required|date',
        ]);

        // -------------------------------------------------
        // 🔥 VALIDATE AGAIN BEFORE SAVING
        // -------------------------------------------------
        $roomBooking = RoomBooking::where('user_id', Auth::id())
            ->where('status', 'booked')
            ->latest()
            ->first();

        if ($roomBooking) {
            $checkIn  = strtotime($roomBooking->check_in);
            $checkOut = strtotime($roomBooking->check_out);
            $spaDate  = strtotime($request->date);

            if ($spaDate < $checkIn || $spaDate > $checkOut) {
                return redirect()->route('customer.dashboard')
                    ->with('error', "Cannot book a spa treatment outside your stay dates ({$roomBooking->check_in} to {$roomBooking->check_out}).");
            }
        } else {
            return redirect()->route('customer.dashboard')
                ->with('error', "You must book a room before booking spa services.");
        }

        SpaBooking::create([
            'user_id'        => Auth::id(),
            'treatment_name' => $spa->name,
            'date'           => $request->date,
            'status'         => 'booked',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your spa booking has been confirmed.');
    }

    /**
     * CUSTOMER — Cancel their spa booking
     */
    public function cancel($id)
    {
        $booking = SpaBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Your spa booking has been cancelled.');
    }
}
