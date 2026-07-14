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
        $activeProgram = JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->first()->jenis_peserta ?? '-';
        if ($activeProgram === 'reg') {
            $activeProgram = 'Reguler';
        } elseif ($activeProgram === 'reg') {
            $activeProgram = 'BLK';
        } else {
            $activeProgram = '-';
        }
        $totalMateri = $activeProgram === '-' ? '-' : MateriPelatihan::count();

        $jenisPesertaAktifTerbaruId = $activeProgram === '-' ? '-' : JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')
            ->latest()
            ->value('id');
        $progressDisetujui = $activeProgram === '-' ? '-' : AktivitasPeserta::where('jenis_peserta_id', $jenisPesertaAktifTerbaruId)->where('status', 'disetujui')->count();
        $progressProses = $activeProgram === '-' ? '-' : AktivitasPeserta::where('jenis_peserta_id', $jenisPesertaAktifTerbaruId)->where('status', 'menunggu')->count();

        return [
            Stat::make('Program Aktif', $activeProgram),
            Stat::make('Total Materi', $totalMateri),
            Stat::make('Pembelajaran Selesai', $progressDisetujui),
            Stat::make('Pembelajaran Proses', $progressProses),
        ];
    }
}
