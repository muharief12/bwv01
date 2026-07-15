<?php

namespace App\Filament\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\LaporanHarian;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $activeMember = Auth::user()->role === 'instruktur' ? JenisPeserta::where('status', 'aktif')->whereHas('aktivitas_pesertas', function ($q) {
            $q->where('instruktur_id', Auth::user()->id);
        })->count() : JenisPeserta::where('status', 'aktif')->count();
        $totalMember = Auth::user()->role === 'instruktur' ? JenisPeserta::whereHas('aktivitas_pesertas', function ($q) {
            $q->where('instruktur_id', Auth::user()->id);
        })->count() : JenisPeserta::count();
        // $productivity = LaporanHarian::where('tanggal', now())->first()->produktivitas ?? 0;
        if ($activeMember === 0) {
            $productivity = 0;
        } else {
            $productivity = Auth::user()->role === 'instruktur' ? AktivitasPeserta::where('instruktur_id', Auth::user()->id)->whereDate('tanggal', now())->distinct()->count() / $activeMember * 100 : AktivitasPeserta::whereDate('tanggal', now())->distinct()->count() / $activeMember * 100;
        }


        return [
            Stat::make('Peserta Aktif', $activeMember),
            Stat::make('Total Peserta', $totalMember),
            Stat::make('Produktivitas', $productivity . ' %'),
        ];
    }
}
