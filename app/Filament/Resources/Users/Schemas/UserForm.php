<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire) => $livewire instanceof CreateRecord)
                    ->placeholder(fn(Page $livewire) => $livewire instanceof EditRecord ? 'Kosongkan jika tidak ingin mengubah password' : ''),
                TextInput::make('alamat')
                    ->default(null),
                TextInput::make('no_hp')
                    ->default(null),
                Select::make('role')
                    ->options(['peserta' => 'Peserta', 'admin' => 'Admin', 'instruktur' => 'Instruktur'])
                    ->default('peserta')
                    ->required(),
            ]);
    }
}
