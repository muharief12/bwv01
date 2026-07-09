<?php

namespace App\Filament\Resources\JenisPesertas\Pages;

use App\Filament\Resources\JenisPesertas\JenisPesertaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisPesertas extends ListRecords
{
    protected static string $resource = JenisPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
