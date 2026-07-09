<?php

namespace App\Filament\Resources\JenisPesertas\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisPesertaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->options(User::where('role', 'peserta')->pluck('name', 'id'))
                    ->required(),
                Select::make('jenis_peserta')
                    ->options(['reg' => 'Reguler', 'blk' => 'BLK'])
                    ->required(),
                Select::make('status')
                    ->options(['aktif' => 'Aktif', 'tidak_aktif' => 'Tidak aktif'])
                    ->default('aktif')
                    ->required(),
                TextInput::make('nilai')
                    ->default(0)
                    ->required()
                    ->numeric(),
                TextInput::make('progress')
                    ->default(0)
                    ->required()
                    ->numeric(),
            ]);
    }
}
