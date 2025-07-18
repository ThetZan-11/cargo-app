<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest Routes (Unauthenticated)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/getData', [DashboardController::class, 'getData'])->name('dashboard.getData');
    // Fix: Redirect /home to /dashboard
    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    // Customer Management
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
        Route::post('/data', [CustomerController::class, 'getData'])->name('customer.data');
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::post('/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::get('/getDataEdit/{id}', [CustomerController::class, 'getDataEdit'])->name('customer.getDataEdit');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    });

    // Country Management
    Route::prefix('countries')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('country.index');
        Route::post('/data', [CountryController::class, 'getData'])->name('country.data');
    });

    // Price Management
    Route::prefix('prices')->group(function () {
        Route::get('/', [PriceController::class, 'index'])->name('price.index');
        Route::post('/data', [PriceController::class, 'getData'])->name('price.data');
        Route::post('/store', [PriceController::class, 'store'])->name('price.store');
        Route::post('/delete/{id}', [PriceController::class, 'delete'])->name('price.delete');
        Route::get('/getDataEdit/{id}', [PriceController::class, 'getDataEdit'])->name('price.getDataEdit');
        Route::post('/update/{id}', [PriceController::class, 'update'])->name('price.update');
    });

    // Order Management
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::post('/data', [OrderController::class, 'getData'])->name('order.data');
        Route::post('/customerSearch', [OrderController::class, 'customerSearch'])->name('customer.search');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/getDataEdit/{id}', [OrderController::class, 'getDataEdit'])->name('order.getDataEdit');
        Route::post('/printData', [OrderController::class, 'printData'])->name('order.print');
        Route::post('/update', [OrderController::class, 'update'])->name('order.update');
    });

    // Language Switcher Route
    Route::get('language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');
});
