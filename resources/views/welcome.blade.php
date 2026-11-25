<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di BarberMan Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between antialiased selection:bg-amber-500 selection:text-slate-950">

    <!-- Navbar Responsif -->
    <header class="w-full border-b border-slate-800/80 bg-slate-950/85 backdrop-blur-md sticky top-0 z-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 sm:gap-3">
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 font-extrabold text-base sm:text-lg shadow-md shadow-amber-500/20 shrink-0">
                    B
                </div>
                <span class="font-bold text-base sm:text-lg tracking-tight text-white">
                    BarberMan <span class="text-amber-400">Academy</span>
                </span>
            </div>
            <span class="text-[11px] sm:text-xs font-medium text-slate-400 text-right">
                Portal Akademik &amp; Pelatihan
            </span>
        </div>
    </header>

    <!-- Main Hero Section -->
    <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="max-w-4xl w-full text-center space-y-6 sm:space-y-8">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full bg-slate-900 border border-slate-800 text-slate-300 text-[11px] sm:text-xs font-semibold tracking-wide uppercase">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Sistem Informasi Terpadu
            </div>

            <!-- Header Utama -->
            <div class="space-y-3 sm:space-y-4">
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight px-1">
                    Selamat Datang di <br class="sm:hidden">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-slate-100 to-sky-400">
                        BarberMan Academy
                    </span>
                </h1>
                <p class="text-slate-400 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto leading-relaxed px-2">
                    Silakan pilih portal akses sesuai dengan peran Anda untuk masuk ke ruang pembelajaran maupun pengelolaan pelatihan.
                </p>
            </div>

            <!-- Grid 2 Button Panel Login (1 Kolom di Mobile, 2 Kolom di Tablet/Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 max-w-3xl mx-auto pt-2 sm:pt-4">

                <!-- PANEL 1: MEMBER (PESERTA) - TEMA AMBER -->
                <a href="{{ url('/member/login') }}"
                   class="group relative flex flex-col justify-between p-5 sm:p-7 rounded-2xl bg-slate-900/90 border-2 border-amber-500/30 hover:border-amber-400 hover:bg-slate-900 transition-all duration-200 text-left shadow-lg hover:shadow-amber-500/15 active:scale-[0.99]">

                    <div>
                        <!-- Header Card: Icon + Role Pill -->
                        <div class="flex items-center justify-between gap-3 mb-4 sm:mb-5">
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-amber-500/15 border border-amber-500/30 flex items-center justify-center text-amber-400 group-hover:bg-amber-500 group-hover:text-slate-950 transition-colors shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-amber-500/15 text-amber-300 border border-amber-500/30">
                                Peserta
                            </span>
                        </div>

                        <!-- Judul & Deskripsi -->
                        <h2 class="text-lg sm:text-xl font-bold text-white group-hover:text-amber-400 transition-colors">
                            Member Panel
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">
                            Akses khusus <strong class="text-amber-300 font-semibold">Peserta</strong> untuk mengikuti materi pelatihan, memantau progres belajar, dan mengunduh sertifikat.
                        </p>
                    </div>

                    <!-- CTA Button Visual -->
                    <div class="mt-5 sm:mt-6 pt-3.5 border-t border-slate-800/80 flex items-center justify-between text-xs sm:text-sm font-semibold text-amber-400 group-hover:text-amber-300">
                        <span>Masuk ke Member Panel</span>
                        <span class="w-7 h-7 rounded-lg bg-amber-500/15 group-hover:bg-amber-500 group-hover:text-slate-950 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </div>
                </a>

                <!-- PANEL 2: DASHBOARD (ADMIN & INSTRUKTUR) - TEMA BIRU SKY -->
                <a href="{{ url('/dashboard/login') }}"
                   class="group relative flex flex-col justify-between p-5 sm:p-7 rounded-2xl bg-slate-900/90 border-2 border-sky-500/30 hover:border-sky-400 hover:bg-slate-900 transition-all duration-200 text-left shadow-lg hover:shadow-sky-500/15 active:scale-[0.99]">

                    <div>
                        <!-- Header Card: Icon + Role Pill -->
                        <div class="flex items-center justify-between gap-3 mb-4 sm:mb-5">
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-sky-500/15 border border-sky-500/30 flex items-center justify-center text-sky-400 group-hover:bg-sky-500 group-hover:text-slate-950 transition-colors shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-sky-500/15 text-sky-300 border border-sky-500/30">
                                Admin &amp; Instruktur
                            </span>
                        </div>

                        <!-- Judul & Deskripsi -->
                        <h2 class="text-lg sm:text-xl font-bold text-white group-hover:text-sky-400 transition-colors">
                            Dashboard Panel
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1.5 leading-relaxed">
                            Akses khusus <strong class="text-sky-300 font-semibold">Admin &amp; Instruktur</strong> untuk mengelola kelas, penilaian kompetensi, dan administrasi akademik.
                        </p>
                    </div>

                    <!-- CTA Button Visual -->
                    <div class="mt-5 sm:mt-6 pt-3.5 border-t border-slate-800/80 flex items-center justify-between text-xs sm:text-sm font-semibold text-sky-400 group-hover:text-sky-300">
                        <span>Masuk ke Dashboard Panel</span>
                        <span class="w-7 h-7 rounded-lg bg-sky-500/15 group-hover:bg-sky-500 group-hover:text-slate-950 flex items-center justify-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </div>
                </a>

            </div>

        </div>
    </main>

    <!-- Footer Responsif -->
    <footer class="w-full border-t border-slate-800/80 px-4 py-5 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} BarberMan Academy. Seluruh hak cipta dilindungi.
    </footer>

</body>
</html>
