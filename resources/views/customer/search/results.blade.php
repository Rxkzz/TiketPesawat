<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Pesawat - Search Results</title>
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
            /* background: linear-gradient(135deg, #00C4CC 0%, #7D2AE7 100%); */
            background-image: url('{{ asset('images/bg_2.jpg') }}');
            background-size: cover;
            background-position: center;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            padding-top: var(--navbar-height);
        }

        /* Search Bar */
        .search-wrapper {
            background: #F8F9FE;
            padding: 16px 0;
            margin-top: var(--navbar-height);
        }

        .search-bar {
            background: white;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            max-width: 1200px;
            margin: 0 auto;
        }

        .search-form {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-input-group {
            display: flex;
            align-items: center;
            flex: 1;
            gap: 8px;
        }

        .location-input {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            flex: 1;
            cursor: pointer;
            min-height: 48px;
        }

        .location-input i {
            color: var(--text-gray);
            font-size: 16px;
        }

        .location-text {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .location-code {
            color: var(--text-gray);
            font-size: 15px;
        }

        .location-swap {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            background: white;
            cursor: pointer;
            flex-shrink: 0;
        }

        .location-swap i {
            color: var(--text-gray);
            font-size: 16px;
        }

        .search-btn {
            background: var(--primary-purple);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            height: 48px;
            min-width: 100px;
        }

        .search-btn:hover {
            background: #5B26A6;
        }

        /* Container styles */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Date Navigation Styles */
        .date-scroll-wrapper {
            background: white;
            border-radius: 12px;
            padding: 2px;
            margin: 24px 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .date-scroll {
            display: flex;
            overflow-x: auto;
            gap: 0;
            scrollbar-width: none;
        }

        .date-scroll::-webkit-scrollbar {
            display: none;
        }

        .date-item {
            flex: 1;
            min-width: 140px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            position: relative;
        }

        .date-item.active {
            background: var(--light-purple);
        }

        .date-item .date {
            font-size: 14px;
            color: var(--text-gray);
        }

        .date-item .price {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            margin-top: 4px;
        }

        .date-item.active .price {
            color: var(--primary-purple);
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            gap: 8px;
            margin: 16px 0;
            flex-wrap: wrap;
        }

        .filter-button {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            background: white;
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .filter-button i {
            font-size: 12px;
            color: var(--text-gray);
        }

        .filter-button.active {
            background: var(--light-purple);
            border-color: var(--primary-purple);
            color: var(--primary-purple);
        }

        /* Promo Banner */
        .promo-banner {
            background: linear-gradient(90deg, #00C4CC 0%, #7D2AE7 100%);
            border-radius: 12px;
            padding: 16px 24px;
            margin: 24px 0;
            display: flex;
            align-items: center;
            gap: 16px;
            color: white;
        }

        .promo-banner i {
            font-size: 24px;
        }

        .promo-text {
            flex: 1;
        }

        .promo-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .promo-subtitle {
            font-size: 13px;
            opacity: 0.8;
        }

        /* Flight Cards */
        .flight-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .flight-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(110, 46, 191, 0.15);
        }

        .airline-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .airline-logo {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .airline-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .airline-facilities {
            display: flex;
            gap: 8px;
        }

        .facility-icon {
            width: 16px;
            height: 16px;
            opacity: 0.6;
        }

        .flight-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .time-section {
            text-align: left;
        }

        .time {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .city {
            font-size: 14px;
            color: var(--text-gray);
        }

        .flight-duration {
            text-align: center;
            position: relative;
            padding: 0 20px;
        }

        .duration-text {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 4px;
        }

        .transit-info {
            font-size: 14px;
            color: var(--text-gray);
        }

        .duration-line {
            position: relative;
            height: 2px;
            background: #E7E8EA;
            margin: 8px 0;
        }

        .duration-line::before,
        .duration-line::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: #E7E8EA;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .duration-line::before {
            left: -4px;
        }

        .duration-line::after {
            right: -4px;
        }

        .price-section {
            text-align: right;
        }

        .price-amount {
            font-size: 24px;
            font-weight: 700;
            color: #FF5E1F;
            line-height: 1.2;
        }

        .price-label {
            font-size: 14px;
            color: var(--text-gray);
        }

        .points {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
            margin-top: 4px;
            font-size: 13px;
            color: var(--primary-purple);
        }

        .points i {
            font-size: 6px;
        }

        .flight-footer {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .reschedule-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: #E6F8EF;
            color: #00AA5B;
            border-radius: 4px;
            font-size: 13px;
        }

        .flight-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
        }

        .transit-link {
            color: var(--primary-purple);
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .transit-link i {
            font-size: 12px;
        }

        /* Navbar Styles */
        .navbar {
            background: white;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 32px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 24px;
            justify-self: start;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .logo img {
            height: 32px;
        }

        .search-global {
            background: var(--light-purple);
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 300px;
        }

        .search-global input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: var(--text-dark);
        }

        .search-global input::placeholder {
            color: var(--text-gray);
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
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
    </style>
</head>
<body>
    @include('customer.partials.navbar')
   
    <!-- Search Bar -->
        <div class="search-bar">
            <div class="search-form">
                <div class="search-input-group">
                    <div class="location-input">
                        <i class="fas fa-plane-departure"></i>
                        <div>
                            <span class="location-text">Jakarta</span>,
                            <span class="location-code">SUBC</span>
                        </div>
                    </div>

                    <button class="location-swap">
                        <i class="fas fa-exchange-alt"></i>
                    </button>

                    <div class="location-input">
                        <i class="fas fa-plane-arrival"></i>
                        <div>
                            <span class="location-text">Bali</span>,
                            <span class="location-code">JKTC</span>
                        </div>
                            </div>

                    <div class="location-input">
                        <i class="far fa-calendar"></i>
                        <div class="location-text">
                            Sat, 25 Jan 25 (Sekali Jalan)
            </div>
        </div>

                    <div class="location-input">
                        <i class="fas fa-user"></i>
                        <div class="location-text">
                            1 penumpang, Ekonomi
                        </div>
                    </div>
                </div>

                <button class="search-btn">
                    Cari
                    </button>
            </div>
                </div>

    <div class="main-container">
        <!-- Date Navigation -->
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

        <!-- Filter Bar -->
        <div class="filter-bar">
            <button class="filter-button">
                <i class="fas fa-filter"></i>
                Filter
            </button>
            <button class="filter-button">
                <i class="fas fa-sort"></i>
                Urutkan
                <i class="fas fa-chevron-down"></i>
            </button>
            <button class="filter-button">
                <i class="fas fa-plane"></i>
                Transit
                <i class="fas fa-chevron-down"></i>
            </button>
            <button class="filter-button">
                <i class="fas fa-clock"></i>
                Waktu
                <i class="fas fa-chevron-down"></i>
            </button>
            <button class="filter-button">
                <i class="fas fa-plane-departure"></i>
                Maskapai
                <i class="fas fa-chevron-down"></i>
            </button>
            <button class="filter-button active">
                Semua
            </button>
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

        <!-- Flight Results -->
        @foreach($results as $result)
        <a href="{{ route('flight.show', $result->id_rute) }}" class="flight-card">
            <div class="airline-header">
                <img src="{{ asset('images/airlines/' . $result->transportasi->kode . '.png') }}" alt="Airline Logo" class="airline-logo">
                <span class="airline-name">{{ $result->transportasi->nama }}</span>
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
    </div>
    @include('customer.partials.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Date item click handler
        $('.date-item').click(function() {
            $('.date-item').removeClass('active');
            $(this).addClass('active');
        });

        // Filter button click handler
        $('.filter-button').click(function() {
            if (!$(this).hasClass('active')) {
                $(this).toggleClass('active');
            }
        });

        // Horizontal scroll for date navigation
        const dateNav = document.querySelector('.date-scroll');
        let isDown = false;
        let startX;
        let scrollLeft;

        dateNav.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - dateNav.offsetLeft;
            scrollLeft = dateNav.scrollLeft;
        });

        dateNav.addEventListener('mouseleave', () => {
            isDown = false;
        });

        dateNav.addEventListener('mouseup', () => {
            isDown = false;
        });

        dateNav.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - dateNav.offsetLeft;
            const walk = (x - startX) * 2;
            dateNav.scrollLeft = scrollLeft - walk;
        });
    </script>
</body>
</html>