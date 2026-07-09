<?php

namespace App\Filament\Resources\AktivitasPesertas\Pages;

use App\Filament\Resources\AktivitasPesertas\AktivitasPesertaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAktivitasPeserta extends ViewRecord
{
    protected static string $resource = AktivitasPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
