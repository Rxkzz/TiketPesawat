<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .detail-header {
            background: linear-gradient(135deg, #5CA0F2, #4A90E2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(74,144,226,0.15);
            color: white;
            opacity: 0.9;
        }

        .flight-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .airline-logo {
            width: 48px;
            height: 48px;
            margin-right: 15px;
        }

        .flight-route {
            display: flex;
            align-items: center;
            margin: 20px 0;
            position: relative;
        }

        .route-line {
            flex: 1;
            height: 2px;
            background: #4A90E2;
            margin: 0 20px;
            position: relative;
        }

        .route-line::before,
        .route-line::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            background: #4A90E2;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .route-line::before {
            left: -6px;
        }

        .route-line::after {
            right: -6px;
        }

        .time-label {
            font-size: 24px;
            font-weight: bold;
            color: #212121;
        }

        .airport-label {
            color: #757575;
            font-size: 14px;
        }

        .flight-details {
            display: flex;
            gap: 30px;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-item {
            flex: 1;
        }

        .detail-item i {
            color: #4A90E2;
            margin-right: 10px;
            font-size: 20px;
        }

        .detail-label {
            color: #757575;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 500;
            color: #212121;
        }

        .price-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-top: 20px;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #4A90E2;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #e0e0e0;
        }

        .facility-item {
            display: inline-flex;
            align-items: center;
            background: #F5F9FF;
            padding: 8px 15px;
            border-radius: 20px;
            margin: 5px;
            color: #4A90E2;
        }

        .facility-item i {
            margin-right: 8px;
        }

        .back-btn {
            background: transparent;
            border: 2px solid #4A90E2;
            color: #4A90E2;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .back-btn:hover {
            background: #F5F9FF;
            color: #4A90E2;
        }

        .book-btn {
            background: #4A90E2;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .book-btn:hover {
            background: #357ABD;
            transform: translateY(-1px);
            color: white;
        }

        .action-buttons {
            margin-top: 30px;
            text-align: right;
        }
    </style>
</head>
<body style="background-image: url('{{ asset('images/bg_1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;">
    <div class="main-container">
        <!-- Detail Header -->
        <div class="detail-header">
            <h4>Flight Details</h4>
            <div>{{ $flight->rute_awal }} to {{ $flight->tujuan }}</div>
            <div>{{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('D, d M Y') }}</div>
        </div>

        <!-- Flight Card -->
        <div class="flight-card">
            <div class="d-flex align-items-center">
                <img src="https://www.malaysiaairlines.com/content/dam/mas/global/favicon/favicon-96x96.png" alt="Airline Logo" class="airline-logo">
                <div>
                    <h5 class="mb-0">{{ $flight->transportasi->nama_transportasi }}</h5>
                    <div class="text-muted">{{ $flight->transportasi->kode }} • {{ $flight->class->nama_class }}</div>
                </div>
            </div>

            <!-- Flight Route -->
            <div class="flight-route">
                <div class="text-center">
                    <div class="time-label">{{ \Carbon\Carbon::parse($flight->waktu_keberangkatan)->format('H:i') }}</div>
                    <div class="airport-label">{{ $flight->rute_awal }}</div>
                </div>
                <div class="route-line"></div>
                <div class="text-center">
                    <div class="time-label">{{ \Carbon\Carbon::parse($flight->waktu_keberangkatan)->addHours(2)->format('H:i') }}</div>
                    <div class="airport-label">{{ $flight->tujuan }}</div>
                </div>
            </div>

            <!-- Flight Details -->
            <div class="flight-details">
                <div class="detail-item">
                    <i class="fas fa-plane-departure"></i>
                    <div class="detail-label">Departure</div>
                    <div class="detail-value">{{ \Carbon\Carbon::parse($flight->tanggal_berangkat)->format('D, d M Y') }}</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <div class="detail-label">Duration</div>
                    <div class="detail-value">2h 0m</div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-suitcase"></i>
                    <div class="detail-label">Baggage</div>
                    <div class="detail-value">{{ $flight->class->bagasi ?? '20' }}kg</div>
                </div>
            </div>

            <!-- Facilities -->
            <div>
                <h6>Facilities</h6>
                <div class="facility-item">
                    <i class="fas fa-suitcase"></i>
                    Cabin Baggage 7kg
                </div>
                <div class="facility-item">
                    <i class="fas fa-utensils"></i>
                    Meals
                </div>
                @if($flight->class->hiburan)
                <div class="facility-item">
                    <i class="fas fa-tv"></i>
                    Entertainment
                </div>
                @endif
                <div class="facility-item">
                    <i class="fas fa-wifi"></i>
                    Wi-Fi
                </div>
            </div>
        </div>

        <!-- Price Section -->
        <div class="price-section">
            <h5>Price Details</h5>
            <div class="price-item">
                <span>Base Fare</span>
                <span>Rp {{ number_format($flight->harga, 0, ',', '.') }}</span>
            </div>
            <div class="price-item">
                <span>Class Addition ({{ $flight->class->nama_class }})</span>
                <span>Rp {{ number_format($rute->class->harga_tambahan ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="price-item">
                <span>Tax</span>
                <span>Rp {{ number_format($flight->harga * 0.1, 0, ',', '.') }}</span>
            </div>
            <div class="price-item total-price">
                <span>Total Price</span>
                <span>Rp {{ number_format($flight->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            
            <a href="#" class="book-btn">
                Continue to Book <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 