<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Balozi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BaloziController extends Controller
{
    // Show create form
    public function create()
    {
        return view('mwenyekiti.balozi.create');
    }

    // Store new Balozi
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:balozi,email',
                'phone' => 'required|string|unique:balozi,phone',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'national_id' => 'required|string|max:255',
                'street_village' => 'required|string|max:255',
                'shina' => 'required|string|max:255',
                'shina_number' => 'required|string|max:255',
                'photo' => 'nullable|image|max:2048',
                'is_active' => 'required|boolean',
            ]);

            // Add mwenyekiti_id from authenticated user
            $validated['mwenyekiti_id'] = auth()->id();

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('balozi/photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $balozi = Balozi::create($validated);

            return redirect()->route('mwenyekiti.balozi.show', $balozi->id)
                ->with('success', 'Balozi created successfully.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating Balozi: ' . $e->getMessage());
        }
    }

    // List Balozi (only those created by the authenticated Mwenyekiti)
    public function index()
    {
        $balozi = Balozi::where('mwenyekiti_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        return view('mwenyekiti.balozi.manage', compact('balozi'));
    }

    // Show single Balozi details
    public function show(Balozi $balozi)
    {
        // Check if the authenticated Mwenyekiti owns this Balozi
        if ($balozi->mwenyekiti_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('mwenyekiti.balozi.show', compact('balozi'));
    }

    // Show edit form
    public function edit(Balozi $balozi)
    {
        // Check if the authenticated Mwenyekiti owns this Balozi
        if ($balozi->mwenyekiti_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('mwenyekiti.balozi.edit', compact('balozi'));
    }

    // Update Balozi
    public function update(Request $request, Balozi $balozi)
    {
        // Check if the authenticated Mwenyekiti owns this Balozi
        if ($balozi->mwenyekiti_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:balozi,email,' . $balozi->id,
                'phone' => 'required|string|unique:balozi,phone,' . $balozi->id,
                'street_village' => 'required|string|max:255',
                'shina' => 'required|string|max:255',
                'shina_number' => 'required|string|max:255',
                'photo' => 'nullable|image|max:2048',
                'is_active' => 'required|boolean',
            ]);

            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($balozi->photo) {
                    Storage::disk('public')->delete($balozi->photo);
                }
                $photoPath = $request->file('photo')->store('balozi/photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $balozi->update($validated);

            return redirect()->route('mwenyekiti.balozi.show', $balozi->id)
                ->with('success', 'Balozi updated successfully.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating Balozi: ' . $e->getMessage());
        }
    }

    // Search Balozi
    public function search(Request $request)
    {
        $search = $request->get('search');

        $balozi = Balozi::where('mwenyekiti_id', auth()->id())
            ->where(function($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('street_village', 'like', "%{$search}%")
                    ->orWhere('shina', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('mwenyekiti.balozi.manage', compact('balozi'));
    }
}