<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\TreePlantingController;
use App\Http\Controllers\TreeAllocationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TreeSpeciesController;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::resource('institutions', InstitutionController::class);
    Route::resource('plantings', TreePlantingController::class);
    Route::resource('allocations', TreeAllocationController::class);
    Route::resource('species', TreeSpeciesController::class);
    Route::post('plantings/{planting}/growth-stage', [TreePlantingController::class, 'updateGrowthStage'])->name('plantings.updateGrowthStage');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
     Route::get('plantings/map', [TreePlantingController::class, 'map'])->name('plantings.map');
    
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    });

require __DIR__.'/auth.php';
