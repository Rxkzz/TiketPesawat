<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerbangan - {{ $flight->transportasi->keterangan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search/flight_detail.css') }}">
    <style>
        body {
            background-image: url("{{ asset('images/bg_2.jpg') }}");
        }
        
        .facility-icon {
            width: 24px;
            height: 24px;
            object-fit: contain;
            margin-right: 10px;
        }

        .flight-class {
            margin-top: 8px;
        }

        .flight-class .badge {
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    @include('customer.partials.loader')
    @include('customer.partials.navbar')

    <div class="main-container">
        <div class="detail-card">
            <div class="flight-header">
                <div class="route-info">
                    <h1>{{ $flight->rute_awal }} → {{ $flight->tujuan }}</h1>
                    <div class="flight-class">
                        <span class="badge bg-primary">Kelas {{ $flight->class->nama_class }}</span>
                    </div>
                </div>
                <div class="passenger-info">
                    <div class="passenger-counter">
                        <label>Jumlah Penumpang:</label>
                        <div class="counter-controls">
                            <button type="button" class="btn-counter" onclick="updatePassengers(-1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="passenger-count" value="1" min="1" max="{{ $flight->kursi_tersedia }}" readonly>
                            <button type="button" class="btn-counter" onclick="updatePassengers(1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flight-section">
                <div class="airline-info">
                    <img src="{{ $flight->transportasi->image ? asset('storage/' . $flight->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                         alt="{{ $flight->transportasi->keterangan }}" 
                         class="airline-logo">
                    <div class="airline-details">
                        <span class="airline-name">{{ $flight->transportasi->keterangan }}</span>
                        <span class="flight-code">{{ $flight->transportasi->kode }}</span>
                    </div>
                </div>

                <div class="flight-schedule">
                    <div class="time-info">
                        <div class="departure">
                            <div class="time">{{ \Carbon\Carbon::parse($flight->waktu_berangkat)->format('H:i') }}</div>
                            <div class="date">{{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d M Y') }}</div>
                            <div class="airport">{{ $flight->rute_awal }}</div>
                            <div class="terminal">Terminal 1 Domestik</div>
                        </div>
                        <div class="duration">
                            <div class="duration-line">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="duration-time">
                                {{ \Carbon\Carbon::parse($flight->waktu_berangkat)->diffInMinutes(\Carbon\Carbon::parse($flight->waktu_tiba)) }} menit
                            </div>
                            <div class="flight-type">Langsung</div>
                        </div>
                        <div class="arrival">
                            <div class="time">{{ \Carbon\Carbon::parse($flight->waktu_tiba)->format('H:i') }}</div>
                            <div class="date">{{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('d M Y') }}</div>
                            <div class="airport">{{ $flight->tujuan }}</div>
                            <div class="terminal">Terminal 1 Domestik</div>
                        </div>
                    </div>
                </div>

                <div class="included-facilities">
                    <div class="facility-title">Tiket Sudah Termasuk</div>
                    @if($flight->class && $flight->class->fasilitas)
                        @foreach($flight->class->fasilitas->take(2) as $fasilitas)
                        <div class="facility-item">
                            <img src="{{ asset($fasilitas->icon_url) }}" alt="{{ $fasilitas->nama_fasilitas }}" class="facility-icon">
                            <div class="facility-text">
                                <strong>{{ $fasilitas->nama_fasilitas }}</strong><br>
                                {{ $fasilitas->deskripsi }}
                            </div>
                        </div>
                        @endforeach
                        @if($flight->class->fasilitas->count() > 2)
                            <a class="see-more" onclick="showFacilities()">Lihat {{ $flight->class->fasilitas->count() - 2 }} fasilitas lainnya</a>
                        @endif
                    @else
                        <div class="facility-item">
                            <i class="fas fa-info-circle"></i>
                            <div class="facility-text">
                                Tidak ada fasilitas yang tersedia
                            </div>
                        </div>
                    @endif
                </div>

                <div class="price-section">
                    <div class="price-details">
                        <div class="price-per-person">
                            <span>Harga per orang:</span>
                            <span class="amount">Rp {{ number_format($flight->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-price">
                            <span>Total harga:</span>
                            <span class="total-amount" id="total-price">Rp {{ number_format($flight->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-section">
                <div class="seats-info">
                    <i class="fas fa-chair"></i>
                    <span>{{ $flight->kursi_tersedia }} kursi tersedia</span>
                </div>
                <form action="{{ route('booking.create', $flight->id_rute) }}" method="GET" class="booking-form">
                    <input type="hidden" name="jumlah_penumpang" id="hidden-passenger-count" value="1">
                    <button type="submit" class="btn-modern btn-primary-modern">
                        <i class="fas fa-ticket-alt"></i>
                        Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Facilities Modal -->
    <div id="facilitiesModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeFacilities()">&times;</span>
            <h3>Fasilitas Kelas {{ $flight->class->nama_class }}</h3>
            <div class="facility-list">
                @if($flight->class && $flight->class->fasilitas)
                    @foreach($flight->class->fasilitas as $fasilitas)
                    <div class="facility-item">
                        <img src="{{ asset($fasilitas->icon_url) }}" alt="{{ $fasilitas->nama_fasilitas }}" class="facility-icon">
                        <div class="facility-text">
                            <strong>{{ $fasilitas->nama_fasilitas }}</strong><br>
                            {{ $fasilitas->deskripsi }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="facility-item">
                        <i class="fas fa-info-circle"></i>
                        <div class="facility-text">
                            Tidak ada fasilitas yang tersedia untuk kelas ini
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        const basePrice = {{ $flight->total_harga }};
        const maxSeats = {{ $flight->kursi_tersedia }};

        function updatePassengers(change) {
            const input = document.getElementById('passenger-count');
            const hiddenInput = document.getElementById('hidden-passenger-count');
            let currentValue = parseInt(input.value);
            let newValue = currentValue + change;

            if (newValue >= 1 && newValue <= maxSeats) {
                input.value = newValue;
                hiddenInput.value = newValue;
                updateTotalPrice(newValue);
            }
        }

        function updateTotalPrice(passengers) {
            const totalPrice = basePrice * passengers;
            document.getElementById('total-price').textContent = 
                'Rp ' + totalPrice.toLocaleString('id-ID');
        }

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