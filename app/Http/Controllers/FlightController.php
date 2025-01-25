<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show($id)
    {
        // Ambil data penerbangan berdasarkan ID
        $flight = Rute::with(['transportasi', 'class'])->where('id_rute', $id)->firstOrFail();

        // Kembalikan view dengan data penerbangan
        return view('customer.search.flight_detail', compact('flight'));
    }
} 