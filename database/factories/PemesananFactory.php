<?php

namespace Database\Factories;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;

    public function definition()
    {
        return [
            'kode_pemesanan' => $this->faker->unique()->word,
            'tanggal_pemesanan' => $this->faker->date(),
            'tempat_pemesanan' => $this->faker->city,
            'id_pelanggan' => $this->faker->randomNumber(),
            'kode_kursi' => $this->faker->word,
            'id_rute' => $this->faker->randomNumber(),
            'tujuan' => $this->faker->city,
            'tanggal_berangkat' => $this->faker->date(),
            'jam_cekin' => $this->faker->time(),
            'jam_berangkat' => $this->faker->time(),
            'total_bayar' => $this->faker->randomFloat(2, 100, 1000),
            'id_petugas' => $this->faker->randomNumber(),
        ];
    }
} 