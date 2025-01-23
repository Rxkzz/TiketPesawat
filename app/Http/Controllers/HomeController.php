<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data rute beserta relasi class
        $routes = Rute::with(['transportasi', 'class'])
                     ->select('rute_awal', 'tujuan', 'id_transportasi', 'id_class')
                     ->distinct()
                     ->get();
        
        // Ambil semua kelas yang tersedia
        $classes = ClassModel::all();
        
        return view('customer.home', compact('routes', 'classes'));
    }

    public function search(Request $request)
    {
        // Log untuk debugging
        Log::info('Search Parameters:', $request->all());

        // Buat query dasar
        $query = Rute::with(['transportasi', 'class', 'transportasi.typeTransportasi']);

        // Gabungkan semua filter dalam satu query
        $query->where(function($q) use ($request) {
            // Filter rute awal dan tanggal
            $q->where(function($subQ) use ($request) {
                $subQ->where('id_transportasi', $request->input('from'))
                     ->where('tanggal_berangkat', $request->input('tanggal_berangkat'));
                
                // Filter kelas jika ada
                if ($request->filled('id_class')) {
                    $subQ->whereHas('class', function($classQ) use ($request) {
                        $classQ->where('nama_class', $request->id_class);
                    });
                }
            });

            // Filter rute tujuan
            $q->orWhere(function($subQ) use ($request) {
                $subQ->where('id_transportasi', $request->input('to'))
                     ->where('tanggal_berangkat', $request->input('tanggal_berangkat'));
                
                // Filter kelas jika ada
                if ($request->filled('id_class')) {
                    $subQ->whereHas('class', function($classQ) use ($request) {
                        $classQ->where('nama_class', $request->id_class);
                    });
                }
            });
        });

        // Log query yang dijalankan untuk debugging
        Log::info('SQL Query:', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        $results = $query->get();

        // Log hasil query
        Log::info('Query Results:', [
            'count' => $results->count(),
            'data' => $results->toArray()
        ]);

        $search_params = $request->all();

        // Jika tidak ada hasil, tampilkan pesan
        if ($results->isEmpty()) {
            return view('customer.search.results', [
                'results' => $results,
                'request' => $request,
                'search_params' => $search_params,
                'message' => 'Tidak ada penerbangan yang ditemukan untuk kriteria pencarian Anda.'
            ]);
        }

        return view('customer.search.results', compact('results', 'request', 'search_params'));
    }
} 