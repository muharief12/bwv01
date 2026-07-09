<?php

namespace App\Filament\Resources\JenisPesertas\Pages;

use App\Filament\Resources\JenisPesertas\JenisPesertaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisPeserta extends EditRecord
{
    protected static string $resource = JenisPesertaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
