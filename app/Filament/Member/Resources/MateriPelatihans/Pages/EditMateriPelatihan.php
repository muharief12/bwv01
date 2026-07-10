<?php

namespace App\Filament\Member\Resources\MateriPelatihans\Pages;

use App\Filament\Member\Resources\MateriPelatihans\MateriPelatihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMateriPelatihan extends EditRecord
{
    protected static string $resource = MateriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
