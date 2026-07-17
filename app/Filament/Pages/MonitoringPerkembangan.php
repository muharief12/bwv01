<?php

namespace App\Filament\Pages;

use App\Filament\CustomWidgets\DaftarAktivitasPeserta;
use App\Filament\CustomWidgets\MonitorProgressPeserta;
use App\Filament\CustomWidgets\ValidasiPembelajaran;
use App\Models\JenisPeserta;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Filament\Pages\Dashboard;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class MonitoringPerkembangan extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowTrendingUp;
    protected static ?string $navigationLabel = 'Monitoring Perkembangan';
    protected static ?int $navigationSort = 2;
    protected static ?string $title = 'Monitoring Perkembangan';
    protected static bool $shouldRegisterNavigation = true;

    protected string $view = 'filament.pages.monitoring-perkembangan';

    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('student')
                            ->label('Peserta')
                            ->live()
                            ->searchable()
                            ->preload()
                            ->options(Auth::user()->role === 'instruktur' ? User::where('role', 'peserta')->whereHas('aktivitas_instruktur', function ($query) {
                                $query->where('instruktur_id', Auth::user()->id);
                            })->pluck('name', 'id') : User::where('role', 'peserta')->pluck('name', 'id'))
                            ->afterStateUpdated(function (Set $set) {
                                $set('program', null);
                            }),
                        Select::make('program')
                            ->options(function (Get $get) {
                                return JenisPeserta::where('user_id', $get('student'))
                                    ->pluck('jenis_peserta', 'id');
                            })
                            ->searchable()
                            ->preload(),
                        // ...
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    protected function getFooterWidgets(): array
    {
        return [
            MonitorProgressPeserta::class,
            ValidasiPembelajaran::class,
            DaftarAktivitasPeserta::class,

        ];
    }
}
