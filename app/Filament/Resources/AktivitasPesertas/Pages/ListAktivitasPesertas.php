<?php

namespace App\Filament\Resources\AktivitasPesertas\Pages;

use App\Filament\Resources\AktivitasPesertas\AktivitasPesertaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAktivitasPesertas extends ListRecords
{
    protected static string $resource = AktivitasPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
