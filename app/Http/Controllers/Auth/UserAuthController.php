<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::guard('balozi')->attempt($credentials, $request->filled('remember'))) {
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

        if (Auth::guard('mwenyekiti')->attempt($credentials, $request->filled('remember'))) {
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
        $guard = Auth::guard('balozi')->check() ? 'balozi' : 'mwenyekiti';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('balozi.login'); // Default to balozi login page
    }
}