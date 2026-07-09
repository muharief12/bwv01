<?php

namespace App\Filament\Resources\MateriPelatihans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MateriPelatihanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('judul'),
                TextEntry::make('video_link')
                    ->placeholder('-'),
                TextEntry::make('konten')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
