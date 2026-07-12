<?php

use App\Http\Controllers\RaportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/dashboard/login');
});

Route::get('/raport/{record}', RaportController::class)->name('raport');
