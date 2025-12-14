<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spa;
use Illuminate\Support\Facades\Storage;

class AdminSpaController extends Controller
{
    public function index()
    {
        $spaServices = Spa::all();
        return view('admin.spa.index', compact('spaServices'));
    }

    public function create()
    {
        return view('admin.spa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('spa', 'public');
        }

        Spa::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $path,
        ]);

        return redirect()->route('admin.spa.index')
            ->with('success', 'Spa service created successfully.');
    }

    public function destroy($id)
    {
        $spa = Spa::findOrFail($id);

        if ($spa->image_path && Storage::disk('public')->exists($spa->image_path)) {
            Storage::disk('public')->delete($spa->image_path);
        }

        $spa->delete();

        return redirect()->route('admin.spa.index')
            ->with('success', 'Spa service deleted successfully.');
    }
}
