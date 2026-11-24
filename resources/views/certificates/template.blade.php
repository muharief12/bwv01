<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kelulusan - {{ $data['participant_name'] }}</title>
    <style>
        /* 1. Kunci ukuran kertas A4 Landscape & atur margin aman langsung di @page */
        @page {
            size: A4 landscape;
            margin: 10mm;
            /* Margin fisik kertas dari semua sisi */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            background-color: #ffffff;
        }

        /* 2. Gunakan ukuran bersih (A4 Landscape 297x210mm dikurangi margin 20mm = 277x190mm) */
        /* Gunakan satuan pt/px yang stabil di DomPDF (277mm ≈ 785pt, 190mm ≈ 538pt) */
        .page-wrapper {
            width: 100%;
            height: 525pt;
            /* Dikunci sedikit di bawah 538pt agar tidak memicu auto page-break */
            position: relative;
        }

        .page-break {
            page-break-after: always;
        }

        /* Bingkai Halaman 1 menggunakan struktur tabel agar border tidak meluber */
        .cert-outer-table {
            width: 100%;
            height: 520pt;
            border: 3pt solid #1e3a8a;
            /* Navy Blue */
            border-collapse: collapse;
        }

        .cert-outer-td {
            padding: 4pt;
            vertical-align: top;
        }

        .cert-inner-table {
            width: 100%;
            height: 520pt;
            border: 1.5pt solid #d97706;
            /* Gold Accent */
            border-collapse: collapse;
        }

        .cert-content-td {
            padding: 22pt 36pt;
            text-align: center;
            vertical-align: middle;
        }

        /* Tipografi Halaman 1 (Menggunakan satuan pt agar proporsional terhadap kertas) */
        .header-org {
            /* font-size: 12pt; */
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 1.5pt;
            color: #1e3a8a;
            text-transform: uppercase;
            margin-bottom: 4pt;
        }

        .cert-number {
            /* font-size: 9pt; */
            font-size: 12pt;
            color: #64748b;
            margin-bottom: 18pt;
        }

        .cert-title {
            /* font-size: 30pt; */
            font-size: 42pt;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 3pt;
            text-transform: uppercase;
            margin: 0;
            line-height: 1.1;
        }

        .cert-subtitle {
            /* font-size: 10.5pt; */
            font-size: 12pt;
            color: #d97706;
            font-weight: bold;
            letter-spacing: 2.5pt;
            text-transform: uppercase;
            margin-top: 4pt;
            margin-bottom: 20pt;
        }

        .presented-to {
            /* font-size: 10.5pt; */
            font-size: 12pt;
            color: #475569;
            margin-bottom: 8pt;
        }

        .participant-name {
            /* font-size: 24pt; */
            font-size: 36pt;
            font-weight: bold;
            color: #1e3a8a;
            border-bottom: 1.5pt solid #cbd5e1;
            display: inline-block;
            padding: 0 24pt 5pt 24pt;
            margin-bottom: 16pt;
        }

        .course-desc {
            /* font-size: 10.5pt; */
            font-size: 12pt;
            line-height: 1.45;
            color: #334155;
            width: 85%;
            margin: 0 auto 8pt auto;
        }

        .course-title {
            /* font-size: 14pt; */
            font-size: 20pt;
            font-weight: bold;
            color: #0f172a;
            /* margin-bottom: 24pt; */
            margin-bottom: 20pt;
        }

        /* Footer & Tanda Tangan Halaman 1 */
        .footer-table {
            width: 100%;
            margin-top: 10pt;
            border-collapse: collapse;
        }

        .footer-table td {
            vertical-align: bottom;
            text-align: center;
        }

        .qr-box {
            text-align: left !important;
            width: 28%;
        }

        .qr-caption {
            font-size: 7pt;
            color: #64748b;
            margin-top: 3pt;
        }

        .signature-box {
            width: 38%;
        }

        .signature-space {
            height: 45pt;
        }

        .signer-name {
            /* font-size: 10.5pt; */
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
            color: #0f172a;
        }

        .signer-title {
            /* font-size: 8.5pt; */
            font-size: 10pt;
            color: #475569;
            margin-top: 2pt;
        }

        /* Styling Halaman 2 (Transkrip / Detail Materi) */
        /* .transcript-outer-table {
            width: 100%;
            height: 520pt;
            height: 520pt;
            border: 1.5pt solid #cbd5e1;
            border-collapse: collapse;
        }
        .transcript-content-td {
            padding: 20pt 28pt;
            vertical-align: top;
        } */
        .transcript-outer-table {
            width: 100%;
            height: 520pt;
            border: 1.5pt solid #cbd5e1;
            border-collapse: collapse;
        }

        .transcript-content-td {
            padding: 20pt 28pt;
            vertical-align: top;
            height: 480pt;
            /* Tinggi bersih di dalam bingkai setelah dikurangi padding atas-bawah (40pt) */
        }

        /* Tabel pembungkus utama di dalam halaman 2 untuk menciptakan efek vertical space-between */
        .transcript-layout-wrapper {
            width: 100%;
            height: 480pt;
            border-collapse: collapse;
        }

        .transcript-top-section {
            vertical-align: top;
            /* Bagian Header + Tabel Materi mentok ke atas */
        }

        .transcript-bottom-section {
            vertical-align: bottom;
            /* Bagian Keterangan + Tanda Tangan mentok ke bawah */
        }

        .transcript-summary {
            margin-top: 14pt;
            width: 100%;
            font-size: 9pt;
            border-collapse: collapse;
        }

        .transcript-header {
            border-bottom: 2pt solid #1e3a8a;
            padding-bottom: 6pt;
            margin-bottom: 12pt;
        }

        .transcript-title {
            font-size: 14pt;
            font-weight: bold;
            color: #1e3a8a;
            margin: 0;
            text-transform: uppercase;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 12pt;
            font-size: 9pt;
            border-collapse: collapse;
        }

        .meta-table td {
            padding: 2.5pt 0;
        }

        .meta-label {
            font-weight: bold;
            color: #475569;
            width: 17%;
        }

        .syllabus-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .syllabus-table th {
            background-color: #1e3a8a;
            color: #ffffff;
            padding: 6pt 8pt;
            text-align: left;
            border: 1pt solid #1e3a8a;
        }

        .syllabus-table td {
            padding: 6pt 8pt;
            border: 1pt solid #cbd5e1;
            color: #1e293b;
        }

        .syllabus-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center !important;
        }

        .badge-pass {
            background-color: #dcfce7;
            color: #166534;
            padding: 2pt 6pt;
            border-radius: 3pt;
            font-weight: bold;
            font-size: 8pt;
        }

        /* .transcript-summary {
            margin-top: 14pt;
            width: 100%;
            font-size: 9pt;
            border-collapse: collapse;
        } */
    </style>
