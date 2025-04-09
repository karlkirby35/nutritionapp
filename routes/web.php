<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\BarcodeController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Display the form
Route::get('/nutrition', [NutritionController::class, 'showForm'])->name('nutrition.form');

Route::post('/nutrition/search', [DashboardController::class, 'search'])->name('nutrition.search');

Route::post('/nutrition/add', [DashboardController::class, 'addFood'])->name('nutrition.add');

// Home route
Route::get('/', function () { return view('welcome'); });

Route::post('/nutrition/delete', [DashboardController::class, 'delete'])->name('nutrition.delete');

Route::get('/map', [MapController::class, 'index'])->name('map');

// routes/web.php
Route::post('/nutrition/process-barcode', [BarcodeController::class, 'processBarcode'])
     ->name('nutrition.process-barcode');





