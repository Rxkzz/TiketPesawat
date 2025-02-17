<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pemesanan;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Hitung total pemesanan
        $totalPemesanan = Pemesanan::count();
        
        // Hitung pemesanan bulan ini
        $pemesananBulanIni = Pemesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        // Hitung pemesanan bulan lalu
        $pemesananBulanLalu = Pemesanan::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
            
        // Hitung persentase perubahan
        $persentasePerubahan = $pemesananBulanLalu > 0 
            ? (($pemesananBulanIni - $pemesananBulanLalu) / $pemesananBulanLalu) * 100 
            : 100;

        // Format persentase
        $descriptionText = abs($persentasePerubahan) . '% ' . 
            ($persentasePerubahan >= 0 ? 'peningkatan' : 'penurunan') . 
            ' dari bulan lalu';

        return [
            Stat::make('Total Pemesanan', $totalPemesanan)
                ->description($descriptionText)
                ->descriptionIcon($persentasePerubahan >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([
                    $pemesananBulanLalu,
                    $pemesananBulanIni
                ])
                ->color($persentasePerubahan >= 0 ? 'success' : 'danger'),

            Stat::make('Pemesanan Bulan Ini', $pemesananBulanIni)
                ->description('Total pemesanan untuk ' . Carbon::now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Rata-rata Pemesanan per Bulan', 
                number_format(Pemesanan::count() / max(1, Carbon::parse(Pemesanan::min('created_at'))->diffInMonths(Carbon::now()) + 1), 1)
            )
                ->description('Dihitung dari awal penggunaan sistem')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
