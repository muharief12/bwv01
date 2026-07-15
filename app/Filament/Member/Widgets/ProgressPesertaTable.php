<?php

namespace App\Filament\Member\Widgets;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProgressPesertaTable extends TableWidget
{
    protected static ?int $sort = 3;
    protected static ?string $title = 'Akttivitas Peserta Terakhir';
    // protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $jenisPesertaAktifTerbaruId = JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')
            ->latest()
            ->value('id');
        return $table
            ->query(
                fn(): Builder => AktivitasPeserta::query()
                    ->where('jenis_peserta_id', JenisPeserta::where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->value('id'))
                // ->oldest() // created_at ASC)
            )
            ->columns([
                TextColumn::make('jenis_peserta.user.name')
                    ->label('Peserta')
                    ->alignCenter()
                    ->searchable(),

                TextColumn::make('materi_pelatihan.judul')
                    ->label('Aktivitas')
                    ->alignCenter()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Submit')
                    ->dateTime('d M Y H:i')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('status')
                    ->alignCenter()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'disetujui' => 'success',
                        'ditolak' => 'danger',
                        'menunggu' => 'warning',
                    }),
                TextColumn::make('deskripsi')
                    ->alignCenter()
                    ->label('Catatan')
                    ->default('-')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
