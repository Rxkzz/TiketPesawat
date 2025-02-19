function showSoldOutAlert() {
    Swal.fire({
        title: 'Tiket Sudah Habis!',
        html: `
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-ticket-alt text-red-500 text-5xl mb-4"></i>
                </div>
                <p class="mb-4">Maaf, tiket untuk penerbangan ini sudah habis.</p>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Saran untuk Anda:</p>
                    <ul class="text-left text-sm space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Coba cari penerbangan di tanggal lain
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-plane text-blue-500 mr-2"></i>
                            Periksa maskapai lain yang tersedia
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-route text-blue-500 mr-2"></i>
                            Coba rute alternatif yang tersedia
                        </li>
                    </ul>
                </div>
            </div>
        `,
        icon: 'warning',
        confirmButtonText: 'Cari Penerbangan Lain',
        showCancelButton: true,
        cancelButtonText: 'Tutup',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = homeRoute;
        }
    });
} 