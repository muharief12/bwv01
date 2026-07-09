<?php

namespace App\Filament\Resources\JenisPesertas;

use App\Filament\Resources\JenisPesertas\Pages\CreateJenisPeserta;
use App\Filament\Resources\JenisPesertas\Pages\EditJenisPeserta;
use App\Filament\Resources\JenisPesertas\Pages\ListJenisPesertas;
use App\Filament\Resources\JenisPesertas\Pages\ViewJenisPeserta;
use App\Filament\Resources\JenisPesertas\Schemas\JenisPesertaForm;
use App\Filament\Resources\JenisPesertas\Schemas\JenisPesertaInfolist;
use App\Filament\Resources\JenisPesertas\Tables\JenisPesertasTable;
use App\Models\JenisPeserta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisPesertaResource extends Resource
{
    protected static ?string $model = JenisPeserta::class;
    protected static string | UnitEnum | null $navigationGroup = 'Data Operasional';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    public static function form(Schema $schema): Schema
    {
        return JenisPesertaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JenisPesertaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisPesertasTable::configure($table);
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
            'index' => ListJenisPesertas::route('/'),
            'create' => CreateJenisPeserta::route('/create'),
            'view' => ViewJenisPeserta::route('/{record}'),
            'edit' => EditJenisPeserta::route('/{record}/edit'),
        ];
    }
}
