<?php

namespace App\Http\Controllers;

use App\Models\FerryID;
use Illuminate\Http\Request;

class FerryIDController extends Controller
{
    /**
     * Restrict access to Admin & Staff only
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role, ['admin', 'staff'])) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Show all Ferry IDs and registered customers
     */
    public function index()
    {
        $ferryIDs = FerryID::with('users')->get();

        return view('ferry_ids.index', compact('ferryIDs'));
    }

    /**
     * Generate next Ferry ID automatically
     */
    public function generate()
    {
        $last = FerryID::orderBy('id', 'desc')->first();

        if ($last) {
            $number = (int) str_replace('FID', '', $last->code);
            $newCode = 'FID' . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'FID0001';
        }

        FerryID::create([
            'code' => $newCode,
        ]);

        return back()->with('success', "Ferry ID {$newCode} generated successfully.");
    }
}
