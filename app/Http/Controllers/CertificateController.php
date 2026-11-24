<?php

namespace App\Http\Controllers;

use App\Models\AktivitasPeserta;
use App\Models\JenisPeserta;
use App\Models\MateriPelatihan;
use App\Models\RaportSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Helper private untuk menyiapkan data & instance PDF
     */
    private function preparePdfData(string $enrollmentId)
    {
        // Catatan: Ganti array statis ini dengan query Eloquent (misal: Enrollment::with(['user', 'course.modules'])->findOrFail($enrollmentId))
        // $certNumber = 'CERT/UNMAHA/TI/2026/' . $enrollmentId;
        $member = JenisPeserta::findOrFail($enrollmentId);

        // URL verifikasi otomatis mengarah ke route 'certificates.verify'
        $verificationUrl = route('certificates.verify', ['certificateNumber' => str_replace('/', '-', $member->id)]);

        $data = [
            'certificate_number' => $member->id,
            'participant_name'   => $member->user->name,
            'course_title'       => 'Kursus Barberman',
            'completion_date'    => Carbon::parse(AktivitasPeserta::where('jenis_peserta_id', $member->id)->latest()->first()->tanggal)->locale('id')->translatedFormat('d F Y'), //'20 November 2026',
            'total_hours'        => MateriPelatihan::count() * 3 . ' Jam Pelajaran (JP)',
            'final_score'        => $member->nilai,
            'qr_code_url'        => 'https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=' . urlencode($verificationUrl),
            'signer_name'        => RaportSetting::where('status', 'aktif')->first()->nama_pj,
            'signer_title'       => 'CEO Garasi Barbershop',
            'signer_url'         => RaportSetting::where('status', 'aktif')->first()->ttd,
            'modules'            => AktivitasPeserta::where('jenis_peserta_id', $member->id)->get(),
            // 'modules'            => [
            //     ['no' => 1, 'title' => 'Konsep Dasar Rekayasa Sistem & Business Process Modeling', 'duration' => '4 JP', 'status' => 'Lulus', 'score' => 90],
            //     ['no' => 2, 'title' => 'Elisitasi Kebutuhan Sistem & Pemodelan UML (Use Case & Activity)', 'duration' => '6 JP', 'status' => 'Lulus', 'score' => 94],
            //     ['no' => 3, 'title' => 'Perancangan Basis Data Relasional & Normalisasi', 'duration' => '6 JP', 'status' => 'Lulus', 'score' => 92],
            //     ['no' => 4, 'title' => 'Arsitektur MVC dengan PHP Laravel & Eloquent ORM', 'duration' => '8 JP', 'status' => 'Lulus', 'score' => 95],
            //     ['no' => 5, 'title' => 'Implementasi Rapid Admin Panel & Pengujian Sistem (UAT)', 'duration' => '8 JP', 'status' => 'Lulus', 'score' => 91],
            // ]
        ];


        $pdf = Pdf::loadView('certificates.template', compact('data', 'member', 'raportSetting'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'defaultFont'          => 'sans-serif'
            ]);

        $fileName = 'Sertifikat_' . str_replace(' ', '_', $data['participant_name']) . '.pdf';

        return ['pdf' => $pdf, 'fileName' => $fileName];
    }

    /**
     * Menampilkan PDF langsung di tab browser (Stream)
     */
    public function generateCertificate(string $enrollmentId)
    {
        $result = $this->preparePdfData($enrollmentId);
        return $result['pdf']->stream($result['fileName']);
    }

    /**
     * Memaksa browser mengunduh file PDF (Download)
     */
    public function downloadCertificate(string $enrollmentId)
    {
        $result = $this->preparePdfData($enrollmentId);
        return $result['pdf']->download($result['fileName']);
    }

    /**
     * Menampilkan halaman validasi keaslian sertifikat saat QR Code di-scan
     */
    public function verify(string $certificateNumber)
    {
        // Kembalikan format strip (-) menjadi garis miring (/) untuk pencarian di database
        $originalCertNumber = str_replace('-', '/', $certificateNumber);

        $member = JenisPeserta::findOrFail($certificateNumber);

        // Contoh pengecekan ke database:
        // $certificate = Certificate::where('certificate_number', $originalCertNumber)->firstOrFail();

        return view('certificates.verify', [
            'certificate_number' => $originalCertNumber ?? '-',
            'status'             => $member->progress === 100 ? 'VALID & TERVERIFIKASI' : 'TIDAK TERVERIFIKASI',
            'participant_name'   => $member->user->name,
            'course_title'       => 'Kursus Barberman',
            'completion_date'    => Carbon::parse(AktivitasPeserta::where('jenis_peserta_id', $member->id)->latest()->first()->tanggal)->locale('id')->translatedFormat('d F Y'), //'20 November 2026',
            'member'             => $member,
        ]);
    }
}
