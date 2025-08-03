<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        if (!$user instanceof \App\Models\Admin) {
            abort(500, 'Authenticated user is not an instance of the Admin model.');
        }
        
        // Load the details relationship or create empty one if doesn't exist
        $user->load('details');
        
        return view('Admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'country' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        // Update basic admin info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update or create admin details
        $detailsData = [
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'country' => $validated['country'],
            'region' => $validated['region'],
            'postal_code' => $validated['postal_code'],
        ];

        $user->details()->updateOrCreate(
            ['admin_id' => $user->id],
            $detailsData
        );

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(12)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The provided password does not match your current password.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password changed successfully');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::guard('admin')->user();

        if ($request->hasFile('picture')) {
            // Get current picture from details
            $currentPicture = $user->details?->picture;
            
            // Delete old picture if exists
            if ($currentPicture && Storage::disk('public')->exists($currentPicture)) {
                Storage::disk('public')->delete($currentPicture);
            }

            try {
                // Store new picture
                $path = $request->file('picture')->store('admin-avatars', 'public');
                
                // Update or create admin details with new picture
                $user->details()->updateOrCreate(
                    ['admin_id' => $user->id],
                    ['picture' => $path]
                );

                return redirect()->route('admin.profile')
                    ->with('success', 'Profile picture updated successfully');
            } catch (\Exception $e) {
                return back()->withErrors(['picture' => 'Failed to upload picture. Please try again.']);
            }
        }

        return back()->withErrors(['picture' => 'No image file provided.']);
    }
}