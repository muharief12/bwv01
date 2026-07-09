<?php

namespace App\Filament\Resources\MateriPelatihans;

use App\Filament\Resources\MateriPelatihans\Pages\CreateMateriPelatihan;
use App\Filament\Resources\MateriPelatihans\Pages\EditMateriPelatihan;
use App\Filament\Resources\MateriPelatihans\Pages\ListMateriPelatihans;
use App\Filament\Resources\MateriPelatihans\Pages\ViewMateriPelatihan;
use App\Filament\Resources\MateriPelatihans\Schemas\MateriPelatihanForm;
use App\Filament\Resources\MateriPelatihans\Schemas\MateriPelatihanInfolist;
use App\Filament\Resources\MateriPelatihans\Tables\MateriPelatihansTable;
use App\Models\MateriPelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MateriPelatihanResource extends Resource
{
    protected static ?string $model = MateriPelatihan::class;
    protected static string | UnitEnum | null $navigationGroup = 'Data Master';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MateriPelatihanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MateriPelatihanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MateriPelatihansTable::configure($table);
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
            'index' => ListMateriPelatihans::route('/'),
            'create' => CreateMateriPelatihan::route('/create'),
            'view' => ViewMateriPelatihan::route('/{record}'),
            'edit' => EditMateriPelatihan::route('/{record}/edit'),
        ];
    }
}
