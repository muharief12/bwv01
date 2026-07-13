<?php

namespace App\Filament\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Columns\ImageColumn;

class ProgressPeserta extends TableWidget
{
    protected static ?int $sort = 4;
    protected static ?string $title = 'Validasi Akttivitas Peserta';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => AktivitasPeserta::query()
                    ->where('status', 'menunggu')
                    ->oldest() // created_at ASC
            )
            ->columns([
                TextColumn::make('jenis_peserta.user.name')
                    ->label('Peserta')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('materi_pelatihan.judul')
                    ->label('Materi')
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->label('Tanggal Submit')
                    ->dateTime('d M Y')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->alignCenter()
                    ->color(fn(string $state): string => match ($state) {
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                        'menunggu' => 'warning',
                    }),
                TextColumn::make('deskripsi')
                    ->label('Catatan')
                    ->alignCenter()
                    ->default('-')
                    ->sortable()
            ])
            ->recordActions([
                // Action::make('setujui')
                //     ->label('Setujui')
                //     ->icon('heroicon-o-check-circle')
                //     ->color('success')
                //     ->requiresConfirmation()
                //     ->modalHeading('Setujui Aktivitas')
                //     ->modalDescription('Apakah Anda yakin ingin menyetujui aktivitas ini?')
                //     ->action(function (AktivitasPeserta $record): void {
                //         $record->update([
                //             'status' => 'disetujui',
                //         ]);

                //         $jumlahDisetujui = AktivitasPeserta::query()
                //             ->where('jenis_peserta_id', $record->jenis_peserta_id)
                //             ->where('status', 'disetujui')
                //             ->count();

                //         $totalMateri = MateriPelatihan::count();

                //         $progress = $totalMateri > 0
                //             ? round(($jumlahDisetujui / $totalMateri) * 100, 2)
                //             : 0;

                //         $jenisPeserta = JenisPeserta::find($record->jenis_peserta_id);

                //         $jenisPeserta?->update([
                //             'progress' => $progress,
                //         ]);
                //     }),
                // Action::make('tolak')
                //     ->label('tolak')
                //     ->icon('heroicon-o-check-circle')
                //     ->color('danger')
                //     ->requiresConfirmation()
                //     ->modalHeading('Tolak Aktivitas')
                //     ->modalDescription('Apakah Anda yakin ingin Menolak aktivitas ini?')
                //     ->action(function (AktivitasPeserta $record): void {
                //         $record->update([
                //             'status' => 'ditolak',
                //         ]);

                //         $jumlahDisetujui = AktivitasPeserta::query()
                //             ->where('jenis_peserta_id', $record->jenis_peserta_id)
                //             ->where('status', 'disetujui')
                //             ->count();

                //         $totalMateri = MateriPelatihan::count();

                //         $progress = $totalMateri > 0
                //             ? round(($jumlahDisetujui / $totalMateri) * 100, 2)
                //             : 0;

                //         $jenisPeserta = JenisPeserta::find($record->jenis_peserta_id);

                //         $jenisPeserta?->update([
                //             'progress' => $progress,
                //         ]);
                //     }),
                // Action::make('validasiAktivitas')
                //     ->label('Validasi')
                //     ->icon('heroicon-o-check-circle')
                //     ->color('success')
                //     ->modalHeading('Validasi Aktivitas')
                //     ->modalDescription('Periksa aktivitas peserta, lalu pilih Setujui atau Ditolak.')
                //     ->modalSubmitActionLabel('Setujui')
                //     ->infolist([
                //         ImageEntry::make('attachment')
                //             ->label('Attachment')
                //             ->disk('public')
                //             ->height(250),

                //         TextEntry::make('tanggal')
                //             ->label('Tanggal')
                //             ->date('d M Y'),

                //         TextEntry::make('materi_pelatihan.judl')
                //             ->label('Materi')
                //             ->placeholder('-'),
                //     ])
                //     ->form([
                //         FileUpload::make('attachment')
                //             ->disabled()
                //             ->dehydrated(),
                //         Textarea::make('description')
                //             ->label('Description')
                //             ->rows(4)
                //             ->maxLength(1000)
                //             ->placeholder('Tambahkan catatan validasi...')
                //             ->required(),
                //     ])
                //     ->extraModalFooterActions([
                //         Action::make('ditolak')
                //             ->label('Ditolak')
                //             ->color('danger')
                //             ->requiresConfirmation()
                //             ->action(function (AktivitasPeserta $record, array $data): void {
                //                 static::updateAktivitasPeserta($record, $data, 'ditolak');
                //             }),
                //     ])
                //     ->action(function (AktivitasPeserta $record, array $data): void {
                //         static::updateAktivitasPeserta($record, $data, 'disetujui');
                //     }),
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
            ]);
    }

    protected static function updateAktivitasPeserta(
        AktivitasPeserta $record,
        array $data,
        string $status
    ): void {
        $record->update([
            'description' => $data['description'] ?? null,
            'status' => $status,
        ]);

        $jumlahDisetujui = AktivitasPeserta::query()
            ->where('jenis_peserta_id', $record->jenis_peserta_id)
            ->where('status', 'disetujui')
            ->count();

        $totalMateri = MateriPelatihan::count();

        $progress = $totalMateri > 0
            ? round(($jumlahDisetujui / $totalMateri) * 100, 2)
            : 0;

        JenisPeserta::query()
            ->whereKey($record->jenis_peserta_id)
            ->update([
                'progress' => $progress,
            ]);

        Notification::make()
            ->title("Aktivitas berhasil {$status}.")
            ->success()
            ->send();
    }
}
