<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rute;

class SearchController extends Controller
{
    public function show($id)
    {
        $flight = Rute::with(['transportasi.typeTransportasi', 'class'])->findOrFail($id);
        return view('customer.search.flight_detail', compact('flight'));
    }

    public function searchFlights(Request $request) {
        $query = Rute::with(['transportasi.typeTransportasi', 'class']);
        
        if ($request->filled('from')) {
            $query->where('rute_from', $request->from);
        }
        
        if ($request->filled('to')) {
            $query->where('rute_to', $request->to);
        }
        
        if ($request->filled('date')) {
            $query->whereDate('tanggal_berangkat', $request->date);
        }

        if ($request->filled('class')) {
            $query->where('id_class', $request->class);
        }
        
        $results = $query->get();
        return view('customer.search.results', compact('results'));
    }
} 