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
    public function createForm(Rute $flight)
    {
        $flight->load(['transportasi', 'class']);
        return view('customer.booking.create', compact('flight'));
    }

    public function store(Request $request)
    {
        // Pastikan user sudah login
        if (!auth('penumpang')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $validated = $request->validate([
            'flight_id' => 'required|exists:rute,id_rute',
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:16',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        DB::beginTransaction();
        try {
            // Ambil data penerbangan
            $flight = Rute::findOrFail($request->flight_id);

            // Generate kode pemesanan unik
            $bookingCode = 'BK-' . strtoupper(Str::random(6));

            // Simpan data pemesanan
            $pemesanan = Pemesanan::create([
                'kode_pemesanan' => $bookingCode,
                'tanggal_pemesanan' => Carbon::now()->format('Y-m-d'),
                'tempat_pemesanan' => 'Online',
                'id_pelanggan' => auth('penumpang')->id(),
                'kode_kursi' => 'A' . rand(1, 100),
                'id_rute' => $flight->id_rute,
                'tujuan' => $flight->tujuan,
                'tanggal_berangkat' => $flight->tanggal_berangkat,
                'jam_cekin' => Carbon::parse($flight->waktu_berangkat)->subHours(2)->format('H:i:s'),
                'jam_berangkat' => $flight->waktu_berangkat,
                'total_bayar' => $flight->total_harga,
                'nama_penumpang' => $validated['full_name'],
                'nomor_identitas' => $validated['id_number'],
                'email' => $validated['email'],
                'nomor_telepon' => $validated['phone'],
                'status_pembayaran' => 'PENDING'
            ]);

            DB::commit();

            return redirect()->route('booking.payment', ['id' => $pemesanan->id_pemesanan])
                ->with('success', 'Pemesanan berhasil dibuat. Silahkan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Booking Error: ' . $e->getMessage());
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function showPayment($id)
    {
        try {
            $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
                ->where('id_pemesanan', $id)
                ->where('id_pelanggan', auth('penumpang')->id())
                ->where('status_pembayaran', 'PENDING')
                ->firstOrFail();

            return view('customer.booking.payment', compact('booking'));
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'Pemesanan tidak ditemukan atau sudah dibayar.');
        }
    }

    public function processPayment(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $booking = Pemesanan::where('id_pemesanan', $id)
                ->where('id_pelanggan', auth('penumpang')->id())
                ->where('status_pembayaran', 'PENDING')
                ->firstOrFail();

            $request->validate([
                'payment_method' => 'required|in:credit_card,bank_transfer,e_wallet',
                'payment_proof' => 'required|image|max:2048'
            ]);

            // Upload bukti pembayaran
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');

            // Update status pembayaran
            $booking->status_pembayaran = 'PAID';
            $booking->payment_method = $request->payment_method;
            $booking->payment_proof = $path;
            $booking->paid_at = now();
            $booking->save();

            DB::commit();

            return redirect()->route('booking.ticket', ['id' => $booking->id_pemesanan])
                ->with('success', 'Pembayaran berhasil. Silahkan lihat e-ticket Anda.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Payment Error: ' . $e->getMessage());
            return back()
                ->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function showTicket($id)
    {
        try {
            $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
                ->where('id_pemesanan', $id)
                ->where('id_pelanggan', auth('penumpang')->id())
                ->where('status_pembayaran', 'PAID')
                ->firstOrFail();

            return view('customer.booking.ticket', compact('booking'));
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'E-ticket tidak ditemukan.');
        }
    }

    public function myBookings()
    {
        $bookings = Pemesanan::with(['rute.transportasi'])
            ->where('id_pelanggan', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.booking.my-bookings', compact('bookings'));
    }
} 