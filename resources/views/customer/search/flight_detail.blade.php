<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Penerbangan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        .flight-detail-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 20px 0;
            padding: 24px;
        }
        .flight-header {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .flight-route {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .flight-date {
            color: #687176;
            font-size: 14px;
        }
        .airline-info {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        .airline-logo {
            width: 32px;
            height: 32px;
            margin-right: 12px;
        }
        .airline-name {
            font-size: 16px;
            font-weight: 500;
        }
        .flight-number {
            color: #687176;
            font-size: 14px;
        }
        .flight-schedule {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        .time-info {
            flex: 1;
            text-align: center;
        }
        .time {
            font-size: 24px;
            font-weight: bold;
        }
        .airport {
            color: #687176;
            font-size: 14px;
            margin-top: 4px;
        }
        .flight-duration {
            text-align: center;
            padding: 0 24px;
            position: relative;
        }
        .duration-line {
            height: 2px;
            background: #e0e0e0;
            position: relative;
            margin: 8px 0;
        }
        .duration-line::before,
        .duration-line::after {
            content: '•';
            position: absolute;
            top: -8px;
            color: #e0e0e0;
        }
        .duration-line::before { left: -4px; }
        .duration-line::after { right: -4px; }
        .duration-text {
            color: #687176;
            font-size: 14px;
        }
        .flight-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }
        .detail-item {
            margin-bottom: 16px;
        }
        .detail-label {
            color: #687176;
            font-size: 14px;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 16px;
        }
        .price-section {
            background: #fff;
            border-radius: 8px;
            padding: 24px;
            margin-top: 16px;
        }
        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #FF5722;
        }
        .book-button {
            background: #FF5722;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            margin-top: 16px;
        }
        .book-button:hover {
            background: #f4511e;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('images/image_1.jpg') }}'); background-size: cover; background-position: center; padding: 20px;">
    <div class="container mt-5">
        <div class="flight-detail-container">
            <!-- Header -->
            <div class="flight-header">
                <div class="flight-route">
                    {{ $flight->rute_awal }} → {{ $flight->tujuan }}
                </div>
                <div class="flight-date">
                    {{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('l, d F Y') }} • 1 Dewasa
                </div>
            </div>

            <!-- Airline Info -->
            <div class="airline-info">
                <img src="{{ asset('images/lion-air-logo.png') }}" alt="Airline Logo" class="airline-logo">
                <div>
                    <div class="airline-name">{{ $flight->transportasi->nama }}</div>
                    <div class="flight-number">{{ $flight->transportasi->kode }}</div>
                </div>
            </div>

            <!-- Flight Schedule -->
            <div class="flight-schedule">
                <div class="time-info">
                    <div class="time">{{ \Carbon\Carbon::parse($flight->waktu_keberangkatan)->format('H:i') }}</div>
                    <div class="airport">{{ $flight->rute_awal }}</div>
                </div>
                <div class="flight-duration">
                    <div class="duration-line"></div>
                    <div class="duration-text">1j 30m</div>
                </div>
                <div class="time-info">
                    <div class="time">{{ \Carbon\Carbon::parse($flight->waktu_keberangkatan)->addHours(2)->format('H:i') }}</div>
                    <div class="airport">{{ $flight->tujuan }}</div>
                </div>
            </div>

            <!-- Flight Details -->
            <div class="flight-details">
                <div class="detail-item">
                    <div class="detail-label">Tipe Pesawat</div>
                    <div class="detail-value">Boeing 737</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Bagasi</div>
                    <div class="detail-value">20 kg</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Hiburan</div>
                    <div class="detail-value">Tidak tersedia</div>
                </div>
            </div>

            <!-- Price Section -->
            <div class="price-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="total-price">
                            Rp {{ number_format($flight->harga, 0, ',', '.') }}
                        </div>
                        <div class="text-muted">per orang</div>
                    </div>
                    <div class="col-md-6">
                        <button class="book-button">
                            Pilih Penerbangan Ini
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 