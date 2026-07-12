<?php

namespace App\Filament\Resources\RaportSettings\Pages;

use App\Filament\Resources\RaportSettings\RaportSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRaportSetting extends EditRecord
{
    protected static string $resource = RaportSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
