<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        // Ekonomi Class (id: 1)
        // Mendapat fasilitas dasar: Makanan & Minuman
        DB::table('class_fasilitas')->insert([
            'id_class' => 1,
            'id_fasilitas' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bisnis Class (id: 2)
        // Mendapat semua fasilitas kecuali WiFi
        for ($i = 1; $i <= 6; $i++) {
            if ($i != 2) { // Skip WiFi
                DB::table('class_fasilitas')->insert([
                    'id_class' => 2,
                    'id_fasilitas' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // First Class (id: 3)
        // Mendapat semua fasilitas
        for ($i = 1; $i <= 6; $i++) {
            DB::table('class_fasilitas')->insert([
                'id_class' => 3,
                'id_fasilitas' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 