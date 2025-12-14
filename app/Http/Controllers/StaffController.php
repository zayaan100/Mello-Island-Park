<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Spa;
use App\Models\Activity;

use App\Models\RoomBooking;
use App\Models\SpaBooking;
use App\Models\ActivityBooking;

use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STAFF DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $roomBookings     = RoomBooking::with('user')->latest()->get();
        $spaBookings      = SpaBooking::with('user')->latest()->get();
        $activityBookings = ActivityBooking::with('user')->latest()->get();

        return view('staff.staff-dashboard', compact(
            'roomBookings',
            'spaBookings',
            'activityBookings'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CANCEL ANY BOOKING
    |--------------------------------------------------------------------------
    */
    public function cancel($type, $id)
    {
        switch ($type) {
            case 'room':
                $booking = RoomBooking::findOrFail($id);
                break;

            case 'spa':
                $booking = SpaBooking::findOrFail($id);
                break;

            case 'activity':
                $booking = ActivityBooking::findOrFail($id);
                break;

            default:
                abort(404);
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('msg', 'Booking cancelled.');
    }



    /*
    |--------------------------------------------------------------------------
    | CUSTOMER LIST
    |--------------------------------------------------------------------------
    */
    public function customers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('staff.customers', compact('customers'));
    }



    /*
    |--------------------------------------------------------------------------
    | SELECT BOOKING TYPE (Room / Spa / Activity)
    |--------------------------------------------------------------------------
    */
    public function selectBookingType($customerId)
    {
        $customer = User::findOrFail($customerId);
        return view('staff.select-booking-type', compact('customer'));
    }




    /*
    |--------------------------------------------------------------------------
    | NEW REQUIRED METHODS (Fix missing routes)
    |--------------------------------------------------------------------------
    | These show the list of Rooms, Spa items, or Activities for staff to pick.
    */
    public function selectRoom($customerId)
    {
        $customer = User::findOrFail($customerId);
        $rooms = Room::all();

        return view('staff.select-room', compact('customer', 'rooms'));
    }

    public function selectSpa($customerId)
    {
        $customer = User::findOrFail($customerId);
        $spaItems = Spa::all();

        return view('staff.select-spa', compact('customer', 'spaItems'));
    }

    public function selectActivity($customerId)
    {
        $customer = User::findOrFail($customerId);
        $activities = Activity::all();

        return view('staff.select-activity', compact('customer', 'activities'));
    }




    /*
    |--------------------------------------------------------------------------
    | ROOM BOOKING FOR CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function roomForm($customerId, $roomName)
    {
        $customer = User::findOrFail($customerId);
        $room     = Room::where('name', $roomName)->firstOrFail();

        return view('staff.book-room', compact('customer', 'room'));
    }


    public function roomStore(Request $request, $customerId, $roomName)
    {
        $customer = User::findOrFail($customerId);
        $room     = Room::where('name', $roomName)->firstOrFail();

        $data = $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1|max:' . $room->capacity,
        ]);

        $existing = RoomBooking::where('user_id', $customer->id)
            ->where('status', 'booked')
            ->get();

        $newIn  = strtotime($data['check_in']);
        $newOut = strtotime($data['check_out']);

        foreach ($existing as $b) {
            $oldIn  = strtotime($b->check_in);
            $oldOut = strtotime($b->check_out);

            if ($newIn < $oldOut && $newOut > $oldIn) {
                return back()->withErrors([
                    'check_in' => "Customer already has a stay from {$b->check_in} to {$b->check_out}."
                ]);
            }
        }

        RoomBooking::create([
            'user_id'   => $customer->id,
            'room_name' => $room->name,
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests'    => $data['guests'],
            'status'    => 'booked',
        ]);

        return redirect()->route('staff.dashboard')->with('msg', 'Room booked successfully!');
    }




    /*
    |--------------------------------------------------------------------------
    | SPA BOOKING FOR CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function spaForm($customerId, $treatmentName)
    {
        $customer = User::findOrFail($customerId);
        $spa      = Spa::where('name', $treatmentName)->firstOrFail();

        return view('staff.book-spa', compact('customer', 'spa'));
    }


    public function spaStore(Request $request, $customerId, $treatmentName)
    {
        $customer = User::findOrFail($customerId);
        $spa      = Spa::where('name', $treatmentName)->firstOrFail();

        $data = $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'people' => 'required|integer|min:1|max:4',
        ]);

        $stay = RoomBooking::where('user_id', $customer->id)
            ->where('status', 'booked')
            ->latest()
            ->first();

        if (!$stay) {
            return back()->withErrors([
                'date' => "Customer must have a room booked first."
            ]);
        }

        $spaDate = strtotime($data['date']);
        $in  = strtotime($stay->check_in);
        $out = strtotime($stay->check_out);

        if ($spaDate < $in || $spaDate > $out) {
            return back()->withErrors([
                'date' => "Date must be between customer's stay ({$stay->check_in} to {$stay->check_out})."
            ]);
        }

        SpaBooking::create([
            'user_id'        => $customer->id,
            'treatment_name' => $spa->name,
            'date'           => $data['date'],
            'status'         => 'booked',
        ]);

        return redirect()->route('staff.dashboard')->with('msg', 'Spa booked successfully!');
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVITY BOOKING FOR CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function activityForm($customerId, $activityName)
    {
        $customer = User::findOrFail($customerId);
        $activity = Activity::where('name', $activityName)->firstOrFail();

        return view('staff.book-activity', compact('customer', 'activity'));
    }


    public function activityStore(Request $request, $customerId, $activityName)
    {
        $customer = User::findOrFail($customerId);
        $activity = Activity::where('name', $activityName)->firstOrFail();

        $data = $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'people' => 'required|integer|min:1|max:6',
        ]);

        $stay = RoomBooking::where('user_id', $customer->id)
            ->where('status', 'booked')
            ->latest()
            ->first();

        if (!$stay) {
            return back()->withErrors([
                'date' => "Customer must have a room booked first."
            ]);
        }

        $activityDate = strtotime($data['date']);
        $in  = strtotime($stay->check_in);
        $out = strtotime($stay->check_out);

        if ($activityDate < $in || $activityDate > $out) {
            return back()->withErrors([
                'date' => "Activity must be within customer's stay ({$stay->check_in} to {$stay->check_out})."
            ]);
        }

        ActivityBooking::create([
            'user_id'       => $customer->id,
            'activity_name' => $activity->name,
            'date'          => $data['date'],
            'status'        => 'booked',
        ]);

        return redirect()->route('staff.dashboard')->with('msg', 'Activity booked successfully!');
    }
}