</head>

<body>

    <!-- HALAMAN 1: SERTIFIKAT COMPLETION -->
    <div class="page-wrapper page-break">
        <table class="cert-outer-table">
            <tr>
                <td class="cert-outer-td">
                    <table class="cert-inner-table">
                        <tr>
                            <td class="cert-content-td">

                                <div class="header-org">Lembaga Pelatihan dan Kursus Garasi Barbershop</div>
                                <div class="cert-number">Nomor Sertifikat: {{ $data['certificate_number'] }}</div>

                                <h1 class="cert-title">Sertifikat Kelulusan</h1>
                                <div class="cert-subtitle">Certificate of Completion</div>

                                <div class="presented-to">Diberikan dengan bangga kepada:</div>
                                <div class="participant-name">{{ $data['participant_name'] }}</div>

                                <div class="course-desc">
                                    Telah berhasil menyelesaikan seluruh rangkaian pembelajaran, studi kasus, dan evaluasi kompetensi pada program pelatihan:
                                </div>
                                <div class="course-title">{{ $data['course_title'] }}</div>

                                <table class="footer-table">
                                    <tr>
                                        <td class="qr-box">
                                            {{-- <img src="{{ $qr_code_url ?? 'https://barcodesindonesia.com/wp-content/uploads/sites/122/2013/11/V-Card.jpg' }}" alt="QR Verifikasi" width="65" height="65"> --}}
                                            @php
                                            $targetUrl = !empty($data['qr_code_url'])
                                            ? $data['qr_code_url']
                                            : 'https://th.bing.com/th/id/OIP.fTKvVXMUIrbyTUACXAFeCwD6D6?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3';

                                            // Tambahkan User-Agent agar tidak diblokir oleh CDN Bing
                                            $context = stream_context_create([
                                            'http' => [
                                            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
                                            ],
                                            'ssl' => [
                                            'verify_peer' => false,
                                            'verify_peer_name' => false,
                                            ]
                                            ]);

                                            $imageData = @file_get_contents($targetUrl, false, $context);
                                            $qrBase64 = $imageData ? 'data:image;base64,' . base64_encode($imageData) : '';
                                            @endphp

                                            @if($qrBase64)
                                            <img src="{{ $qrBase64 }}" alt="QR Verifikasi" width="65" height="65">
                                            @else
                                            <div style="width: 65px; height: 65px; border: 1px solid #cbd5e1; font-size: 7pt; text-align: center; line-height: 65px;">
                                                QR Error
                                            </div>
                                            @endif
                                            <div class="qr-caption">Pindai untuk verifikasi keaslian dokumen</div>
                                        </td>
                                        <td style="width: 34%; font-size: 9pt; color: #475569;">
                                            Diterbitkan pada:<br>
                                            <strong style="color: #0f172a;">{{ $data['completion_date'] }}</strong>
                                        </td>
                                        <td class="signature-box">
                                            <div class="signature-space"></div>
                                            @php
                                                // Ambil nama file bersihnya saja agar aman untuk Skenario A maupun B
                                                $filename = basename($data['signer_url'] ?? '');

                                                // Cek jalur via public/storage terlebih dahulu, lalu fallback ke storage/app/public
                                                $ttdPath = public_path('storage/signature/' . $filename);
                                                if (!file_exists($ttdPath)) {
                                                    $ttdPath = storage_path('app/public/signature/' . $filename);
                                                }

                                                $ttdBase64 = '';
                                                if ($filename && file_exists($ttdPath)) {
                                                    $ext = pathinfo($ttdPath, PATHINFO_EXTENSION);
                                                    $ttdBase64 = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($ttdPath));
                                                }
                                            @endphp

                                            @if($ttdBase64)
                                                <img src="{{ $ttdBase64 }}" alt="TTD Pengesahan" width="100">
                                            @else
                                                <span style="color: red; font-size: 8pt;">TTD</span>
                                            @endif
                                            <div class="signer-name">{{ $data['signer_name'] }}</div>
                                            <div class="signer-title">{{ $data['signer_title'] }}</div>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>


    <!-- HALAMAN 2: DETAIL MATERI / TRANSKRIP KOMPETENSI -->
    <div class="page-wrapper">
        <table class="transcript-outer-table">
            <tr>
                <td class="transcript-content-td">

                    <!-- Wrapper Vertical Space-Between -->
                    <table class="transcript-layout-wrapper">

                        <!-- BARIS 1: KONTEN ATAS (Judul, Identitas, Tabel Materi) -->
                        <tr>
                            <td class="transcript-top-section">
                                <div class="transcript-header">
                                    <h2 class="transcript-title">Rincian Materi & Evaluasi Kompetensi</h2>
                                </div>

                                <table class="meta-table">
                                    <tr>
                                        <td class="meta-label">Nama Peserta</td>
                                        <td style="width: 38%;">: {{ $data['participant_name'] }}</td>
                                        <td class="meta-label">Nomor Sertifikat</td>
                                        <td>: {{ $data['certificate_number'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">Program Pelatihan</td>
                                        <td>: {{ $data['course_title'] }}</td>
                                        <td class="meta-label">Tanggal Selesai</td>
                                        <td>: {{ $data['completion_date'] }}</td>
                                    </tr>
                                </table>

                                <table class="syllabus-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 6%;">No</th>
                                            <th style="width: 54%;">Modul / Pokok Bahasan Materi</th>
                                            <th class="text-center" style="width: 14%;">Beban Studi</th>
                                            <th class="text-center" style="width: 13%;">Nilai</th>
                                            <th class="text-center" style="width: 13%;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($data['modules'] as $module)
                                        <tr>
                                            {{-- <td class="text-center">{{ $module['no'] }}</td>
                                            <td>{{ $module['title'] }}</td>
                                            <td class="text-center">{{ $module['duration'] }}</td>
                                            <td class="text-center"><strong>{{ $module['score'] }}</strong></td>
                                            <td class="text-center"><span class="badge-pass">{{ $module['status'] }}</span></td> --}}
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td>{{ $module->materi_pelatihan['judul'] }}</td>
                                            <td class="text-center">3</td>
                                            <td class="text-center"><strong>{{ $member['nilai'] }}</strong></td>
                                            <td class="text-center"><span class="badge-pass">{{ $module['status'] }}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <!-- BARIS 2: KONTEN BAWAH (Keterangan & Pengesahan Mentok Bawah) -->
                        <tr>
                            <td class="transcript-bottom-section">
                                <table class="transcript-summary">
                                    <tr>
                                        <td style="width: 65%; vertical-align: bottom; color: #475569; font-size: 8.5pt;">
                                            <strong>Keterangan Penilaian:</strong><br>
                                            Sertifikat ini dinyatakan sah apabila terverifikasi melalui kode QR pada halaman utama.<br>
                                            Total Akumulasi Beban Studi: <strong>{{ $data['total_hours'] }}</strong> | Predikat Akhir: <strong>{{ $data['final_score'] }}</strong>
                                        </td>
                                        <td style="width: 35%; text-align: right; vertical-align: bottom;">
                                            <div style="margin-bottom: 35pt; font-size: 9pt;">Disahkan oleh,</div>
                                            @php
                                                // Ambil nama file bersihnya saja agar aman untuk Skenario A maupun B
                                                $filename = basename($data['signer_url'] ?? '');

                                                // Cek jalur via public/storage terlebih dahulu, lalu fallback ke storage/app/public
                                                $ttdPath = public_path('storage/signature/' . $filename);
                                                if (!file_exists($ttdPath)) {
                                                    $ttdPath = storage_path('app/public/signature/' . $filename);
                                                }

                                                $ttdBase64 = '';
                                                if ($filename && file_exists($ttdPath)) {
                                                    $ext = pathinfo($ttdPath, PATHINFO_EXTENSION);
                                                    $ttdBase64 = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($ttdPath));
                                                }
                                            @endphp

                                            @if($ttdBase64)
                                                <img src="{{ $ttdBase64 }}" alt="TTD Pengesahan" width="100">
                                            @else
                                                <span style="color: red; font-size: 8pt;">File tidak ditemukan di: {{ $ttdPath }}</span>
                                            @endif
                                            <div class="signer-name" style="font-size: 9.5pt;">{{ $data['signer_name'] }}</div>
                                            <div class="signer-title" style="font-size: 8pt;">{{ $data['signer_title'] }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>
        </table>
    </div>

</body>

</html>
