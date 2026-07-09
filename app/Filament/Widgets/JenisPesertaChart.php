<?php

namespace App\Filament\Widgets;

use App\Models\JenisPeserta;
use Filament\Widgets\ChartWidget;

class JenisPesertaChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Jenis Peserta Chart';

    protected function getData(): array
    {
        $reg = JenisPeserta::where('jenis_peserta', 'reg')->count();
        $blk = JenisPeserta::where('jenis_peserta', 'blk')->count();

        return [
            'datasets' => [[
                'label' => 'Jumlah Peserta',
                'data' => [$reg, $blk],
                'backgroundColor' => [
                    '#fc30a0',
                    '#102cb9',
                ]
            ]],
            'labels' => [
                'Reguler',
                'BLK'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
