<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BaloziAuth;
use App\Models\MwenyekitiAuth;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    public function __construct()
    {
        // Apply rate limiting to login methods
        $this->middleware('throttle:5,1')->only(['baloziLogin', 'mwenyekitiLogin']);
    }

    // Balozi Login
    public function showBaloziLoginForm()
    {
        return view('auth.balozi-login');
    }

    public function baloziLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $key = 'balozi_login_attempts_' . $request->ip();
        $maxAttempts = 5;
        $lockoutTime = 300; // 5 minutes in seconds

        // Check if IP has exceeded login attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('username');
        }

        // Find the balozi auth record
        $baloziAuth = BaloziAuth::where('username', $credentials['username'])
                               ->where('is_active', true)
                               ->first();

        if ($baloziAuth && Hash::check($credentials['password'], $baloziAuth->password)) {
            // Load the associated balozi
            $balozi = $baloziAuth->balozi;
            
            if (!$balozi || !$balozi->is_active) {
                RateLimiter::hit($key, $lockoutTime);
                return back()->withErrors([
                    'username' => 'This account is inactive.',
                ])->onlyInput('username');
            }

            // Create session
            session([
                'balozi_id' => $balozi->id,
                'balozi_auth_id' => $baloziAuth->id,
                'user_type' => 'balozi'
            ]);

            // Create session log
            Sessions::create([
                'session_id' => $request->session()->getId(),
                'user_type' => 'balozi',
                'user_id' => $balozi->id,
                'username' => $baloziAuth->username,
                'email' => $balozi->email ?? null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
                'is_active' => true,
            ]);

            $request->session()->regenerate();

            // Reset login attempts on successful login
            RateLimiter::clear($key);

            // Log successful login
            Log::info('Balozi login successful', [
                'username' => $request->username,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('balozi.dashboard');
        }

        // Increment failed login attempts
        RateLimiter::hit($key, $lockoutTime);

        // Log failed login attempt
        Log::warning('Balozi login failed', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    // Mwenyekiti Login
    public function showMwenyekitiLoginForm()
    {
        return view('auth.mwenyekiti-login');
    }

    public function mwenyekitiLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $key = 'mwenyekiti_login_attempts_' . $request->ip();
        $maxAttempts = 5;
        $lockoutTime = 300; // 5 minutes in seconds

        // Check if IP has exceeded login attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('username');
        }

        // Find the mwenyekiti auth record
        $mwenyekitiAuth = MwenyekitiAuth::where('username', $credentials['username'])
                                       ->where('is_active', true)
                                       ->first();

        if ($mwenyekitiAuth && Hash::check($credentials['password'], $mwenyekitiAuth->password)) {
            // Load the associated mwenyekiti
            $mwenyekiti = $mwenyekitiAuth->mwenyekiti;
            
            if (!$mwenyekiti || !$mwenyekiti->is_active) {
                RateLimiter::hit($key, $lockoutTime);
                return back()->withErrors([
                    'username' => 'This account is inactive.',
                ])->onlyInput('username');
            }

            // Create session
            session([
                'mwenyekiti_id' => $mwenyekiti->id,
                'mwenyekiti_auth_id' => $mwenyekitiAuth->id,
                'user_type' => 'mwenyekiti'
            ]);

            // Create session log
            Sessions::create([
                'session_id' => $request->session()->getId(),
                'user_type' => 'mwenyekiti',
                'user_id' => $mwenyekiti->id,
                'username' => $mwenyekitiAuth->username,
                'email' => $mwenyekiti->email ?? null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
                'is_active' => true,
            ]);

            $request->session()->regenerate();

            // Reset login attempts on successful login
            RateLimiter::clear($key);

            // Log successful login
            Log::info('Mwenyekiti login successful', [
                'username' => $request->username,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->route('mwenyekiti.dashboard');
        }

        // Increment failed login attempts
        RateLimiter::hit($key, $lockoutTime);

        // Log failed login attempt
        Log::warning('Mwenyekiti login failed', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    // Logout (shared for both Balozi and Mwenyekiti)
    public function logout(Request $request)
    {
        $userType = session('user_type');
        $sessionId = $request->session()->getId();
        
        // Update session log based on user type
        if ($userType === 'mwenyekiti') {
            $userId = session('mwenyekiti_id');
        } elseif ($userType === 'balozi') {
            $userId = session('balozi_id');
        }

        if (isset($userId) && $userType) {
            Sessions::where('session_id', $sessionId)
                    ->where('user_type', $userType)
                    ->where('user_id', $userId)
                    ->where('is_active', true)
                    ->update([
                        'logout_at' => now(),
                        'is_active' => false,
                    ]);
        }

        session()->forget([
            'balozi_id',
            'balozi_auth_id',
            'mwenyekiti_id',
            'mwenyekiti_auth_id',
            'user_type'
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login1');
    }

    public function showLoginForm()
    {
        return view('auth.Login1');
    }

    // Add new method to handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $key = 'login_attempts_' . $request->ip();
        $maxAttempts = 5;
        $lockoutTime = 300; // 5 minutes in seconds

        // Check if IP has exceeded login attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'username' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('username');
        }

        // First check if it's a Mwenyekiti
        $mwenyekitiAuth = MwenyekitiAuth::where('username', $credentials['username'])
                                       ->where('is_active', true)
                                       ->first();

        if ($mwenyekitiAuth && Hash::check($credentials['password'], $mwenyekitiAuth->password)) {
            return $this->handleMwenyekitiLogin($request, $mwenyekitiAuth, $key);
        }

        // If not Mwenyekiti, check if it's a Balozi
        $baloziAuth = BaloziAuth::where('username', $credentials['username'])
                               ->where('is_active', true)
                               ->first();

        if ($baloziAuth && Hash::check($credentials['password'], $baloziAuth->password)) {
            return $this->handleBaloziLogin($request, $baloziAuth, $key);
        }

        // If neither, increment failed login attempts
        RateLimiter::hit($key, $lockoutTime);

        // Log failed login attempt
        Log::warning('Login failed', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    private function handleMwenyekitiLogin(Request $request, MwenyekitiAuth $mwenyekitiAuth, $key)
    {
        $mwenyekiti = $mwenyekitiAuth->mwenyekiti;
        
        if (!$mwenyekiti || !$mwenyekiti->is_active) {
            RateLimiter::hit($key);
            return back()->withErrors([
                'username' => 'This account is inactive.',
            ])->onlyInput('username');
        }

        session([
            'mwenyekiti_id' => $mwenyekiti->id,
            'mwenyekiti_auth_id' => $mwenyekitiAuth->id,
            'user_type' => 'mwenyekiti'
        ]);

        // Create session log
        Sessions::create([
            'session_id' => $request->session()->getId(),
            'user_type' => 'mwenyekiti',
            'user_id' => $mwenyekiti->id,
            'username' => $mwenyekitiAuth->username,
            'email' => $mwenyekiti->email ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'is_active' => true,
        ]);

        $request->session()->regenerate();
        RateLimiter::clear($key);

        Log::info('Mwenyekiti login successful', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('mwenyekiti.dashboard');
    }

    private function handleBaloziLogin(Request $request, BaloziAuth $baloziAuth, $key)
    {
        $balozi = $baloziAuth->balozi;
        
        if (!$balozi || !$balozi->is_active) {
            RateLimiter::hit($key);
            return back()->withErrors([
                'username' => 'This account is inactive.',
            ])->onlyInput('username');
        }

        session([
            'balozi_id' => $balozi->id,
            'balozi_auth_id' => $baloziAuth->id,
            'user_type' => 'balozi'
        ]);

        // Create session log
        Sessions::create([
            'session_id' => $request->session()->getId(),
            'user_type' => 'balozi',
            'user_id' => $balozi->id,
            'username' => $baloziAuth->username,
            'email' => $balozi->email ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'is_active' => true,
        ]);

        $request->session()->regenerate();
        RateLimiter::clear($key);

        Log::info('Balozi login successful', [
            'username' => $request->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('balozi.dashboard');
    }
}