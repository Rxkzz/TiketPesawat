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
use App\Http\Controllers\ProfileController;

// Route default mengarah ke home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

// Search routes (dapat diakses tanpa login)
Route::post('/search', [HomeController::class, 'search'])->name('search.flights');
Route::get('/search/types', [HomeController::class, 'getTypePesawat'])->name('search.types');
Route::post('/search/filter-type', [HomeController::class, 'filterByType'])->name('search.filter-type');
Route::post('/search/filter-waktu', [HomeController::class, 'filterByWaktu'])->name('search.filter-waktu');
Route::post('/search/filter-urutan', [HomeController::class, 'filterByUrutan'])->name('search.filter-urutan');
Route::get('/search/deal/{from}/{to}/{date}', [HomeController::class, 'searchDeal'])->name('search.deal');
Route::get('/flight/{id}', [FlightController::class, 'show'])->name('flight.show');

// Customer routes (harus login)
Route::middleware('auth:penumpang')->group(function () {
    // Rute untuk halaman home customer
    Route::get('/home', [HomeController::class, 'index'])->name('customer.home');

    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Booking routes
    Route::get('/booking/{flight}/create', [BookingController::class, 'createForm'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}/payment', [BookingController::class, 'showPayment'])->name('booking.payment');
    Route::post('/booking/{id}/payment', [BookingController::class, 'processPayment'])->name('booking.process-payment');
    Route::get('/booking/{id}/ticket', [BookingController::class, 'showTicket'])->name('booking.ticket');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.my-bookings');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Logout route
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect()->route('home');
})->name('logout');