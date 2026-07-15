<?php

namespace App\Filament\Resources\JenisPesertas\Tables;

use App\Models\JenisPeserta;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class JenisPesertasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();

                if ($user->role === 'instruktur') {
                    $query->whereHas('aktivitas_pesertas', function ($q) use ($user) {
                        $q->where('instruktur_id', $user->id);
                    });
                }
            })
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
                Action::make('raport')
                    ->label('PDF File')
                    ->color('danger')
                    ->icon('heroicon-o-folder-arrow-down')
                    ->url(fn(JenisPeserta $record) => route('raport', $record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
