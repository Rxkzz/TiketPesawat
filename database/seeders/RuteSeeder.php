<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rute;
use App\Models\ClassModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class RuteSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan direktori storage ada
        if (!Storage::disk('public')->exists('rute-images')) {
            Storage::disk('public')->makeDirectory('rute-images');
        }

        $rutes = [
            [
                'tujuan' => 'Jakarta',
                'rute_awal' => 'Surabaya',
                'rute_akhir' => 'Jakarta',
                'harga' => 1500000,
                'jumlah_kursi' => 200,
                'kursi_tersedia' => 200,
                'id_transportasi' => 1,
                'tanggal_berangkat' => Carbon::now()->addDays(1),
                'waktu_berangkat' => '08:00:00',
                'waktu_tiba' => '09:30:00',
                'id_class' => 1,
                'gambar' => 'rute-images/jakarta.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'tujuan' => 'Bali',
                'rute_awal' => 'Jakarta',
                'rute_akhir' => 'Bali',
                'harga' => 2000000,
                'jumlah_kursi' => 160,
                'kursi_tersedia' => 160,
                'id_transportasi' => 2,
                'tanggal_berangkat' => Carbon::now()->addDays(2),
                'waktu_berangkat' => '10:00:00',
                'waktu_tiba' => '12:15:00',
                'id_class' => 2,
                'gambar' => 'rute-images/bali.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=1000&auto=format&fit=crop'
            ],
            [
                'tujuan' => 'Yogyakarta',
                'rute_awal' => 'Surabaya',
                'rute_akhir' => 'Yogyakarta',
                'harga' => 1200000,
                'jumlah_kursi' => 180,
                'kursi_tersedia' => 180,
                'id_transportasi' => 3,
                'tanggal_berangkat' => Carbon::now()->addDays(3),
                'waktu_berangkat' => '14:00:00',
                'waktu_tiba' => '15:30:00',
                'id_class' => 3,
                'gambar' => 'rute-images/yogyakarta.jpg',
                'image_url' => 'https://images.unsplash.com/photo-1584810359583-96fc3448beaa?q=80&w=1000&auto=format&fit=crop'
            ]
        ];

        // Download dan simpan gambar dari internet
        foreach ($rutes as $rute) {
            try {
                $response = Http::get($rute['image_url']);
                if ($response->successful()) {
                    Storage::disk('public')->put($rute['gambar'], $response->body());
                }
            } catch (\Exception $e) {
                // Jika gagal download, gunakan gambar placeholder
                $placeholderUrl = 'https://via.placeholder.com/800x400.jpg?text=' . urlencode($rute['tujuan']);
                try {
                    $response = Http::get($placeholderUrl);
                    if ($response->successful()) {
                        Storage::disk('public')->put($rute['gambar'], $response->body());
                    }
                } catch (\Exception $e) {
                    // Jika masih gagal, lewati
                    continue;
                }
            }
        }

        foreach ($rutes as $rute) {
            // Hapus URL dari data sebelum disimpan
            unset($rute['image_url']);
            
            // Ambil harga tambahan dari kelas
            $class = ClassModel::find($rute['id_class']);
            // Gabungkan harga dasar dengan harga tambahan kelas
            $rute['total_harga'] = $rute['harga'] + $class->harga_tambahan;
            
            Rute::create($rute);
        }
    }
} 