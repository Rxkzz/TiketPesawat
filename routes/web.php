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

// Route default mengarah ke home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

// Customer routes
Route::middleware('auth:penumpang')->group(function () {
    Route::get('/home', function () {
        return view('customer.home');
    })->name('customer.home');

    // Rute untuk halaman home
    Route::get('/home', [HomeController::class, 'index'])->name('customer.home');

    // Rute untuk halaman pencarian penerbangan
    Route::post('/search/flights', [HomeController::class, 'search'])->name('search.flights');
    Route::get('/flight/{id}', [FlightController::class, 'show'])->name('flight.show');

    // Booking routes
    Route::get('/booking/{flight}/create', [BookingController::class, 'createForm'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}/payment', [BookingController::class, 'showPayment'])->name('booking.payment');
    Route::post('/booking/{id}/payment', [BookingController::class, 'processPayment'])->name('booking.process-payment');
    Route::get('/booking/{id}/ticket', [BookingController::class, 'showTicket'])->name('booking.ticket');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.history');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Logout route
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect()->route('home');
})->name('logout');