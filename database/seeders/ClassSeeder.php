<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run()
    {
        // Data kelas
        $classes = [
            [
                'nama_class' => 'Ekonomi',
                'keterangan' => 'Kelas ekonomi dengan kenyamanan dasar',
                'harga_tambahan' => 0,
                'bagasi' => 20,
                'fasilitas' => [1, 3, 9] // Makanan Ringan, WiFi, Selimut & Bantal
            ],
            [
                'nama_class' => 'Bisnis',
                'keterangan' => 'Kelas bisnis dengan kenyamanan ekstra',
                'harga_tambahan' => 1000000,
                'bagasi' => 30,
                'fasilitas' => [1, 2, 3, 4, 6, 7, 9] // Tambah Makanan Berat, Kursi Rebah, Lounge, Priority Check-in
            ],
            [
                'nama_class' => 'First Class',
                'keterangan' => 'Kelas utama dengan fasilitas terlengkap',
                'harga_tambahan' => 2500000,
                'bagasi' => 40,
                'fasilitas' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Semua fasilitas
            ]
        ];

        // Buat record kelas dan hubungkan dengan fasilitas
        foreach ($classes as $class) {
            $fasilitas = $class['fasilitas'];
            unset($class['fasilitas']);
            
            $newClass = ClassModel::create($class);
            
            // Hubungkan kelas dengan fasilitas menggunakan relasi
            $newClass->fasilitas()->attach($fasilitas);
        }
    }
} 