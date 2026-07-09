<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Register;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomRegister extends Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                $this->getPasswordFormComponent(),
                TextInput::make('no_hp')
                    ->required()
                    ->placeholder('Awali dengan 62')
                    ->maxLength(14),
                $this->getPasswordConfirmationFormComponent(),
            ])->columns(2);
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['role'] = 'peserta';

        return $data;
    }
}
