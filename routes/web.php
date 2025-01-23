<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\FlightController;

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
    Route::get('/home', function () {
        $routes = App\Models\Rute::all(); // Ambil semua rute dari database
        return view('customer.home', compact('routes'));
     })->name('customer.home');

    // Rute untuk halaman pencarian penerbangan
    Route::post('/search/flights', function (Request $request) {
        // Ambil input dari permintaan
        $from = $request->input('from');
        $to = $request->input('to');
        
        // Ambil tanggal yang sudah diformat dari input
        $tanggal_berangkat = $request->input('tanggal_berangkat'); // Sudah dalam format Y-m-d

        // Lakukan pencarian berdasarkan input
        $results = App\Models\Rute::where('id_transportasi', $from)
            ->where('tanggal_berangkat', $tanggal_berangkat)
            ->orWhere(function($query) use ($to, $tanggal_berangkat) {
                $query->where('id_transportasi', $to)
                      ->where('tanggal_berangkat', $tanggal_berangkat);
            })
            ->get();

        // Jika tidak ada hasil, tampilkan pesan
        if ($results->isEmpty()) {
            return view('customer.search.results', [
                'results' => $results,
                'message' => 'Tidak ada penerbangan yang ditemukan untuk tanggal keberangkatan tersebut.'
            ]);
        }

        return view('customer.search.results', compact('results'));
    })->name('search.flights');

    Route::get('/flight/{id}', [FlightController::class, 'show'])->name('flight.show');
});

// Admin routes akan ditangani oleh Filament secara otomatis

// Tambahkan route logout
Route::post('/logout', function () {
    auth('penumpang')->logout();
    return redirect('/');
})->name('logout');
