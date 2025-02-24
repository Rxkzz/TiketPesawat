<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Bersihkan tabel-tabel
        DB::table('pemesanan')->truncate();
        DB::table('users')->truncate();
        DB::table('penumpangs')->truncate();
        DB::table('rute')->truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Buat data dummy untuk testing
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->call([
            TypeTransportasiSeeder::class,
            TransportasiSeeder::class,
            FasilitasSeeder::class,
            ClassSeeder::class,
            RuteSeeder::class,
        ]);
    }
}
