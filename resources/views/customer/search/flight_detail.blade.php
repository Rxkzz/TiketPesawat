<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerbangan - {{ $flight->transportasi->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/search/flight_detail.css') }}">
    <style>
        body {
            background-image: url("{{ asset('images/bg_2.jpg') }}");
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
                    <img src="{{ $flight->transportasi->image ? asset('storage/' . $flight->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                         alt="{{ $flight->transportasi->keterangan }}" 
                         class="airline-logo">
                    <div class="airline-info">
                        <span>{{ $flight->transportasi->keterangan }}</span>
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