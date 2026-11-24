<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\RaportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/dashboard/login');
});

Route::get('/raport/{record}', RaportController::class)->name('raport');

// Grouping route untuk fitur sertifikat agar lebih rapi dan mudah dikelola
Route::prefix('certificates')->name('certificates.')->group(function () {

    // 1. Preview PDF Sertifikat di browser (Stream)
    // URL: /certificates/11042/preview
    Route::get('/{enrollmentId}/preview', [CertificateController::class, 'generateCertificate'])
        ->name('preview');
    //->middleware('auth'); // Batasi akses hanya untuk user yang login (Opsional)

    // 2. Unduh langsung file PDF Sertifikat (Force Download)
    // URL: /certificates/11042/download
    Route::get('/{enrollmentId}/download', [CertificateController::class, 'downloadCertificate'])
        ->name('download')
        ->middleware('auth');

    // 3. Halaman Publik Verifikasi Keaslian Sertifikat (Tujuan dari Scan QR Code)
    // URL: /certificates/verify/CERT-UNMAHA-TI-2026-11042
    Route::get('/verify/{certificateNumber}', [CertificateController::class, 'verify'])
        ->name('verify');
});
