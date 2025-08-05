<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\TreePlantingController;
use App\Http\Controllers\ReportController;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('partials.dashboard');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::resource('institutions', InstitutionController::class);
    Route::resource('plantings', TreePlantingController::class);
    Route::post('plantings/{planting}/growth-stage', [TreePlantingController::class, 'updateGrowthStage'])->name('plantings.updateGrowthStage');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
