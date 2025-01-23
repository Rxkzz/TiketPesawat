<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchFlights(Request $request) {
        // Logika untuk mencari penerbangan berdasarkan input
        // ...
        return view('customer.search.results', compact('results'));
    }
} 