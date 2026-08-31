<x-admin-layout>
    <x-slot name="header">
        Rekap Absensi Siswa
    </x-slot>

    <div class="space-y-6 px-2 sm:px-0">
        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter, Pencarian & Tombol Aksi -->
        <div class="bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-800 shadow-xl flex flex-col gap-4">
            <form method="GET" action="{{ route('attendances.index') }}"
                class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">

                <!-- Grup Filter Tanggal dan Pencarian -->
                <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full lg:w-auto">
                    <!-- Input Pencarian -->
                    <div class="relative w-full sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama siswa atau orang tua..."
                            class="w-full bg-slate-950 border border-slate-800 text-white placeholder-slate-500 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-emerald-500 transition">
                    </div>

                    <!-- Filter Dari Tanggal -->
                    <div class="flex items-center gap-2 bg-slate-950 border border-slate-800 px-3 py-1.5 rounded-xl">
                        <label class="text-xs text-slate-400 font-medium whitespace-nowrap">Dari:</label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="bg-transparent text-white text-xs sm:text-sm focus:outline-none w-full">
                    </div>

                    <!-- Filter Sampai Tanggal -->
                    <div class="flex items-center gap-2 bg-slate-950 border border-slate-800 px-3 py-1.5 rounded-xl">
                        <label class="text-xs text-slate-400 font-medium whitespace-nowrap">Sampai:</label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="bg-transparent text-white text-xs sm:text-sm focus:outline-none w-full">
                    </div>

                    <!-- Tombol Filter & Reset -->
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-xl text-sm font-bold transition flex-1 sm:flex-none">
                            Filter
                        </button>

                        @if (request('search') || request('start_date') != date('Y-m-01') || request('end_date') != date('Y-m-t'))
                            <a href="{{ route('attendances.index') }}"
                                class="bg-slate-950 hover:bg-slate-800 text-slate-400 hover:text-white px-3 py-2 rounded-xl text-sm border border-slate-800 transition text-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Tombol Input Absensi Harian -->
                <a href="{{ route('attendances.create') }}"
                    class="w-full lg:w-auto text-center bg-slate-800 hover:bg-slate-700 text-emerald-400 border border-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2 shrink-0">
                    <span>➕</span> Input Absensi Harian
                </a>
            </form>
        </div>

        <!-- Tabel Rekap -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden shadow-xl">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left text-white border-collapse min-w-[700px]">
                    <thead
                        class="bg-slate-950/50 text-slate-400 text-xs uppercase border-b border-slate-800 tracking-wider">
                        <tr>
                            <th class="p-3 sm:p-4 w-12">No</th>
                            <th class="p-3 sm:p-4">Nama Siswa</th>
                            <th class="p-3 sm:p-4 text-center">Hadir</th>
                            <th class="p-3 sm:p-4 text-center">Izin</th>
                            <th class="p-3 sm:p-4 text-center">Sakit</th>
                            <th class="p-3 sm:p-4 text-center">Alpha</th>
                            <th class="p-3 sm:p-4 text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse($students as $index => $student)
                            @php
                                $present = $student->attendances->where('status', 'present')->count();
                                $permission = $student->attendances->where('status', 'permission')->count();
                                $sick = $student->attendances->where('status', 'sick')->count();
                                $alpha = $student->attendances->where('status', 'alpha')->count();
                                $total = $present + $permission + $sick + $alpha;
                            @endphp
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="p-3 sm:p-4 text-slate-400">
                                    {{ ($students->currentPage() - 1) * $students->perPage() + $index + 1 }}
                                </td>
                                <td class="p-3 sm:p-4 font-bold">
                                    <a href="{{ route('attendances.show', $student->id) }}"
                                        class="hover:text-emerald-400 transition flex items-center gap-1.5">
                                        {{ $student->name }}
                                        <span class="text-xs text-slate-500 font-normal">&rarr; detail</span>
                                    </a>
                                </td>
                                <td class="p-3 sm:p-4 text-center">
                                    <span
                                        class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-1 rounded-lg font-bold text-xs">{{ $present }}</span>
                                </td>
                                <td class="p-3 sm:p-4 text-center">
                                    <span
                                        class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded-lg font-bold text-xs">{{ $permission }}</span>
                                </td>
                                <td class="p-3 sm:p-4 text-center">
                                    <span
                                        class="bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 px-2.5 py-1 rounded-lg font-bold text-xs">{{ $sick }}</span>
                                </td>
                                <td class="p-3 sm:p-4 text-center">
                                    <span
                                        class="bg-red-500/10 text-red-400 border border-red-500/20 px-2.5 py-1 rounded-lg font-bold text-xs">{{ $alpha }}</span>
                                </td>
                                <td class="p-3 sm:p-4 text-center font-bold text-slate-300">{{ $total }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-500">
                                    Tidak ada data rekap absensi atau siswa aktif yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bagian Pagination -->
            @if ($students->hasPages())
                <div class="p-4 bg-slate-950/50 border-t border-slate-800">
                    {{ $students->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
