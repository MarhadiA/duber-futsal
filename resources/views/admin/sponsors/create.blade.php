<x-admin-layout>
    <x-slot:header>Tambah Sponsor</x-slot:header>

    <div class="max-w-xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">
        <form action="{{ route('sponsors.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf
            <div>
                <label class="text-sm font-medium text-slate-400">Nama Sponsor / Perusahaan</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500"
                    required>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Nama Pemilik / Owner (Opsional)</label>
                <input type="text" name="owner_name" value="{{ old('owner_name') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500"
                    placeholder="Contoh: Bpk. Budi Santoso">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Logo Sponsor</label>
                <input type="file" name="logo"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm" required>
            </div>
            <div class="flex gap-3 pt-4">
                <a href="{{ route('sponsors.index') }}"
                    class="bg-slate-800 text-slate-300 px-6 py-2.5 rounded-xl">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
