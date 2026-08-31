<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duber Futsal Academy - Akademi Futsal Profesional</title>

    <!-- Memuat Tailwind CSS Lokal via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-emerald-500 selection:text-white">

    <!-- NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-slate-950/85 backdrop-blur-md border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="#" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Garuda Futsal"
                        class="w-10 h-10 object-contain rounded-xl">
                    <span class="font-extrabold text-base sm:text-lg tracking-wider text-white">DUBER FUTSAL</span>
                </a>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="#about" class="hover:text-emerald-400 transition">Tentang</a>
                <a href="#achievements" class="hover:text-emerald-400 transition">Prestasi</a>
                <a href="#coaches" class="hover:text-emerald-400 transition">Pelatih</a>
                <a href="#location" class="hover:text-emerald-400 transition">Lokasi</a>
                <a href="#faq" class="hover:text-emerald-400 transition">FAQ</a>
            </nav>
            <div class="flex items-center gap-4">
                <a href="/login"
                    class="text-xs font-medium text-slate-400 hover:text-white transition hidden sm:inline-block">Login
                    Admin</a>
                <a href="https://wa.me/6285934581027?text=Halo%2C%20saya%20tertarik%20mendaftarkan%20anak%20saya%20di%20Duber%20Futsal%20Academy."
                    target="_blank"
                    class="bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-lg shadow-emerald-900/30 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Daftar via WhatsApp
                </a>
            </div>
        </div>
    </header>

    <!-- HEADER / HERO SECTION -->


    <section class="relative pt-36 pb-20 md:pt-48 md:pb-32 overflow-hidden bg-slate-950 text-slate-100" id="about">
        <!-- Efek Glow Background Modern -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-600/10 rounded-full blur-[120px] pointer-events-none -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span
                class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 border border-emerald-500/20 tracking-wide uppercase">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Pendaftaran Siswa Baru Dibuka {{ date('Y') }}
            </span>
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight text-white mb-6 leading-tight">
                Wujudkan Impian Anak Jadi Bintang Lapangan Bersama <span class="text-emerald-500">Duber Futsal
                    Academy</span>
            </h1>
            <p class="max-w-2xl mx-auto text-slate-400 text-base sm:text-lg mb-10 leading-relaxed">
                Wadah pembinaan futsal profesional usia dini yang aman, suportif, dan menyenangkan. Dilatih oleh pelatih
                bersertifikat untuk membentuk disiplin, karakter juara, dan skill kelas atas.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/6285934581027?text=Halo%2C%20saya%20ingin%20tanya%20jadwal%20latihan%20dan%20pendaftaran%20futsal%20academy."
                    target="_blank"
                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-8 py-4 rounded-2xl transition shadow-xl shadow-emerald-950/50 text-base flex items-center justify-center gap-2.5 border border-emerald-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 0 1-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Konsultasi Gratis via WhatsApp
                </a>
                <a href="#location"
                    class="bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 font-semibold px-8 py-4 rounded-2xl transition text-base flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg>
                    Cek Lokasi & Jadwal Latihan
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION PRESTASI (ACHIEVEMENTS) -->

    <section id="achievements" class="py-20 bg-slate-950 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span
                    class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-3 border border-emerald-500/20 tracking-wide uppercase">
                    Our Achievements
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Prestasi & Galeri Akademi</h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">Deretan piala, penghargaan, dan momen kejuaraan yang
                    berhasil diraih oleh tim kami.</p>
            </div>

            <!-- CONTAINER SLIDER ACHIEVEMENTS -->
            <div class="relative group">
                <div id="achievementsSlider"
                    class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar pb-6">
                    @forelse($achievements as $index => $item)
                        <div
                            class="flex-shrink-0 w-80 sm:w-96 snap-center bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl hover:border-emerald-500/50 transition-all duration-300 flex flex-col group/card">

                            <!-- 1. SLIDER FOTO DI BAGIAN ATAS -->
                            @if ($item->photos && is_array($item->photos))
                                <div class="h-72 w-full bg-slate-950 overflow-hidden relative group/slider">
                                    <div id="slider-{{ $index }}"
                                        class="flex h-full w-full overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar">
                                        @foreach ($item->photos as $photoIndex => $photo)
                                            <div class="flex-shrink-0 w-full h-full snap-center relative cursor-pointer"
                                                onclick="openLightbox('{{ asset('storage/' . $photo) }}', '{{ $item->title }}')">
                                                <img src="{{ asset('storage/' . $photo) }}" alt="{{ $item->title }}"
                                                    class="w-full h-full object-cover group-hover/card:scale-105 transition duration-500">
                                                <div
                                                    class="absolute inset-0 bg-black/30 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                                                    <span
                                                        class="bg-black/70 text-white text-xs px-3 py-1.5 rounded-full backdrop-blur-md">🔍
                                                        Klik Perbesar</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Tombol Navigasi Mini Khusus Foto dalam 1 Card -->
                                    @if (count($item->photos) > 1)
                                        <button onclick="scrollSlider('slider-{{ $index }}', -1)"
                                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-emerald-600 text-white p-2 rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover/slider:opacity-100 transition duration-300 z-10">
                                            ❮
                                        </button>
                                        <button onclick="scrollSlider('slider-{{ $index }}', 1)"
                                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-slate-900/80 hover:bg-emerald-600 text-white p-2 rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover/slider:opacity-100 transition duration-300 z-10">
                                            ❯
                                        </button>
                                    @endif
                                </div>
                            @else
                                <div
                                    class="h-72 w-full flex items-center justify-center text-5xl bg-slate-950 text-slate-700">
                                    🏆
                                </div>
                            @endif

                            <!-- 2. JUDUL DAN DESKRIPSI DI BAGIAN BAWAH -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white mb-2 group-hover/card:text-emerald-400 transition">
                                        {{ $item->title }}</h3>
                                    @if ($item->description)
                                        <p class="text-slate-400 text-xs sm:text-sm leading-relaxed">
                                            {{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <div
                            class="w-full text-center py-16 text-slate-500 bg-slate-900/50 border border-slate-800 rounded-3xl">
                            <span class="text-4xl block mb-2">🏆</span>
                            <p class="text-sm">Belum ada data prestasi yang ditampilkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Navigasi Utama Slider Card Achievements (Kiri & Kanan) -->
                @if (count($achievements) > 1)
                    <button onclick="scrollSlider('achievementsSlider', -1)"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-slate-900/90 hover:bg-emerald-600 text-white p-3 rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 z-20 border border-slate-800">
                        ❮
                    </button>
                    <button onclick="scrollSlider('achievementsSlider', 1)"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-slate-900/90 hover:bg-emerald-600 text-white p-3 rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 z-20 border border-slate-800">
                        ❯
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- MODAL LIGHTBOX UNTUK FULLSCREEN FOTO -->
    <div id="photoLightbox"
        class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden items-center justify-center p-4">
        <button onclick="closeLightbox()"
            class="absolute top-6 right-6 text-white text-3xl hover:text-emerald-400 transition">&times;</button>
        <div class="max-w-4xl max-h-[90vh] flex flex-col items-center">
            <img id="lightboxImage" src="" alt="Fullscreen Photo"
                class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-slate-800">
            <p id="lightboxTitle" class="text-white text-base font-bold mt-4 text-center"></p>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT UNTUK SLIDER & LIGHTBOX -->
    <script>
        function scrollSlider(sliderId, direction) {
            const slider = document.getElementById(sliderId);
            const scrollAmount = slider.clientWidth * direction;
            slider.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        }

        function openLightbox(imageSrc, title) {
            const lightbox = document.getElementById('photoLightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxTitle = document.getElementById('lightboxTitle');

            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('photoLightbox');
            lightbox.classList.remove('flex');
            lightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('photoLightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    </script>

    <!-- CSS Tambahan -->
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>


    <!-- SECTION PELATIH (COACHES) -->
    <section id="coaches" class="py-20 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <span
                    class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-3 border border-emerald-500/20 tracking-wide uppercase">
                    Professional Staff
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Tim Pelatih Profesional</h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">Dibimbing langsung oleh pelatih berpengalaman yang
                    memiliki lisensi resmi dan keahlian tinggi di bidangnya.</p>
            </div>

            <!-- CONTAINER SLIDER COACHES -->
            <div class="relative group">
                <div id="coachesSlider"
                    class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar pb-6">
                    @forelse($coaches as $coach)
                        <div
                            class="flex-shrink-0 w-80 sm:w-96 snap-center bg-slate-950 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl hover:border-emerald-500/50 transition-all duration-300 flex flex-col group/card">
                            <div class="h-72 w-full bg-slate-900 overflow-hidden relative">
                                @if ($coach->photo)
                                    <img src="{{ Str::startsWith($coach->photo, 'http') ? $coach->photo : asset('storage/' . $coach->photo) }}"
                                        alt="{{ $coach->name }}"
                                        class="w-full h-full object-cover object-center group-hover/card:scale-105 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-5xl bg-slate-950 text-slate-700">
                                        <i class="fa-solid fa-chalkboard-user text-slate-600"></i>
                                    </div>
                                @endif

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60">
                                </div>

                                @if ($coach->profession)
                                    <div class="absolute bottom-4 left-4 right-4 z-10">
                                        <span
                                            class="inline-flex items-center gap-2 bg-slate-900/90 backdrop-blur-md text-emerald-400 text-xs font-semibold px-3 py-1 rounded-lg border border-slate-700/80 shadow-md">
                                            <i class="fa-solid fa-briefcase text-[10px]"></i> {{ $coach->profession }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <h3
                                        class="text-xl font-bold text-white mb-3 group-hover/card:text-emerald-400 transition">
                                        {{ $coach->name }}</h3>

                                    <div
                                        class="space-y-2.5 text-xs text-slate-300 bg-slate-900/80 p-4 rounded-2xl border border-slate-800">
                                        @if ($coach->license)
                                            <div class="flex items-start gap-2.5 pb-2.5 border-b border-slate-800/80">
                                                <span class="text-emerald-400 mt-0.5 shrink-0"><i
                                                        class="fa-solid fa-award"></i></span>
                                                <div>
                                                    <span
                                                        class="font-bold text-slate-400 block text-[10px] uppercase tracking-wider">Lisensi
                                                        Resmi</span>
                                                    <span
                                                        class="text-emerald-400 font-bold leading-relaxed">{{ $coach->license }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="flex items-start gap-2.5">
                                            <span class="text-slate-400 mt-0.5 shrink-0"><i
                                                    class="fa-solid fa-graduation-cap"></i></span>
                                            <div>
                                                <span
                                                    class="font-bold text-slate-400 block text-[10px] uppercase tracking-wider">Pendidikan</span>
                                                <span
                                                    class="text-slate-200 font-medium leading-relaxed">{{ $coach->education ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-2.5 pt-2.5 border-t border-slate-800/80">
                                            <span class="text-slate-400 mt-0.5 shrink-0"><i
                                                    class="fa-solid fa-clock-rotate-left"></i></span>
                                            <div>
                                                <span
                                                    class="font-bold text-slate-400 block text-[10px] uppercase tracking-wider">Pengalaman</span>
                                                <span
                                                    class="text-slate-300 leading-relaxed">{{ $coach->experience ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="w-full text-center py-16 text-slate-500 bg-slate-950/50 border border-slate-800 rounded-3xl">
                            <i class="fa-regular fa-folder-open text-4xl mb-3 block text-slate-600"></i>
                            <p class="text-sm">Belum ada data pelatih yang tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Navigasi Kiri & Kanan (Hanya muncul jika ada pelatih) -->
                @if (count($coaches) > 1)
                    <button onclick="scrollSlider('coachesSlider', -1)"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-slate-900/90 hover:bg-emerald-600 text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 z-20 border border-slate-800">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button onclick="scrollSlider('coachesSlider', 1)"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-slate-900/90 hover:bg-emerald-600 text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg backdrop-blur-md opacity-0 group-hover:opacity-100 transition duration-300 z-20 border border-slate-800">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION SPONSOR / MITRA -->
    @if (isset($sponsors) && $sponsors->count() > 0)
        <section class="py-12 bg-slate-900 border-t border-slate-800 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
                <p class="text-xs uppercase tracking-widest text-slate-400 font-semibold">Didukung Oleh & Mitra Resmi
                </p>
            </div>

            <div class="relative w-full overflow-hidden">
                <div id="sponsorSlider" class="flex gap-6 items-center py-2 w-max mx-auto">
                    @foreach ($sponsors as $sponsor)
                        <div
                            class="flex-shrink-0 w-52 bg-slate-950/60 border border-slate-800/80 rounded-2xl flex flex-col items-center justify-center p-4 shadow-lg hover:border-emerald-500/50 transition">
                            <div class="h-12 flex items-center justify-center mb-2">
                                <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                    class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                            </div>
                            <div class="text-center w-full">
                                <p class="text-xs font-bold text-white truncate">{{ $sponsor->name }}</p>
                                @if ($sponsor->owner_name)
                                    <p class="text-[10px] text-slate-400 truncate">Owner: {{ $sponsor->owner_name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if ($sponsors->count() > 1)
                        @foreach ($sponsors as $sponsor)
                            <div
                                class="flex-shrink-0 w-52 bg-slate-950/60 border border-slate-800/80 rounded-2xl flex flex-col items-center justify-center p-4 shadow-lg hover:border-emerald-500/50 transition">
                                <div class="h-12 flex items-center justify-center mb-2">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                        class="max-h-full max-w-full object-contain filter grayscale hover:grayscale-0 transition duration-300">
                                </div>
                                <div class="text-center w-full">
                                    <p class="text-xs font-bold text-white truncate">{{ $sponsor->name }}</p>
                                    @if ($sponsor->owner_name)
                                        <p class="text-[10px] text-slate-400 truncate">Owner:
                                            {{ $sponsor->owner_name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const slider = document.getElementById('sponsorSlider');
                let scrollSpeed = 1;

                @if ($sponsors->count() > 1)
                    function autoScroll() {
                        if (slider) {
                            slider.scrollLeft += scrollSpeed;
                            if (slider.scrollLeft >= (slider.scrollWidth / 2)) {
                                slider.scrollLeft = 0;
                            }
                        }
                    }

                    let scrollInterval = setInterval(autoScroll, 30);

                    slider.addEventListener('mouseenter', () => clearInterval(scrollInterval));
                    slider.addEventListener('mouseleave', () => scrollInterval = setInterval(autoScroll, 30));
                @endif
            });
        </script>
    @endif

    <!-- SECTION LOKASI (GOOGLE MAPS) -->
    <section id="location" class="py-20 border-t border-slate-900 bg-slate-900/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-16">
                <h2 class="text-xs font-bold text-emerald-400 tracking-widest uppercase mb-3">Our Basecamp</h2>
                <p class="text-3xl font-extrabold text-white">Lokasi Lapangan Latihan</p>
            </div>
            <div class="max-w-4xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                <div
                    class="p-6 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="font-bold text-lg text-white">Duber Fustal Academy</h3>
                        <p class="text-slate-400 text-sm">Jalan Raya, Talagasari, Kec. Kadungora, Kabupaten Garut, Jawa
                            Barat 44153</p>
                    </div>
                    <a href="https://maps.google.com" target="_blank"
                        class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition border border-slate-700 flex items-center gap-1.5">
                        Buka di Google Maps
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
                <div class="w-full h-80 bg-slate-950">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1979.6324946276789!2d107.89654293103388!3d-7.0952530514730014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b7d16da8c207%3A0x212c25f1b667f4c0!2sRumah%20Makan%20Saung%20Wihoga!5e0!3m2!1sid!2sid!4v1787237976067!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION FAQ INTERAKTIF (PALING BAWAH SEBELUM FOOTER) -->

    <section id="faq" class="py-20 bg-slate-950 border-t border-slate-800">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span
                    class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-4 py-1.5 rounded-full mb-3 border border-emerald-500/20 tracking-wide uppercase">
                    Bantuan & Informasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Pertanyaan yang Sering Diajukan
                    (FAQ)</h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">Klik salah satu pertanyaan di bawah untuk melihat
                    jawabannya.</p>
            </div>

            <div class="space-y-4">

                <!-- FAQ Item 6 (Keunggulan Resmi Afkab Garut & Sistem Digital) -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-6')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Kenapa harus memilih dan bergabung di Dubér
                            Futsal?
                        </span>
                        <svg id="icon-faq-6" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-6"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4">
                        Dubér Futsal merupakan pilihan terbaik karena telah resmi terdaftar sebagai klub di <strong
                            class="text-white">Afkab Garut</strong>, sehingga legalitas, pembinaan, serta jalur
                        kompetisi resminya terjamin. Selain itu, latihan di sini didukung penuh oleh sistem digital
                        modern berbasis grafik performa dan evaluasi per aspek (seperti pemantauan tren skor per
                        periode), memastikan perkembangan teknik maupun fisik pemain terpantau secara objektif,
                        transparan, dan terukur.
                    </div>
                </div>
                <!-- FAQ Item 1 -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-1')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Bagaimana cara mendaftarkan anak saya di Duber
                            Futsal Academy?
                        </span>
                        <svg id="icon-faq-1" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-1"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4">
                        Sangat mudah! Anda bisa langsung mengklik tombol <strong class="text-white">"Daftar via
                            WhatsApp"</strong> di bagian atas halaman ini untuk terhubung langsung dengan admin kami
                        guna mendapatkan info formulir dan jadwal.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-2')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Berapa batasan usia anak yang bisa bergabung dalam
                            pelatihan?
                        </span>
                        <svg id="icon-faq-2" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-2"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4">
                        Kami membuka kelas pembinaan usia dini secara terstruktur, mulai dari kelompok usia anak-anak
                        hingga remaja (umumnya 7 hingga 18 tahun) yang ingin serius mengasah bakat futsalnya.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-3')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Apakah orang tua dapat memantau absensi dan
                            perkembangan latihan?
                        </span>
                        <svg id="icon-faq-3" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-3"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4">
                        Ya, tentu! Akademi kami menggunakan sistem manajemen digital terpadu di mana pencatatan
                        kehadiran (absensi harian) dan rekam jejak siswa dikelola secara transparan dan profesional oleh
                        tim pelatih.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-4')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Di mana lokasi tempat latihan rutin dilaksanakan?
                        </span>
                        <svg id="icon-faq-4" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-4"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4">
                        Latihan rutin dipusatkan di basecamp kami berlokasi di Talagasari, Kadungora, Kabupaten Garut.
                        Anda dapat melihat petunjuk arah lengkapnya pada bagian peta lokasi di atas.
                    </div>
                </div>

                <!-- FAQ Item 5 (Biaya, Jersey, SPP, dan Iuran) -->
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden transition">
                    <button onclick="toggleFaq('faq-5')"
                        class="w-full text-left p-6 font-bold text-base text-white flex items-center justify-between gap-4 focus:outline-none hover:text-emerald-400 transition">
                        <span class="flex items-center gap-3">
                            <span class="text-emerald-400">Q:</span> Bagaimana rincian biaya pendaftaran, SPP, dan
                            iuran latihan di akademi?
                        </span>
                        <svg id="icon-faq-5" class="w-5 h-5 text-slate-400 transition-transform duration-300 shrink-0"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-5"
                        class="hidden px-6 pb-6 text-slate-400 text-sm leading-relaxed border-t border-slate-800/60 pt-4 space-y-2">
                        <p>Rincian biaya di Duber Futsal Academy sangat terjangkau:</p>
                        <ul class="list-disc pl-5 space-y-1 text-slate-300">
                            <li><strong class="text-white">Biaya Pendaftaran:</strong> Tersedia pilihan pendaftaran
                                resmi (sudah termasuk <span class="text-emerald-400 font-semibold">Free Jersey
                                    Latihan</span> eksklusif).</li>
                            <li><strong class="text-white">SPP Bulanan:</strong> Iuran tetap bulanan untuk mendukung
                                operasional dan fasilitas pembinaan siswa.</li>
                            <li><strong class="text-white">Iuran Per Latihan:</strong> Kontribusi ringan yang
                                dibayarkan setiap kali siswa hadir dalam sesi latihan rutin.</li>
                        </ul>
                        <p class="pt-2">Untuk nominal pastinya, Anda dapat langsung menanyakannya kepada admin kami
                            melalui tombol WhatsApp.</p>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- SCRIPT JAVASCRIPT UNTUK ACCORDION FAQ -->
    <script>
        // function toggleFaq(id) {
        //     const content = document.getElementById(id);
        //     const icon = document.getElementById('icon-' + id);

        //     if (content.classList.contains('hidden')) {
        //         content.classList.remove('hidden');
        //         icon.textContent = '－';
        //         icon.style.transform = 'rotate(180deg)';
        //     } else {
        //         content.classList.add('hidden');
        //         icon.textContent = '＋';
        //         icon.style.transform = 'rotate(0deg)';
        //     }
        // }
        function toggleFaq(id) {
            const content = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            // Membuka atau menutup konten FAQ
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                if (icon) icon.style.transform = 'rotate(180deg)'; // Panah berputar ke atas
            } else {
                content.classList.add('hidden');
                if (icon) icon.style.transform = 'rotate(0deg)'; // Panah kembali ke posisi semula
            }
        }
    </script>

    <!-- FOOTER -->
    <footer class="border-t border-slate-900 py-12 text-center text-sm text-slate-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="mb-2 font-bold text-slate-300">DUBER FUTSAL ACADEMY</p>
            <p>&copy; {{ date('Y') }} Seluruh Hak Cipta Dilindungi. Dibangun untuk kemajuan prestasi anak bangsa.
            </p>
        </div>
    </footer>

</body>
<script>
    // Fungsi untuk menggeser slider ke kiri atau ke kanan
    function scrollSlider(sliderId, direction) {
        const slider = document.getElementById(sliderId);
        if (!slider) return;

        // Mengambil lebar elemen untuk digeser sejauh satu card penuh
        const scrollAmount = slider.clientWidth;
        slider.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

    // Fungsi Lightbox sederhana untuk memperbesar foto
    function openLightbox(imageSrc, imageTitle) {
        // Cek apakah modal lightbox sudah ada di DOM, jika belum buat secara dinamis
        let lightbox = document.getElementById('custom-lightbox');
        if (!lightbox) {
            lightbox = document.createElement('div');
            lightbox.id = 'custom-lightbox';
            lightbox.className =
                'fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300';
            lightbox.innerHTML = `
            <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center">
                <button onclick="closeLightbox()" class="absolute -top-10 right-0 text-white text-xl font-bold bg-slate-800/80 hover:bg-emerald-600 px-3 py-1 rounded-full transition">✕ Tutup</button>
                <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-2xl border border-slate-800 shadow-2xl mb-3">
                <p id="lightbox-title" class="text-white text-center font-medium text-sm sm:text-base"></p>
            </div>
        `;
            // Klik di luar gambar untuk menutup lightbox
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });
            document.body.appendChild(lightbox);
        }

        // Set isi gambar dan judul
        document.getElementById('lightbox-img').src = imageSrc;
        document.getElementById('lightbox-title').innerText = imageTitle;

        // Tampilkan lightbox
        lightbox.classList.remove('opacity-0', 'pointer-events-none');
    }

    // Fungsi untuk menutup lightbox
    function closeLightbox() {
        const lightbox = document.getElementById('custom-lightbox');
        if (lightbox) {
            lightbox.classList.add('opacity-0', 'pointer-events-none');
        }
    }
</script>

</html>
