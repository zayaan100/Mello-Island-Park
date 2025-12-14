<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffManagementController extends Controller
{
    // Show all staff
    public function index()
    {
        $staff = User::where('role', 'staff')->get();
        return view('admin.staff.index', compact('staff'));
    }

    // Show create staff form
    public function create()
    {
        return view('admin.staff.create');
    }

    // Store new staff
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6',
            'dob'         => 'required',
            'gender'      => 'required',
            'nationality' => 'required',
        ]);

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'staff',
            'dob'         => $request->dob,
            'gender'      => $request->gender,
            'nationality' => $request->nationality,
        ]);

        return redirect('/admin/staff')->with('success', 'Staff created successfully!');
    }

    // DELETE staff member
    public function destroy($id)
    {
        $staff = User::findOrFail($id);

        // (Optional safety) Prevent deleting own admin account
        if (auth()->id() == $staff->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $staff->delete();

        return redirect('/admin/staff')->with('success', 'Staff removed successfully!');
    }
}
