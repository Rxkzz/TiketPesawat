<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transportasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TransportasiSeeder extends Seeder
{
    public function run()
    {
        // Pastikan direktori storage ada
        if (!Storage::disk('public')->exists('maskapai-images')) {
            Storage::disk('public')->makeDirectory('maskapai-images');
        }

        // Data maskapai dengan gambar dari internet
        $transportasi = [
            [
                'kode' => 'GA-001',
                'keterangan' => 'Garuda Indonesia Airways',
                'id_type_transportasi' => 1,
                'image' => 'maskapai-images/garuda.png',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/id/thumb/9/9c/Garuda_Indonesia_Logo.svg/1200px-Garuda_Indonesia_Logo.svg.png'
            ],
            [
                'kode' => 'LI-001',
                'keterangan' => 'Lion Air',
                'id_type_transportasi' => 1,
                'image' => 'maskapai-images/lion.png',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/id/thumb/8/8f/Lion_Air_logo_2018.svg/1200px-Lion_Air_logo_2018.svg.png'
            ],
            [
                'kode' => 'BA-001',
                'keterangan' => 'Batik Air',
                'id_type_transportasi' => 1,
                'image' => 'maskapai-images/batik.png',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/96/Batik_Air_Logo.svg/2560px-Batik_Air_Logo.svg.png'
            ],
            [
                'kode' => 'CI-001',
                'keterangan' => 'Citilink',
                'id_type_transportasi' => 1,
                'image' => 'maskapai-images/citilink.png',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/Citilink_logo.svg/2560px-Citilink_logo.svg.png'
            ],
        ];

        // Download dan simpan gambar dari internet
        foreach ($transportasi as $t) {
            try {
                $response = Http::get($t['image_url']);
                if ($response->successful()) {
                    Storage::disk('public')->put($t['image'], $response->body());
                }
            } catch (\Exception $e) {
                // Jika gagal download, gunakan gambar placeholder
                $placeholderUrl = 'https://via.placeholder.com/300x150.png?text=' . urlencode($t['keterangan']);
                try {
                    $response = Http::get($placeholderUrl);
                    if ($response->successful()) {
                        Storage::disk('public')->put($t['image'], $response->body());
                    }
                } catch (\Exception $e) {
                    // Jika masih gagal, lewati
                    continue;
                }
            }
        }

        // Buat record di database
        foreach ($transportasi as $t) {
            unset($t['image_url']); // Hapus URL dari data sebelum disimpan
            Transportasi::create($t);
        }
    }
} 