<x-admin-layout>
    <x-slot:header>Riwayat Absensi: {{ $coach->name }}</x-slot:header>

    <div class="space-y-6">
        <!-- Filter Bulan & Tombol Kembali -->
        <div
            class="bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
            <form method="GET" action="{{ route('coach-attendances.show', $coach->id) }}"
                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <label class="text-sm text-slate-400">Pilih Bulan:</label>
                <input type="month" name="month" value="{{ $month }}"
                    class="bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500 w-full sm:w-auto">
                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition text-center">Filter</button>
            </form>

            <a href="{{ route('coach-attendances.index') }}"
                class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-5 py-2.5 rounded-xl text-sm font-semibold transition text-center">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Kartu Statistik Singkat -->
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl text-center">
                <p class="text-xs text-slate-400 uppercase font-semibold">Hadir</p>
                <p class="text-2xl font-bold text-emerald-400 mt-1">{{ $stats['Hadir'] }} Sesi</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl text-center">
                <p class="text-xs text-slate-400 uppercase font-semibold">Izin</p>
                <p class="text-2xl font-bold text-amber-400 mt-1">{{ $stats['Izin'] }} Sesi</p>
            </div>
            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl text-center">
                <p class="text-xs text-slate-400 uppercase font-semibold">Alpha</p>
                <p class="text-2xl font-bold text-rose-400 mt-1">{{ $stats['Alpha'] }} Sesi</p>
            </div>
        </div>

        <!-- Tabel Riwayat Detail -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr
                            class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider bg-slate-950/50">
                            <th class="p-4">Tanggal Sesi</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4">Catatan / Materi Latihan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="p-4 font-medium text-white">
                                    {{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('d F Y') }}</td>
                                <td class="p-4 text-center">
                                    @if ($attendance->status === 'Hadir')
                                        <span
                                            class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full text-xs font-semibold">Hadir</span>
                                    @elseif($attendance->status === 'Izin')
                                        <span
                                            class="bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-semibold">Izin</span>
                                    @else
                                        <span
                                            class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-1 rounded-full text-xs font-semibold">Alpha</span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-300">{{ $attendance->notes ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-6 text-center text-slate-500">Belum ada riwayat absensi pada
                                    bulan ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
