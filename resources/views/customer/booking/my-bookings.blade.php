<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiketPesawat - Find Your Best Flight</title>
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking/my-bookings.css') }}">

</head>

<body>
    @include('customer.partials.navbar')

<div class="bookings-container">
    <h1 class="page-title">
        <i class="fas fa-ticket-alt text-primary"></i>
        Riwayat Pemesanan
    </h1>

    @if($bookings->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-plane"></i>
            </div>
            <p class="empty-text">Anda belum memiliki riwayat pemesanan tiket</p>
            <a href="{{ route('home') }}" class="btn-book">
                <i class="fas fa-search"></i>
                Cari Penerbangan
            </a>
        </div>
    @else
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-code">
                        <i class="fas fa-hashtag"></i>
                        {{ $booking->kode_pemesanan }}
                    </div>
                    <div class="booking-status {{ $booking->status_pembayaran == 'PAID' ? 'status-paid' : ($booking->status_pembayaran == 'PENDING' ? 'status-pending' : 'status-cancelled') }}">
                        {{ $booking->status_pembayaran }}
                    </div>
                </div>

                <div class="booking-body">
                    <div class="flight-info">
                        <img src="{{ asset('images/airlines/' . $booking->rute->transportasi->kode . '.png') }}" 
                             alt="Airline Logo" 
                             class="airline-logo">
                        
                        <div class="route-info">
                            <div class="departure">
                                <div class="city">{{ $booking->rute->rute_awal }}</div>
                                <div class="time">{{ \Carbon\Carbon::parse($booking->rute->waktu_berangkat)->format('H:i') }}</div>
                            </div>
                            
                            <i class="fas fa-long-arrow-alt-right text-primary"></i>
                            
                            <div class="arrival">
                                <div class="city">{{ $booking->rute->tujuan }}</div>
                                <div class="time">{{ \Carbon\Carbon::parse($booking->rute->waktu_tiba)->format('H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="booking-footer">
                    <div class="price-info">
                        IDR {{ number_format($booking->total_bayar, 0, ',', '.') }}
                    </div>
                    <div class="action-buttons">
                        @if($booking->status_pembayaran == 'PAID')
                            <a href="{{ route('booking.ticket', $booking->id_pemesanan) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i>
                                Lihat E-Ticket
                            </a>
                        @else
                            <a href="{{ route('booking.payment', $booking->id_pemesanan) }}" class="btn-action btn-view">
                                <i class="fas fa-credit-card"></i>
                                Lanjutkan Pembayaran
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
</body>