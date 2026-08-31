<x-admin-layout>
    <x-slot:header>Dashboard Admin</x-slot:header>

    <div class="space-y-6">

        <!-- 1. KARTU KPI / RINGKASAN UTAMA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Siswa Aktif -->
            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Siswa</p>
                    <h3 class="text-2xl font-black text-white">{{ $totalStudents }} <span
                            class="text-xs font-normal text-slate-400">Anak</span></h3>
                </div>
                <div
                    class="w-12 h-12 bg-indigo-500/15 border border-indigo-500/30 rounded-xl flex items-center justify-center text-indigo-400 text-lg">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
            </div>

            <!-- Pelatih -->
            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pelatih</p>
                    <h3 class="text-2xl font-black text-white">{{ $totalCoaches }} <span
                            class="text-xs font-normal text-slate-400">Coach</span></h3>
                </div>
                <div
                    class="w-12 h-12 bg-amber-500/15 border border-amber-500/30 rounded-xl flex items-center justify-center text-amber-400 text-lg">
                    <i class="fa-solid fa-futbol"></i>
                </div>
            </div>

            <!-- Saldo Bulan Ini -->
            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Saldo Bulan Ini</p>
                    <h3 class="text-xl font-black text-emerald-400">Rp {{ number_format($netBalance, 0, ',', '.') }}
                    </h3>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-500/15 border border-emerald-500/30 rounded-xl flex items-center justify-center text-emerald-400 text-lg">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>

            <!-- Kehadiran -->
            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Rata-rata Hadir</p>
                    <h3 class="text-2xl font-black text-sky-400">{{ $attendanceRate }}%</h3>
                </div>
                <div
                    class="w-12 h-12 bg-sky-500/15 border border-sky-500/30 rounded-xl flex items-center justify-center text-sky-400 text-lg">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
        </div>

        <!-- 2. SECTION GRAFIK (CHART.JS) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Chart Keuangan -->
            <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-chart-column text-emerald-400"></i> Arus Kas Bulan Ini
                </h3>
                <div class="relative h-64 w-full">
                    <canvas id="cashFlowChart"></canvas>
                </div>
            </div>

            <!-- Chart Absensi -->
            <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-user text-sky-400"></i> Grafik Kehadiran Siswa
                </h3>
                <div class="relative h-64 w-full">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- 3. TABEL AKTIVITAS TERBARU -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Transaksi Terakhir -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden flex flex-col">
                <div class="p-5 border-b border-slate-800 flex justify-between items-center">
                    <h3 class="text-base font-bold text-white">Transaksi Keuangan Terakhir</h3>
                    <a href="{{ route('cash-flow.index') }}" class="text-xs text-emerald-400 hover:underline">Lihat
                        Semua &rarr;</a>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left text-slate-300 text-xs whitespace-nowrap sm:whitespace-normal">
                        <thead
                            class="bg-slate-950/60 text-slate-400 uppercase tracking-wider border-b border-slate-800">
                            <tr>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Nama</th>
                                <th class="py-3 px-4 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse($recentTransactions as $trx)
                                <tr>
                                    <td class="py-3 px-4 font-semibold text-white">
                                        {{ $trx->category }}
                                        <span
                                            class="block text-[10px] {{ $trx->type == 'income' ? 'text-emerald-400' : 'text-red-400' }}">
                                            {{ ucfirst($trx->type) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-slate-400">{{ $trx->name ?? '-' }}</td>
                                    <td
                                        class="py-3 px-4 text-right font-bold {{ $trx->type == 'income' ? 'text-emerald-400' : 'text-red-400' }}">
                                        {{ $trx->type == 'income' ? '+' : '-' }} Rp
                                        {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-slate-500">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Siswa Terbaru -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden flex flex-col">
                <div class="p-5 border-b border-slate-800 flex justify-between items-center">
                    <h3 class="text-base font-bold text-white">Siswa Terbaru Bergabung</h3>
                    <span class="text-xs text-slate-500">Daftar Terbaru</span>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left text-slate-300 text-xs whitespace-nowrap sm:whitespace-normal">
                        <thead
                            class="bg-slate-950/60 text-slate-400 uppercase tracking-wider border-b border-slate-800">
                            <tr>
                                <th class="py-3 px-4">Nama Siswa</th>
                                <th class="py-3 px-4">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse($recentStudents as $student)
                                <tr>
                                    <td class="py-3 px-4 font-semibold text-white flex items-center gap-2">
                                        <span
                                            class="w-7 h-7 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 text-xs"><i
                                                class="fa-solid fa-user"></i></span> {{ $student->name }}
                                    </td>
                                    <td class="py-3 px-4 text-slate-400">
                                        {{ $student->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-6 text-slate-500">Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPT CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Keuangan (Bar)
        const ctxCash = document.getElementById('cashFlowChart').getContext('2d');
        new Chart(ctxCash, {
            type: 'bar',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    label: 'Jumlah (Rp)',
                    data: [{{ $totalIncome }}, {{ $totalExpense }}],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: '#1e293b'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });

        // Chart Absensi (Doughnut)
        const ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctxAttendance, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Izin', 'Alpha / Sakit'],
                datasets: [{
                    data: [80, 12, 8],
                    backgroundColor: ['#38bdf8', '#fbbf24', '#f87171'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94a3b8',
                            boxWidth: 12
                        }
                    }
                }
            }
        });
    </script>
</x-admin-layout>
