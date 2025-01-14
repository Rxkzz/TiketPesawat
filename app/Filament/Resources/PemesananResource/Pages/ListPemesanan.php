<?php

namespace App\Filament\Resources\PemesananResource\Pages;

use App\Filament\Resources\PemesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemesanan extends ListRecords
{
    protected static string $resource = PemesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Export')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $pemesanans = \App\Models\Pemesanan::all();
                    
                    $csv = fopen('php://temp', 'w+');
                    
                    // Header
                    fputcsv($csv, [
                        'ID',
                        'Kode Pemesanan',
                        'Tanggal Pemesanan',
                        'Tempat Pemesanan',
                        'ID Pelanggan',
                        'Kode Kursi',
                        'Tujuan',
                        'Tanggal Berangkat',
                        'Jam Cekin',
                        'Jam Berangkat',
                        'Total Bayar',
                        'ID Petugas'
                    ]);

                    // Data
                    foreach ($pemesanans as $pemesanan) {
                        fputcsv($csv, [
                            $pemesanan->id_pemesanan,
                            $pemesanan->kode_pemesanan,
                            $pemesanan->tanggal_pemesanan,
                            $pemesanan->tempat_pemesanan,
                            $pemesanan->id_pelanggan,
                            $pemesanan->kode_kursi,
                            $pemesanan->tujuan,
                            $pemesanan->tanggal_berangkat,
                            $pemesanan->jam_cekin,
                            $pemesanan->jam_berangkat,
                            $pemesanan->total_bayar,
                            $pemesanan->id_petugas
                        ]);
                    }

                    rewind($csv);
                    $content = stream_get_contents($csv);
                    fclose($csv);

                    return response()->streamDownload(
                        fn () => print($content),
                        'pemesanan-' . now()->format('Y-m-d-His') . '.csv',
                        ['Content-Type' => 'text/csv']
                    );
                })
        ];
    }
}