<?php

namespace App\Filament\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ProgressPeserta extends TableWidget
{
    protected static ?int $sort = 4;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => AktivitasPeserta::query()
                    ->where('status', 'menunggu')
                    ->oldest() // created_at ASC
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Peserta')
                    ->searchable(),

                TextColumn::make('judul')
                    ->label('Aktivitas')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Submit')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color('warning'),
            ])
            ->recordActions([
                Action::make('setujui')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Aktivitas')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui aktivitas ini?')
                    ->action(function (AktivitasPeserta $record): void {
                        $record->update([
                            'status' => 'disetujui',
                        ]);

                        $jumlahDisetujui = AktivitasPeserta::query()
                            ->where('jenis_peserta_id', $record->jenis_peserta_id)
                            ->where('status', 'disetujui')
                            ->count();

                        $totalMateri = MateriPelatihan::count();

                        $progress = $totalMateri > 0
                            ? round(($jumlahDisetujui / $totalMateri) * 100, 2)
                            : 0;

                        $jenisPeserta = JenisPeserta::find($record->jenis_peserta_id);

                        $jenisPeserta?->update([
                            'progress' => $progress,
                        ]);
                    })
            ]);
    }
}
