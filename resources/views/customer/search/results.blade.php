<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
        }

        .search-header {
            background: linear-gradient(135deg, #5CA0F2, #4A90E2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(74,144,226,0.15);
        }

        .search-box {
            background: white;
            border-radius: 8px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .route-info {
            font-size: 16px;
            color: #424242;
        }

        .route-info strong {
            font-size: 18px;
        }

        .search-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .notification-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .date-selector {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .date-item {
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            min-width: 120px;
            text-align: center;
        }

        .date-item.active {
            background: white;
            color: #4A90E2;
        }

        .coupon-section {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .coupon-tag {
            display: inline-block;
            padding: 5px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            font-size: 14px;
        }

        .sort-options {
            display: flex;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .sort-option {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sort-option:hover {
            background: #f8f9fa;
        }

        .sort-option.active {
            background: #F5F9FF;
        }

        .sort-option i {
            color: #4A90E2;
            margin-right: 8px;
        }

        .sort-option .price {
            font-weight: bold;
            color: #4A90E2;
            margin-top: 5px;
        }

        .sort-option .duration {
            color: #757575;
            font-size: 14px;
        }

        .flight-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            display: block;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .flight-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .airline-logo {
            width: 32px;
            height: 32px;
            margin-right: 10px;
        }

        .flight-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .flight-time {
            font-size: 20px;
            font-weight: bold;
            color: #212121;
        }

        .flight-duration {
            color: #757575;
            font-size: 14px;
            text-align: center;
            padding: 0 20px;
        }

        .flight-price {
            text-align: right;
            color: #4A90E2;
            font-size: 24px;
            font-weight: bold;
        }

        .flight-features {
            display: flex;
            gap: 15px;
            color: #757575;
            font-size: 14px;
            margin-top: 10px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .loading-bar {
            height: 4px;
            background: #e0e0e0;
            margin: 20px 0;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .loading-progress {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 63%;
            background: linear-gradient(90deg, #5CA0F2, #4A90E2);
            animation: loading 2s infinite;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(200%); }
        }

        .search-status {
            text-align: center;
            color: #f44336;
            margin: 10px 0;
            font-size: 14px;
        }

        .tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            border-radius: 20px;
            background: rgba(255,255,255,0.1);
            color: white;
            cursor: pointer;
        }

        .tab.active {
            background: white;
            color: #4A90E2;
        }

        .choose-btn {
            background: #4A90E2;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .choose-btn:hover {
            background: #357ABD;
            transform: translateY(-1px);
        }

        .text-success {
            color: #4A90E2 !important;
        }

        /* Navbar Styles */
        .ftco-navbar-light {
            background: transparent !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 30px 0;
        }

        .ftco-navbar-light .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 24px;
        }

        .ftco-navbar-light .navbar-nav > .nav-item > .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            font-size: 15px;
            font-weight: 500;
        }

        .ftco-navbar-light .navbar-nav > .nav-item > .nav-link:hover {
            color: #007bff;;
        }

        .ftco-navbar-light .navbar-nav > .nav-item.active > .nav-link {
            color: #007bff;
        }

        /* Scrolled state */
        .ftco-navbar-light.scrolled {
            background: #fff !important;
            padding: 15px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .ftco-navbar-light.scrolled .navbar-brand {
            color: #007bff;
        }

        .ftco-navbar-light.scrolled .navbar-nav > .nav-item > .nav-link {
            color: #007bff;
        }

        .ftco-navbar-light.scrolled .navbar-nav > .nav-item > .nav-link:hover {
            color: #007bff;
        }

        .ftco-navbar-light.scrolled .navbar-nav > .nav-item.active > .nav-link {
            color: #007bff;
        }

        /* Adjust main container for transparent navbar */
        .main-container {
            padding-top: 120px;
        }
    </style>
</head>
  <body style="background-image: url('{{ asset('images/bg_1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Pacific Travel Agency</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"> Menu</span>
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ route('customer.home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="destination.html" class="nav-link">Destination</a></li>
                    <li class="nav-item"><a href="hotel.html" class="nav-link">Hotel</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

                    @if(auth('penumpang')->check())
                        <!-- User is authenticated, show the dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome, {{ auth('penumpang')->user()->nama_penumpang }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Edit Profile -->
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user-edit mr-2"></i> Edit Profile
                                </a>
                                
                                <!-- Dashboard -->
                                <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                </a>
                                
                                <!-- Divider -->
                                <div class="dropdown-divider"></div>
                                
                                <!-- Logout -->
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <!-- User is not authenticated, show Sign In -->
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Sign In</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="main-container">
        <!-- Search Header -->
        <div class="search-header">
            <div class="search-box">
                <div class="route-info">
                    <strong>{{ $results->first()->rute_awal }} ({{ $results->first()->transportasi->kode }})</strong>
                    <i class="fas fa-arrow-right mx-2"></i>
                    <strong>{{ $results->first()->tujuan }} ({{ $results->first()->transportasi->kode }})</strong>
                    <div class="text-black mt-1">
                        {{ \Carbon\Carbon::parse($results->first()->tanggal_berangkat)->format('D, d M Y') }} | 
                        {{ $request->passenger_count ?? 1 }} passenger(s) | {{ $results->first()->class->nama_class }}
                    </div>
                </div>
                <div class="search-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="btn btn-light" id="changeSearchBtn">
                        <i class="fas fa-search"></i> Change Search
                    </button>
                </div>
            </div>

            <!-- Date Selector -->
            <div class="date-selector">
                @for($i = -2; $i <= 2; $i++)
                    @php
                        $date = \Carbon\Carbon::parse($results->first()->tanggal_berangkat)->addDays($i);
                        $isActive = $i == 0;
                    @endphp
                    <div class="date-item {{ $isActive ? 'active' : '' }}">
                        <div>{{ $date->format('D, d M') }}</div>
                        <div>Rp {{ number_format($results->min('total_harga') + ($i * 100000), 0, ',', '.') }}</div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Coupon Section -->
        <div class="coupon-section">
            <span class="coupon-tag">
                <i class="fas fa-ticket-alt me-2"></i>
                Coupon: FLDOMCNY
            </span>
        </div>

        <!-- Sort Options -->
        <div class="sort-options">
            <div class="sort-option active">
                <i class="fas fa-dollar-sign"></i>
                <span>Lowest price</span>
                <div class="price">Rp {{ number_format($results->min('total_harga'), 0, ',', '.') }}</div>
                <div class="duration">16h 20m</div>
            </div>
            <div class="sort-option">
                <i class="fas fa-clock"></i>
                <span>Shortest duration</span>
                <div class="price">Rp {{ number_format($results->min('total_harga'), 0, ',', '.') }}</div>
                <div class="duration">16h 20m</div>
            </div>
            <div class="sort-option">
                <i class="fas fa-plane"></i>
                <span>Direct flights first</span>
                <div class="price">Rp {{ number_format($results->min('total_harga'), 0, ',', '.') }}</div>
                <div class="duration">16h 20m</div>
            </div>
        </div>

        <!-- Loading Bar -->
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
        <div class="search-status">Searching for flights... 63%</div>

        <!-- Flight Results -->
        @if($results->isEmpty())
            <div class="alert alert-info text-center">
                Tidak ada penerbangan yang tersedia untuk kriteria pencarian Anda.
            </div>
        @else
            @foreach($results as $result)
            <div class="flight-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="flight-info">
                            <img src="https://www.malaysiaairlines.com/content/dam/mas/global/favicon/favicon-96x96.png" alt="Airline Logo" class="airline-logo">
                            <div>
                                <div class="flight-time">
                                    {{ \Carbon\Carbon::parse($result->waktu_keberangkatan)->format('H:i') }}
                                    <i class="fas fa-arrow-right mx-3"></i>
                                    {{ \Carbon\Carbon::parse($result->waktu_keberangkatan)->addHours(2)->format('H:i') }}
                                </div>
                                <div class="flight-duration">
                                    {{ $result->transportasi->nama_transportasi }} • 1 stop
                                </div>
                            </div>
                        </div>
                        <div class="flight-features">
                            <div class="feature-item">
                                <i class="fas fa-suitcase"></i>
                                40kg Baggage
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-utensils"></i>
                                Meals
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-tv"></i>
                                Entertainment
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-end">
                            <div class="text-success mb-1">
                                <i class="fas fa-tag"></i>
                                Save Rp 2.681.275 /pax
                            </div>
                            <div class="flight-price">
                                Rp {{ number_format($result->total_harga, 0, ',', '.') }}
                                <small class="text-muted d-block">/pax</small>
                            </div>
                            <a href="{{ route('flight.show', $result->id_rute) }}" class="choose-btn mt-2 d-inline-block text-decoration-none">Choose</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.ftco-navbar-light').addClass('scrolled');
            } else {
                $('.ftco-navbar-light').removeClass('scrolled');
            }
        });

        // Sort options functionality
        const sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(option => {
            option.addEventListener('click', function() {
                sortOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Date selector functionality
        const dateItems = document.querySelectorAll('.date-item');
        dateItems.forEach(item => {
            item.addEventListener('click', function() {
                dateItems.forEach(date => date.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>