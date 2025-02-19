  <!-- Flight Results -->
  @foreach($results as $result)
    <div class="flight-card {{ $result->kursi_tersedia <= 0 ? 'sold-out' : '' }}">
        @if($result->kursi_tersedia > 0)
            <a href="{{ route('flight.show', $result->id_rute) }}" class="flight-content">
        @else
            <div class="flight-content" onclick="showSoldOutAlert()">
        @endif
            <div class="airline-header">
                <img src="{{ $result->transportasi->image ? asset('storage/' . $result->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                     alt="{{ $result->transportasi->keterangan }}" 
                     class="airline-logo">
                <span class="airline-name">{{ $result->transportasi->keterangan }}</span>
                <span class="flight-type">{{ $result->transportasi->typeTransportasi->nama_type }}</span>
                @if($result->kursi_tersedia <= 0)
                    <span class="sold-out-badge">
                        <i class="fas fa-times-circle"></i>
                        Tiket Habis
                    </span>
                @endif
            </div>

            <div class="flight-info">
                <div class="time-section">
                    <div class="time">{{ \Carbon\Carbon::parse($result->waktu_berangkat)->format('H:i') }}</div>
                    <div class="city">{{ $result->rute_awal }}</div>
                </div>

                <div class="flight-duration">
                    <div class="duration-text">{{ \Carbon\Carbon::parse($result->waktu_berangkat)->diffInMinutes(\Carbon\Carbon::parse($result->waktu_berangkat)->addHours(1)->addMinutes(20)) }} menit</div>
                    <div class="duration-line"></div>
                    <div class="transit-info">1 transit</div>
                </div>

                <div class="time-section">
                    <div class="time">{{ \Carbon\Carbon::parse($result->waktu_berangkat)->addHours(1)->addMinutes(20)->format('H:i') }}</div>
                    <div class="city">{{ $result->tujuan }}</div>
                </div>

                <div class="price-section">
                    <div class="price-amount">IDR {{ number_format($result->total_harga, 0, ',', '.') }}</div>
                    <div class="price-label">/pax</div>
                    <div class="points">
                        <i class="fas fa-circle"></i>
                        {{ number_format($result->total_harga/1000, 0) }} poin
                    </div>
                </div>
            </div>

            <div class="flight-footer">
                <div class="reschedule-badge">
                    <i class="fas fa-sync-alt"></i>
                    Bisa reschedule & refund
                </div>
                @if($result->kursi_tersedia <= 0)
                    <div class="sold-out-info">
                        <i class="fas fa-exclamation-circle"></i>
                        Klik untuk mencari penerbangan lain
                    </div>
                @else
                    <div class="seats-badge {{ $result->kursi_tersedia <= 5 ? 'seats-warning' : '' }}">
                        <i class="fas fa-chair"></i>
                        {{ $result->kursi_tersedia }} kursi tersisa
                    </div>
                @endif
            </div>
        @if($result->kursi_tersedia > 0)
            </a>
        @else
            </div>
        @endif
    </div>
    @endforeach

<style>
.flight-card {
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
}

.flight-card.sold-out {
    opacity: 0.7;
}

.flight-card.sold-out:hover {
    opacity: 0.8;
}

.sold-out-badge {
    background-color: #ef4444;
    color: white;
    padding: 4px 8px;
    border-radius: 9999px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    animation: pulse 2s infinite;
}

.sold-out-info {
    color: #ef4444;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.seats-badge {
    background-color: #10b981;
    color: white;
    padding: 4px 8px;
    border-radius: 9999px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.seats-badge.seats-warning {
    background-color: #f59e0b;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}
</style>

<script>
function showSoldOutAlert() {
    Swal.fire({
        title: 'Tiket Sudah Habis!',
        html: `
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-ticket-alt text-red-500 text-5xl mb-4"></i>
                </div>
                <p class="mb-4">Maaf, tiket untuk penerbangan ini sudah habis.</p>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Saran untuk Anda:</p>
                    <ul class="text-left text-sm space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Coba cari penerbangan di tanggal lain
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-plane text-blue-500 mr-2"></i>
                            Periksa maskapai lain yang tersedia
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-route text-blue-500 mr-2"></i>
                            Coba rute alternatif yang tersedia
                        </li>
                    </ul>
                </div>
            </div>
        `,
        icon: 'warning',
        confirmButtonText: 'Cari Penerbangan Lain',
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("home") }}';
        }
    });
}
</script>