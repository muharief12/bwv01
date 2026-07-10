<?php

namespace App\Filament\Resources\JenisPesertas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JenisPesertasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Peserta')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('jenis_peserta')
                    ->alignCenter()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'reg' => 'info',
                        'blk' => 'warning',
                    }),
                TextColumn::make('status')
                    ->alignCenter()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'aktif' => 'success',
                        'tidak_aktif' => 'danger',
                    }),
                TextColumn::make('nilai')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('progress')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->alignCenter()
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
