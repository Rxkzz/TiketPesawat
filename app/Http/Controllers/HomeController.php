<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data rute beserta relasi class untuk semua user
        $routes = Rute::with(['transportasi', 'class'])
                     ->select('rute_awal', 'tujuan', 'id_transportasi', 'id_class')
                     ->distinct()
                     ->get();
        
        // Ambil semua kelas yang tersedia
        $classes = ClassModel::all();

        // Ambil data deals (6 rute termurah)
        $deals = Rute::with(['transportasi'])
            ->orderBy('total_harga', 'asc')
            ->take(6)
            ->get()
            ->map(function ($rute) {
                return [
                    'from' => $rute->rute_awal,
                    'to' => $rute->tujuan,
                    'price' => $rute->total_harga,
                    'gambar' => $rute->gambar,
                    'tanggal_berangkat' => $rute->tanggal_berangkat
                ];
            });

        // Debug log untuk deals
        \Log::info('Deals Data:', $deals->toArray());

        // Jika user sudah login sebagai penumpang
        if (Auth::guard('penumpang')->check()) {
            return view('customer.home', compact('routes', 'classes', 'deals'));
        }
        
        // Jika belum login, tampilkan halaman welcome dengan data yang sama
        return view('customer.home', compact('routes', 'classes', 'deals'));
    }

    public function search(Request $request)
    {
        // Log untuk debugging
        Log::info('Search Parameters:', $request->all());

        // Ambil data kelas
        $classes = ClassModel::all();

        // Ambil data rute untuk form pencarian
        $routes = Rute::with(['transportasi', 'class'])
            ->select('rute_awal', 'tujuan', 'id_transportasi', 'id_class')
            ->distinct()
            ->get();

        // Ambil data maskapai untuk filter
        $airlines = Rute::with(['transportasi.typeTransportasi'])
            ->get()
            ->map(function ($rute) {
                return [
                    'id_transportasi' => $rute->transportasi->id_transportasi,
                    'kode' => $rute->transportasi->kode,
                    'nama' => $rute->transportasi->nama,
                    'type' => $rute->transportasi->typeTransportasi->nama_type,
                    'id_type' => $rute->transportasi->typeTransportasi->id_type_transportasi,
                    'keterangan_type' => $rute->transportasi->typeTransportasi->keterangan,
                    'keterangan_maskapai' => $rute->transportasi->keterangan,
                    'gambar' => $rute->transportasi->gambar
                ];
            })
            ->unique('type')
            ->values();

        // Debug log untuk airlines
        Log::info('Airlines Data:', $airlines->toArray());

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
                'classes' => $classes,
                'routes' => $routes,
                'airlines' => $airlines,
                'message' => 'Tidak ada penerbangan yang ditemukan untuk kriteria pencarian Anda.'
            ]);
        }

        return view('customer.search.results', compact('results', 'request', 'search_params', 'classes', 'routes', 'airlines'));
    }

    public function searchDeal($from, $to, $date)
    {
        // Ambil data kelas
        $classes = ClassModel::all();

        // Ambil data rute untuk form pencarian
        $routes = Rute::with(['transportasi', 'class'])
            ->select('rute_awal', 'tujuan', 'id_transportasi', 'id_class')
            ->distinct()
            ->get();

        // Ambil data maskapai untuk filter
        $airlines = Rute::with(['transportasi.typeTransportasi'])
            ->get()
            ->map(function ($rute) {
                return [
                    'id_transportasi' => $rute->transportasi->id_transportasi,
                    'kode' => $rute->transportasi->kode,
                    'nama' => $rute->transportasi->nama,
                    'type' => $rute->transportasi->typeTransportasi->nama_type,
                    'keterangan_type' => $rute->transportasi->typeTransportasi->keterangan,
                    'keterangan_maskapai' => $rute->transportasi->keterangan,
                    'gambar' => $rute->transportasi->gambar
                ];
            })
            ->unique('id_transportasi')
            ->values();

        // Buat query untuk mencari rute berdasarkan deal yang diklik
        $query = Rute::with(['transportasi', 'class', 'transportasi.typeTransportasi'])
            ->where('rute_awal', $from)
            ->where('tujuan', $to)
            ->where('tanggal_berangkat', $date);

        $results = $query->get();

        $search_params = [
            'from' => $from,
            'to' => $to,
            'tanggal_berangkat' => $date
        ];

        // Jika tidak ada hasil, tampilkan pesan
        if ($results->isEmpty()) {
            return view('customer.search.results', [
                'results' => $results,
                'search_params' => $search_params,
                'classes' => $classes,
                'routes' => $routes,
                'airlines' => $airlines,
                'message' => 'Tidak ada penerbangan yang ditemukan untuk kriteria pencarian Anda.'
            ]);
        }

        return view('customer.search.results', compact('results', 'search_params', 'classes', 'routes', 'airlines'));
    }


    public function getTypePesawat()
    {
        $types = \App\Models\TypeTransportasi::all();
        return response()->json($types);
    }

    public function filterByType(Request $request)
    {
        // Log untuk debugging input
        Log::info('Filter Type Input:', [
            'type_id' => $request->type_id
        ]);

        // Buat query dasar
        $query = Rute::with(['transportasi.typeTransportasi', 'class']);
        
        if ($request->type_id && $request->type_id !== 'all') {
            $query->whereHas('transportasi', function($q) use ($request) {
                $q->whereHas('typeTransportasi', function($tq) use ($request) {
                    $tq->where('nama_type', $request->type_id);
                });
            });
        }

        // Tambahkan filter berdasarkan parameter pencarian yang ada di session
        if (session()->has('search_params')) {
            $search = session('search_params');
            
            if (isset($search['tanggal_berangkat'])) {
                $query->where('tanggal_berangkat', $search['tanggal_berangkat']);
            }
            if (isset($search['id_class'])) {
                $query->whereHas('class', function($q) use ($search) {
                    $q->where('nama_class', $search['id_class']);
                });
            }
        }

        $results = $query->get();
        
        // Log untuk debugging hasil
        Log::info('Filter Type Results:', [
            'type_id' => $request->type_id,
            'count' => $results->count(),
            'search_params' => session('search_params'),
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        return view('customer.search.partials.results', compact('results'))->render();
    }

    public function filterByMaskapai(Request $request)
    {
        // Buat query dasar
        $query = Rute::with(['transportasi.typeTransportasi', 'class']);
        
        if ($request->maskapai_id && $request->maskapai_id !== 'all') {
            $query->whereHas('transportasi', function($q) use ($request) {
                $q->where('id_transportasi', $request->maskapai_id);
            });
        }

        // Tambahkan filter berdasarkan parameter pencarian yang ada di session
        if (session()->has('search_params')) {
            $search = session('search_params');
            
            if (isset($search['from'])) {
                $query->where('rute_awal', $search['from']);
            }
            if (isset($search['to'])) {
                $query->where('tujuan', $search['to']);
            }
            if (isset($search['tanggal_berangkat'])) {
                $query->where('tanggal_berangkat', $search['tanggal_berangkat']);
            }
            if (isset($search['id_class'])) {
                $query->whereHas('class', function($q) use ($search) {
                    $q->where('nama_class', $search['id_class']);
                });
            }
        }

        $results = $query->get();
        
        // Log untuk debugging
        Log::info('Filter Maskapai Results:', [
            'maskapai_id' => $request->maskapai_id,
            'count' => $results->count(),
            'search_params' => session('search_params')
        ]);

        return view('customer.search.partials.results', compact('results'))->render();
    }

    public function filterByWaktu(Request $request)
    {
        // Log untuk debugging input
        Log::info('Filter Waktu Input:', [
            'waktu_type' => $request->waktu_type,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        // Buat query dasar
        $query = Rute::with(['transportasi.typeTransportasi', 'class']);
        
        // Filter berdasarkan range waktu
        if ($request->waktu_type === 'pergi') {
            $query->whereRaw('TIME(waktu_berangkat) >= ? AND TIME(waktu_berangkat) <= ?', 
                [$request->start_time, $request->end_time]);
        } else {
            $query->whereRaw('TIME(waktu_tiba) >= ? AND TIME(waktu_tiba) <= ?', 
                [$request->start_time, $request->end_time]);
        }

        // Tambahkan filter berdasarkan parameter pencarian yang ada di session
        if (session()->has('search_params')) {
            $search = session('search_params');
            
            if (isset($search['tanggal_berangkat'])) {
                $query->where('tanggal_berangkat', $search['tanggal_berangkat']);
            }
            if (isset($search['id_class'])) {
                $query->whereHas('class', function($q) use ($search) {
                    $q->where('nama_class', $search['id_class']);
                });
            }
        }

        $results = $query->get();
        
        // Log untuk debugging hasil
        Log::info('Filter Waktu Results:', [
            'count' => $results->count(),
            'search_params' => session('search_params'),
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings()
        ]);

        return view('customer.search.partials.results', compact('results'))->render();
    }

    public function filterByUrutan(Request $request)
    {
        // Log untuk debugging input
        Log::info('Filter Urutan Input:', [
            'sort_by' => $request->sort_by
        ]);

        // Buat query dasar
        $query = Rute::with(['transportasi.typeTransportasi', 'class']);

        // Filter berdasarkan jenis pengurutan
        switch($request->sort_by) {
            case 'rekomendasi':
                // Urutan default (bisa disesuaikan dengan logika rekomendasi)
                $query->orderBy('total_harga', 'asc');
                break;
            case 'harga_terendah':
                $query->orderBy('total_harga', 'asc');
                break;
            case 'berangkat_awal':
                $query->orderBy('waktu_berangkat', 'asc');
                break;
            case 'berangkat_akhir':
                $query->orderBy('waktu_berangkat', 'desc');
                break;
            case 'tiba_awal':
                $query->orderBy('waktu_tiba', 'asc');
                break;
            case 'tiba_akhir':
                $query->orderBy('waktu_tiba', 'desc');
                break;
            case 'durasi_pendek':
                $query->orderByRaw('TIMEDIFF(waktu_tiba, waktu_berangkat) ASC');
                break;
        }

        // Tambahkan filter berdasarkan parameter pencarian yang ada di session
        if (session()->has('search_params')) {
            $search = session('search_params');
            
            if (isset($search['tanggal_berangkat'])) {
                $query->where('tanggal_berangkat', $search['tanggal_berangkat']);
            }
            if (isset($search['id_class'])) {
                $query->whereHas('class', function($q) use ($search) {
                    $q->where('nama_class', $search['id_class']);
                });
            }
        }

        $results = $query->get();
        
        // Log untuk debugging hasil
        Log::info('Filter Urutan Results:', [
            'sort_by' => $request->sort_by,
            'count' => $results->count(),
            'search_params' => session('search_params')
        ]);

        return view('customer.search.partials.results', compact('results'))->render();
    }
} 