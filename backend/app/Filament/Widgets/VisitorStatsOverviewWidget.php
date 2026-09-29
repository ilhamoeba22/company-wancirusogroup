<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanKemitraan;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorStatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();
        $sevenDaysAgo = Carbon::today()->subDays(6)->toDateString();

        // Total Kunjungan Hari Ini & Kemarin
        $todayViews = VisitorLog::where('visit_date', $today)->count();
        $yesterdayViews = VisitorLog::where('visit_date', $yesterday)->count();

        // Pengunjung Unik Hari Ini
        $todayUniques = VisitorLog::where('visit_date', $today)
            ->distinct('ip_hash')
            ->count('ip_hash');

        // Total Kunjungan 7 Hari Terakhir
        $weekViews = VisitorLog::where('visit_date', '>=', $sevenDaysAgo)->count();

        // Trend data sparkline 7 hari terakhir
        $sparkline = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = Carbon::today()->subDays($i)->toDateString();
            $sparkline[] = VisitorLog::where('visit_date', $d)->count();
        }

        // Hitung persentase kenaikan vs kemarin
        $diff = $todayViews - $yesterdayViews;
        $trendDesc = $diff >= 0 ? "+{$diff} dibanding kemarin" : "{$diff} dibanding kemarin";
        $trendColor = $diff >= 0 ? 'success' : 'gray';
        $trendIcon = $diff >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';

        // Total Pengajuan Kemitraan Masuk
        $totalKemitraan = PengajuanKemitraan::count();

        return [
            Stat::make('Kunjungan Hari Ini', number_format($todayViews, 0, ',', '.'))
                ->description($trendDesc)
                ->descriptionIcon($trendIcon)
                ->color($trendColor)
                ->chart($sparkline),

            Stat::make('Pengunjung Unik Hari Ini', number_format($todayUniques, 0, ',', '.'))
                ->description('Perangkat / IP unik')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Kunjungan Minggu Ini', number_format($weekViews, 0, ',', '.'))
                ->description('Akumulasi 7 hari terakhir')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),

            Stat::make('Pesan Kemitraan B2B', number_format($totalKemitraan, 0, ',', '.'))
                ->description('Total pengajuan kemitraan')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
        ];
    }
}
