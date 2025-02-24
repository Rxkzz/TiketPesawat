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
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call([
            RoleAndPermissionSeeder::class,
            TypeTransportasiSeeder::class,
            TransportasiSeeder::class,
            FasilitasSeeder::class,
            ClassSeeder::class,
            RuteSeeder::class,
        ]);
    }
}
