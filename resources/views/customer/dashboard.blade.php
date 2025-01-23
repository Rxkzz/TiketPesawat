<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Customer - {{ config('app.name', 'Tiket Pesawat') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="min-vh-100">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
    <div class="container">
        <span class="navbar-brand fw-semibold">Tiket Pesawat</span>
        <div class="d-flex align-items-center">
            <li class="nav-item dropdown list-unstyled">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome, {{ auth('penumpang')->user()->nama_penumpang }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- Edit Profile -->
                    <a class="dropdown-item" href="">
                        <i class="fas fa-user-edit me-2"></i> Edit Profile
                    </a>
                    
                    <!-- Dashboard -->
                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    
                    <!-- Divider -->
                    <div class="dropdown-divider"></div>
                    
                    <!-- Logout -->
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
    </div>
</nav>

        <!-- Main Content -->
        <div class="py-5">
            <div class="container">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="fs-2 fw-semibold mb-4">Dashboard Customer</h2>
                        <p>Selamat datang di panel customer Tiket Pesawat.</p>
                        
                        <!-- Dashboard Content -->
                        <div class="row mt-4 g-4">
                            <div class="col-md-4">
                                <div class="card bg-warning bg-opacity-10">
                                    <div class="card-body">
                                        <h3 class="fs-5 fw-semibold mb-2">Pesan Tiket</h3>
                                        <p>Mulai pemesanan tiket pesawat Anda.</p>
                                        <a href="{{ route('customer.home') }}" class="btn btn-warning mt-3">
                                            Pesan Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card bg-warning bg-opacity-10">
                                    <div class="card-body">
                                        <h3 class="fs-5 fw-semibold mb-2">Riwayat Pemesanan</h3>
                                        <p>Lihat history pemesanan tiket Anda.</p>
                                        <a href="#" class="btn btn-warning mt-3">
                                            Lihat Riwayat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card bg-warning bg-opacity-10">
                                    <div class="card-body">
                                        <h3 class="fs-5 fw-semibold mb-2">Profil Saya</h3>
                                        <p>Update informasi profil Anda.</p>
                                        <a href="#" class="btn btn-warning mt-3">
                                            Edit Profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>