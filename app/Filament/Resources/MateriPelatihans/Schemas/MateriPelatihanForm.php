<?php

namespace App\Filament\Resources\MateriPelatihans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MateriPelatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                TextInput::make('video_link')
                    ->default(null),
                Textarea::make('konten')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
