<?php

namespace App\Filament\Resources\LaporanHarians;

use App\Filament\Resources\LaporanHarians\Pages\CreateLaporanHarian;
use App\Filament\Resources\LaporanHarians\Pages\EditLaporanHarian;
use App\Filament\Resources\LaporanHarians\Pages\ListLaporanHarians;
use App\Filament\Resources\LaporanHarians\Schemas\LaporanHarianForm;
use App\Filament\Resources\LaporanHarians\Tables\LaporanHariansTable;
use App\Models\LaporanHarian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanHarianResource extends Resource
{
    protected static ?string $model = LaporanHarian::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    public static function form(Schema $schema): Schema
    {
        return LaporanHarianForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanHariansTable::configure($table);
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
            'index' => ListLaporanHarians::route('/'),
            'create' => CreateLaporanHarian::route('/create'),
            'edit' => EditLaporanHarian::route('/{record}/edit'),
        ];
    }
}
