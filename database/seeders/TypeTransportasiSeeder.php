<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeTransportasi;

class TypeTransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'nama_type' => 'Boeing 737',
                'keterangan' => 'Pesawat penumpang narrow-body'
            ],
            [
                'nama_type' => 'Airbus A320',
                'keterangan' => 'Pesawat penumpang single-aisle'
            ],
            [
                'nama_type' => 'Boeing 777',
                'keterangan' => 'Pesawat penumpang wide-body'
            ]
        ];

        foreach ($types as $type) {
            TypeTransportasi::create($type);
        }
    }
}
