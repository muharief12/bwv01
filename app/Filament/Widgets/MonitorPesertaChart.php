<?php

namespace App\Filament\Widgets;

use App\Models\JenisPeserta;
use Filament\Widgets\ChartWidget;

class MonitorPesertaChart extends ChartWidget
{
    protected ?string $heading = '10 Progress Peserta Terendah';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $monitor = JenisPeserta::query()
            ->with('user')
            ->orderBy('progress', 'asc')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Progress (%)',
                    'data' => $monitor->pluck('progress')->toArray(),
                    'backgroundColor' => '#93C5FD',
                    'borderColor' => '#60A5FA',
                ],
            ],
            'labels' => $monitor
                ->pluck('user.name')
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'max' => 100,
                ],
            ],
        ];
    }
}
