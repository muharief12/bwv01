<?php

namespace App\Filament\Resources\MateriPelatihans\Pages;

use App\Filament\Resources\MateriPelatihans\MateriPelatihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMateriPelatihans extends ListRecords
{
    protected static string $resource = MateriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
