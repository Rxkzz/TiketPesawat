<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerbangan - {{ $flight->transportasi->nama }}</title>
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

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 20px;
        }

        .detail-wrapper {
            margin-top: var(--navbar-height);
            padding: 24px 0;
            background: white;
        }

        .detail-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(110, 46, 191, 0.15);
        }

        .flight-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .route-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .route-info h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .passenger-info {
            color: var(--text-gray);
            font-size: 14px;
        }

        .flight-section {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .departure-info {
            display: flex;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 24px;
        }

        .time-location {
            flex: 1;
        }

        .time {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .location {
            font-size: 14px;
            color: var(--text-gray);
        }

        .airline-detail {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: var(--light-purple);
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .airline-logo {
            width: 32px;
            height: 32px;
        }

        .airline-info span {
            display: block;
            font-size: 14px;
        }

        .flight-number {
            color: var(--text-gray);
        }

        .included-facilities {
            margin-top: 24px;
        }

        .facility-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .facility-item i {
            color: var(--text-gray);
            width: 20px;
        }

        .facility-text {
            font-size: 14px;
        }

        .see-more {
            color: var(--primary-purple);
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background: white;
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            padding: 24px;
            border-radius: 16px;
        }

        .modal-close {
            position: absolute;
            right: 24px;
            top: 24px;
            cursor: pointer;
            font-size: 20px;
            color: var(--text-gray);
        }

        /* Modern Button Styles */
        .btn-modern {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary-purple), #8B5CF6);
            color: white;
            box-shadow: 0 4px 12px rgba(110, 46, 191, 0.15);
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(110, 46, 191, 0.25);
        }

        .btn-outline-modern {
            background: white;
            color: var(--primary-purple);
            border: 2px solid var(--primary-purple);
        }

        .btn-outline-modern:hover {
            background: var(--light-purple);
            transform: translateY(-2px);
        }

        /* Flight Detail Card */
        .flight-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 24px;
            margin-bottom: 24px;
        }

        .price-summary {
            background: var(--light-purple);
            border-radius: 12px;
            padding: 20px;
            margin-top: 24px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            font-size: 15px;
        }

        .price-total {
            border-top: 2px dashed var(--border-color);
            margin-top: 12px;
            padding-top: 12px;
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-purple);
        }

        /* Form Controls */
        .form-control-modern {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control-modern:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 3px rgba(110, 46, 191, 0.1);
            outline: none;
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 16px;
            margin-top: 24px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .btn-modern {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('customer.partials.navbar')

    <div class="main-container">
        
        <div class="detail-card">
            <div class="flight-header">
                <div class="route-info">
                    <h1>{{ $flight->rute_awal }} → {{ $flight->tujuan }}</h1>
                </div>
                <div class="passenger-info">
                    1 Dewasa
                </div>
            </div>

            <div class="flight-section">
                <div class="departure-info">
                    <div class="time-location">
                        <div class="time">{{ \Carbon\Carbon::parse($flight->waktu_berangkat)->format('H:i') }}</div>
                        <div class="location">Soekarno Hatta - Terminal 3 Domestik</div>
                        <div class="date">{{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d M') }}</div>
                    </div>
                </div>

                <div class="airline-detail">
                    <img src="{{ asset('images/airlines/' . $flight->transportasi->kode . '.png') }}" alt="Airline Logo" class="airline-logo">
                    <div class="airline-info">
                        <span>{{ $flight->transportasi->nama }}</span>
                        <span class="flight-number">{{ $flight->transportasi->kode }} • {{ $flight->class->nama_class }} • {{ \Carbon\Carbon::parse($flight->waktu_berangkat)->diffInMinutes(\Carbon\Carbon::parse($flight->waktu_tiba)) }}m</span>
                    </div>
                </div>

                <div class="included-facilities">
                    <div class="facility-title">Tiket Sudah Termasuk</div>
                    <div class="facility-item">
                    <i class="fas fa-suitcase"></i>
                        <div class="facility-text">
                            Kabin: 7 kg<br>
                            Bagasi: 20 kg
                        </div>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-utensils"></i>
                        <div class="facility-text">Tidak termasuk makanan</div>
                    </div>
                    <a class="see-more" onclick="showFacilities()">Lihat fasilitas lain</a>
                </div>
            </div>

            <div style="margin-top: 32px;">
            <div class="action-buttons">
                    <a href="{{ route('booking.create', $flight->id_rute) }}" class="btn-modern btn-primary-modern">
                        <i class="fas fa-ticket-alt"></i>
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilities Modal -->
    <div id="facilitiesModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeFacilities()">&times;</span>
            <h3>Fasilitas Penerbangan</h3>
            <div class="facility-list">
                <div class="facility-item">
                    <i class="fas fa-suitcase"></i>
                    <div class="facility-text">
                        <strong>Bagasi</strong><br>
                        Kabin: 7 kg<br>
                        Bagasi: 20 kg
                    </div>
                </div>
                <div class="facility-item">
                    <i class="fas fa-utensils"></i>
                    <div class="facility-text">
                        <strong>Makanan</strong><br>
                        Tidak termasuk makanan
                </div>
                </div>
                <div class="facility-item">
                    <i class="fas fa-wifi"></i>
                    <div class="facility-text">
                        <strong>WiFi</strong><br>
                        Tersedia WiFi di pesawat
                    </div>
                </div>
                <!-- Tambahkan fasilitas lain sesuai kebutuhan -->
            </div>
        </div>
    </div>

    <script>
        function showFacilities() {
            document.getElementById('facilitiesModal').style.display = 'block';
        }

        function closeFacilities() {
            document.getElementById('facilitiesModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('facilitiesModal')) {
                closeFacilities();
            }
        }
    </script>
</body>
</html> 