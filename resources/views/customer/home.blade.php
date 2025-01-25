<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiketPesawat - Find Your Best Flight</title>
    
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6851FF;
            --text-color: #1E1E1E;
            --border-color: #E5E7EB;
            --gradient-start: #2F80ED;
            --gradient-end: #56CCF2;
            --primary-purple: #6851FF;
            --light-purple: #F5F3FF;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            min-height: 100vh;
            padding-top: 64px;
        }

        /* Reset navbar styles yang bertabrakan */
        .navbar {
            background: white !important;
            padding: 12px 0 !important;
            border-bottom: 1px solid var(--border-color) !important;
            height: auto !important;
        }

        .navbar .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            padding: 8px 16px !important;
            transition: color 0.3s ease !important;
        }

        .nav-link:hover {
            color: var(--primary-purple) !important;
        }

        /* Override button styles */
        .btn-light, .btn-primary {
            border-radius: 20px !important;
            padding: 8px 24px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .btn-light {
            background: var(--light-purple) !important;
            color: var(--primary-purple) !important;
            border: none !important;
        }

        .btn-primary {
            background: var(--primary-purple) !important;
            border: none !important;
            color: white !important;
        }

        .btn-primary:hover {
            background: #5842FF !important;
            transform: translateY(-1px) !important;
        }

        /* Search bar style */
        .nav-search {
            position: relative;
            width: 300px;
            margin: 0 24px;
        }

        .nav-search .search-input {
            width: 100%;
            padding: 8px 16px 8px 40px;
            border: none;
            border-radius: 8px;
            background: #F3F4F6;
            font-size: 14px;
            color: var(--text-dark);
        }

        .nav-search .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
        }

        /* Dropdown menu style */
        .dropdown-menu {
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            border-radius: 12px !important;
            padding: 8px !important;
            min-width: 200px !important;
        }

        .dropdown-item {
            padding: 8px 16px !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }

        .dropdown-item:hover {
            background: var(--primary-purple) !important;
            color: white !important;
        }

        /* Hapus style navbar yang bertabrakan */
        .nav-menu,
        .nav-item,
        .navbar-right,
        .auth-buttons,
        .btn-login,
        .btn-register {
            all: unset;
        }

        .container{
            margin-top:80px;
        }

        .search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 24px;
            margin: 20px auto;
            max-width: 1000px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
        }

        .trip-types {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
            background: #F8F9FA;
            padding: 8px;
            border-radius: 12px;
            width: fit-content;
        }

        .trip-type {
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            background: transparent;
            transition: all 0.3s ease;
        }

        .trip-type.active {
            background: #E3FCE9;
            color: var(--primary-green);
        }

        .search-form {
            display: grid;
            gap: 16px;
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 16px;
            position: relative;
            align-items: center;
        }

        .search-input {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 16px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-input:hover {
            border-color: var(--primary-green);
            background: #F8F9FA;
        }

        .search-input i {
            font-size: 16px;
            color: var(--text-gray);
        }

        .search-input-content {
            flex: 1;
        }

        .search-label {
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 4px;
        }

        .search-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .search-code {
            font-size: 12px;
            color: var(--text-gray);
        }

        .search-close {
            color: var(--text-gray);
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .search-close:hover {
            background: #F3F4F6;
            color: var(--text-dark);
        }

        .swap-icon {
            width: 32px;
            height: 32px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .swap-icon:hover {
            background: #F8F9FA;
            transform: rotate(180deg);
        }

        .search-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 16px;
        }

        .search-field {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .search-field:hover {
            border-color: var(--primary-green);
            background: #F8F9FA;
        }

        .search-btn {
			background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            width: 100%;
            margin-top: 16px;
            padding: 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(47, 128, 237, 0.4);
        }

        .hero-section {
            display: grid;
            grid-template-columns: 1fr 600px;
            gap: 40px;
            position: relative;
            min-height: 600px;
            padding: 40px 0;
            align-items: center;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-right: 40px;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            max-width: 600px;
        }

        .product-nav {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 8px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }

        .product-item.active {
            background: white;
            color: var(--gradient-start);
        }

        .product-item i {
            font-size: 20px;
        }

        /* Deals Section */
        .deals-section {
            padding: 60px 0;
            background: white;
            position: relative;
            z-index: 2;
            margin-top: 40px;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -4px 24px rgba(0,0,0,0.1);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .explore-link {
            color: var(--gradient-start);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .deals-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .deal-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(47, 128, 237, 0.1);
        }

        .deal-card:hover {
            border-color: var(--gradient-start);
            transform: translateY(-4px);
        }

        .deal-image {
            height: 200px;
            overflow: hidden;
        }

        .deal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .deal-content {
            padding: 16px;
        }

        .deal-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .deal-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--gradient-start);
        }

        .airplane-container {
            position: relative;
            width: 600px;
            height: 500px;
            perspective: 2000px;
            transform-style: preserve-3d;
            z-index: 1;
        }

        .airplane-3d {
            position: absolute;
            width: 400px;
            height: 400px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            transform-style: preserve-3d;
            z-index: 10;
            transition: transform 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .airplane-3d img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(4px 8px 12px rgba(0,0,0,0.2));
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .cloud {
            position: absolute;
            z-index: 1;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            opacity: 0.9;
            filter: brightness(1.1);
        }

        .cloud-1 {
            width: 180px;
            top: 15%;
            right: 10%;
        }

        .cloud-2 {
            width: 140px;
            top: 35%;
            right: 45%;
        }

        .cloud-3 {
            width: 200px;
            top: 60%;
            right: 25%;
        }

        .cloud-4 {
            width: 160px;
            top: 80%;
            right: 15%;
        }

        .cloud-5 {
            width: 120px;
            top: 25%;
            right: 65%;
        }

        @keyframes initialFlight {
            0% {
                transform: translate(-50%, -50%) rotate3d(1, 1, 0, 45deg) translateZ(-500px);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, -50%) rotate3d(0, 0, 0, 0deg) translateZ(0);
                opacity: 1;
            }
        }

        @keyframes flyToRight {
            0% {
                transform: translate(-50%, -50%) rotate3d(0, 1, 0, 0deg) translateX(0);
            }
            100% {
                transform: translate(-50%, -50%) rotate3d(0, 1, 0, 10deg) translateX(200px);
            }
        }

        @keyframes cloudMoveLeft {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(-100px);
                opacity: 0.6;
            }
        }

        /* Tambahkan overlay gradient */
        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(47, 128, 237, 0.1),
                rgba(86, 204, 242, 0.1)
            );
            z-index: 1;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
            margin-top: 300px;
            margin: 0;
            padding: 0;
            justify-self: center;
        }

        .nav-item {
            font-size: 14px;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
        }

        .nav-item:hover {
            color: var(--primary-purple);
        }

        .nav-item.dropdown {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .navbar-right {
            justify-self: end;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-login {
            color: var(--primary-purple);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            background: var(--light-purple);
        }

        .btn-register {
            color: white;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            background: var(--primary-purple);
        }

        /* Tambahkan style untuk form elements */
        .search-select {
            width: 100%;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            padding: 0;
        }

        .search-select:focus {
            outline: none;
        }

        .field-input {
            width: 100%;
            border: none;
            background: none;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
        }

        .field-input:focus {
            outline: none;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .passenger-select,
        .class-select {
            width: 100%;
            border: none;
            background: none;
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .passenger-select:focus,
        .class-select:focus {
            outline: none;
        }

        /* Update search button */
        .search-btn {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(47, 128, 237, 0.4);
        }
    </style>
</head>
<body>
    @include('customer.partials.navbar')

    <!-- Content -->
    <div class="container">
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Find cheap flights from 1000s of airlines and travel agents</h1>
                
                <div class="product-nav">
                    <a href="#" class="product-item active">
                        <i class="fas fa-plane"></i>
                        <span>Flights</span>
                    </a>
                    <a href="#" class="product-item">
                        <i class="fas fa-bed"></i>
                        <span>Stays</span>
                    </a>
                    <a href="#" class="product-item">
                        <i class="fas fa-car"></i>
                        <span>car rental</span>
                    </a>
                </div>

                <div class="search-container">
                    <form action="{{ route('search.flights') }}" method="POST">
                        @csrf
                        <div class="search-row">
                            <div class="search-input">
                                <i class="fas fa-plane-departure"></i>
                                <div class="search-input-content">
                                    <div class="search-label">From</div>
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
                                    <div class="search-label">To</div>
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
                                <div class="field-label">Departure</div>
                                <input type="date" name="tanggal_berangkat" class="field-input" required>
                            </div>

                            <div class="search-field">
                                <div class="field-label">Passengers & Class</div>
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
                                                @if($class->harga_tambahan)
                                                    (+ Rp {{ number_format($class->harga_tambahan, 0, ',', '.') }})
                                                @endif
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
                <h2 class="section-title">Travel deals under Rp 2,433,880</h2>
                <a href="#" class="explore-link">
                    Explore more
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="deals-grid">
                <div class="deal-card">
                    <div class="deal-image">
                        <img src="{{ asset('images/deals/deal1.jpg') }}" alt="Deal">
                    </div>
                    <div class="deal-content">
                        <h3 class="deal-title">Bali Adventure Package</h3>
                        <div class="deal-price">Rp 1,999,000</div>
                    </div>
                </div>
                <!-- Add more deal cards -->
            </div>
        </div>
    </section>

    @include('customer.partials.footer')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <script>
        // Trip type selection
        const tripTypes = document.querySelectorAll('.trip-type');
        tripTypes.forEach(type => {
            type.addEventListener('click', () => {
                tripTypes.forEach(t => t.classList.remove('active'));
                type.classList.add('active');
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const airplane = document.querySelector('.airplane-3d');
            const clouds = document.querySelectorAll('.cloud');
            let isFlying = false;
            let lastScrollY = window.scrollY;
            let scrollTimeout;

            // Initial animation
            airplane.style.animation = 'initialFlight 2s cubic-bezier(0.23, 1, 0.32, 1)';
            
            // Scroll animation
            window.addEventListener('scroll', () => {
                const currentScroll = window.scrollY;
                
                // Mulai animasi saat scroll minimal 10px
                if (currentScroll > 10 && !isFlying) {
                    isFlying = true;
                    
                    // Animasi pesawat ke kanan
                    airplane.style.transform = `
                        translate(-50%, -50%)
                        rotate3d(0, 1, 0, 10deg)
                        translate3d(200px, 0, 100px)
                    `;

                    // Animasi awan ke kiri
                    clouds.forEach((cloud, index) => {
                        const delay = index * 100;
                        setTimeout(() => {
                            cloud.style.transform = 'translateX(-100px)';
                            cloud.style.opacity = '0.6';
                        }, delay);
                    });
                }
                
                // Reset posisi saat scroll kembali ke atas
                if (currentScroll <= 10) {
                    isFlying = false;
                    
                    airplane.style.transform = 'translate(-50%, -50%) rotate3d(0, 0, 0, 0deg)';
                    
                    clouds.forEach(cloud => {
                        cloud.style.transform = 'translateX(0)';
                        cloud.style.opacity = '1';
                    });
                }
            });

            // Mouse move effect (tetap sama)
            document.addEventListener('mousemove', (e) => {
                if (!isFlying) {
                    const { clientX, clientY } = e;
                    const { innerWidth, innerHeight } = window;
                    
                    const rotateX = ((clientY / innerHeight) - 0.5) * 30;
                    const rotateY = ((clientX / innerWidth) - 0.5) * 30;
                    const translateZ = Math.abs(rotateX + rotateY) * 2;

                    airplane.style.transform = `
                        translate(-50%, -50%)
                        rotateX(${-rotateX}deg)
                        rotateY(${rotateY}deg)
                        translateZ(${translateZ}px)
                    `;
                }
            });

            // Reset transform on mouse leave
            document.addEventListener('mouseleave', () => {
                if (!isFlying) {
                    airplane.style.transform = 'translate(-50%, -50%) rotate3d(0, 0, 0, 0deg)';
                }
            });
        });

        // Tambahkan script untuk swap functionality
        document.querySelector('.swap-icon').addEventListener('click', function() {
            const fromSelect = document.getElementById('from');
            const toSelect = document.getElementById('to');
            const tempValue = fromSelect.value;
            fromSelect.value = toSelect.value;
            toSelect.value = tempValue;
        });
    </script>
</body>
</html>