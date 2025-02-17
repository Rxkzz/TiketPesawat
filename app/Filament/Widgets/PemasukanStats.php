<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pemesanan;
use Carbon\Carbon;

class PemasukanStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Data untuk chart 6 bulan terakhir
        $chartData = collect(range(5, 0))->map(function ($month) {
            $date = Carbon::now()->subMonths($month);
            return Pemesanan::where('status_pembayaran', 'PAID')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_bayar') / 1000000; // Konversi ke juta rupiah
        })->toArray();

        // Hitung total pemasukan dari pemesanan yang sudah dibayar
        $totalPemasukan = Pemesanan::where('status_pembayaran', 'PAID')
            ->sum('total_bayar');
            
        // Hitung pemasukan bulan ini
        $pemasukanBulanIni = Pemesanan::where('status_pembayaran', 'PAID')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_bayar');
            
        // Hitung pemasukan bulan lalu
        $pemasukanBulanLalu = Pemesanan::where('status_pembayaran', 'PAID')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_bayar');
            
        // Hitung persentase perubahan
        $persentasePerubahan = $pemasukanBulanLalu > 0 
            ? (($pemasukanBulanIni - $pemasukanBulanLalu) / $pemasukanBulanLalu) * 100 
            : 100;

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalPemasukan, 0, ',', '.'))
                ->description('Total pemasukan dari semua pemesanan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart($chartData)
                ->color('success'),

            Stat::make('Pemasukan Bulan Ini', 'Rp ' . number_format($pemasukanBulanIni, 0, ',', '.'))
                ->description(abs($persentasePerubahan) . '% ' . ($persentasePerubahan >= 0 ? 'peningkatan' : 'penurunan') . ' dari bulan lalu')
                ->descriptionIcon($persentasePerubahan >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([
                    $pemasukanBulanLalu/1000000,
                    $pemasukanBulanIni/1000000
                ])
                ->color($persentasePerubahan >= 0 ? 'success' : 'danger'),

            Stat::make('Rata-rata Pemasukan per Bulan', 'Rp ' . number_format($totalPemasukan / max(1, Carbon::parse(Pemesanan::min('created_at'))->diffInMonths(Carbon::now()) + 1), 0, ',', '.'))
                ->description('Dihitung dari awal penggunaan sistem')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->chart(array_values($chartData)) 
                ->color('info'),
        ];
    }
} 