@extends('layouts.app')

<style>
    .bookings-container {
        max-width: 1200px;
        margin: 32px auto;
        padding: 0 20px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .booking-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .booking-card:hover {
        transform: translateY(-2px);
    }

    .booking-header {
        background: linear-gradient(135deg, #6851FF, #8B74FF);
        padding: 16px 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .booking-code {
        font-weight: 600;
    }

    .booking-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .status-paid {
        background: #10B981;
    }

    .status-pending {
        background: #F59E0B;
    }

    .status-cancelled {
        background: #EF4444;
    }

    .booking-body {
        padding: 20px;
    }

    .flight-info {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 16px;
        background: #F8F9FA;
        border-radius: 8px;
        margin-bottom: 16px;
    }

    .airline-logo {
        width: 48px;
        height: 48px;
        object-fit: contain;
    }

    .route-info {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .city-pair {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .city {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .time {
        font-size: 14px;
        color: #6B7280;
    }

    .booking-footer {
        padding: 16px 20px;
        border-top: 1px solid #E5E7EB;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-info {
        font-weight: 600;
        color: #1a1a1a;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-view {
        background: #6851FF;
        color: white;
    }

    .btn-view:hover {
        background: #5842FF;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .empty-icon {
        font-size: 48px;
        color: #6B7280;
        margin-bottom: 16px;
    }

    .empty-text {
        font-size: 16px;
        color: #6B7280;
        margin-bottom: 24px;
    }

    .btn-book {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #6851FF;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-book:hover {
        background: #5842FF;
        color: white;
    }
</style>

@section('content')
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
@endsection 