<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect('/login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

// Customer routes
Route::middleware('auth:penumpang')->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // Rute untuk halaman home
    Route::get('/home', [HomeController::class, 'index'])->name('customer.home');

    // Rute untuk halaman pencarian penerbangan
    Route::post('/search/flights', [HomeController::class, 'search'])->name('search.flights');

    Route::get('/flight/{id}', [FlightController::class, 'show'])->name('flight.show');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Tambahkan route logout
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect('/');
})->name('logout');
