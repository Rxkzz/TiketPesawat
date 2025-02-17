<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportasi;

class TransportasiSeeder extends Seeder
{
    public function run()
    {
        $transportasi = [
            [
                'kode' => 'GA-001',
                'keterangan' => 'Garuda Indonesia Airways',
                'id_type_transportasi' => 1,
            ],
            [
                'kode' => 'LI-001',
                'keterangan' => 'Lion Air',
                'id_type_transportasi' => 1,
            ],
            [
                'kode' => 'BA-001',
                'keterangan' => 'Batik Air',
                'id_type_transportasi' => 1,
            ],
            [
                'kode' => 'CI-001',
                'keterangan' => 'Citilink',
                'id_type_transportasi' => 1,
            ],
        ];

        foreach ($transportasi as $t) {
            Transportasi::create($t);
        }
    }
} 