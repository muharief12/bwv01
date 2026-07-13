<?php

namespace App\Providers;

use App\Models\AktivitasPeserta;
use App\Observers\AktivitasPesertaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AktivitasPeserta::observe(AktivitasPesertaObserver::class);
    }
}
