<?php

namespace App\Filament\Member\Resources\MateriPelatihans;

use App\Filament\Member\Resources\MateriPelatihans\Pages\CreateMateriPelatihan;
use App\Filament\Member\Resources\MateriPelatihans\Pages\EditMateriPelatihan;
use App\Filament\Member\Resources\MateriPelatihans\Pages\ListMateriPelatihans;
use App\Filament\Member\Resources\MateriPelatihans\Schemas\MateriPelatihanForm;
use App\Filament\Member\Resources\MateriPelatihans\Tables\MateriPelatihansTable;
use App\Models\MateriPelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MateriPelatihanResource extends Resource
{
    protected static ?string $model = MateriPelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    public static function form(Schema $schema): Schema
    {
        return MateriPelatihanForm::configure($schema);
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

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'peserta';
    }

    public static function canView(Model $record): bool
    {
        return Auth::user()?->role === 'peserta';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMateriPelatihans::route('/'),
            'create' => CreateMateriPelatihan::route('/create'),
            'edit' => EditMateriPelatihan::route('/{record}/edit'),
        ];
    }
}
