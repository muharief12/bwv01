<?php

namespace App\Filament\Member\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class MemberStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $activeProgram = JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->first()->jenis_peserta;
        $totalMateri = MateriPelatihan::count();

        $jenisPesertaAktifTerbaruId = JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')
            ->latest()
            ->value('id');
        $progressDisetujui = AktivitasPeserta::where('jenis_peserta_id', $jenisPesertaAktifTerbaruId)->where('status', 'disetujui')->count() ?? 0;
        $progressProses = AktivitasPeserta::where('jenis_peserta_id', $jenisPesertaAktifTerbaruId)->where('status', 'menunggu')->count() ?? 0;

        return [
            Stat::make('Program Aktif', $activeProgram === 'reg' ? 'Reguler' : 'BLK'),
            Stat::make('Total Materi', $totalMateri),
            Stat::make('Pembelajaran Selesai', $progressDisetujui),
            Stat::make('Pembelajaran Proses', $progressProses),
        ];
    }
}
