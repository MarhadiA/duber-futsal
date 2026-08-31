<x-admin-layout>
    <x-slot name="header">
        Absensi Siswa
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('attendances.index') }}"
            class="inline-flex items-center text-slate-400 hover:text-white transition text-sm font-medium">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali ke Rekap Absensi
        </a>
    </div>

    <div class="space-y-6 px-2 sm:px-0">
        <!-- Form Filter Tanggal & Pencarian Siswa -->
        <div class="bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-800 shadow-xl">
            <form method="GET" action="{{ route('attendances.create') }}"
                class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">

                <!-- Pilihan Tanggal Latihan -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                    <label class="text-sm font-medium text-slate-300 whitespace-nowrap">Tanggal Latihan:</label>
                    <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()"
                        class="bg-slate-950 border border-slate-800 text-white text-sm rounded-xl p-2.5 focus:ring-emerald-500 focus:border-emerald-500 w-full">
                </div>

                <!-- Form Pencarian Nama Siswa -->
                <div class="flex items-center gap-2 w-full lg:max-w-md">
                    <!-- Bawa parameter tanggal agar tetap ikut saat mencari -->
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="relative w-full">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama siswa..."
                            class="w-full bg-slate-950 border border-slate-800 text-white placeholder-slate-500 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500 transition">
                    </div>

                    <button type="submit"
                        class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2.5 rounded-xl text-sm font-medium border border-slate-700 shrink-0 transition flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i> Cari
                    </button>

                    @if (request('search'))
                        <a href="{{ route('attendances.create', ['date' => $date]) }}"
                            class="bg-slate-950 hover:bg-slate-800 text-slate-400 hover:text-white px-3 py-2.5 rounded-xl text-sm border border-slate-800 shrink-0 flex items-center justify-center transition">
                            <i class="fa-solid fa-rotate-right text-xs"></i>
                        </a>
                    @endif
                </div>
            </form>

            <div
                class="mt-4 pt-3 border-t border-slate-800/80 text-xs text-slate-400 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <span>Menampilkan seluruh siswa aktif untuk tanggal: <span
                        class="text-emerald-400 font-bold">{{ $date }}</span></span>
                @if (request('search'))
                    <span class="text-slate-300">Hasil pencarian untuk: "<strong
                            class="text-white">{{ request('search') }}</strong>"</span>
                @endif
            </div>
        </div>

        <!-- Form Input Absensi Massal -->
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">

            <!-- Pertahankan parameter query pencarian & halaman saat form disubmit jika diperlukan -->
            @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden shadow-xl">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left text-white border-collapse min-w-[700px]">
                        <thead
                            class="bg-slate-950/50 text-slate-400 text-xs uppercase border-b border-slate-800 tracking-wider">
                            <tr>
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Nama Siswa</th>
                                <th class="p-4">Status Kehadiran</th>
                                <th class="p-4">Pencatat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-sm">
                            @forelse($students as $index => $student)
                                @php
                                    $attendance = $attendances[$student->id] ?? null;
                                    $currentStatus = $attendance ? $attendance->status : 'present';
                                    $recordedBy = $attendance ? $attendance->recorded_by : '-';
                                @endphp
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="p-4 text-slate-400 text-center font-medium">
                                        {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="p-4 font-semibold">
                                        {{ $student->name }}
                                        <input type="hidden" name="attendances[{{ $student->id }}][student_id]"
                                            value="{{ $student->id }}">
                                    </td>
                                    <td class="p-4">
                                        <select name="attendances[{{ $student->id }}][status]"
                                            class="bg-slate-950 border border-slate-800 rounded-xl p-2.5 text-xs sm:text-sm text-white focus:ring-emerald-500 focus:border-emerald-500 transition w-full sm:w-auto">
                                            <option value="present"
                                                {{ $currentStatus == 'present' ? 'selected' : '' }}>Hadir (Present)
                                            </option>
                                            <option value="permission"
                                                {{ $currentStatus == 'permission' ? 'selected' : '' }}>Izin
                                                (Permission)
                                            </option>
                                            <option value="sick" {{ $currentStatus == 'sick' ? 'selected' : '' }}>
                                                Sakit (Sick)
                                            </option>
                                            <option value="alpha" {{ $currentStatus == 'alpha' ? 'selected' : '' }}>
                                                Alpha
                                            </option>
                                        </select>
                                    </td>
                                    <td class="p-4 text-xs text-slate-400">
                                        {{ $recordedBy }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-slate-500">
                                        <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                        Tidak ada data siswa aktif yang cocok dengan pencarian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi & Tombol Simpan -->
                <div
                    class="px-6 py-4 bg-slate-950/50 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-400 w-full sm:w-auto text-center sm:text-left">
                        @if ($students->total() > 0)
                            Menampilkan
                            <span class="font-semibold text-white">{{ $students->firstItem() }}</span> sampai
                            <span class="font-semibold text-white">{{ $students->lastItem() }}</span> dari
                            <span class="font-semibold text-white">{{ $students->total() }}</span> data siswa
                        @endif
                    </div>

                    <div class="w-full sm:w-auto flex flex-col sm:flex-row items-center justify-end gap-4">
                        @if ($students->hasPages())
                            <div class="w-full sm:w-auto overflow-x-auto">
                                {{ $students->appends(request()->query())->links() }}
                            </div>
                        @endif

                        @if ($students->isNotEmpty())
                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-lg shadow-emerald-950 flex items-center justify-center gap-2 whitespace-nowrap w-full sm:w-auto">
                                <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Absensi
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
