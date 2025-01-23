<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportasi;

class TransportasiSeeder extends Seeder
{
    public function run(): void
    {
        $transportasi = [
            [
                'kode' => 'GA-001',
                'jumlah_kursi' => 180,
                'keterangan' => 'Garuda Indonesia Airways',
                'id_type_transportasi' => 1, // Boeing 737
            ],
            [
                'kode' => 'LA-001',
                'jumlah_kursi' => 150,
                'keterangan' => 'Lion Air',
                'id_type_transportasi' => 2, // Airbus A320
            ],
            [
                'kode' => 'BA-001',
                'jumlah_kursi' => 200,
                'keterangan' => 'Batik Air',
                'id_type_transportasi' => 3, // Boeing 777
            ]
        ];

        foreach ($transportasi as $transport) {
            Transportasi::create($transport);
        }
    }
} 