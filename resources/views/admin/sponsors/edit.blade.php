<x-admin-layout>
    <x-slot:header>Edit Sponsor</x-slot:header>

    <div class="max-w-xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">
        <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm font-medium text-slate-400">Nama Sponsor / Perusahaan</label>
                <input type="text" name="name" value="{{ old('name', $sponsor->name) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500"
                    required>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Nama Pemilik / Owner (Opsional)</label>
                <input type="text" name="owner_name" value="{{ old('owner_name', $sponsor->owner_name) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500">
            </div>
            <div>
                <p class="text-xs text-slate-400 mb-2">Logo Saat Ini:</p>
                <img src="{{ asset('storage/' . $sponsor->logo) }}"
                    class="w-24 h-16 object-contain bg-slate-950 p-2 rounded-xl border border-slate-800 mb-3">
                <label class="text-sm font-medium text-slate-400">Ganti Logo (Opsional)</label>
                <input type="file" name="logo"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm">
            </div>
            <div class="flex gap-3 pt-4">
                <a href="{{ route('sponsors.index') }}"
                    class="bg-slate-800 text-slate-300 px-6 py-2.5 rounded-xl">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold">Update</button>
            </div>
        </form>
    </div>
</x-admin-layout>
