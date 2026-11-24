<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat - {{ $certificate_number }}</title>
    <!-- Menggunakan Tailwind CSS CDN agar tampilan langsung rapi tanpa kompilasi ulang -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col justify-between p-4">

    <main class="my-auto mx-auto w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">

            <!-- Header Status Keaslian -->
            <div class="{{ $member->progress === 100 ? 'bg-emerald-600' : 'bg-rose-600'}} px-6 py-7 text-center text-white relative">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 ring-4 ring-white/10">
                    <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="inline-block px-3 py-1 bg-emerald-800/60 text-emerald-100 text-xs font-semibold tracking-wider uppercase rounded-full mb-2">
                    Sistem Verifikasi Dokumen Resmi
                </span>
                <h1 class="text-xl font-bold tracking-wide uppercase">{{ $status }}</h1>
                <p class="text-emerald-100 text-xs mt-1">
                    {{ $member->progress < 100 ? 'Maaf, Peserta belum menyelesaikan pelatihan': 'Sertifikat ini terdaftar sah dalam basis data Lembaga Kami.'}}
                </p>
            </div>

            <!-- Nomor Seri Sertifikat -->
            <div class="px-6 pt-6">
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-center">
                    <span class="text-[11px] font-semibold uppercase tracking-widest text-slate-400 block mb-1">
                        Nomor Registrasi Sertifikat
                    </span>
                    <span class="font-mono text-base sm:text-lg font-bold text-blue-900 select-all">
                        {{ $certificate_number }}
                    </span>
                </div>
            </div>

            <!-- Rincian Data Pemilik & Pelatihan -->
            <div class="p-6 space-y-4">
                <div class="border-b border-slate-100 pb-3">
                    <span class="text-xs text-slate-400 block">Diberikan Kepada</span>
                    <span class="text-base font-bold text-slate-900">{{ $participant_name }}</span>
                </div>

                <div class="border-b border-slate-100 pb-3">
                    <span class="text-xs text-slate-400 block">Program Pelatihan / Kompetensi</span>
                    <span class="text-sm font-semibold text-slate-800 leading-snug block mt-0.5">
                        {{ $course_title }}
                    </span>
                </div>

                <div class="flex justify-between items-center pt-1">
                    <div>
                        <span class="text-xs text-slate-400 block">Tanggal Penyelesaian</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $completion_date }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-slate-400 block">Status Dokumen</span>
                        @if ($member->progress === 100)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                            ● Aktif & Sah
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
                            ● Tidak Aktif
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer Card -->
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between text-xs text-slate-500">
                <span>Diverifikasi pada: {{ now()->locale('id')->translatedFormat('d M Y, H:i') }} WIB</span>
                <button onclick="window.print()" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center gap-1 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Bukti
                </button>
            </div>

        </div>
    </main>

    <footer class="text-center text-xs text-slate-400 mt-6">
        &copy; {{ date('Y') }} Lembaga Pelatihan dan Kursus Garasi Barbershop
    </footer>

</body>
</html>
