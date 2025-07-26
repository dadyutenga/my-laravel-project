<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Superadmin\CreateAdminController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Admin\MwenyekitiController;
use App\Http\Controllers\Admin\ManageBaloziController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Mwenyekiti\BaloziController;
use App\Http\Controllers\Admin\BaloziAccountController;
use App\Http\Controllers\Balozi\WatuController;
use App\Http\Controllers\Balozi\ServiceController;
use App\Http\Controllers\Balozi\DailyprogressController;
use App\Http\Controllers\Balozi\KayaMaskiniController;
use App\Http\Controllers\Balozi\MalalamikoController;
use App\Http\Controllers\Balozi\MtaameetingRequestController;
use App\Http\Controllers\Balozi\PreferencesController;

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

// Guest routes for Admin/Superadmin
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Replace the separate login form routes with a single route
Route::get('/login1', [UserAuthController::class, 'showLoginForm'])->name('login1');
Route::post('/login1', [UserAuthController::class, 'login'])->name('login1.submit');

// Protected Balozi/Mwenyekiti routes
Route::middleware(['auth.balozi'])->group(function () {
    Route::get('/balozi/dashboard', function () {
        return view('balozi.dashboard');
    })->name('balozi.dashboard');
    
    // Add Watu routes for Balozi
    Route::prefix('balozi/watu')->name('balozi.watu.')->group(function () {
        Route::get('/', [WatuController::class, 'index'])->name('index');
        Route::get('/create', [WatuController::class, 'create'])->name('create');
        Route::post('/', [WatuController::class, 'store'])->name('store');
        Route::get('/{id}', [WatuController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [WatuController::class, 'edit'])->name('edit');
        Route::put('/{id}', [WatuController::class, 'update'])->name('update');
        Route::delete('/{id}', [WatuController::class, 'destroy'])->name('destroy');
    });
    
    // Add Service routes for Balozi
    Route::prefix('balozi/services')->name('balozi.services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        Route::get('/{id}', [ServiceController::class, 'show'])->name('show');
    });

    // Add Daily Progress routes for Balozi
    Route::prefix('balozi/daily-progress')->name('balozi.daily-progress.')->group(function () {
        Route::get('/', [DailyprogressController::class, 'index'])->name('index');
        Route::get('/create', [DailyprogressController::class, 'create'])->name('create');
        Route::post('/', [DailyprogressController::class, 'store'])->name('store');
        Route::get('/{id}', [DailyprogressController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DailyprogressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DailyprogressController::class, 'update'])->name('update');
        Route::delete('/{id}', [DailyprogressController::class, 'destroy'])->name('destroy');
    });

    // Add Kaya Maskini routes for Balozi
    Route::prefix('balozi/kaya-maskini')->name('balozi.kaya-maskini.')->group(function () {
        Route::get('/', [KayaMaskiniController::class, 'index'])->name('index');
        Route::get('/create', [KayaMaskiniController::class, 'create'])->name('create');
        Route::post('/', [KayaMaskiniController::class, 'store'])->name('store');
        Route::get('/{id}', [KayaMaskiniController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [KayaMaskiniController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KayaMaskiniController::class, 'update'])->name('update');
        Route::delete('/{id}', [KayaMaskiniController::class, 'destroy'])->name('destroy');
    });

    // Add Malalamiko routes for Balozi
    Route::prefix('balozi/malalamiko')->name('balozi.malalamiko.')->group(function () {
        Route::get('/', [MalalamikoController::class, 'index'])->name('index');
        Route::get('/create', [MalalamikoController::class, 'create'])->name('create');
        Route::post('/', [MalalamikoController::class, 'store'])->name('store');
        Route::get('/{id}', [MalalamikoController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MalalamikoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MalalamikoController::class, 'update'])->name('update');
        Route::delete('/{id}', [MalalamikoController::class, 'destroy'])->name('destroy');
    });

    // Mtaa Meeting Request Routes
    Route::prefix('balozi/mtaameetingrequest')->group(function () {
        Route::get('/create', [MtaameetingRequestController::class, 'create'])->name('balozi.mtaameetingrequest.create');
        Route::post('/', [MtaameetingRequestController::class, 'store'])->name('balozi.mtaameetingrequest.store');
        Route::get('/', [MtaameetingRequestController::class, 'index'])->name('balozi.mtaameetingrequest.index');
        Route::get('/{id}/edit', [MtaameetingRequestController::class, 'edit'])->name('balozi.mtaameetingrequest.edit');
        Route::put('/{id}', [MtaameetingRequestController::class, 'update'])->name('balozi.mtaameetingrequest.update');
        Route::delete('/{id}', [MtaameetingRequestController::class, 'destroy'])->name('balozi.mtaameetingrequest.destroy');
    });
    Route::group(['prefix' => 'balozi', 'as' => 'balozi.'], function () {
    // ...existing routes...
    
    Route::get('/preferences', [PreferencesController::class, 'index'])->name('preferences.index');
    
    Route::put('/preferences/password', [PreferencesController::class, 'updatePassword'])->name('preferences.update-password');
    });
});

Route::middleware(['auth.mwenyekiti'])->group(function () {
    Route::get('/mwenyekiti/dashboard', function () {
        return view('mwenyekiti.dashboard');
    })->name('mwenyekiti.dashboard');

    // Add Balozi routes
    Route::prefix('mwenyekiti')->name('mwenyekiti.')->group(function () {
        // Resource routes for Balozi
        Route::get('/balozi', [BaloziController::class, 'index'])->name('balozi.index');
        Route::get('/balozi/create', [BaloziController::class, 'create'])->name('balozi.create');
        Route::post('/balozi', [BaloziController::class, 'store'])->name('balozi.store');
        Route::get('/balozi/{balozi}', [BaloziController::class, 'show'])->name('balozi.show');
        Route::get('/balozi/{balozi}/edit', [BaloziController::class, 'edit'])->name('balozi.edit');
        Route::put('/balozi/{balozi}', [BaloziController::class, 'update'])->name('balozi.update');
        
       
        // Additional route for search
        Route::get('/balozi/search', [BaloziController::class, 'search'])->name('balozi.search');

        // Add this new route for account requests
        Route::post('/balozi/{balozi}/request-account', [BaloziController::class, 'requestAccount'])
            ->name('balozi.request-account');
    });
});

// Admin routes with its logout
Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
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
            
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
            Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
            Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

            // Balozi Account Management Routes
            Route::prefix('balozi/accounts')->name('balozi.account.')->group(function () {
                // For viewing and managing existing accounts
                Route::get('/', [BaloziAccountController::class, 'index'])->name('index');
                Route::get('/manage', [BaloziAccountController::class, 'index'])->name('manage');
                Route::patch('/{id}/password', [BaloziAccountController::class, 'updatePassword'])->name('update-password');
                Route::patch('/{id}/toggle-status', [BaloziAccountController::class, 'toggleStatus'])->name('toggle-status');
                
                // For handling account requests
                Route::get('/requests', [BaloziAccountController::class, 'accountRequests'])->name('requests');
                Route::get('/requests/{requestId}', [BaloziAccountController::class, 'showRequest'])->name('show-request');
                Route::post('/requests/{requestId}/process', [BaloziAccountController::class, 'processRequest'])->name('process-request');
            });
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

// Balozi/Mwenyekiti routes with their logout
Route::post('/logout1', [UserAuthController::class, 'logout'])
    ->name('logout1')
    ->middleware(['web']);

    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware(['web']);

    