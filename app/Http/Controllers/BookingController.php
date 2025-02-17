<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rute;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function createForm($flight_id)
    {
        $flight = Rute::with(['transportasi', 'class'])->findOrFail($flight_id);
        return view('customer.booking.create', compact('flight'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:rute,id_rute',
            'jumlah_penumpang' => 'required|integer|min:1',
            'passengers.*.full_name' => 'required|string|max:255',
            'passengers.*.id_number' => 'required|string|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        $flight = Rute::findOrFail($request->flight_id);
        
        // Generate nomor kursi untuk setiap penumpang
        $kode_kursi = [];
        $kursi_tersedia = $flight->kursi_tersedia;
        $baris = ceil($kursi_tersedia / 6); // 6 kursi per baris (A-F)
        
        for ($i = 0; $i < $request->jumlah_penumpang; $i++) {
            do {
                $nomor_baris = rand(1, $baris);
                $huruf_kursi = chr(rand(65, 70)); // A-F (65-70 dalam ASCII)
                $nomor_kursi = $nomor_baris . $huruf_kursi;
            } while (in_array($nomor_kursi, $kode_kursi));
            
            $kode_kursi[] = $nomor_kursi;
        }
        
        // Hitung total bayar
        $harga_dasar = $flight->total_harga * $request->jumlah_penumpang;
        $pajak = $harga_dasar * 0.1; // 10% pajak
        $total_bayar = $harga_dasar + $pajak;

        // Buat kode pemesanan unik
        $kode_pemesanan = 'TIX-' . strtoupper(Str::random(6));

        // Simpan pemesanan
        $booking = Pemesanan::create([
            'kode_pemesanan' => $kode_pemesanan,
            'tanggal_pemesanan' => now(),
            'id_pelanggan' => auth('penumpang')->id(),
            'id_rute' => $request->flight_id,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'nama_penumpang' => collect($request->passengers)->pluck('full_name')->implode(', '),
            'nomor_identitas' => collect($request->passengers)->pluck('id_number')->implode(', '),
            'email' => $request->email,
            'nomor_telepon' => $request->phone,
            'total_bayar' => $total_bayar,
            'status_pembayaran' => 'PENDING',
            'tanggal_berangkat' => $flight->tanggal_berangkat,
            'jam_berangkat' => $flight->waktu_berangkat,
            'tujuan' => $flight->tujuan,
            'kode_kursi' => implode(', ', $kode_kursi)
        ]);

        // Kurangi jumlah kursi tersedia
        $flight->kurangiKursi($request->jumlah_penumpang);

        return redirect()->route('booking.payment', $booking->id_pemesanan)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show($id)
    {
        $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
            ->where('id_pelanggan', auth('penumpang')->id())
            ->findOrFail($id);
            
        // Cek status pembayaran
        if ($booking->status_pembayaran === 'PENDING') {
            return redirect()->route('booking.payment', $booking->id_pemesanan)
                ->with('warning', 'Silakan lakukan pembayaran terlebih dahulu.');
        }
        
        if ($booking->status_pembayaran === 'WAITING_CONFIRMATION') {
            return redirect()->route('booking.payment', $booking->id_pemesanan)
                ->with('warning', 'Pembayaran Anda sedang dalam proses verifikasi oleh petugas. Mohon tunggu konfirmasi.');
        }
        
        if ($booking->status_pembayaran !== 'PAID') {
            return redirect()->route('booking.my-bookings')
                ->with('error', 'Detail pemesanan hanya dapat diakses setelah pembayaran diverifikasi.');
        }
        
        return view('customer.booking.ticket', compact('booking'));
    }

    public function showPayment($id)
    {
        $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
            ->where('id_pelanggan', auth('penumpang')->id())
            ->findOrFail($id);
            
        return view('customer.booking.payment', compact('booking'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'payment_proof' => 'required|image|max:2048'
        ]);

        $booking = Pemesanan::where('id_pelanggan', auth('penumpang')->id())
            ->findOrFail($id);

        // Upload bukti pembayaran
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        // Update status pemesanan
        $booking->update([
            'payment_method' => $request->payment_method,
            'payment_proof' => $path,
            'status_pembayaran' => 'WAITING_CONFIRMATION',
            'paid_at' => now()
        ]);

        return redirect()->route('booking.show', $booking->id_pemesanan)
            ->with('success', 'Pembayaran berhasil diupload. Mohon tunggu konfirmasi dari admin.');
    }

    public function myBookings()
    {
        $bookings = Pemesanan::with(['rute.transportasi', 'rute.class'])
            ->where('id_pelanggan', auth('penumpang')->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('customer.booking.my-bookings', compact('bookings'));
    }

    public function showTicket($id)
    {
        $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
            ->where('id_pelanggan', auth('penumpang')->id())
            ->findOrFail($id);
            
        // Cek status pembayaran
        if ($booking->status_pembayaran === 'PENDING') {
            return redirect()->route('booking.payment', $booking->id_pemesanan)
                ->with('warning', 'Silakan lakukan pembayaran terlebih dahulu untuk melihat tiket Anda.');
        }
        
        if ($booking->status_pembayaran === 'WAITING_CONFIRMATION') {
            return redirect()->route('booking.payment', $booking->id_pemesanan)
                ->with('warning', 'Pembayaran Anda sedang dalam proses verifikasi oleh petugas. Mohon tunggu konfirmasi.');
        }
        
        if ($booking->status_pembayaran !== 'PAID') {
            return redirect()->route('booking.my-bookings')
                ->with('error', 'Tiket hanya dapat diakses setelah pembayaran diverifikasi.');
        }
        
        return view('customer.booking.ticket', compact('booking'));
    }
} 