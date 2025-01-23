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
                'nama_fasilitas' => 'Makanan & Minuman',
                'deskripsi' => 'Layanan makanan dan minuman selama penerbangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Wi-Fi',
                'deskripsi' => 'Koneksi internet selama penerbangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Stop Kontak',
                'deskripsi' => 'Stop kontak untuk mengisi daya perangkat elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Selimut & Bantal',
                'deskripsi' => 'Selimut dan bantal untuk kenyamanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Hiburan In-Flight',
                'deskripsi' => 'Sistem hiburan dengan film, musik, dan games',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Kursi Dapat Direbahkan',
                'deskripsi' => 'Kursi yang dapat direbahkan untuk kenyamanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($fasilitas as $f) {
            Fasilitas::create($f);
        }
    }
} 