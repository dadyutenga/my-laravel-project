<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mwenyekiti;
use App\Models\MwenyekitiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MwenyekitiController extends Controller
{
    public function create()
    {
        return view('Admin.mwenyekiti.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mwenyekiti,email',
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'national_id' => 'required|string|max:50|unique:mwenyekiti,national_id',
            'ward' => 'required|string|max:255',
            'mtaa' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('mwenyekiti_photos', 'public');
            $validated['photo'] = $path;
        }

        $mwenyekiti = Mwenyekiti::create($validated);

        return redirect()->route('admin.mwenyekiti.createAccount', ['id' => $mwenyekiti->id])
            ->with('success', 'Mwenyekiti created successfully. Now create their account.');
    }

    public function manage(Request $request)
    {
        $mwenyekiti = Mwenyekiti::with('auth')->get();
        $mode = $request->query('mode', 'list');
        $id = $request->query('id', null);
        $selectedMwenyekiti = $id ? Mwenyekiti::with('auth')->findOrFail($id) : null;

        return view('admin.mwenyekiti.manage', compact('mwenyekiti', 'mode', 'selectedMwenyekiti'));
    }

    public function update(Request $request, $id)
    {
        $mwenyekiti = Mwenyekiti::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mwenyekiti,email,' . $mwenyekiti->id,
            'phone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'national_id' => 'required|string|max:50|unique:mwenyekiti,national_id,' . $mwenyekiti->id,
            'ward' => 'required|string|max:255',
            'mtaa' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($mwenyekiti->photo && Storage::disk('public')->exists($mwenyekiti->photo)) {
                Storage::disk('public')->delete($mwenyekiti->photo);
            }
            $path = $request->file('photo')->store('mwenyekiti_photos', 'public');
            $validated['photo'] = $path;
        }

        $mwenyekiti->update($validated);

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti updated successfully');
    }

    public function destroy($id)
    {
        $mwenyekiti = Mwenyekiti::findOrFail($id);
        
        // Delete associated photo if exists
        if ($mwenyekiti->photo && Storage::disk('public')->exists($mwenyekiti->photo)) {
            Storage::disk('public')->delete($mwenyekiti->photo);
        }
        
        // Delete associated auth record if exists
        if ($mwenyekiti->auth) {
            $mwenyekiti->auth->delete();
        }
        
        $mwenyekiti->delete();

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti deleted successfully');
    }

    public function createAccount(Request $request)
    {
        $id = $request->query('id', null);
        $mwenyekiti = $id ? Mwenyekiti::findOrFail($id) : null;
        return view('admin.mwenyekiti.manageAcc', compact('mwenyekiti'));
    }

    public function storeAccount(Request $request, $id)
    {
        $mwenyekiti = Mwenyekiti::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:mwenyekiti_auths,username',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        MwenyekitiAuth::create([
            'mwenyekiti_id' => $mwenyekiti->id,
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti account created successfully');
    }

    public function updateAccount(Request $request, $id)
    {
        $auth = MwenyekitiAuth::where('mwenyekiti_id', $id)->firstOrFail();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:mwenyekiti_auths,username,' . $auth->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        $auth->username = $validated['username'];
        if (!empty($validated['password'])) {
            $auth->password = Hash::make($validated['password']);
        }
        $auth->is_active = $validated['is_active'] ?? true;
        $auth->save();

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti account updated successfully');
    }

    public function toggleStatus($id)
    {
        $mwenyekiti = Mwenyekiti::findOrFail($id);
        $mwenyekiti->is_active = !$mwenyekiti->is_active;
        $mwenyekiti->save();

        // Also toggle associated auth record if exists
        if ($mwenyekiti->auth) {
            $mwenyekiti->auth->is_active = $mwenyekiti->is_active;
            $mwenyekiti->auth->save();
        }

        return redirect()->route('admin.mwenyekiti.manage')
            ->with('success', 'Mwenyekiti status updated successfully');
    }
}