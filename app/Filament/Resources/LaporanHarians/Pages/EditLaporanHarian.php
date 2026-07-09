<?php

namespace App\Filament\Resources\LaporanHarians\Pages;

use App\Filament\Resources\LaporanHarians\LaporanHarianResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanHarian extends EditRecord
{
    protected static string $resource = LaporanHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
