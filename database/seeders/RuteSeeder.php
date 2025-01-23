<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rute;
use App\Models\ClassModel;
use Carbon\Carbon;

class RuteSeeder extends Seeder
{
    public function run(): void
    {
        $rutes = [
            [
                'tujuan' => 'Jakarta',
                'rute_awal' => 'Surabaya',
                'rute_akhir' => 'Jakarta',
                'harga' => 1500000, // harga dasar
                'id_transportasi' => 1,
                'tanggal_berangkat' => Carbon::now()->addDays(1),
                'waktu_keberangkatan' => '08:00:00',
                'id_class' => 1 // Ekonomi
            ],
            [
                'tujuan' => 'Bali',
                'rute_awal' => 'Jakarta',
                'rute_akhir' => 'Bali',
                'harga' => 2000000, // harga dasar
                'id_transportasi' => 2,
                'tanggal_berangkat' => Carbon::now()->addDays(2),
                'waktu_keberangkatan' => '10:00:00',
                'id_class' => 2 // Bisnis
            ],
            [
                'tujuan' => 'Yogyakarta',
                'rute_awal' => 'Surabaya',
                'rute_akhir' => 'Yogyakarta',
                'harga' => 1200000, // harga dasar
                'id_transportasi' => 3,
                'tanggal_berangkat' => Carbon::now()->addDays(3),
                'waktu_keberangkatan' => '14:00:00',
                'id_class' => 3 // First Class
            ]
        ];

        foreach ($rutes as $rute) {
            // Ambil harga tambahan dari kelas
            $class = ClassModel::find($rute['id_class']);
            // Gabungkan harga dasar dengan harga tambahan kelas
            $rute['harga'] = $rute['harga'] + $class->harga_tambahan;
            
            Rute::create($rute);
        }
    }
} 