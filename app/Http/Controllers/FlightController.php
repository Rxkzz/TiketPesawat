<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show($id)
    {
        // Ambil data penerbangan berdasarkan ID dengan eager loading untuk class dan fasilitas
        $flight = Rute::with([
            'transportasi',
            'class' => function($query) {
                $query->with(['fasilitas' => function($q) {
                    $q->select('fasilitas.*');
                }]);
            }
        ])->findOrFail($id);

        // Kembalikan view dengan data penerbangan
        return view('customer.search.flight_detail', compact('flight'));
    }
} 