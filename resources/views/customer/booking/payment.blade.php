<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket - {{ $booking->rute->transportasi->nama }}</title>
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

        .payment-container {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .payment-section {
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

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .payment-method {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: var(--primary-purple);
            background: var(--light-purple);
        }

        .payment-method.active {
            border-color: var(--primary-purple);
            background: var(--light-purple);
        }

        .payment-method i {
            font-size: 24px;
            margin-bottom: 8px;
            color: var(--primary-purple);
        }

        .payment-method-name {
            font-size: 14px;
            font-weight: 500;
        }

        .upload-section {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-top: 24px;
        }

        .upload-icon {
            font-size: 32px;
            color: var(--text-gray);
            margin-bottom: 12px;
        }

        .upload-text {
            font-size: 14px;
            color: var(--text-gray);
            margin-bottom: 16px;
        }

        .btn-upload {
            background: var(--light-purple);
            color: var(--primary-purple);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
        }

        .booking-summary {
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
    </style>
</head>
<body>
    @include('customer.partials.navbar')

    <div class="payment-container">
        <!-- Payment Section -->
        <div class="payment-form">
            <div class="payment-section">
                <h2 class="section-title">
                    <i class="fas fa-credit-card"></i>
                    Metode Pembayaran
                </h2>

                <form action="{{ route('booking.process-payment', $booking->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="payment-methods">
                        <div class="payment-method" data-method="credit_card">
                            <i class="fas fa-credit-card"></i>
                            <div class="payment-method-name">Kartu Kredit</div>
                        </div>
                        <div class="payment-method" data-method="bank_transfer">
                            <i class="fas fa-university"></i>
                            <div class="payment-method-name">Transfer Bank</div>
                        </div>
                        <div class="payment-method" data-method="e_wallet">
                            <i class="fas fa-wallet"></i>
                            <div class="payment-method-name">E-Wallet</div>
                        </div>
                    </div>

                    <input type="hidden" name="payment_method" id="payment_method" required>

                    <div class="upload-section">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <div class="upload-text">Upload bukti pembayaran Anda di sini</div>
                        <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required style="display: none;">
                        <button type="button" class="btn-upload" onclick="document.getElementById('payment_proof').click()">
                            Pilih File
                        </button>
                        <div id="file-name" class="mt-2"></div>
                    </div>

                    <button type="submit" class="btn-pay">
                        <i class="fas fa-lock"></i>
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="booking-summary">
            <div class="payment-section">
                <h2 class="section-title">
                    <i class="fas fa-ticket-alt"></i>
                    Detail Pemesanan
                </h2>

                <div class="booking-summary">
                    <div class="airline-info">
                        <img src="{{ asset('images/airlines/' . $booking->rute->transportasi->kode . '.png') }}" 
                             alt="Airline Logo" class="airline-logo">
                        <div>
                            <div class="airline-name">{{ $booking->rute->transportasi->nama }}</div>
                            <div class="flight-number">{{ $booking->rute->transportasi->kode }}</div>
                        </div>
                    </div>

                    <div class="route-info">
                        <div>
                            <div class="time-info">{{ \Carbon\Carbon::parse($booking->rute->waktu_berangkat)->format('H:i') }}</div>
                            <div class="city-info">{{ $booking->rute->rute_awal }}</div>
                        </div>
                        <i class="fas fa-long-arrow-alt-right"></i>
                        <div>
                            <div class="time-info">{{ \Carbon\Carbon::parse($booking->rute->waktu_tiba)->format('H:i') }}</div>
                            <div class="city-info">{{ $booking->rute->tujuan }}</div>
                        </div>
                    </div>
                </div>

                <div class="price-summary">
                    <div class="price-row">
                        <span>Harga Tiket</span>
                        <span>IDR {{ number_format($booking->total_bayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span>Pajak</span>
                        <span>IDR {{ number_format($booking->total_bayar * 0.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-total">
                        <span>Total</span>
                        <span>IDR {{ number_format($booking->total_bayar * 1.1, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Payment method selection
        const paymentMethods = document.querySelectorAll('.payment-method');
        const paymentMethodInput = document.getElementById('payment_method');

        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                paymentMethods.forEach(m => m.classList.remove('active'));
                method.classList.add('active');
                paymentMethodInput.value = method.dataset.method;
            });
        });

        // File upload
        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.getElementById('file-name').textContent = fileName;
            }
        });
    </script>
</body>
</html> 