<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Tambah User Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-slate-900 p-6 rounded-lg border border-slate-800">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 text-white">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="name"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Role</label>
                    <select name="role" class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2">
                        <option value="student">Siswa</option>
                        <option value="coach">Pelatih</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full bg-slate-950 border border-slate-800 rounded-lg p-2" required>
                </div>
                <button type="submit" class="w-full bg-emerald-600 py-2 rounded-lg font-bold">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>
