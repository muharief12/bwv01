<?php

namespace App\Filament\Member\Resources\AktivitasPesertas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AktivitasPesertasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // ->modifyQueryUsing(function (Builder $query) {
            //     $user = Auth::user();
            //     if ($user->role === 'peserta') {
            //         $query->whereHas('jenis_peserta.user', function (Builder $q) use ($user) {
            //             $q->where('user_id', $user->id);
            //         });
            //     }
            // })
            ->columns([
                TextColumn::make('jenis_peserta.jenis_peserta')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('materi_pelatihan.judul')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('instruktur.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
