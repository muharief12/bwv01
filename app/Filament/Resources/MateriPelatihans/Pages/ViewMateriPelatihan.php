<?php

namespace App\Filament\Resources\MateriPelatihans\Pages;

use App\Filament\Resources\MateriPelatihans\MateriPelatihanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMateriPelatihan extends ViewRecord
{
    protected static string $resource = MateriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
