<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolarProductController;
use App\Http\Controllers\SolarContractController;
use App\Http\Controllers\ElectricityContractController;
use App\Http\Controllers\Electricity\DashboardController as ElectricityDashboardController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\Solar\DashboardController as SolarDashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;

// Welcome / Root

// Unified Main Dashboard


// 🔌 Electricity Module
Route::prefix('electricity')->name('electricity.')->group(function () {
    Route::get('/dashboard', [ElectricityDashboardController::class, 'index'])->name('dashboard');
    
});



// ☀️ Solar Module
Route::prefix('solar')->name('solar.')->group(function () {
    Route::get('/dashboard', [SolarDashboardController::class, 'index'])->name('dashboard');
    Route::get('/contracts/{id}/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/contracts/{id}/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes/grouped', [QuoteController::class, 'indexGrouped'])->name('quotes.grouped');
});

Route::prefix('solar_contracts')->name('solar_contracts.')->group(function () {
    Route::get('/', [SolarContractController::class, 'index'])->name('index');
    Route::get('/create', [SolarContractController::class, 'create'])->name('create');
    Route::post('/store', [SolarContractController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SolarContractController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SolarContractController::class, 'update'])->name('update');
    Route::delete('/{id}', [SolarContractController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [SolarContractController::class, 'show'])->name('show');
});

Route::prefix('electricity-contracts')->name('electricity_contracts.')->group(function () {
    Route::get('/', [ElectricityContractController::class, 'index'])->name('index');
    Route::get('/create', [ElectricityContractController::class, 'create'])->name('create');
    Route::post('/', [ElectricityContractController::class, 'store'])->name('store');
    Route::get('/{id}', [ElectricityContractController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ElectricityContractController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ElectricityContractController::class, 'update'])->name('update');
    Route::delete('/{id}', [ElectricityContractController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/invoice', [ElectricityContractController::class, 'invoice'])->name('invoice');
    
    Route::resource('customers', CustomerController::class);
});


// 🔧 Solar Products (CRUD)
Route::resource('solar_products', SolarProductController::class);

Route::get('/solar/installation-dates', [SolarContractController::class, 'installationDates'])->name('solar.installation.dates');





Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// Cleanup: Placeholder route for '/home'
// Route::get('/home', function () {
//     return redirect()->route('dashboard'); // redirecting for now
// });
