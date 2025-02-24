<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            [
                'nama_fasilitas' => 'Makanan Ringan',
                'deskripsi' => 'Snack dan minuman ringan',
                'icon_url' => 'https://img.icons8.com/color/96/000000/cookie.png'
            ],
            [
                'nama_fasilitas' => 'Makanan Berat',
                'deskripsi' => 'Makanan utama dengan menu pilihan',
                'icon_url' => 'https://img.icons8.com/color/96/000000/restaurant.png'
            ],
            [
                'nama_fasilitas' => 'WiFi',
                'deskripsi' => 'Koneksi internet dalam penerbangan',
                'icon_url' => 'https://img.icons8.com/color/96/000000/wifi.png'
            ],
            [
                'nama_fasilitas' => 'Kursi Dapat Direbahkan',
                'deskripsi' => 'Kursi yang dapat diatur kemiringannya',
                'icon_url' => 'https://img.icons8.com/color/96/000000/armchair.png'
            ],
            [
                'nama_fasilitas' => 'Hiburan Premium',
                'deskripsi' => 'Akses ke film, musik, dan hiburan premium',
                'icon_url' => 'https://img.icons8.com/color/96/000000/movie.png'
            ],
            [
                'nama_fasilitas' => 'Lounge Akses',
                'deskripsi' => 'Akses ke lounge bandara',
                'icon_url' => 'https://img.icons8.com/color/96/000000/living-room.png'
            ],
            [
                'nama_fasilitas' => 'Priority Check-in',
                'deskripsi' => 'Check-in prioritas tanpa antrian',
                'icon_url' => 'https://img.icons8.com/color/96/000000/checked-2.png'
            ],
            [
                'nama_fasilitas' => 'Priority Baggage',
                'deskripsi' => 'Prioritas pengambilan bagasi',
                'icon_url' => 'https://img.icons8.com/color/96/000000/suitcase.png'
            ],
            [
                'nama_fasilitas' => 'Selimut & Bantal',
                'deskripsi' => 'Selimut dan bantal nyaman',
                'icon_url' => 'https://img.icons8.com/color/96/000000/pillow.png'
            ],
            [
                'nama_fasilitas' => 'Kit Amenities',
                'deskripsi' => 'Peralatan mandi dan kenyamanan pribadi',
                'icon_url' => 'https://img.icons8.com/color/96/000000/toiletries.png'
            ],
        ];

        foreach ($fasilitas as $f) {
            Fasilitas::create($f);
        }
    }
} 