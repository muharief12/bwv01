<?php

namespace App\Filament\Resources\AktivitasPesertas\Schemas;

use App\Models\JenisPeserta;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AktivitasPesertaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_peserta_id')
                    ->default(fn() => JenisPeserta::query()->where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->value('id'))
                    ->disabled()
                    ->required()
                    ->numeric(),
                Select::make('materi_pelatihan_id')
                    ->label('Materi Pelatihan')
                    ->relationship('materi_pelatihan', 'judul')
                    ->searchable()
                    ->required(),
                Select::make('instruktur_id')
                    ->label('Instruktur')
                    ->relationship('instruktur', 'name')
                    ->searchable()
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                Textarea::make('deskripsi')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'])
                    ->default('menunggu')
                    ->required(),
            ]);
    }
}
