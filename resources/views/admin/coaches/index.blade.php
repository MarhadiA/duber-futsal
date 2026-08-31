<x-admin-layout>
    <x-slot:header>Kelola Data Pelatih</x-slot:header>

    <!-- Header & Search -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-slate-400 text-sm">Daftar seluruh pelatih akademi yang aktif.</p>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('coaches.index') }}" method="GET" class="flex-1 sm:flex-none">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/profesi..."
                    class="bg-slate-900 border border-slate-700 text-white text-sm rounded-xl px-4 py-2.5 w-full sm:w-64 focus:ring-2 focus:ring-emerald-500 outline-none">
            </form>

            <a href="{{ route('coaches.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition flex items-center gap-2 text-sm whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Pelatih</span>
            </a>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-slate-300 text-sm">
                <thead
                    class="bg-slate-950/60 text-slate-400 uppercase text-xs tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-4 px-6 w-16 text-center">No</th>
                        <th class="py-4 px-6">Pelatih</th>
                        <th class="py-4 px-6">Kontak</th>
                        <th class="py-4 px-6">Profesi & Lisensi</th>
                        <th class="py-4 px-6">Pendidikan & Pengalaman</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse ($coaches as $index => $coach)
                        <tr class="hover:bg-slate-800/40 transition">
                            <!-- Nomor Urut Otomatis -->
                            <td class="py-4 px-6 text-center text-slate-500">
                                {{ $coaches->firstItem() + $index }}
                            </td>

                            <!-- Kolom Foto & Nama -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-slate-800 overflow-hidden shrink-0 border border-slate-700 flex items-center justify-center">
                                        @if ($coach->photo)
                                            <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <p class="font-bold text-white">{{ $coach->name }}</p>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-xs">
                                <div class="flex items-center gap-1.5 text-slate-300">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <span>{{ $coach->phone ?? '-' }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <p class="font-medium text-white mb-1">{{ $coach->profession ?? '-' }}</p>
                                @if ($coach->license)
                                    <span
                                        class="inline-flex items-center gap-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold px-2.5 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                            </path>
                                        </svg>
                                        <span>{{ $coach->license }}</span>
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center gap-1.5 text-xs text-slate-200 mb-1">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                        </path>
                                    </svg>
                                    <span>{{ $coach->education ?? '-' }}</span>
                                </div>
                                <div class="flex items-start gap-1.5 text-xs text-slate-400 max-w-xs">
                                    <svg class="w-4 h-4 text-slate-500 shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="line-clamp-2">{{ $coach->experience ?? '-' }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('coaches.edit', $coach->id) }}"
                                        class="bg-amber-500/10 hover:bg-amber-500 hover:text-white text-amber-400 border border-amber-500/20 p-2.5 rounded-xl transition"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('coaches.destroy', $coach->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500/10 hover:bg-red-600 hover:text-white text-red-400 border border-red-500/20 p-2.5 rounded-xl transition"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-slate-500">Data tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="px-6 py-4 border-t border-slate-800">
            {{ $coaches->links() }}
        </div>
    </div>
</x-admin-layout>
