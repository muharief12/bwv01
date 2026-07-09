<?php

namespace App\Filament\Member\Resources\AktivitasPesertas\Schemas;

use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AktivitasPesertaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_peserta_id')
                    ->default(fn(?Model $record) => $record?->jenis_peserta_id ?? JenisPeserta::query()->where('user_id', Auth::user()->id)->where('status', 'aktif')->latest()->value('id'))
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->numeric(),
                Select::make('materi_pelatihan_id')
                    ->label('Materi Pelatihan')
                    ->preload()
                    ->options(function (callable $get, ?Model $record) {
                        $jenisPesertaId = $get('jenis_peserta_id');

                        if (!$jenisPesertaId) {
                            return [];
                        }

                        return MateriPelatihan::query()->whereNotIn('id', function ($query) use ($jenisPesertaId, $record) {
                            $query->select('materi_pelatihan_id')->from('aktivitas_pesertas')->where('jenis_peserta_id', $jenisPesertaId);
                            if ($record) {
                                $query->where('id', '!=', $record->id);
                            };
                        })->pluck('judul', 'id');
                    })
                    ->searchable()
                    ->required(),
                Select::make('instruktur_id')
                    ->label('Instruktur')
                    ->options(User::query()->where('role', 'instruktur')->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                Textarea::make('deskripsi')
                    ->label('Catatan')
                    ->default('-')
                    ->columnSpanFull(),
                FileUpload::make('attachment')
                    ->disk('public')
                    ->directory('attachment_ap')
                    ->columnSpanFull(),
                Hidden::make('status')
                    ->default('menunggu')
                    ->required(),
            ]);
    }
}
