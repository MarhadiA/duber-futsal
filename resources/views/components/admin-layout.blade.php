<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Admin' }} - Duber Futsal Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased h-screen overflow-hidden flex">

    <!-- BACKDROP GELAP SAAT SIDEBAR TERBUKA DI HP -->
    <div id="sidebarOverlay" onclick="toggleSidebar()"
        class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm md:hidden hidden"></div>

    <!-- SIDEBAR KIRI -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out md:sticky md:top-0 md:h-screen overflow-y-auto shrink-0 shadow-2xl md:shadow-none">
        <div>
            <!-- Logo / Brand & Tombol Close Mobile -->
            <div
                class="h-20 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-900 sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Garuda Futsal"
                        class="w-10 h-10 object-contain rounded-xl">
                    <div>
                        <span class="font-extrabold text-sm text-white tracking-wider block">DUBER FUTSAL</span>
                        <span class="text-[10px] text-emerald-400 font-semibold uppercase tracking-widest">
                            {{ auth()->check() && auth()->user()->role === 'coach' ? 'Panel Pelatih' : 'Panel Admin' }}
                        </span>
                    </div>
                </div>
                <!-- Tombol Tutup Sidebar khusus HP -->
                <button onclick="toggleSidebar()"
                    class="md:hidden text-slate-400 hover:text-white p-2 rounded-lg bg-slate-800 flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Navigasi Menu -->
            <nav class="p-4 space-y-1.5">
                @php
                    $userRole = auth()->check() ? auth()->user()->role : null;

                    $menus = [
                        // Dashboard Berdasarkan Role
                        $userRole === 'admin'
                            ? [
                                'route' => 'admin.dashboard',
                                'label' => 'Beranda Admin',
                                'icon' => 'fa-solid fa-chart-pie',
                                'actual_route' => 'admin.dashboard',
                            ]
                            : [
                                'route' => 'coach.dashboard',
                                'label' => 'Dashboard Pelatih',
                                'icon' => 'fa-solid fa-futbol',
                                'actual_route' => 'coach.dashboard',
                            ],

                        // Menu Utama yang Bisa Diakses Bersama (Admin & Coach)
                        [
                            'route' => 'students*',
                            'label' => 'Data Siswa',
                            'icon' => 'fa-solid fa-graduation-cap',
                            'actual_route' => 'students.index',
                        ],
                        [
                            'route' => 'attendances*',
                            'label' => 'Rekap & Absensi',
                            'icon' => 'fa-solid fa-clipboard-user',
                            'actual_route' => 'attendances.index',
                        ],
                        [
                            'route' => 'grades*',
                            'label' => 'Rapot Siswa',
                            'icon' => 'fa-solid fa-scroll',
                            'actual_route' => 'grades.index',
                        ],
                    ];

                    // Menu Khusus Pelatih (Data Transaksi Pemasukan & Pengeluaran)
                    if ($userRole === 'coach') {
                        $menus[] = [
                            'route' => 'cash-flow*',
                            'label' => 'Data Transaksi',
                            'icon' => 'fa-solid fa-credit-card',
                            'actual_route' => 'cash-flow.index',
                        ];
                    }

                    // Menu Tambahan Khusus Admin Murni (Termasuk Rekap SPP)
                    if ($userRole === 'admin') {
                        $menus = array_merge($menus, [
                            [
                                'route' => 'spp*',
                                'label' => 'Rekap SPP',
                                'icon' => 'fa-solid fa-money-bill-wave',
                                'actual_route' => 'spp.index',
                            ],
                            [
                                'route' => 'admin.users*',
                                'label' => 'Data User',
                                'icon' => 'fa-solid fa-users',
                                'actual_route' => 'admin.users.index',
                            ],
                            [
                                'route' => 'achievements*',
                                'label' => 'Data Prestasi',
                                'icon' => 'fa-solid fa-trophy',
                                'actual_route' => 'achievements.index',
                            ],
                            [
                                'route' => 'coaches*',
                                'label' => 'Data Pelatih',
                                'icon' => 'fa-solid fa-chalkboard-user',
                                'actual_route' => 'coaches.index',
                            ],
                            [
                                'route' => 'coach-attendances*',
                                'label' => 'Absen Pelatih',
                                'icon' => 'fa-solid fa-clipboard-list',
                                'actual_route' => 'coach-attendances.index',
                            ],
                            [
                                'route' => 'salaries*',
                                'label' => 'Gaji Pelatih',
                                'icon' => 'fa-solid fa-wallet',
                                'actual_route' => 'salaries.index',
                            ],
                            [
                                'route' => 'sponsors*',
                                'label' => 'Data Sponsor',
                                'icon' => 'fa-solid fa-handshake',
                                'actual_route' => 'sponsors.index',
                            ],
                            [
                                'route' => 'cash-flow*',
                                'label' => 'Data Transaksi',
                                'icon' => 'fa-solid fa-credit-card',
                                'actual_route' => 'cash-flow.index',
                            ],
                            [
                                'route' => 'jerseys*',
                                'label' => 'Manajemen Jersey',
                                'icon' => 'fa-solid fa-shirt',
                                'actual_route' => 'jerseys.index',
                            ],
                        ]);
                    }
                @endphp

                @foreach ($menus as $menu)
                    <a href="{{ route($menu['actual_route'] ?? str_replace('*', '.index', $menu['route'])) }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition
            {{ request()->routeIs($menu['route'])
                ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20'
                : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                        <i class="{{ $menu['icon'] }} w-5 text-center text-base"></i>
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Tombol Logout -->
        <div class="p-4 border-t border-slate-800 bg-slate-900 sticky bottom-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 text-xs font-semibold py-3 rounded-xl transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA (Diberikan overflow-y-auto agar bisa di-scroll secara mandiri) -->
    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">
        <header
            class="h-20 bg-slate-950/85 backdrop-blur-md border-b border-slate-800 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shrink-0">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()"
                    class="md:hidden text-slate-300 hover:text-white p-2.5 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-base sm:text-xl font-bold text-white truncate">{{ $header ?? 'Dashboard' }}</h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="/" target="_blank"
                    class="text-xs text-slate-400 hover:text-emerald-400 transition flex items-center gap-1.5 bg-slate-900 border border-slate-800 px-3 py-2 rounded-xl">
                    <i class="fa-solid fa-globe text-emerald-400"></i> <span class="hidden sm:inline">Lihat
                        Website</span>
                </a>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
            @if (session('success'))
                <div id="success-alert"
                    class="mb-6 flex items-center justify-between bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-2xl shadow-lg transition">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('success-alert').remove()"
                        class="text-emerald-400 hover:text-white transition p-1 rounded-lg hover:bg-emerald-500/20 text-sm font-bold px-2.5">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        let alertBox = document.getElementById('success-alert');
                        if (alertBox) {
                            alertBox.style.transition = 'opacity 0.5s ease';
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 500);
                        }
                    }, 5000);
                </script>
            @endif

            {{ $slot }}
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>

</html>
