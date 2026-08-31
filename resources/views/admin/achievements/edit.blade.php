<x-admin-layout>
    <x-slot:header>Edit Data Prestasi: {{ $achievement->title }}</x-slot:header>

    <div class="max-w-2xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">
        <form action="{{ route('achievements.update', $achievement->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf
            @method('PUT')

            <div>
                <label class="text-sm font-medium text-slate-400">Judul Prestasi</label>
                <input type="text" name="title" value="{{ old('title', $achievement->title) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none"
                    required>
            </div>

            <!-- Preview Foto Lama -->
            @if ($achievement->photos && is_array($achievement->photos))
                <div>
                    <p class="text-xs text-slate-400 mb-2">Foto Saat Ini:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($achievement->photos as $photo)
                            <img src="{{ asset('storage/' . $photo) }}"
                                class="w-16 h-16 object-cover rounded-xl border border-slate-700">
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <label class="text-sm font-medium text-slate-400">Tambah Foto Baru (Opsional)</label>
                <input type="file" name="photos[]" multiple
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Deskripsi / Keterangan</label>
                <textarea name="description" rows="4"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">{{ old('description', $achievement->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('achievements.index') }}"
                    class="bg-slate-800 text-slate-300 px-6 py-2.5 rounded-xl">Batal</a>
                <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold">Update
                    Data</button>
            </div>
        </form>
    </div>
</x-admin-layout>
