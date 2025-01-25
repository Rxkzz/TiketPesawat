<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket - {{ $booking->kode_pemesanan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-purple: #6E2EBF;
            --light-purple: #F5F2FF;
            --text-dark: #35405A;
            --text-gray: #687182;
            --border-color: #E7E8EA;
            --success-green: #00AA5B;
            --navbar-height: 84px;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #F7F7F7;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            padding-top: var(--navbar-height);
        }

        .ticket-container {
            max-width: 800px;
            margin: 32px auto;
            padding: 0 20px;
        }

        .ticket-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .ticket-header {
            background: linear-gradient(135deg, var(--primary-purple), #8B5CF6);
            padding: 24px;
            color: white;
            text-align: center;
        }

        .booking-code {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .booking-status {
            display: inline-block;
            padding: 4px 12px;
            background: var(--success-green);
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .ticket-body {
            padding: 24px;
        }

        .flight-info {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 20px;
            background: var(--light-purple);
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .airline-logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }

        .route-info {
            flex: 1;
        }

        .city-pair {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
        }

        .city {
            font-size: 18px;
            font-weight: 600;
        }

        .airport {
            font-size: 14px;
            color: var(--text-gray);
        }

        .flight-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .detail-item {
            padding: 16px;
            background: #F8F9FA;
            border-radius: 12px;
        }

        .detail-label {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
        }

        .passenger-info {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border-color);
        }

        .qr-section {
            text-align: center;
            margin-top: 32px;
            padding: 24px;
            border-top: 1px dashed var(--border-color);
        }

        .qr-code {
            width: 160px;
            height: 160px;
            margin-bottom: 12px;
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            margin-top: 24px;
        }

        .btn-action {
            flex: 1;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-download {
            background: var(--primary-purple);
            color: white;
            border: none;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(110, 46, 191, 0.25);
        }

        .btn-share {
            background: var(--light-purple);
            color: var(--primary-purple);
            border: 2px solid var(--primary-purple);
        }

        .btn-share:hover {
            background: var(--primary-purple);
            color: white;
        }

        @media print {
            .no-print {
                display: none;
            }
            
            body {
                padding: 0;
                background: white;
            }
            
            .ticket-container {
                margin: 0;
                padding: 0;
            }
            
            .ticket-card {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    @include('customer.partials.navbar')

    <div class="ticket-container">
        <div class="ticket-card">
            <div class="ticket-header">
                <div class="booking-code">{{ $booking->kode_pemesanan }}</div>
                <div class="booking-status">E-Ticket</div>
            </div>

            <div class="ticket-body">
                <div class="flight-info">
                    <img src="{{ asset('images/airlines/' . $booking->rute->transportasi->kode . '.png') }}" 
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
                            {{ $booking->rute->transportasi->nama }} - {{ $booking->rute->transportasi->kode }}
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
                        <div class="detail-value">{{ $booking->kode_kursi }}</div>
                    </div>
                </div>

                <div class="passenger-info">
                    <h3 class="section-title">Detail Penumpang</h3>
                    <div class="detail-item">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $booking->nama_penumpang }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Nomor Identitas</div>
                        <div class="detail-value">{{ $booking->nomor_identitas }}</div>
                    </div>
                </div>

                <div class="qr-section">
                    {!! QrCode::size(160)->generate($booking->kode_pemesanan) !!}
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