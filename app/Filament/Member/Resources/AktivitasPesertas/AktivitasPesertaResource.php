<?php

namespace App\Filament\Member\Resources\AktivitasPesertas;

use App\Filament\Member\Resources\AktivitasPesertas\Pages\CreateAktivitasPeserta;
use App\Filament\Member\Resources\AktivitasPesertas\Pages\EditAktivitasPeserta;
use App\Filament\Member\Resources\AktivitasPesertas\Pages\ListAktivitasPesertas;
use App\Filament\Member\Resources\AktivitasPesertas\Schemas\AktivitasPesertaForm;
use App\Filament\Member\Resources\AktivitasPesertas\Tables\AktivitasPesertasTable;
use App\Models\AktivitasPeserta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AktivitasPesertaResource extends Resource
{
    protected static ?string $model = AktivitasPeserta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return AktivitasPesertaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AktivitasPesertasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAktivitasPesertas::route('/'),
            'create' => CreateAktivitasPeserta::route('/create'),
            'edit' => EditAktivitasPeserta::route('/{record}/edit'),
        ];
    }
}
