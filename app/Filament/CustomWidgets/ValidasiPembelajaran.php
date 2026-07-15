<?php

namespace App\Filament\CustomWidgets;

use App\Models\AktivitasPeserta;
use App\Models\MateriPelatihan;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class ValidasiPembelajaran extends ChartWidget
{
    use InteractsWithPageFilters;
    protected ?string $heading = 'Validasi Pembelajaran';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $pesertaId = $this->pageFilters['student'] ?? null;
        $program = $this->pageFilters['program'] ?? null;

        if (! $pesertaId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        if (! $program) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $approved = AktivitasPeserta::where('jenis_peserta_id', $program)->where('status', 'disetujui')->count();
        $waiting = AktivitasPeserta::where('jenis_peserta_id', $program)->where('status', 'menunggu')->count();
        $declined = AktivitasPeserta::where('jenis_peserta_id', $program)->where('status', 'ditolak')->count();
        $remaining = MateriPelatihan::count() - ($approved + $waiting - $declined);

        return [
            'datasets' => [[
                'label' => 'Pembelajaran',
                'data' => [$approved, $waiting, $declined, $remaining],
                'backgroundColor' => [
                    '#16a34a', // Green 600
                    '#ca8a04', // Yellow 600
                    '#dc2626', // Red 600
                    '#2563eb', // Blue 600
                ]
            ]],
            'labels' => [
                'Disetujui',
                'Menunggu',
                'Ditolak',
                'Sisa',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
