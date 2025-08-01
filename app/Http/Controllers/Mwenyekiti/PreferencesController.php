<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MwenyekitiAuth;
use App\Models\Mwenyekiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PreferencesController extends Controller
{
    /**
     * Display the preferences page
     */
    public function index()
    {
        $mwenyekitiId = session('mwenyekiti_id');
        
        if (!$mwenyekitiId) {
            return redirect()->route('mwenyekiti.login')
                ->with('error', 'Tafadhali ingia kwanza');
        }

        // Get the authenticated mwenyekiti from session
        $mwenyekiti = MwenyekitiAuth::find($mwenyekitiId);
        
        if (!$mwenyekiti) {
            session()->forget('mwenyekiti_id');
            return redirect()->route('mwenyekiti.login')
                ->with('error', 'Akaunti yako haipatikani');
        }

        // Get related mwenyekiti data (if exists)
        $mwenyekitiData = $mwenyekiti->mwenyekiti ?? (object)[
            'email' => null,
            'phone' => null,
            'id' => null
        ];
        
        return view('Mwenyekiti.Preferences.index', compact('mwenyekiti', 'mwenyekitiData'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        try {
            $mwenyekitiId = session('mwenyekiti_id');
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login');
            }

            $request->validate([
                'current_password' => ['required', 'string'],
                'password' => [
                    'required',
                    'string',
                    'confirmed',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
                ],
            ], [
                'current_password.required' => 'Nenosiri la sasa ni lazima',
                'password.required' => 'Nenosiri jipya ni lazima',
                'password.min' => 'Nenosiri lazima liwe na angalau herufi 8',
                'password.regex' => 'Nenosiri lazima liwe na herufi kubwa, ndogo, nambari na alama maalum',
                'password.confirmed' => 'Uthibitisho wa nenosiri haulingani',
            ]);

            $mwenyekiti = MwenyekitiAuth::find($mwenyekitiId);

            // Verify current password
            if (!Hash::check($request->current_password, $mwenyekiti->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Nenosiri la sasa si sahihi'])
                    ->withInput();
            }

            // Check if new password is different from current
            if (Hash::check($request->password, $mwenyekiti->password)) {
                return redirect()->back()
                    ->withErrors(['password' => 'Nenosiri jipya lazima liwe tofauti na la sasa'])
                    ->withInput();
            }

            // Update password
            $mwenyekiti->update([
                'password' => Hash::make($request->password),
                'updated_at' => now(),
            ]);

            return redirect()->back()
                ->with('success', 'Nenosiri limebadilishwa kwa ufanisi! 🔐');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Password change error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kubadilisha nenosiri. Jaribu tena.');
        }
    }

    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        try {
            $mwenyekitiId = session('mwenyekiti_id');
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login');
            }

            $mwenyekiti = MwenyekitiAuth::find($mwenyekitiId);

            $request->validate([
                'username' => [
                    'required',
                    'string',
                    'min:3',
                    'max:50',
                    'regex:/^[a-zA-Z0-9._-]+$/',
                    'unique:mwenyekiti_auths,username,' . $mwenyekiti->id
                ],
                'email' => [
                    'nullable',
                    'email',
                    'max:255',
                ],
                'phone' => [
                    'nullable',
                    'string',
                    'regex:/^(\+255|0)[67][0-9]{8}$/',
                ],
            ], [
                'username.required' => 'Jina la mtumiaji ni lazima',
                'username.min' => 'Jina la mtumiaji lazima liwe na angalau herufi 3',
                'username.max' => 'Jina la mtumiaji lisilidi herufi 50',
                'username.regex' => 'Jina la mtumiaji linaweza kuwa na herufi, nambari, na alama (. _ -) tu',
                'username.unique' => 'Jina hili la mtumiaji tayari limetumiwa',
                'email.email' => 'Barua pepe si sahihi',
                'phone.regex' => 'Nambari ya simu si sahihi (mfano: +255712345678 au 0712345678)',
            ]);

            // Update auth table
            $mwenyekiti->update([
                'username' => $request->username,
            ]);

            // Try to update related mwenyekiti record if exists
            if ($mwenyekiti->mwenyekiti && ($request->filled('email') || $request->filled('phone'))) {
                $updateData = [];
                
                if ($request->filled('email')) {
                    $updateData['email'] = $request->email;
                }
                
                if ($request->filled('phone')) {
                    $updateData['phone'] = $request->phone;
                }
                
                if (!empty($updateData)) {
                    $updateData['updated_at'] = now();
                    $mwenyekiti->mwenyekiti->update($updateData);
                }
            }

            return redirect()->back()
                ->with('success', 'Taarifa za akaunti zimesasishwa kwa ufanisi! ✅');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kusasisha taarifa. Jaribu tena.');
        }
    }

    /**
     * Check password strength (AJAX)
     */
    public function checkPasswordStrength(Request $request)
    {
        $password = $request->password;
        $score = 0;
        $feedback = [];

        // Length check
        if (strlen($password) >= 8) {
            $score += 20;
        } else {
            $feedback[] = 'Ongeza herufi zaidi (angalau 8)';
        }

        // Uppercase check
        if (preg_match('/[A-Z]/', $password)) {
            $score += 20;
        } else {
            $feedback[] = 'Ongeza herufi kubwa (A-Z)';
        }

        // Lowercase check
        if (preg_match('/[a-z]/', $password)) {
            $score += 20;
        } else {
            $feedback[] = 'Ongeza herufi ndogo (a-z)';
        }

        // Numbers check
        if (preg_match('/[0-9]/', $password)) {
            $score += 20;
        } else {
            $feedback[] = 'Ongeza nambari (0-9)';
        }

        // Symbols check
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            $score += 20;
        } else {
            $feedback[] = 'Ongeza alama maalum (@, #, $, nk)';
        }

        // Determine strength level
        if ($score >= 80) {
            $strength = 'strong';
            $message = 'Nenosiri ni lenye nguvu! 💪';
            $color = '#10b981';
        } elseif ($score >= 60) {
            $strength = 'medium';
            $message = 'Nenosiri ni la wastani 👍';
            $color = '#f59e0b';
        } else {
            $strength = 'weak';
            $message = 'Nenosiri ni dhaifu 👎';
            $color = '#ef4444';
        }

        return response()->json([
            'score' => $score,
            'strength' => $strength,
            'message' => $message,
            'color' => $color,
            'feedback' => $feedback,
        ]);
    }

    /**
     * Get security activities (simplified version)
     */
    public function getSecurityActivities()
    {
        try {
            $mwenyekitiId = session('mwenyekiti_id');
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Haujaruhusiwa'], 401);
            }

            $mwenyekiti = MwenyekitiAuth::find($mwenyekitiId);
            
            // Simple mock data for now (you can enhance this later)
            $activities = [
                [
                    'description' => 'Uliingia kwenye akaunti',
                    'created_at' => now()->format('d/m/Y H:i'),
                    'created_at_human' => 'sasa hivi',
                ],
                [
                    'description' => 'Umetembelea ukurasa wa mipangilio',
                    'created_at' => now()->subMinutes(30)->format('d/m/Y H:i'),
                    'created_at_human' => 'dakika 30 zilizopita',
                ],
                [
                    'description' => 'Umetembelea dashboard',
                    'created_at' => now()->subHours(2)->format('d/m/Y H:i'),
                    'created_at_human' => 'saa 2 zilizopita',
                ],
            ];

            return response()->json([
                'activities' => $activities,
                'total' => count($activities),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Kuna tatizo katika kupata historia ya usalama',
                'activities' => [],
                'total' => 0,
            ], 500);
        }
    }
}