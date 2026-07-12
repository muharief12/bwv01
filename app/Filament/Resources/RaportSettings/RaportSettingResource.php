<?php

namespace App\Filament\Resources\RaportSettings;

use App\Filament\Resources\RaportSettings\Pages\CreateRaportSetting;
use App\Filament\Resources\RaportSettings\Pages\EditRaportSetting;
use App\Filament\Resources\RaportSettings\Pages\ListRaportSettings;
use App\Filament\Resources\RaportSettings\Schemas\RaportSettingForm;
use App\Filament\Resources\RaportSettings\Tables\RaportSettingsTable;
use App\Models\RaportSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RaportSettingResource extends Resource
{
    protected static ?string $model = RaportSetting::class;
    protected static string | UnitEnum | null $navigationGroup = 'Data Master';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    public static function form(Schema $schema): Schema
    {
        return RaportSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RaportSettingsTable::configure($table);
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
            'index' => ListRaportSettings::route('/'),
            'create' => CreateRaportSetting::route('/create'),
            'edit' => EditRaportSetting::route('/{record}/edit'),
        ];
    }
}
