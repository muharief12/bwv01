<?php

namespace App\Http\Controllers;

use App\Models\JenisPeserta;
use App\Models\RaportSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function __invoke(JenisPeserta $record)
    {
        $record->load(['user', 'aktivitas_pesertas']);
        $raportSetting = RaportSetting::where('status', 'aktif')->first();

        return Pdf::loadView('raport', ['record' => $record, 'raportSetting' => $raportSetting])
            // ->stream('Laporan Hasil Rapor_' . $jenisPeserta->user->name . 'Program Pelatihan ' . $jenisPeserta->jenis_peserta . ' oleh Garasi Babershop' . Carbon::parse(now())->format('Y-m'));
            ->stream('Laporan Hasil Rapor_' . 'Program Pelatihan ' . $record->jenis_peserta . ' oleh Garasi Babershop' . Carbon::parse(now())->format('Y-m'));
    }
}
