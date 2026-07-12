<?php

namespace App\Filament\Resources\RaportSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RaportSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('lokasi')
                    ->required(),
                TextInput::make('nama_pj')
                    ->required(),
                Select::make('status')
                    ->default('aktif')
                    ->options(['aktif' => 'Aktif', 'tidak_aktif' => 'Tidak aktif'])
                    ->required(),
                FileUpload::make('ttd')
                    ->disk('public')
                    ->directory('signature')
                    ->required()
                    ->columnSpanFull(),
            ])->columns(3);
    }
}
