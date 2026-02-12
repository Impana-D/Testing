<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProspectPersonalController;
use App\Http\Controllers\Api\ProspectHouseholdController;
use App\Http\Controllers\Api\ProspectPreferenceController;
use App\Http\Controllers\Api\ProspectPurchaseController;

// Root URL - Redirect to first prospect step
Route::get('/', function () {
    return redirect()->route('prospect.personal.create');
});

// Prospect Routes Group
Route::prefix('prospect')->group(function () {

    // Step 1: Personal
    Route::get('personal', [ProspectPersonalController::class, 'create'])
        ->name('prospect.personal.create');
    Route::post('personal', [ProspectPersonalController::class, 'store'])
        ->name('prospect.personal.store');

    // Step 2: Household
    Route::get('household', [ProspectHouseholdController::class, 'create'])
        ->name('prospect.household.create');
    Route::post('household', [ProspectHouseholdController::class, 'store'])
        ->name('prospect.household.store');

    // Step 3: Preferences
    Route::get('preferences', [ProspectPreferenceController::class, 'create'])
        ->name('prospect.preferences.create');
    Route::post('preferences', [ProspectPreferenceController::class, 'store'])
        ->name('prospect.preferences.store');

    // Step 4: Purchase
    Route::get('purchase', [ProspectPurchaseController::class, 'create'])
        ->name('prospect.purchase.create');
    Route::post('purchase', [ProspectPurchaseController::class, 'store'])
        ->name('prospect.purchase.store');
});
