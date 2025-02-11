  <!-- Flight Results -->
  @foreach($results as $result)
        <a href="{{ route('flight.show', $result->id_rute) }}" class="flight-card">
            <div class="airline-header">
                <img src="{{ $result->transportasi->image ? asset('storage/' . $result->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                     alt="{{ $result->transportasi->keterangan }}" 
                     class="airline-logo">
                <span class="airline-name">{{ $result->transportasi->keterangan }}</span>
                <span class="flight-type">{{ $result->transportasi->typeTransportasi->nama_type }}</span>
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
            </div>
        </a>
            @endforeach