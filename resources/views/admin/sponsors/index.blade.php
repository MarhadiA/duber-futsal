<x-admin-layout>
    <x-slot:header>Kelola Data Sponsor</x-slot:header>

    <div class="space-y-6 px-2 sm:px-0">
        <!-- Bagian Header & Tombol Tambah -->
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl shadow-xl">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-handshake text-emerald-500"></i> Daftar Sponsor & Mitra
                </h2>
                <p class="text-slate-400 text-xs sm:text-sm">Daftar logo sponsor dan mitra akademi.</p>
            </div>
            <a href="{{ route('sponsors.create') }}"
                class="bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-lg shadow-emerald-950 flex items-center justify-center gap-2 whitespace-nowrap w-full sm:w-auto">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Sponsor</span>
            </a>
        </div>

        <!-- Bagian Tabel Responsif -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr
                            class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider bg-slate-950/50">
                            <th class="p-3 sm:p-4 w-28">Logo</th>
                            <th class="p-3 sm:p-4">Nama Sponsor & Owner</th>
                            <th class="p-3 sm:p-4 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80 text-sm text-white">
                        @forelse($sponsors as $sponsor)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="p-3 sm:p-4">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="Logo Sponsor"
                                        class="w-20 h-12 object-contain bg-slate-950 p-1.5 rounded-lg border border-slate-800">
                                </td>
                                <td class="p-3 sm:p-4">
                                    <div class="font-bold text-white">{{ $sponsor->name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        <i class="fa-regular fa-user text-[10px] text-slate-500 mr-1"></i> Owner:
                                        {{ $sponsor->owner_name ?? '-' }}
                                    </div>
                                </td>
                                <td class="p-3 sm:p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('sponsors.edit', $sponsor->id) }}"
                                            class="bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-white border border-amber-500/20 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition flex items-center gap-1">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i> Edit
                                        </a>

                                        <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus sponsor ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white border border-red-500/20 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition flex items-center gap-1">
                                                <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-12 text-slate-500">
                                    <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                    Belum ada data sponsor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Bagian Paginasi (Jika Menggunakan Paginator) -->
            @if (isset($sponsors) && method_exists($sponsors, 'hasPages') && $sponsors->hasPages())
                <div
                    class="px-6 py-4 bg-slate-950/50 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-400">
                        Menampilkan
                        <span class="font-semibold text-white">{{ $sponsors->firstItem() }}</span> sampai
                        <span class="font-semibold text-white">{{ $sponsors->lastItem() }}</span> dari
                        <span class="font-semibold text-white">{{ $sponsors->total() }}</span> data sponsor
                    </div>
                    <div>
                        {{ $sponsors->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
