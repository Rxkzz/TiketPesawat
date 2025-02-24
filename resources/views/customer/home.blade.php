<!DOCTYPE html>
<html lang="en">
<head>
    @php
        use Illuminate\Support\Facades\Storage;
        use Carbon\Carbon;
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiketPesawat - Temukan Penerbangan Terbaik Anda</title>
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    @include('customer.partials.loader')
    @include('customer.partials.navbar')

    <!-- Content -->
    <div class="container">
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Temukan tiket pesawat murah dari ribuan maskapai dan agen perjalanan</h1>
                
                <div class="product-nav">
                    <a href="#" class="product-item active">
                        <i class="fas fa-plane"></i>
                        <span>Penerbangan</span>
                    </a>
                    <a href="#" class="product-item">
                        <i class="fas fa-bed"></i>
                        <span>Penginapan</span>
                    </a>
                    <a href="#" class="product-item">
                        <i class="fas fa-car"></i>
                        <span>Rental Mobil</span>
                    </a>
                </div>

                <div class="search-container">
                    <form action="{{ route('search.flights') }}" method="POST">
                        @csrf
                        <div class="search-row">
                            <div class="search-input">
                                <i class="fas fa-plane-departure"></i>
                                <div class="search-input-content">
                                    <div class="search-label">Dari</div>
                                    <select name="from" id="from" class="search-select" required>
                                        <option value="">Pilih Kota Asal</option>
                                        @foreach($routes as $route)
                                            <option value="{{ $route->id_transportasi }}">
                                                {{ $route->rute_awal }} ({{ $route->transportasi->kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="swap-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>

                            <div class="search-input">
                                <i class="fas fa-plane-arrival"></i>
                                <div class="search-input-content">
                                    <div class="search-label">Ke</div>
                                    <select name="to" id="to" class="search-select" required>
                                        <option value="">Pilih Kota Tujuan</option>
                                        @foreach($routes as $route)
                                            <option value="{{ $route->id_transportasi }}">
                                                {{ $route->tujuan }} ({{ $route->transportasi->kode }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="search-options">
                            <div class="search-field">
                                <div class="field-label">Tanggal Keberangkatan</div>
                                <input type="date" name="tanggal_berangkat" class="field-input" required>
                            </div>

                            <div class="search-field">
                                <div class="field-label">Penumpang & Kelas</div>
                                <div class="field-group">
                                    <select name="passenger_count" class="passenger-select" required>
                                        <option value="">Jumlah Penumpang</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }} Penumpang</option>
                                        @endfor
                                    </select>
                                    <select name="id_class" class="class-select" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->nama_class }}">
                                                {{ $class->nama_class }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            Cari Penerbangan
                        </button>
                    </form>
                </div>
            </div>
            <div class="airplane-container">
                <!-- Clouds -->
                <img src="{{ url('images/cloud.png') }}" class="cloud cloud-1" alt="Cloud">
                <img src="{{ url('images/cloud.png') }}" class="cloud cloud-2" alt="Cloud">
                <img src="{{ url('images/cloud.png') }}" class="cloud cloud-3" alt="Cloud">
                <img src="{{ url('images/cloud.png') }}" class="cloud cloud-4" alt="Cloud">
                <img src="{{ url('images/cloud.png') }}" class="cloud cloud-5" alt="Cloud">
                
                <!-- 3D Airplane -->
                <div class="airplane-3d">
                    <img src="{{ url('images/airplane1.png') }}" alt="3D Airplane">
                </div>
            </div>
        </div>
    </div>

    <!-- Deals Section -->
    <section class="deals-section">
        <div class="container">
            <div class="section-header">
                <div class="header-content">
                    <h2 class="section-title">Penawaran Penerbangan Unggulan</h2>
                    <p class="section-subtitle">Temukan harga terbaik untuk rute populer</p>
                </div>
                <a href="#" class="explore-link">
                    Lihat Semua Penawaran
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="deals-slider">
                <div class="swiper dealsSwiper">
                    <div class="swiper-wrapper">
                        @foreach($deals as $deal)
                        <div class="swiper-slide">
                            <a href="{{ route('search.deal', ['from' => $deal['from'], 'to' => $deal['to'], 'date' => $deal['tanggal_berangkat']]) }}" class="text-decoration-none">
                                <div class="deal-card">
                                    <div class="deal-image">
                                        <img src="{{ $deal['gambar'] ? asset('storage/' . $deal['gambar']) : asset('images/default-destination.jpg') }}" alt="{{ $deal['to'] }}">
                                        <div class="deal-badge">Harga Terbaik</div>
                                    </div>
                                    <div class="deal-content">
                                        <div class="deal-route">
                                            <span class="route-from">{{ $deal['from'] }}</span>
                                            <i class="fas fa-arrow-right route-arrow"></i>
                                            <span class="route-to">{{ $deal['to'] }}</span>
                                        </div>
                                        <div class="deal-info">
                                            <div class="deal-date">
                                                {{ \Carbon\Carbon::parse($deal['tanggal_berangkat'])->isoFormat('D MMMM Y') }}
                                            </div>
                                            <div class="deal-price">
                                                <span class="price-from">Mulai dari</span>
                                                <span class="price-amount">Rp {{ number_format($deal['price'], 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>

    @include('customer.partials.footer')
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>