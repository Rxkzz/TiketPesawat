<!DOCTYPE html>
<html lang="en">
<head>
    <title>Traveloka - Hasil Pencarian Penerbangan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        .background-image {
            background-image: url('{{ asset('images/bg/-1.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .traveloka-header {
            background-color: #2196F3;
            color: white;
            padding: 10px 0;
        }
        .result-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            padding: 20px;
        }
        .filter-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-right: 1px solid #e0e0e0;
        }
        .flight-card {
    display: block; /* Agar tautan dapat diklik di seluruh area kartu */
    text-decoration: none; /* Menghilangkan garis bawah */
    color: inherit; /* Menggunakan warna teks yang sama */
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 15px;
    transition: box-shadow 0.3s;
}

.flight-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Efek hover */
}
        .flight-details {
            flex-grow: 1;
        }
        .flight-price {
            font-size: 20px;
            font-weight: bold;
            color: #FF5722;
            margin-right: 15px;
        }
        .book-button {
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .search-info {
            background-color: #E3F2FD;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="background-image" style="background-image: url('{{ asset('images/image_1.jpg') }}'); background-size: cover; background-position: center; padding: 20px;">
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container" >
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

                            <br><br><br><br><br>

    <div class="container">
        <div class="result-container">
            <h2 class="text-center">Hasil Pencarian Penerbangan</h2>
            
            <!-- Info Pencarian -->
            <div class="search-info">
                <div class="row">
                    <div class="col-md-8">
                        @if($results->isNotEmpty())
                            <strong>{{ $results->first()->rute_awal }} ({{ $results->first()->transportasi->kode }})</strong> → 
                            <strong>{{ $results->first()->tujuan }} ({{ $results->first()->transportasi->kode }})</strong>
                            <p>{{ \Carbon\Carbon::parse($results->first()->tanggal_berangkat)->format('l, d F Y') }} | 1 Penumpang | Kelas Bisnis</p>
                        @endif
                    </div>
                    <div class="col-md-4 text-right">
                        <button class="btn btn-primary">Ubah Pencarian</button>
                    </div>
                </div>
            </div>

            @if($results->isEmpty())
                <div class="alert alert-info text-center">
                    Tidak ada penerbangan yang tersedia.
                </div>
            @else
                @foreach($results as $result)
                    <a href="{{ route('flight.show', $result->id_rute) }}" class="flight-card">
                        <div class="flight-details">
                            <h5>{{ $result->rute_awal }} ({{ $result->transportasi->kode }}) → {{ $result->tujuan }} ({{ $results->first()->transportasi->kode }})</h5>
                            <p>
                                <i class="fas fa-plane"></i> 
                                {{ \Carbon\Carbon::parse($result->tanggal_berangkat)->format('d-m-Y') }} | 
                                {{ \Carbon\Carbon::parse($result->waktu_keberangkatan)->format('H:i') }} - {{ \Carbon\Carbon::parse($result->waktu_keberangkatan)->addHours(2)->format('H:i') }}
                            </p>
                            <div class="flight-class">
                                <strong>Kelas:</strong> {{ $result->class->nama_class }}
                            </div>
                        </div>
                        <div class="flight-price">
                            Rp {{ number_format($result->total_harga, 0, ',', '.') }}
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>