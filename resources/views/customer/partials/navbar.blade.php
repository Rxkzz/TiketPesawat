<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            <span class="font-semibold text-xl">AeroGO</span>
        </a>

        <!-- Search Bar -->
        <div class="nav-search">
            <i class="fas fa-search search-icon"></i>
            <div class="search-input-wrapper">
                <input type="text" class="search-input" placeholder="">
                <div class="placeholder-animation">
                    <div class="placeholder-text">Staycation di Bandung</div>
                    <div class="placeholder-text">Liburan ke Bali</div>
                    <div class="placeholder-text">Penerbangan ke Jakarta</div>
                    <div class="placeholder-text">Hotel di Yogyakarta</div>
                </div>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Main Nav Menu -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Pesawat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hotel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kereta</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Lainnya
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMore">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-car me-2"></i>Car Rental
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-calendar-alt me-2"></i>Events
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-map-marker-alt me-2"></i>Attractions
                        </a>
                    </div>
                </li>
            </ul>

            <!-- Auth Menu -->
            <ul class="navbar-nav ms-auto">
                @if(auth('penumpang')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <img src="{{ auth('penumpang')->user()->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                                 alt="{{ auth('penumpang')->user()->nama_penumpang }}" 
                                 class="rounded-circle me-2" width="32">
                            <span>{{ auth('penumpang')->user()->nama_penumpang }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="">
                                <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('booking.my-bookings') }}">
                                <i class="fas fa-ticket-alt me-2"></i>My Bookings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-light me-2">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">