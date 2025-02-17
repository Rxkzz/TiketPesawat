<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tiket - {{ $flight->transportasi->keterangan }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking/create.css') }}">
</head>
<body>
    @include('customer.partials.navbar')

    <div class="booking-container">
        <!-- Form Section -->
        <div class="booking-form">
            <div class="booking-section">
                <h2 class="section-title">
                    <i class="fas fa-user"></i>
                    Detail Penumpang
                </h2>

                <form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <input type="hidden" name="flight_id" value="{{ $flight->id_rute }}">
                    <input type="hidden" name="jumlah_penumpang" value="{{ request('jumlah_penumpang', 1) }}">
                    
                    @for($i = 1; $i <= request('jumlah_penumpang', 1); $i++)
                    <div class="passenger-details">
                        <span class="passenger-type">Penumpang {{ $i }} - Dewasa</span>

                        <div class="form-group">
                            <label class="form-label">Nama Lengkap (sesuai KTP)</label>
                            <input type="text" class="form-control-modern" name="passengers[{{ $i }}][full_name]" required value="{{ old('passengers.'.$i.'.full_name') }}">
                            @error('passengers.'.$i.'.full_name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor KTP</label>
                            <input type="text" class="form-control-modern" name="passengers[{{ $i }}][id_number]" required value="{{ old('passengers.'.$i.'.id_number') }}">
                            @error('passengers.'.$i.'.id_number')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($i === 1)
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control-modern" name="email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control-modern" name="phone" required value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                    </div>
                    @endfor

                    <button type="submit" class="btn-pay">
                        <i class="fas fa-lock"></i>
                        Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="booking-summary">
            <div class="booking-section">
                <h2 class="section-title">
                    <i class="fas fa-ticket-alt"></i>
                    Detail Penerbangan
                </h2>

                <div class="flight-summary">
                    <div class="airline-info">
                        <img src="{{ $flight->transportasi->image ? asset('storage/' . $flight->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                             alt="Airline Logo" class="airline-logo">
                        <div>
                            <div class="airline-name">{{ $flight->transportasi->keterangan }}</div>
                            <div class="flight-number">{{ $flight->transportasi->kode }}</div>
                        </div>
                    </div>

                    <div class="route-info">
                        <div>
                            <div class="time-info">{{ \Carbon\Carbon::parse($flight->waktu_berangkat)->format('H:i') }}</div>
                            <div class="city-info">{{ $flight->rute_awal }}</div>
                        </div>
                        <i class="fas fa-long-arrow-alt-right"></i>
                        <div>
                            <div class="time-info">{{ \Carbon\Carbon::parse($flight->waktu_tiba)->format('H:i') }}</div>
                            <div class="city-info">{{ $flight->tujuan }}</div>
                        </div>
                    </div>
                </div>

                <div class="passenger-info">
                    <div class="info-row">
                        <span>Jumlah Penumpang</span>
                        <span>{{ request('jumlah_penumpang', 1) }} orang</span>
                    </div>
                    <div class="info-row">
                        <span>Kelas</span>
                        <span>{{ $flight->class->nama_class }}</span>
                    </div>
                </div>

                <div class="price-summary">
                    <div class="price-row">
                        <span>Harga Tiket ({{ request('jumlah_penumpang', 1) }}x)</span>
                        <span>IDR {{ number_format($flight->total_harga * request('jumlah_penumpang', 1), 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span>Pajak</span>
                        <span>IDR {{ number_format($flight->total_harga * request('jumlah_penumpang', 1) * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-total">
                        <span>Total</span>
                        <span>IDR {{ number_format($flight->total_harga * request('jumlah_penumpang', 1) * 1.1, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 