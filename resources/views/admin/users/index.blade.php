<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Kelola Pengguna</h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Bagian Tombol Filter & Aksi (Dibuat fleksibel untuk mobile) -->
            <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition border {{ !request('role') ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30' : 'bg-slate-900 text-slate-300 border-slate-800 hover:bg-slate-800' }}">Semua</a>
                    <a href="{{ route('admin.users.index', ['role' => 'admin']) }}"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition border {{ request('role') == 'admin' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30' : 'bg-slate-900 text-slate-300 border-slate-800 hover:bg-slate-800' }}">Admin</a>
                    <a href="{{ route('admin.users.index', ['role' => 'coach']) }}"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition border {{ request('role') == 'coach' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30' : 'bg-slate-900 text-slate-300 border-slate-800 hover:bg-slate-800' }}">Pelatih</a>
                    <a href="{{ route('admin.users.index', ['role' => 'student']) }}"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition border {{ request('role') == 'student' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30' : 'bg-slate-900 text-slate-300 border-slate-800 hover:bg-slate-800' }}">Siswa</a>
                </div>
                <a href="{{ route('admin.users.create') }}"
                    class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-950/50">
                    <i class="fa-solid fa-plus text-xs"></i> Tambah User
                </a>
            </div>

            <!-- Tabel Data Responsif -->
            <div class="bg-slate-900 shadow-xl sm:rounded-2xl border border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table
                        class="w-full text-left text-white text-xs sm:text-sm whitespace-nowrap sm:whitespace-normal">
                        <thead
                            class="bg-slate-950/80 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-800">
                            <tr>
                                <th class="p-4">Nama</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Role</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-800/50 transition">
                                    <td class="p-4 font-semibold text-white">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="w-7 h-7 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 text-xs shrink-0">
                                                <i class="fa-solid fa-user"></i>
                                            </span>
                                            <span class="truncate">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-slate-400">{{ $user->email }}</td>
                                    <td class="p-4 capitalize">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-xs font-semibold
                                            {{ $user->role == 'admin'
                                                ? 'bg-indigo-500/15 text-indigo-400 border border-indigo-500/30'
                                                : ($user->role == 'coach'
                                                    ? 'bg-amber-500/15 text-amber-400 border border-amber-500/30'
                                                    : 'bg-sky-500/15 text-sky-400 border border-sky-500/30') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-white border border-amber-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white border border-red-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8 text-slate-500">Belum ada data pengguna.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
