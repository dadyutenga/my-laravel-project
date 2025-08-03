<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mwenyekiti;
use App\Models\MwenyekitiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SalimMbise\TanzaniaRegions\TanzaniaRegions;

class MwenyekitiController extends Controller
{
    // Show create form
    public function create()
    {
        $tanzaniaRegions = new TanzaniaRegions();
        $regions = $tanzaniaRegions->getRegions();
        return view('Admin.mwenyekiti.create', compact('regions'));
    }

    // Store new Mwenyekiti
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:mwenyekiti,email',
                'phone' => 'required|string|unique:mwenyekiti,phone',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'national_id' => 'required|string|max:255',
                'ward' => 'required|string|max:255',
                'mtaa' => 'required|string|max:255',
                'region' => 'required|string|max:255',
                'photo' => 'nullable|image|max:2048',
                'is_active' => 'required|boolean',
            ]);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('mwenyekiti/photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $mwenyekiti = Mwenyekiti::create($validated);

            return redirect()->route('admin.mwenyekiti.manage')
                ->with('success', 'Mwenyekiti created successfully.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating Mwenyekiti: ' . $e->getMessage());
        }
    }

    // Show manage page with list and details
    public function manage(Request $request)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->get();
        $mode = $request->query('mode', 'list');
        $id = $request->query('id', null);
        $selectedMwenyekiti = $id ? Mwenyekiti::with('auth')->findOrFail($id) : null;

        return view('Admin.mwenyekiti.manage', compact('mwenyekiti', 'mode', 'selectedMwenyekiti'));
    }

    // Update Mwenyekiti
    public function update(Request $request, Mwenyekiti $mwenyekiti)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:mwenyekiti,email,' . $mwenyekiti->id,
            'phone' => 'required|string|unique:mwenyekiti,phone,' . $mwenyekiti->id,
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'national_id' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'mtaa' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($mwenyekiti->photo) {
                Storage::disk('public')->delete($mwenyekiti->photo);
            }
            $photoPath = $request->file('photo')->store('mwenyekiti/photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $mwenyekiti->update($validated);

        return redirect()->route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $mwenyekiti->id])
            ->with('success', 'Mwenyekiti updated successfully.');
    }

    // Delete Mwenyekiti
    public function destroy(Mwenyekiti $mwenyekiti)
    {
        if ($mwenyekiti->photo) {
            Storage::disk('public')->delete($mwenyekiti->photo);
        }
        
        $mwenyekiti->delete();

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti deleted successfully.');
    }

    // Show create account form
    public function createAccount(Request $request)
    {
        $id = $request->query('id', null);
        $mwenyekiti = null;
        if ($id) {
            $mwenyekiti = Mwenyekiti::find($id);
            if (!$mwenyekiti) {
                return redirect()->route('admin.mwenyekiti.manage')
                    ->with('error', 'Mwenyekiti not found. Please select a valid Mwenyekiti.');
            }
        }
        return view('Admin.mwenyekiti.manageAcc', compact('mwenyekiti'));
    }

    // Store new Mwenyekiti account
    public function storeAccount(Request $request, $id)
    {
        $mwenyekiti = Mwenyekiti::findOrFail($id);

        if ($mwenyekiti->auth) {
            return redirect()->route('admin.mwenyekiti.createAccount', ['id' => $id])
                ->with('error', 'Account already exists for this Mwenyekiti.');
        }

        $validated = $request->validate([
            'username' => 'required|string|unique:mwenyekiti_auths,username',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'required|boolean',
        ]);

        MwenyekitiAuth::create([
            'mwenyekiti_id' => $mwenyekiti->id,
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $id])
            ->with('success', 'Account created successfully.');
    }

    // Update Mwenyekiti account
    public function updateAccount(Request $request, $id)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->findOrFail($id);

        if (!$mwenyekiti->auth) {
            return redirect()->route('admin.mwenyekiti.createAccount', ['id' => $id])
                ->with('error', 'No account exists for this Mwenyekiti.');
        }

        $validated = $request->validate([
            'username' => 'required|string|unique:mwenyekiti_auths,username,' . $mwenyekiti->auth->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_active' => 'required|boolean',
        ]);

        $updateData = [
            'username' => $validated['username'],
            'is_active' => $validated['is_active'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $mwenyekiti->auth->update($updateData);

        return redirect()->route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $id])
            ->with('success', 'Account updated successfully.');
    }

    // Delete Mwenyekiti account
    public function deleteAccount($id)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->findOrFail($id);

        if (!$mwenyekiti->auth) {
            return redirect()->route('admin.mwenyekiti.createAccount', ['id' => $id])
                ->with('error', 'No account exists for this Mwenyekiti.');
        }

        $mwenyekiti->auth->delete();

        return redirect()->route('admin.mwenyekiti.manage', ['mode' => 'view', 'id' => $id])
            ->with('success', 'Account deleted successfully.');
    }

    // List all accounts
    public function manageAccounts()
    {
        $mwenyekiti = Mwenyekiti::with('auth')->get();
        return view('Admin.mwenyekiti.manageAcc', compact('mwenyekiti'));
    }

    // Add these methods to your MwenyekitiController class
    public function getDistricts($region)
    {
        $tanzaniaRegions = new TanzaniaRegions();
        $districts = $tanzaniaRegions->getDistricts($region);
        return response()->json($districts);
    }

  
}