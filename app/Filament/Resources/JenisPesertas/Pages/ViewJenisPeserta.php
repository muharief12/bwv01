<?php

namespace App\Filament\Resources\JenisPesertas\Pages;

use App\Filament\Resources\JenisPesertas\JenisPesertaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisPeserta extends ViewRecord
{
    protected static string $resource = JenisPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
