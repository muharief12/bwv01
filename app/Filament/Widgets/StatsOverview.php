<?php

namespace App\Filament\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\LaporanHarian;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $activeMember = JenisPeserta::where('status', 'aktif')->count();
        $totalMember = JenisPeserta::count();
        // $productivity = LaporanHarian::where('tanggal', now())->first()->produktivitas ?? 0;
        $productivity = AktivitasPeserta::whereDate('tanggal', now())->distinct()->count() / $activeMember * 100;

        return [
            Stat::make('Peserta Aktif', $activeMember),
            Stat::make('Total Peserta', $totalMember),
            Stat::make('Produktivitas', $productivity . ' %'),
        ];
    }
}
