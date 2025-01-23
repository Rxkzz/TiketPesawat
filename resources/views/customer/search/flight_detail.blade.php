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
        .facilities-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .facilities-list li {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .facilities-list li i {
            margin-right: 8px;
            color: #28a745;
            width: 20px;
            text-align: center;
        }
        .see-more-facilities {
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            font-size: 14px;
            margin-top: 8px;
        }
        .modal-header {
            border-bottom: none;
            padding: 20px 20px 0;
        }
        .modal-header .close {
            padding: 20px;
            margin: -20px -20px -20px auto;
        }
        .modal-body {
            padding: 20px;
        }
        .facility-section {
            margin-bottom: 24px;
        }
        .facility-section:last-child {
            margin-bottom: 0;
        }
        .facility-section h6 {
            color: #687176;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .facility-section p {
            color: #687176;
            margin-bottom: 16px;
            font-size: 14px;
        }
        .facility-info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        .facility-info:last-child {
            margin-bottom: 0;
        }
        .facility-info i {
            margin-right: 12px;
            color: #28a745;
            margin-top: 3px;
            width: 20px;
            text-align: center;
        }
        .facility-info .content {
            flex: 1;
        }
        .facility-info .title {
            font-size: 14px;
            margin-bottom: 4px;
        }
        .facility-note {
            font-size: 12px;
            color: #687176;
            margin: 0;
        }
        .modal-content {
            border-radius: 12px;
        }
        .modal-title {
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body style="background-color: #f5f5f5; padding: 20px;">
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
                    <div class="detail-label">Kelas</div>
                    <div class="detail-value">{{ $flight->class->nama_class }}</div>
                </div>
                 
                <div class="detail-item">
                    <div class="detail-label">Tipe Pesawat</div>
                    <div class="detail-value">{{ $flight->transportasi->typeTransportasi->nama_type }}</div>
                </div>

                <!-- Fasilitas -->
                <div class="detail-item">
                    <div class="detail-label">Tiket Sudah Termasuk</div>
                    <div class="detail-value">
                        <ul class="facilities-list">
                            <li>
                                <i class="fas fa-suitcase"></i>
                                <span>Bagasi: {{ $flight->class->bagasi }} kg</span>
                            </li>
                            @if($flight->class->hiburan)
                            <li>
                                <i class="fas fa-tv"></i>
                                <span>Hiburan In-Flight</span>
                            </li>
                            @endif
                            @foreach($flight->class->fasilitas->take(2) as $fasilitas)
                            <li>
                                <i class="fas fa-check"></i>
                                <span>{{ $fasilitas->nama_fasilitas }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @if($flight->class->fasilitas->count() > 2)
                        <button type="button" class="see-more-facilities" data-toggle="modal" data-target="#fasilitasModal">
                            Lihat fasilitas lainnya
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Price Section -->
            <div class="price-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="total-price">
                            Rp {{ number_format($flight->total_harga, 0, ',', '.') }}
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

    <!-- Modal Fasilitas -->
    <div class="modal fade" id="fasilitasModal" tabindex="-1" role="dialog" aria-labelledby="fasilitasModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fasilitasModalLabel">Fasilitas Penerbangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="facility-section">
                        <h6>{{ $flight->transportasi->typeTransportasi->nama_type }} • {{ $flight->transportasi->kode }}</h6>
                        <p>{{ $flight->class->nama_class }} • {{ \Carbon\Carbon::parse($flight->waktu_keberangkatan)->format('H:i') }}</p>
                    </div>

                    <div class="facility-section">
                        <h6>Tiket Sudah Termasuk</h6>
                        <div class="facility-info">
                            <i class="fas fa-suitcase"></i>
                            <div class="content">
                                <div class="title">Bagasi: {{ $flight->class->bagasi }} kg</div>
                                <p class="facility-note">Pembelian bagasi tambahan tersedia di halaman pemesanan. *Ketersediaan tergantung pihak maskapai.</p>
                            </div>
                        </div>
                        @if($flight->class->hiburan)
                        <div class="facility-info">
                            <i class="fas fa-tv"></i>
                            <div class="content">
                                <div class="title">Hiburan In-Flight</div>
                                <p class="facility-note">Nikmati berbagai hiburan selama penerbangan.</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="facility-section">
                        <h6>Fasilitas Tambahan</h6>
                        @foreach($flight->class->fasilitas as $fasilitas)
                        <div class="facility-info">
                            <i class="fas fa-check"></i>
                            <div class="content">
                                <div class="title">{{ $fasilitas->nama_fasilitas }}</div>
                                <p class="facility-note">{{ $fasilitas->deskripsi }}</p>
                            </div>
                        </div>
                        @endforeach
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