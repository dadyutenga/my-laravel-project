<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\BaloziAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class PreferencesController extends Controller
{
    // Get the ID of the currently logged-in Balozi from session or Auth
    protected function getBaloziId()
    {
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        return $baloziId;
    }

    public function index()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $baloziAuth = BaloziAuth::where('balozi_id', $baloziId)->first();
        
        // Handle case where no auth record exists
        if (!$baloziAuth) {
            return redirect()->back()->with('error', 'Authentication record not found. Please contact administrator.');
        }
        
        return view('Balozi.Preferences.index', compact('baloziAuth'));
    }

    public function updatePassword(Request $request)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $baloziAuth = BaloziAuth::where('balozi_id', $baloziId)->first();
        
        if (!$baloziAuth) {
            return back()->with('error', 'Authentication record not found.');
        }

        // Check if current password is correct
        if (!Hash::check($request->current_password, $baloziAuth->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password only
        $baloziAuth->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}