<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket - {{ $booking->rute->transportasi->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking/payment.css') }}">
</head>
<body>
    @include('customer.partials.loader')
    @include('customer.partials.navbar')

    @if(session('email_sent'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            Email konfirmasi telah dikirim ke {{ $booking->email }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('email_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('email_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="payment-container">
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($booking->status_pembayaran === 'PAID')
            <div class="status-banner success">
                <div class="success-animation">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <div class="status-content">
                    <h3>Pembayaran Berhasil!</h3>
                    <p>Pembayaran Anda telah diverifikasi. Silakan cetak e-ticket Anda.</p>
                    <div class="action-wrapper">
                        <a href="{{ route('booking.ticket', $booking->id_pemesanan) }}" class="btn-ticket">
                            <span class="btn-content">
                                <i class="fas fa-ticket-alt"></i>
                                <span>Lihat E-Ticket</span>
                            </span>
                            <span class="btn-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if($booking->status_pembayaran === 'WAITING_CONFIRMATION')
            <div class="status-banner">
                <i class="fas fa-clock"></i>
                <div class="status-message">
                    <h3>Pembayaran Sedang Diverifikasi</h3>
                    <p>Mohon tunggu konfirmasi dari petugas kami. Proses verifikasi biasanya membutuhkan waktu 1x24 jam kerja.</p>
                </div>
            </div>
        @endif

        <!-- Payment Section -->
        @if($booking->status_pembayaran === 'PENDING')
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
        @endif

        <!-- Summary Section -->
        <div class="booking-summary">
            <div class="payment-section">
                <h2 class="section-title">
                    <i class="fas fa-ticket-alt"></i>
                    Detail Pemesanan
                </h2>

                <div class="booking-summary">
                    <div class="airline-info">
                    <img src="{{ $booking->rute->transportasi->image ? asset('storage/' . $booking->rute->transportasi->image) : asset('storage/maskapai-images/garuda.png') }}" 
                             alt="Airline Logo" class="airline-logo">
                        <div>
                            <div class="airline-name">{{ $booking->rute->transportasi->keterangan }}</div>
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
                        <span>IDR {{ number_format($booking->total_bayar / 1.1, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span>Pajak (10%)</span>
                        <span>IDR {{ number_format($booking->total_bayar - ($booking->total_bayar / 1.1), 0, ',', '.') }}</span>
                    </div>
                    <div class="price-total">
                        <span>Total</span>
                        <span>IDR {{ number_format($booking->total_bayar, 0, ',', '.') }}</span>
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