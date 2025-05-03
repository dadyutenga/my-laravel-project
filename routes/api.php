<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\MwenyekitiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Use only one set of these routes (preferably from RegionController)
Route::get('/regions/{region}/districts', [RegionController::class, 'getDistricts']);
Route::get('/districts/{district}/wards', [RegionController::class, 'getWards']);
