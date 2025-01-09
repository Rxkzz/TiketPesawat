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
        TypeTransportasi::factory(10)->create();
    }
}
