<?php

namespace App\Filament\CustomWidgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Facades\DB;

class MonitorProgressPeserta extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Monitor Progress Peserta';

    use InteractsWithPageFilters;

    protected function getData(): array
    {
        $pesertaId = $this->pageFilters['student'] ?? null;
        $program = $this->pageFilters['program'] ?? null;

        // Cek akun peserta
        if (! $pesertaId) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        // Total Materi
        $totalMateri = MateriPelatihan::count();

        if ($totalMateri === 0) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        // Cek program pelatihan aktif oleh peserta yang diambil berdasarkan data terbaru
        $programPelatihan = JenisPeserta::where('user_id', $pesertaId)->where('status', 'aktif')->latest()->first();

        if (!$program) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        } else {
            // Ambil tanggal unik dan jumlah aktivitas per tanggal
            $aktivitasPerTanggal = AktivitasPeserta::query()
                ->where('jenis_peserta_id', $program)
                ->where('status', 'disetujui')
                ->select('tanggal', DB::raw('COUNT(*) as jumlah'))
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            $labels = [];
            $data = [];
            $akumulasi = 0;

            foreach ($aktivitasPerTanggal as $item) {
                $akumulasi += $item->jumlah;
                $persentase = ($akumulasi / $totalMateri) * 100;

                $labels[] = \Carbon\Carbon::parse($item->tanggal)->format('d M Y');
                $data[] = round($persentase, 1);
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Progress (%)',
                        'data' => $data,
                        'borderColor' => '#3b82f6',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'fill' => true,
                        'tension' => 0.3,
                    ],
                ],
                'labels' => $labels,
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,

            'scales' => [
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tanggal',
                    ],
                    'grid' => [
                        'display' => false, // Tidak menampilkan garis vertikal
                    ],
                ],

                'y' => [
                    'min' => 0,
                    'max' => 100,

                    'title' => [
                        'display' => true,
                        'text' => 'Progres (%)',
                    ],

                    'ticks' => [
                        'stepSize' => 10,
                        'callback' => '(value) => value + "%"',
                    ],

                    'grid' => [
                        'display' => true,   // Menampilkan garis horizontal
                        'drawBorder' => true,
                    ],
                ],
            ],

            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
