<?php

namespace App\Filament\Widgets;

use App\Models\VisitorLog;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class VisitorChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Grafik Tren Pengunjung Website (Daily Traffic Analytics)';
    protected ?string $description = 'Statistik total pageviews dan pengunjung unik per hari secara realtime.';
    protected ?string $maxHeight = '320px';
    protected ?string $pollingInterval = '30s';

    public ?string $filter = '7';

    protected function getFilters(): ?array
    {
        return [
            '7' => '7 Hari Terakhir',
            '14' => '14 Hari Terakhir',
            '30' => '30 Hari Terakhir',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? 7);
        if (!in_array($days, [7, 14, 30])) {
            $days = 7;
        }

        $startDate = Carbon::today()->subDays($days - 1)->toDateString();

        $pageviewsByDate = VisitorLog::where('visit_date', '>=', $startDate)
            ->selectRaw('visit_date, COUNT(*) as total')
            ->groupBy('visit_date')
            ->pluck('total', 'visit_date')
            ->toArray();

        $uniquesByDate = VisitorLog::where('visit_date', '>=', $startDate)
            ->selectRaw('visit_date, COUNT(DISTINCT ip_hash) as total')
            ->groupBy('visit_date')
            ->pluck('total', 'visit_date')
            ->toArray();

        $labels = [];
        $pageviewsData = [];
        $uniquesData = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $dateObj = Carbon::today()->subDays($i);
            $dateStr = $dateObj->toDateString();
            $labels[] = $dateObj->format('d M');
            $pageviewsData[] = (int) ($pageviewsByDate[$dateStr] ?? 0);
            $uniquesData[] = (int) ($uniquesByDate[$dateStr] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Pageviews',
                    'data' => $pageviewsData,
                    'borderColor' => '#dc2626',
                    'backgroundColor' => 'rgba(220, 38, 38, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                    'pointBackgroundColor' => '#dc2626',
                    'pointBorderColor' => '#ffffff',
                    'pointHoverRadius' => 6,
                ],
                [
                    'label' => 'Pengunjung Unik',
                    'data' => $uniquesData,
                    'borderColor' => '#2563eb',
                    'backgroundColor' => 'rgba(37, 99, 235, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                    'pointBackgroundColor' => '#2563eb',
                    'pointBorderColor' => '#ffffff',
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
