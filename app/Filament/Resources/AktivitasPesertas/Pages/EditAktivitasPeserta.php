<?php

namespace App\Filament\Resources\AktivitasPesertas\Pages;

use App\Filament\Resources\AktivitasPesertas\AktivitasPesertaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAktivitasPeserta extends EditRecord
{
    protected static string $resource = AktivitasPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
