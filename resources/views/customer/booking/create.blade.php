<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tiket - {{ $flight->transportasi->nama }}</title>
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
            background: #F7F7F7;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            padding-top: var(--navbar-height);
        }

        .booking-container {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .booking-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--primary-purple);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-gray);
        }

        .form-control-modern {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control-modern:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 3px rgba(110, 46, 191, 0.1);
            outline: none;
        }

        .flight-summary {
            background: var(--light-purple);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .airline-logo {
            width: 32px;
            height: 32px;
        }

        .route-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .time-info {
            font-size: 16px;
            font-weight: 600;
        }

        .city-info {
            font-size: 14px;
            color: var(--text-gray);
        }

        .price-summary {
            background: white;
            border-radius: 12px;
            padding: 20px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }

        .price-total {
            border-top: 2px dashed var(--border-color);
            margin-top: 12px;
            padding-top: 12px;
            font-weight: 700;
            font-size: 18px;
        }

        .btn-pay {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-purple), #8B5CF6);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 24px;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(110, 46, 191, 0.25);
        }

        .passenger-type {
            display: inline-block;
            padding: 4px 12px;
            background: var(--light-purple);
            color: var(--primary-purple);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 16px;
        }
    </style>
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
                
                <span class="passenger-type">Penumpang 1 - Dewasa</span>

                <form id="bookingForm">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap (sesuai KTP)</label>
                        <input type="text" class="form-control-modern" name="full_name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor KTP</label>
                        <input type="text" class="form-control-modern" name="id_number" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control-modern" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control-modern" name="phone" required>
                    </div>
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
                        <img src="{{ asset('images/airlines/' . $flight->transportasi->kode . '.png') }}" 
                             alt="Airline Logo" class="airline-logo">
                        <div>
                            <div class="airline-name">{{ $flight->transportasi->nama }}</div>
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

                <div class="price-summary">
                    <div class="price-row">
                        <span>Harga Tiket</span>
                        <span>IDR {{ number_format($flight->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span>Pajak</span>
                        <span>IDR {{ number_format($flight->total_harga * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-total">
                        <span>Total</span>
                        <span>IDR {{ number_format($flight->total_harga * 1.1, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button type="submit" class="btn-pay" form="bookingForm">
                    <i class="fas fa-lock"></i>
                    Lanjut ke Pembayaran
                </button>
            </div>
        </div>
    </div>
</body>
</html> 