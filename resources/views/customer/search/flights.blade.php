<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pencarian Penerbangan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <!-- Tambahkan CSS yang diperlukan di sini -->
</head>
<body>
    <nav>
        <!-- Tambahkan navigasi yang sesuai di sini -->
    </nav>
    <div class="container">
        <h1>Cari Penerbangan</h1>
        <form action="{{ route('search.flights') }}" method="POST" class="search-property-1">
            @csrf
            <div class="row no-gutters">
                <div class="col-md d-flex">
                    <div class="form-group p-4 border-0">
                        <label for="from">Dari</label>
                        <div class="form-field">
                            <select name="from" id="from" class="form-control" required>
                                <option value="">Dari</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id_transportasi }}">
                                        {{ $route->rute_awal }} ({{ $route->id_transportasi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex">
                    <div class="form-group p-4 border-0">
                        <label for="to">Ke</label>
                        <div class="form-field">
                            <select name="to" id="to" class="form-control" required>
                                <option value="">Ke</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id_transportasi }}">
                                        {{ $route->tujuan }} ({{ $route->id_transportasi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex">
                    <div class="form-group p-4">
                        <label for="departure_date">Tanggal Berangkat</label>
                        <div class="form-field">
                            <input type="text" id="departure_date" name="departure_date" class="form-control checkin_date" placeholder="Pilih Tanggal" required>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex">
                    <div class="form-group d-flex w-100 border-0">
                        <button type="submit" class="align-self-stretch form-control btn btn-primary">
                            Cari Penerbangan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="js/main.js"></script>
</body>
</html> 