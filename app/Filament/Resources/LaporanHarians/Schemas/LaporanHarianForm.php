<?php

namespace App\Filament\Resources\LaporanHarians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LaporanHarianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('jumlah_peserta_belajar')
                    ->required()
                    ->numeric(),
                TextInput::make('jumlah_peserta-aktif')
                    ->required()
                    ->numeric(),
                TextInput::make('produktivitas')
                    ->required()
                    ->numeric(),
            ]);
    }
}
