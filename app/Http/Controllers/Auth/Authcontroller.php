<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function __construct()
    {
        // Apply rate limiting to login and register methods
        $this->middleware('throttle:5,1')->only(['login', 'register']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = 'login_attempts_' . $request->ip();
        $maxAttempts = 5;
        $lockoutTime = 300; // 5 minutes in seconds

        // Check if the IP has exceeded login attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('email');
        }

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Reset login attempts on successful login
            RateLimiter::clear($key);

            // Log successful login
            Log::info('Admin login successful', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Redirect based on role
            $route = Auth::guard('admin')->user()->role === 'superadmin'
                ? 'superadmin.dashboard'
                : 'admin.dashboard';
            return redirect()->route($route);
        }

        // Increment failed login attempts
        RateLimiter::hit($key, $lockoutTime);

        // Log failed login attempt
        Log::warning('Admin login failed', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
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
            'role' => 'required|in:admin,superadmin',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        // Log registration
        Log::info('Admin registered', [
            'email' => $request->email,
            'role' => $request->role,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    
}