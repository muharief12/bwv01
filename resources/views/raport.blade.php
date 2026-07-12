<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Pelatihan Kursus</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000000;
            /* background-color: #727272; */
        }

        /* --- Page Wrapper (Mengisi Seluruh Halaman Dalam Margin) --- */
        .page-container {
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 0mm 0mm;
            position: relative;
        }

        /* --- Header / Judul Dokumen --- */
        .header-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        /* --- Section Informasi Peserta (2 Kolom Menggunakan Tabel) --- */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .info-table td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 11pt;
        }

        .info-table td.label {
            width: 14%;
        }

        .info-table td.colon {
            width: 2%;
            text-align: center;
        }

        .info-table td.value {
            width: 34%;
        }

        /* --- Teks Pengantar Nilai --- */
        .narration-block {
            text-align: center;
            margin-bottom: 25px;
            padding: 0 10px;
        }

        .score-display {
            font-size: 14pt;
            font-weight: bold;
            margin: 8px 0;
        }

        /* --- Tabel Rincian Materi --- */
        .materi-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 35px;
        }

        /* Membuat sudut melengkung pada tabel luar (jika didukung pdf engine) */
        .materi-table th,
        .materi-table td {
            border: 1px solid #b0b0b0;
            padding: 12px 15px;
            font-size: 9pt;
        }

        .materi-table th {
            font-weight: bold;
            text-align: center;
            background-color: #ffffff;
        }

        .materi-table td.center-align {
            text-align: center;
            width: 15%;
        }

        .materi-table td.left-align {
            text-align: left;
        }

        /* --- Blok Tanda Tangan --- */
        .signature-block {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-container {
            width: 45%;
            margin-left: auto;
            /* Menggeser blok ke sisi kanan halaman */
            text-align: left;
        }

        .signature-space {
            height: 50px;
            /* Ruang untuk tanda tangan fisik/digital */
        }

        .signature-name {
            font-weight: normal;
            border-top: 1px dashed transparent;
            /* Bisa diganti solid jika ingin garis bawah */
            padding-top: 2px;
        }
    </style>
</head>

<body>

    <div class="page-container">

        <div class="header-title">
            Laporan Hasil Pelatihan
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td class="value">{{ $record->user?->name ?? 'User Tidak Ditemukan' }}</td>
                <td class="label">Alamat</td>
                <td class="colon">:</td>
                <td class="value">{{ $record->user->alamat}}</td>
            </tr>
            <tr>
                <td class="label">Program</td>
                <td class="colon">:</td>
                <td class="value">{{ $record->jenis_peserta === "reg" ? 'Reguler' : 'BLK'}}</td>
                <td class="label">No. HP</td>
                <td class="colon">:</td>
                <td class="value">{{ $record->user->no_hp}}</td>
            </tr>
        </table>

        <div class="narration-block">
            telah menyelesaikan pelatihan dan memperoleh nilai akhir :
            <div class="score-display">{{ number_format($record->nilai )}} / 100</div>
            yang diselenggarakan oleh GARASI Barbershop,<br>
            dengan rincian materi pelatihan sebagai berikut :
        </div>

        <table class="materi-table">
            <thead>
                <tr>
                    <th style="width: 15%;">No</th>
                    <th>Materi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @for ($i = 1; $i < 13; $i++)
                    <tr>
                    <td class="center-align">{{ $i }}</td>
                    <td class="left-align"> Materi {{ $i }}</td>
                    </tr>
                    @endfor
                    <!-- @forelse ($record->aktivitas_pesertas as $aktivitas)
                    <tr>
                        <td class="center-align">{{ $i++ }}</td>
                        <td class="left-align">{{ $aktivitas->materi_pelatihan->judul }}</td>
                    </tr>
                    @empty
                    <tr colspan="2">
                        <center>
                            <p>Data tidak ditemukan</p>
                        </center>
                    </tr>
                    @endforelse -->
                    <!-- <tr>
                    <td class="center-align">...</td>
                    <td class="left-align">Lorem dolar ipsum color</td>
                </tr>
                <tr>
                    <td class="center-align">n</td>
                    <td class="left-align">Lorem dolar ipsum color</td>
                </tr> -->
            </tbody>
        </table>

        <div class="signature-block">
            <div class="signature-container">
                <div>{{ $raportSetting->lokasi}}, {{ Carbon\Carbon::parse(now())->translatedFormat('d F Y')}}</div>
                <!-- <div class="signature-space"></div> -->
                <div style="margin-top: 10%;">
                    @if (Storage::url($raportSetting->ttd))
                    <img src="{{ public_path(Storage::url($raportSetting->ttd)) }}" style="width: 40%;">
                    @else
                    <p>ttd</p>
                    @endif
                </div>
                <div class="signature-name">{{ $raportSetting->nama_pj}}</div>
            </div>
        </div>

    </div>

</body>

</html>