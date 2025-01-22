<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Customer - {{ config('app.name', 'Tiket Pesawat') }}</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-xl font-semibold">
                            Tiket Pesawat
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">
                            Selamat datang, {{ auth('penumpang')->user()->nama_penumpang }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-semibold mb-4">Dashboard Customer</h2>
                        <p>Selamat datang di panel customer Tiket Pesawat.</p>
                        
                        <!-- Tambahkan konten dashboard sesuai kebutuhan -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-100 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Pesan Tiket</h3>
                                <p>Mulai pemesanan tiket pesawat Anda.</p>
                                <a href="{{ route('customer.home') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Pesan Sekarang
                                </a>
                            </div>
                            
                            <div class="bg-green-100 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Riwayat Pemesanan</h3>
                                <p>Lihat history pemesanan tiket Anda.</p>
                                <a href="#" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                    Lihat Riwayat
                                </a>
                            </div>
                            
                            <div class="bg-purple-100 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">Profil Saya</h3>
                                <p>Update informasi profil Anda.</p>
                                <a href="#" class="mt-4 inline-block bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                                    Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 