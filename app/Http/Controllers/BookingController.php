<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rute;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function createForm(Rute $flight)
    {
        $flight->load(['transportasi', 'class']);

        // Cek ketersediaan kursi
        $bookedSeats = Pemesanan::where('id_rute', $flight->id_rute)
            ->where('tanggal_berangkat', $flight->tanggal_berangkat)
            ->count();

        if ($bookedSeats >= 100) {
            return back()->with('error', 'Maaf, kursi sudah penuh untuk penerbangan ini.');
        }

        return view('customer.booking.create', compact('flight'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'flight_id' => 'required|exists:rute,id_rute',
            'full_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:16',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        // Ambil data penerbangan
        $flight = Rute::with(['transportasi', 'class'])->findOrFail($request->flight_id);

        // Cek ketersediaan kursi
        $bookedSeats = Pemesanan::where('id_rute', $flight->id_rute)
            ->where('tanggal_berangkat', $flight->tanggal_berangkat)
            ->count();

        if ($bookedSeats >= 100) { // Asumsi kapasitas maksimal 100
            return back()->with('error', 'Maaf, kursi sudah penuh untuk penerbangan ini.');
        }

        try {
            // Generate kode pemesanan unik
            $bookingCode = 'BK-' . strtoupper(Str::random(6));

            // Simpan data pemesanan
            $booking = Pemesanan::create([
                'kode_pemesanan' => $bookingCode,
                'tanggal_pemesanan' => Carbon::now(),
                'tempat_pemesanan' => 'Online',
                'id_pelanggan' => auth('penumpang')->id(),
                'kode_kursi' => 'A' . ($bookedSeats + 1), // Generate kode kursi
                'id_rute' => $flight->id_rute,
                'tujuan' => $flight->tujuan,
                'tanggal_berangkat' => $flight->tanggal_berangkat,
                'jam_cekin' => Carbon::parse($flight->waktu_keberangkatan)
                    ->subHours(2)
                    ->format('H:i:s'),
                'jam_berangkat' => $flight->waktu_keberangkatan,
                'total_bayar' => $flight->total_harga,
                'status_pembayaran' => 'PENDING',
                'nama_penumpang' => $validated['full_name'],
                'nomor_identitas' => $validated['id_number'],
                'email' => $validated['email'],
                'nomor_telepon' => $validated['phone']
            ]);

            // Redirect ke halaman pembayaran
            return redirect()->route('booking.show', $booking->id_pemesanan)
                ->with('success', 'Pemesanan berhasil dibuat. Silahkan lakukan pembayaran.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi.')
                ->withInput();
        }
    }

    public function show($id)
    {
        $booking = Pemesanan::with(['rute.transportasi', 'rute.class'])
            ->where('id_pemesanan', $id)
            ->where('id_pelanggan', auth('penumpang')->id())
            ->firstOrFail();

        // Jika status masih PENDING, tampilkan halaman pembayaran
        if ($booking->status_pembayaran === 'PENDING') {
            return view('customer.booking.payment', compact('booking'));
        }

        // Jika sudah dibayar, tampilkan e-ticket
        return view('customer.booking.ticket', compact('booking'));
    }

    public function processPayment(Request $request, $id)
    {
        $booking = Pemesanan::findOrFail($id);

        // Validasi pembayaran
        $request->validate([
            'payment_method' => 'required|in:credit_card,bank_transfer,e_wallet',
            'payment_proof' => 'required|image|max:2048' // Jika menggunakan upload bukti pembayaran
        ]);

        try {
            // Proses pembayaran (integrasi dengan payment gateway bisa ditambahkan di sini)
            
            // Update status pembayaran
            $booking->update([
                'status_pembayaran' => 'PAID',
                'payment_method' => $request->payment_method,
                'payment_proof' => $request->payment_proof->store('payment_proofs', 'public'),
                'paid_at' => Carbon::now()
            ]);

            // Kirim email konfirmasi
            // Mail::to($booking->email)->send(new BookingConfirmation($booking));

            return redirect()->route('booking.show', $booking->id_pemesanan)
                ->with('success', 'Pembayaran berhasil. E-ticket telah dikirim ke email Anda.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran. Silahkan coba lagi.')
                ->withInput();
        }
    }
} 