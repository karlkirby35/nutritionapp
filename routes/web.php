<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Display the form
Route::get('/nutrition', [NutritionController::class, 'showForm'])->name('nutrition.form');

// Handle form submission
Route::post('/nutrition', [NutritionController::class, 'getNutritionData'])->name('nutrition.search');

// Home route
Route::get('/', function () {
    return view('welcome');
});