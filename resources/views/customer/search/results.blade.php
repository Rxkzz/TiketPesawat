<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Pesawat - Search Results</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search/results.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('customer.partials.navbar')
    
    <!-- Search Bar -->
        <div class="search-bar">
            <form action="{{ route('search.flights') }}" method="POST" class="search-form">
                @csrf
                <div class="search-input-group">
                    <div class="location-input">
                        <i class="fas fa-plane-departure"></i>
                        <div>
                            <select name="from" required style="border:none; background:none; outline:none;">
                                <option value="">Pilih Kota Asal</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id_transportasi }}" {{ $search_params['from'] == $route->id_transportasi ? 'selected' : '' }}>
                                        {{ $route->rute_awal }} ({{ $route->transportasi->kode }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="button" class="location-swap">
                        <i class="fas fa-exchange-alt"></i>
                    </button>

                    <div class="location-input">
                        <i class="fas fa-plane-arrival"></i>
                        <div>
                            <select name="to" required style="border:none; background:none; outline:none;">
                                <option value="">Pilih Kota Tujuan</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id_transportasi }}" {{ $search_params['to'] == $route->id_transportasi ? 'selected' : '' }}>
                                        {{ $route->tujuan }} ({{ $route->transportasi->kode }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="location-input">
                        <i class="far fa-calendar"></i>
                        <div>
                            <input type="date" name="tanggal_berangkat" value="{{ $search_params['tanggal_berangkat'] ?? '' }}" required style="border:none; background:none; outline:none;">
                        </div>
                    </div>

                    <div class="location-input">
                        <i class="fas fa-user"></i>
                        <div style="display: flex; gap: 10px;">
                            <select name="passenger_count" required style="border:none; background:none; outline:none;">
                                <option value="">Jumlah Penumpang</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ ($search_params['passenger_count'] ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }} Penumpang
                                    </option>
                                @endfor
                            </select>
                            <select name="id_class" required style="border:none; background:none; outline:none;">
                                <option value="">Pilih Kelas</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->nama_class }}" {{ ($search_params['id_class'] ?? '') == $class->nama_class ? 'selected' : '' }}>
                                        {{ $class->nama_class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

    <div class="main-container">
        <!-- Date Navigation -->
        @if($results->isNotEmpty())
        <div class="date-scroll-wrapper">
            <div class="date-scroll">
                @for($i = -4; $i <= 4; $i++)
                    @php
                        $date = \Carbon\Carbon::parse($results->first()->tanggal_berangkat)->addDays($i);
                        $isActive = $i == 0;
                    @endphp
                    <div class="date-item {{ $isActive ? 'active' : '' }}">
                        <div class="date">{{ $date->format('D, d M Y') }}</div>
                        <div class="price">IDR {{ number_format($results->min('total_harga') + ($i * 50000), 0, ',', '.') }}</div>
                    </div>
                @endfor
            </div>
        </div>
        @else
        <div class="alert alert-info">
            <p>Maaf, tidak ada penerbangan yang tersedia untuk pencarian Anda.</p>
            <p>Silakan coba tanggal atau rute lain.</p>
        </div>
        @endif

        <!-- Filter Bar -->
        <div class="filter-bar">
            
            <div class="dropdown">
                <button class="filter-button" type="button" id="urutanFilterButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-sort"></i>
                Urutkan
                <i class="fas fa-chevron-down"></i>
            </button>
                <ul class="dropdown-menu" aria-labelledby="urutanFilterButton" id="urutanList">
                    <li><a class="dropdown-item active" href="#" data-sort="all">
                        <div class="urutan-item">
                            <span class="urutan-name">Semua</span>
                        </div>
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" data-sort="rekomendasi">
                        <div class="urutan-item">
                            <span class="urutan-name">Rekomendasi</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="harga_terendah">
                        <div class="urutan-item">
                            <span class="urutan-name">Harga terendah</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="berangkat_awal">
                        <div class="urutan-item">
                            <span class="urutan-name">Keberangkatan paling awal</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="berangkat_akhir">
                        <div class="urutan-item">
                            <span class="urutan-name">Keberangkatan paling akhir</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="tiba_awal">
                        <div class="urutan-item">
                            <span class="urutan-name">Kedatangan paling awal</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="tiba_akhir">
                        <div class="urutan-item">
                            <span class="urutan-name">Kedatangan paling akhir</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-sort="durasi_pendek">
                        <div class="urutan-item">
                            <span class="urutan-name">Durasi terpendek</span>
                        </div>
                    </a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="filter-button" type="button" id="transitFilterButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-plane"></i>
                Transit
                <i class="fas fa-chevron-down"></i>
            </button>
                <ul class="dropdown-menu" aria-labelledby="transitFilterButton" id="transitList">
                    <li><a class="dropdown-item active" href="#" data-transit="all">
                        <div class="transit-item">
                            <span class="transit-name">Semua</span>
                        </div>
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" data-transit="langsung">
                        <div class="transit-item">
                            <span class="transit-name">Langsung</span>
                        </div>
                    </a></li>
                    <li><a class="dropdown-item" href="#" data-transit="1-transit">
                        <div class="transit-item">
                            <span class="transit-name">1 Transit</span>
                        </div>
                    </a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="filter-button" type="button" id="waktuFilterButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-clock"></i>
                Waktu
                <i class="fas fa-chevron-down"></i>
            </button>
                <ul class="dropdown-menu dropdown-menu-lg" aria-labelledby="waktuFilterButton" id="waktuList">
                    <div class="waktu-filter-container">
                        <div class="waktu-section">
                            <h6 class="dropdown-header">Waktu Pergi</h6>
                            <li><a class="dropdown-item active" href="#" data-waktu-type="all" data-start="" data-end="">
                                <div class="waktu-item">
                                    <span class="waktu-range">Semua Waktu</span>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="pergi" data-start="00:00" data-end="06:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">00:00 - 06:00</span>
                                    <small class="text-muted d-block">Dini hari</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="pergi" data-start="06:00" data-end="12:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">06:00 - 12:00</span>
                                    <small class="text-muted d-block">Pagi</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="pergi" data-start="12:00" data-end="18:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">12:00 - 18:00</span>
                                    <small class="text-muted d-block">Siang</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="pergi" data-start="18:00" data-end="24:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">18:00 - 24:00</span>
                                    <small class="text-muted d-block">Malam</small>
                                </div>
                            </a></li>
                        </div>

                        <div class="waktu-divider"></div>

                        <div class="waktu-section">
                            <h6 class="dropdown-header">Waktu Tiba</h6>
                            <li><a class="dropdown-item active" href="#" data-waktu-type="all" data-start="" data-end="">
                                <div class="waktu-item">
                                    <span class="waktu-range">Semua Waktu</span>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="tiba" data-start="00:00" data-end="06:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">00:00 - 06:00</span>
                                    <small class="text-muted d-block">Dini hari</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="tiba" data-start="06:00" data-end="12:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">06:00 - 12:00</span>
                                    <small class="text-muted d-block">Pagi</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="tiba" data-start="12:00" data-end="18:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">12:00 - 18:00</span>
                                    <small class="text-muted d-block">Siang</small>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#" data-waktu-type="tiba" data-start="18:00" data-end="24:00">
                                <div class="waktu-item">
                                    <span class="waktu-range">18:00 - 24:00</span>
                                    <small class="text-muted d-block">Malam</small>
                                </div>
                            </a></li>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="dropdown">
                <button class="filter-button" type="button" id="typeFilterButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-plane"></i>
                    Type Pesawat
                <i class="fas fa-chevron-down"></i>
            </button>
                <ul class="dropdown-menu" aria-labelledby="typeFilterButton" id="typePesawatList">
                    <li><a class="dropdown-item active" href="#" data-type-id="all">
                        <div class="type-item">
                            <span class="type-name">Semua Type Pesawat</span>
                            <small class="text-muted d-block">Tampilkan semua tipe pesawat yang tersedia</small>
                        </div>
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    @foreach($airlines->unique('type') as $airline)
                    <li>
                        <a class="dropdown-item" href="#" data-type-id="{{ $airline['type'] }}">
                            <div class="type-item">
                                <span class="type-name">{{ $airline['type'] }}</span>
                                @if(isset($airline['keterangan_type']))
                                <small class="text-muted d-block">{{ $airline['keterangan_type'] }}</small>
                                @endif
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            </div>

        <!-- Promo Banner -->
        <div class="promo-banner">
            <i class="fas fa-gift"></i>
            <div class="promo-text">
                <div class="promo-title">Wah, ada Jaminan Harga Termurah untuk tujuan penerbangan yang kamu cari! (*)</div>
                <div class="promo-subtitle">*Syarat & Ketentuan berlaku</div>
            </div>
            <i class="fas fa-chevron-right"></i>
        </div>

        <!-- Results Section -->
        <div id="searchResults">
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
            </div>
    </div>

    @include('customer.partials.footer')

    <script>
        const homeRoute = '{{ route("home") }}';
    </script>
    <script src="{{ asset('js/search/results.js') }}"></script>
</body>
</html>