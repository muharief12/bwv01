<?php

namespace App\Filament\Resources\LaporanHarians\Pages;

use App\Filament\Resources\LaporanHarians\LaporanHarianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanHarians extends ListRecords
{
    protected static string $resource = LaporanHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
