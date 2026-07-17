<?php

namespace App\Filament\Member\Resources\MateriPelatihans\Pages;

use App\Filament\Member\Resources\MateriPelatihans\MateriPelatihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListMateriPelatihans extends ListRecords
{
    protected static string $resource = MateriPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        if (Auth::user()->role != 'peserta') {
            return [
                CreateAction::make(),
            ];
        }

        return [];
    }
}
