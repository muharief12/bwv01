<?php

namespace App\Filament\Member\Resources\AktivitasPesertas\Pages;

use App\Filament\Member\Resources\AktivitasPesertas\AktivitasPesertaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAktivitasPeserta extends EditRecord
{
    protected static string $resource = AktivitasPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
