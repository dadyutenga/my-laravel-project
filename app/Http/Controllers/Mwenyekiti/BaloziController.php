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

            return redirect()->route('mwenyekiti.balozi.index')
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
                        ->get();

        return view('mwenyekiti.balozi.index', compact('balozi'));
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
}