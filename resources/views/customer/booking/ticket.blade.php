<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket - {{ $booking->kode_pemesanan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking/ticket.css') }}">
</head>
<body>
    @include('customer.partials.navbar')

    @if(session('email_sent'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            E-ticket telah dikirim ke {{ $booking->email }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('email_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('email_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="ticket-container">
        @php
            $nama_penumpang = explode(', ', $booking->nama_penumpang);
            $nomor_identitas = explode(', ', $booking->nomor_identitas);
        @endphp
        
        @for($i = 0; $i < count($nama_penumpang); $i++)
            <div class="ticket-card mb-4">
                <div class="ticket-header">
                    <div class="booking-code">{{ $booking->kode_pemesanan }}-{{ $i + 1 }}</div>
                    <div class="booking-status">E-Ticket</div>
                </div>

                <div class="ticket-body">
                    <div class="flight-info">
                        <img src="{{ $booking->rute->transportasi->image ? asset('storage/' . $booking->rute->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                            alt="Airline Logo" 
                            class="airline-logo">
                        <div class="route-info">
                            <div class="city-pair">
                                <div>
                                    <div class="city">{{ $booking->rute->rute_awal }}</div>
                                    <div class="airport">Terminal 3</div>
                                </div>
                                <i class="fas fa-plane"></i>
                                <div>
                                    <div class="city">{{ $booking->rute->tujuan }}</div>
                                    <div class="airport">Terminal 2</div>
                                </div>
                            </div>
                            <div class="flight-number">
                                {{ $booking->rute->transportasi->keterangan }} - {{ $booking->rute->transportasi->kode }}
                            </div>
                        </div>
                    </div>

                    <div class="flight-details">
                        <div class="detail-item">
                            <div class="detail-label">Tanggal Keberangkatan</div>
                            <div class="detail-value">
                                {{ \Carbon\Carbon::parse($booking->tanggal_berangkat)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Waktu Keberangkatan</div>
                            <div class="detail-value">{{ $booking->jam_berangkat }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Check-in</div>
                            <div class="detail-value">{{ $booking->jam_cekin }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Nomor Kursi</div>
                            <div class="detail-value">{{ $booking->kode_kursi ? explode(', ', $booking->kode_kursi)[$i] ?? 'TBA' : 'TBA' }}</div>
                        </div>
                    </div>

                    <div class="passenger-info">
                        <h3 class="section-title">Detail Penumpang</h3>
                        <div class="passenger-item">
                            <h4 class="passenger-title">Penumpang {{ $i + 1 }}</h4>
                            <div class="detail-item">
                                <div class="detail-label">Nama Lengkap</div>
                                <div class="detail-value">{{ $nama_penumpang[$i] }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Nomor Identitas</div>
                                <div class="detail-value">{{ $nomor_identitas[$i] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="qr-section">
                        {!! QrCode::size(160)->generate($booking->kode_pemesanan . '-' . ($i + 1)) !!}
                        <div class="detail-label">Scan untuk check-in</div>
                    </div>

                    <div class="action-buttons no-print">
                        <button onclick="window.print()" class="btn-action btn-download">
                            <i class="fas fa-download"></i> Download E-Ticket
                        </button>
                        <button onclick="shareTicket()" class="btn-action btn-share">
                            <i class="fas fa-share-alt"></i> Bagikan
                        </button>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <script>
        function shareTicket() {
            if (navigator.share) {
                navigator.share({
                    title: 'E-Ticket {{ $booking->kode_pemesanan }}',
                    text: 'Ini adalah e-ticket untuk penerbangan saya',
                    url: window.location.href
                });
            }
        }
    </script>
</body>
</html>