<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
        <p class="fas fa-plane-departure">AeroGO</p>
        </a>

        <!-- Search Bar -->
        <div class="nav-search">
            <i class="fas fa-search search-icon"></i>
            <input type="text" placeholder="Staycation di Bandung" class="search-input">
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Main Nav Menu -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/pesawat">Pesawat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/hotel">Hotel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/vila-apt">Vila & Apt.</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/todo">To Do</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kereta">Kereta</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button" data-bs-toggle="dropdown">
                        Lainnya
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/car-rental">Car Rental</a></li>
                        <li><a class="dropdown-item" href="/events">Events</a></li>
                        <li><a class="dropdown-item" href="/attractions">Attractions</a></li>
                    </ul>
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
                            <a class="dropdown-item" href="/bookings">
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

<style>
:root {
    --primary-color: #6851FF;
    --text-color: #1E1E1E;
    --border-color: #E5E7EB;
}

.navbar {
    background: #FFFFFF;
    padding: 8px 0;
    height: 64px;
    border-bottom: 1px solid var(--border-color);
}

.navbar-brand img {
    height: 32px;
}

.nav-search {
    position: relative;
    width: 300px;
    margin: 0 24px;
}

.search-input {
    width: 100%;
    padding: 8px 16px 8px 40px;
    border: none;
    border-radius: 8px;
    background: #F3F4F6;
    font-size: 14px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6B7280;
}

.nav-link {
    color: var(--text-color);
    font-size: 14px;
    font-weight: 500;
    padding: 8px 16px;
}

.nav-link:hover {
    color: var(--primary-color);
}

.btn-light {
    background: #F3F4F6;
    border: none;
    padding: 8px 24px;
    font-size: 14px;
    font-weight: 500;
}

.btn-primary {
    background: var(--primary-color);
    border: none;
    padding: 8px 24px;
    font-size: 14px;
    font-weight: 500;
}

.btn-primary:hover {
    background: #5842FF;
}

.dropdown-menu {
    border: 1px solid var(--border-color);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 8px;
}

.dropdown-item {
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 4px;
}

@media (max-width: 991.98px) {
    .nav-search {
        width: 100%;
        margin: 8px 0;
    }

    .navbar-collapse {
        background: white;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
    }
}
</style>

<!-- Pastikan semua script dimuat -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 