<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Superadmin\CreateAdminController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Admin\MwenyekitiController;
use App\Http\Controllers\Admin\BaloziController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\ProfileController;

// Default route redirects to login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/login');
});

// Guest routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Admin routes
Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin dashboard routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // User Management Routes
        Route::prefix('admin')->name('admin.')->group(function () {
            // Mwenyekiti Routes
            Route::get('/mwenyekiti/create', [MwenyekitiController::class, 'create'])->name('mwenyekiti.create');
            Route::get('/mwenyekiti/manage', [MwenyekitiController::class, 'manage'])->name('mwenyekiti.manage');
            
            // Balozi Routes
            Route::get('/balozi/manage', [BaloziController::class, 'manage'])->name('balozi.manage');
            
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


