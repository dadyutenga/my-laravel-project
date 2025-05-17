<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class CreateAdminController extends Controller
{
    /**
     * Display a listing of admins
     */
    public function index()
    {
        $admins = Admin::with('details')->where('role', 'admin')->get();
        return view('superadmin.AdminManagement.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin
     */
    public function create()
    {
        return view('superadmin.AdminManagement.create');
    }

    /**
     * Store a newly created admin in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', Password::defaults()],
            'phone_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'country' => ['required', 'string', 'max:100'],
            'region' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'picture' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        try {
            DB::beginTransaction();

            // Create admin user
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin',
                'is_active' => true,
            ]);

            // Handle profile picture upload
            $picturePath = null;
            if ($request->hasFile('picture')) {
                $picturePath = $request->file('picture')->store('admin-pictures', 'public');
            }

            // Create admin details
            $admin->details()->create([
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'picture' => $picturePath,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'country' => $request->country,
                'region' => $request->region,
                'postal_code' => $request->postal_code,
            ]);

            DB::commit();

            return redirect()->route('superadmin.admins.index')
                ->with('success', 'Admin account created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create admin account. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show admin details
     */
    public function show(Admin $admin)
    {
        $admin->load('details');
        return response()->json($admin);
    }

    /**
     * Show the form for editing an admin
     */
    public function edit(Admin $admin)
    {
        $admin->load('details');
        return view('superadmin.adminmanagement.edit', compact('admin'));
    }

    /**
     * Update the specified admin
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('superadmin.admins.index')
            ->with('success', 'Admin password updated successfully.');
    }

    /**
     * Toggle admin account status
     */
    public function toggleStatus(Admin $admin)
    {
        $admin->update(['is_active' => !$admin->is_active]);
        $status = $admin->is_active ? 'activated' : 'deactivated';
        
        return back()->with('success', "Admin account has been {$status}");
    }

    /**
     * Remove the specified admin
     */
    public function destroy(Admin $admin)
    {
        try {
            DB::beginTransaction();

            // Delete admin details first
            if ($admin->details) {
                // Delete profile picture if exists
                if ($admin->details->picture) {
                    \Storage::disk('public')->delete($admin->details->picture);
                }
                $admin->details->delete();
            }

            // Delete admin
            $admin->delete();

            DB::commit();

            return redirect()->route('superadmin.admins.index')
                ->with('success', 'Admin account deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete admin account. Please try again.');
        }
    }
}
