<?php

namespace App\Filament\Resources\RaportSettings\Pages;

use App\Filament\Resources\RaportSettings\RaportSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRaportSettings extends ListRecords
{
    protected static string $resource = RaportSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
