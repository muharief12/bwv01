<?php

namespace App\Filament\Member\Resources\AktivitasPesertas\Pages;

use App\Filament\Member\Resources\AktivitasPesertas\AktivitasPesertaResource;
use App\Models\JenisPeserta;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListAktivitasPesertas extends ListRecords
{
    protected static string $resource = AktivitasPesertaResource::class;

    protected function getHeaderActions(): array
    {
        if (JenisPeserta::where('user_id', Auth::user()->id)->first()) {
            return [
                CreateAction::make(),
            ];
        }

        return [];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()
            ->whereHas('jenis_peserta', function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            });
    }
}
