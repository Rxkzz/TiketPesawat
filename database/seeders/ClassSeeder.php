<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'nama_class' => 'Ekonomi',
                'harga_tambahan' => 0,
                'keterangan' => 'Kelas ekonomi dengan layanan standar',
                'bagasi' => 20,
                'hiburan' => false
            ],
            [
                'nama_class' => 'Bisnis',
                'harga_tambahan' => 500000,
                'keterangan' => 'Kelas bisnis dengan layanan premium',
                'bagasi' => 30,
                'hiburan' => true
            ],
            [
                'nama_class' => 'First Class',
                'harga_tambahan' => 1000000,
                'keterangan' => 'Kelas first class dengan layanan eksklusif',
                'bagasi' => 40,
                'hiburan' => true
            ],
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
} 