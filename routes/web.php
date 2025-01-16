<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

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
    Route::get('/dashboard', function() {
        return view('customer.dashboard');
    })->name('customer.dashboard');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Tambahkan route logout
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect('/');
})->name('logout');
