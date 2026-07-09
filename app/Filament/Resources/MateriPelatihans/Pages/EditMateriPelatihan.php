<?php

namespace App\Filament\Resources\MateriPelatihans\Pages;

use App\Filament\Resources\MateriPelatihans\MateriPelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMateriPelatihan extends EditRecord
{
    protected static string $resource = MateriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
