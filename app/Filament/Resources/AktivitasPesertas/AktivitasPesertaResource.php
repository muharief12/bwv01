<?php

namespace App\Filament\Resources\AktivitasPesertas;

use App\Filament\Resources\AktivitasPesertas\Pages\CreateAktivitasPeserta;
use App\Filament\Resources\AktivitasPesertas\Pages\EditAktivitasPeserta;
use App\Filament\Resources\AktivitasPesertas\Pages\ListAktivitasPesertas;
use App\Filament\Resources\AktivitasPesertas\Pages\ViewAktivitasPeserta;
use App\Filament\Resources\AktivitasPesertas\Schemas\AktivitasPesertaForm;
use App\Filament\Resources\AktivitasPesertas\Schemas\AktivitasPesertaInfolist;
use App\Filament\Resources\AktivitasPesertas\Tables\AktivitasPesertasTable;
use App\Models\AktivitasPeserta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AktivitasPesertaResource extends Resource
{
    protected static ?string $model = AktivitasPeserta::class;
    protected static string | UnitEnum | null $navigationGroup = 'Data Operasional';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return AktivitasPesertaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AktivitasPesertaInfolist::configure($schema);
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
            'view' => ViewAktivitasPeserta::route('/{record}'),
            'edit' => EditAktivitasPeserta::route('/{record}/edit'),
        ];
    }
}
