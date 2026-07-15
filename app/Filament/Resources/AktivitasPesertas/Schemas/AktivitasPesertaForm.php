<?php

namespace App\Filament\Resources\AktivitasPesertas\Schemas;

use App\Models\JenisPeserta;
use App\Models\User;
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
                Select::make('jenis_peserta_id')
                    ->default(fn() => JenisPeserta::query()->where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->value('id'))
                    ->options(JenisPeserta::with('user')->get()->mapWithKeys(function ($item) {
                        return [
                            $item->id => "{$item->user->name} | {$item->jenis_peserta} | {$item->created_at->format('d M Y')}"
                        ];
                    }))
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('materi_pelatihan_id')
                    ->label('Materi Pelatihan')
                    ->relationship('materi_pelatihan', 'judul')
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('instruktur_id')
                    ->label('Instruktur')
                    ->options(User::where('role', 'instruktur')->pluck('name', 'id'))
                    ->preload()
                    ->default(Auth::user()->id)
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
