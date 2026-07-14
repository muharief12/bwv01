<?php

namespace App\Filament\Resources\AktivitasPesertas\Tables;

use App\Models\AktivitasPeserta;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AktivitasPesertasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();

                if ($user->role === 'instruktur') {
                    $query->where('instruktur_id', $user->id);
                }
            })
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
                // ViewAction::make(),
                EditAction::make(),
                Action::make('Validasi')
                    ->label('Validasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->modalHeading('Validasi Aktivitas')
                    ->modalDescription('Periksa aktivitas peserta, lalu pilih Setujui atau Ditolak.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Section::make('Data Aktivitas')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                ImageEntry::make('attachment')
                                                    ->hiddenLabel()
                                                    ->disk('public'),
                                                Section::make()
                                                    ->schema([
                                                        TextEntry::make('jenis_peserta.user.name')
                                                            ->label('Nama Peserta'),
                                                        TextEntry::make('materi_pelatihan.judul')
                                                            ->label('Materi Pelatihan'),
                                                        TextEntry::make('instruktur.name')
                                                            ->label('Nama Instruktur'),
                                                        TextEntry::make('jenis_peserta.jenis_peserta')
                                                            ->label('Jenis Peserta')
                                                            ->badge(),
                                                    ])->contained(false),
                                            ])
                                    ]),
                                Section::make('Validasi')
                                    ->schema([
                                        Textarea::make('deskripsi')
                                            ->label('catatan')
                                            ->default(fn($record) => $record->deskripsi)
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->placeholder('Tambahkan catatan validasi...')
                                            ->required(),
                                        Select::make('status')
                                            ->default('disetujui')
                                            ->options([
                                                'disetujui' => 'Setuju',
                                                'ditolak' => 'Tolak'
                                            ])
                                    ]),
                            ]),
                    ])
                    ->action(function (array $data, AktivitasPeserta $record): void {
                        $record->update([
                            'status' => $data['status'],
                            'deskripsi' => $data['deskripsi']
                        ]);

                        Notification::make()
                            ->title("Aktivitas berhasil {$data['status']}.")
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
