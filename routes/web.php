<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Superadmin\CreateAdminController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Admin\MwenyekitiController;
use App\Http\Controllers\Admin\ManageBaloziController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\UserAuthController;

// Default route - Changed to show welcome page directly
Route::get('/', function () {
    return view('welcome');
});

// Home route (can potentially be removed or kept depending on needs)
Route::get('/home', function () {
    if (Auth::guard('admin')->check()) {
        $route = Auth::guard('admin')->user()->role === 'superadmin'
            ? 'superadmin.dashboard'
            : 'admin.dashboard';
        return redirect()->route($route);
    }
    // If not logged in, redirect to welcome or login as preferred
    return redirect('/'); // Or redirect()->route('login');
});

// Replace the separate login form routes with a single route
Route::get('/users/login', [UserAuthController::class, 'showLoginForm'])
    ->name('users.login')
    ->middleware('guest');

// Keep these routes for form submission
Route::post('/balozi/login', [UserAuthController::class, 'baloziLogin'])
    ->name('balozi.login')
    ->middleware('guest');

Route::post('/mwenyekiti/login', [UserAuthController::class, 'mwenyekitiLogin'])
    ->name('mwenyekiti.login')
    ->middleware('guest');

// Admin routes
Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin dashboard routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // User Management Routes
        Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin'])->group(function () {
            // Mwenyekiti Routes
            Route::get('/mwenyekiti/create', [MwenyekitiController::class, 'create'])->name('mwenyekiti.create');
            Route::post('/mwenyekiti', [MwenyekitiController::class, 'store'])->name('mwenyekiti.store');
            Route::get('/mwenyekiti/manage', [MwenyekitiController::class, 'manage'])->name('mwenyekiti.manage');
            Route::put('/mwenyekiti/{mwenyekiti}', [MwenyekitiController::class, 'update'])->name('mwenyekiti.update');
            Route::delete('/mwenyekiti/{mwenyekiti}', [MwenyekitiController::class, 'destroy'])->name('mwenyekiti.destroy');
            
            // Mwenyekiti Account Routes
            Route::get('/mwenyekiti/create-account', [MwenyekitiController::class, 'createAccount'])->name('mwenyekiti.createAccount');
            Route::post('/mwenyekiti/{id}/account', [MwenyekitiController::class, 'storeAccount'])->name('mwenyekiti.storeAccount');
            Route::put('/mwenyekiti/{id}/account', [MwenyekitiController::class, 'updateAccount'])->name('mwenyekiti.updateAccount');
            Route::delete('/mwenyekiti/{id}/account', [MwenyekitiController::class, 'deleteAccount'])->name('mwenyekiti.deleteAccount');
            Route::get('/mwenyekiti/manage-accounts', [MwenyekitiController::class, 'manageAccounts'])->name('mwenyekiti.manageAccounts');
            
            // Balozi Routes
            Route::get('/balozi/manage', [ManageBaloziController::class, 'manage'])->name('balozi.manage');
            
            // Support Tickets Routes
            Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
            
            // Profile Routes
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        });
    });

    // Superadmin dashboard routes
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/superadmin/dashboard', function () {
            return view('superadmin.dashboard');
        })->name('superadmin.dashboard');

        // Admin management routes
        Route::prefix('superadmin/admins')->name('superadmin.admins.')->group(function () {
            Route::get('/', [CreateAdminController::class, 'index'])->name('index');
            Route::get('/create', [CreateAdminController::class, 'create'])->name('create');
            Route::post('/', [CreateAdminController::class, 'store'])->name('store');
            Route::get('/{admin}', [CreateAdminController::class, 'show'])->name('show');
            Route::get('/{admin}/edit', [CreateAdminController::class, 'edit'])->name('edit');
            Route::put('/{admin}', [CreateAdminController::class, 'update'])->name('update');
            Route::delete('/{admin}', [CreateAdminController::class, 'destroy'])->name('destroy');
            Route::patch('/{admin}/toggle-status', [CreateAdminController::class, 'toggleStatus'])->name('toggle-status');
        });

        Route::prefix('superadmin')->name('superadmin.')->middleware(['auth:admin'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
    });
});

// Keep your existing protected routes
Route::middleware(['auth.balozi'])->group(function () {
    Route::get('/balozi/dashboard', function () {
        return view('balozi.dashboard');
    })->name('balozi.dashboard');
});

Route::middleware(['auth.mwenyekiti'])->group(function () {
    Route::get('/mwenyekiti/dashboard', function () {
        return view('mwenyekiti.dashboard');
    })->name('mwenyekiti.dashboard');
});

// Shared logout route
Route::post('/logout', [UserAuthController::class, 'logout'])
    ->name('logout')
    ->middleware(['web']);