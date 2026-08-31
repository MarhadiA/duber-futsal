<x-admin-layout>
    <x-slot:header>Tambah Data Prestasi</x-slot:header>

    <div class="max-w-2xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">
        <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf

            <div>
                <label class="text-sm font-medium text-slate-400">Judul Prestasi</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none"
                    required>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Upload Foto (Bisa pilih banyak sekaligus)</label>
                <input type="file" name="photos[]" multiple
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm">
                <p class="text-xs text-slate-500 mt-1">Anda dapat memilih lebih dari satu file foto.</p>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Deskripsi / Keterangan</label>
                <textarea name="description" rows="4"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('achievements.index') }}"
                    class="bg-slate-800 text-slate-300 px-6 py-2.5 rounded-xl">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
