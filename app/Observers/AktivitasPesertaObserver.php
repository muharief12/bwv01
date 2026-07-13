<?php

namespace App\Observers;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;

class AktivitasPesertaObserver
{
    /**
     * Handle the AktivitasPeserta "created" event.
     */
    public function created(AktivitasPeserta $aktivitasPeserta): void
    {
        //
    }

    /**
     * Handle the AktivitasPeserta "updated" event.
     */
    public function updated(AktivitasPeserta $aktivitasPeserta): void
    {
        if (! $aktivitasPeserta->wasChanged(['status', 'jenis_peserta_id'])) {
            return;
        }

        $this->updateProgressJenisPeserta($aktivitasPeserta->jenis_peserta_id);

        if ($aktivitasPeserta->wasChanged('jenis_peserta_id')) {
            $oldJenisPesertaId = $aktivitasPeserta->getOriginal('jenis_peserta_id');

            if ($oldJenisPesertaId) {
                $this->updateProgressJenisPeserta($oldJenisPesertaId);
            }
        }
    }

    /**
     * Handle the AktivitasPeserta "deleted" event.
     */
    public function deleted(AktivitasPeserta $aktivitasPeserta): void
    {
        //
    }

    /**
     * Handle the AktivitasPeserta "restored" event.
     */
    public function restored(AktivitasPeserta $aktivitasPeserta): void
    {
        //
    }

    /**
     * Handle the AktivitasPeserta "force deleted" event.
     */
    public function forceDeleted(AktivitasPeserta $aktivitasPeserta): void
    {
        //
    }

    protected function updateProgressJenisPeserta(int|string|null $jenisPesertaId): void
    {
        if (! $jenisPesertaId) {
            return;
        }

        $jumlahDisetujui = AktivitasPeserta::query()
            ->where('jenis_peserta_id', $jenisPesertaId)
            ->where('status', 'disetujui')
            ->count();

        $totalMateri = MateriPelatihan::query()->count();

        $progress = $totalMateri > 0
            ? round(($jumlahDisetujui / $totalMateri) * 100, 2)
            : 0;

        JenisPeserta::query()
            ->whereKey($jenisPesertaId)
            ->update([
                'progress' => $progress,
            ]);
    }
}
