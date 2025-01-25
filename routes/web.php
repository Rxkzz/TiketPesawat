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
use App\Http\Controllers\BookingController;

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
    Route::post('/search/flights', [FlightController::class, 'search'])->name('search.flights');
    Route::get('/flight/{id}', [FlightController::class, 'show'])->name('flight.show');

    // Booking routes
    Route::get('/booking/create/{flight}', [BookingController::class, 'createForm'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::post('/booking/{id}/payment', [BookingController::class, 'processPayment'])->name('booking.payment');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Tambahkan route logout
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect('/');
})->name('logout');
