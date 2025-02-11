<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportasi;

class TransportasiSeeder extends Seeder
{
    public function run(): void
    {
        $maskapai = [
            ['kode' => 'GA', 'nama' => 'Garuda Indonesia', 'type' => 1],
            ['kode' => 'LA', 'nama' => 'Lion Air', 'type' => 2],
            ['kode' => 'BA', 'nama' => 'Batik Air', 'type' => 3],
            ['kode' => 'CI', 'nama' => 'Citilink', 'type' => 1],
        ];

        $transportasi = [];
        $counter = 1;

        // Generate 12 pesawat (4 untuk setiap kelas)
        foreach ($maskapai as $m) {
            for ($i = 1; $i <= 3; $i++) {
                $transportasi[] = [
                    'kode' => $m['kode'] . sprintf('-%03d', $counter),
                    'jumlah_kursi' => rand(150, 250),
                    'keterangan' => $m['nama'] . ' Airways',
                    'id_type_transportasi' => $m['type'],
                ];
                $counter++;
            }
        }

        foreach ($transportasi as $transport) {
            Transportasi::create($transport);
        }
    }
} 