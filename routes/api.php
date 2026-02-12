<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\RoleUserController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\ProspectPersonalController;
use App\Http\Controllers\Api\ProspectHouseholdController;
use App\Http\Controllers\Api\ProspectPreferenceController;
use App\Http\Controllers\Api\ProspectPreferencesCuisineController;
use App\Http\Controllers\Api\ProspectPurchaseController; 

Route::post('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API working'
    ]);
});

// Existing API routes
Route::post('prospect-preferences-cuisine', [ProspectPreferencesCuisineController::class, 'store']);
Route::post('prospect-preference', [ProspectPreferenceController::class, 'store']);
Route::post('/prospect-household', [ProspectHouseholdController::class, 'store']);
Route::post('/prospect-personal', [ProspectPersonalController::class, 'store']);
Route::post('/communities', [CommunityController::class, 'store']);
Route::post('/cities', [CityController::class, 'store']);
Route::post('/assign-role', [RoleUserController::class, 'store']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/roles', [RolesController::class, 'store']);
Route::post('/states', [StateController::class, 'store']);
Route::post('/prospect-purchase', [ProspectPurchaseController::class, 'store']);
