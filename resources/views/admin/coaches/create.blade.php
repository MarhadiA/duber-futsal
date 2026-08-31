<x-admin-layout>
    <x-slot:header>Tambah Pelatih Baru</x-slot:header>

    <div class="max-w-2xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">
        <!-- Tampilkan error jika validasi gagal -->
        @if ($errors->any())
            <div class="bg-red-500/20 text-red-400 p-4 rounded-xl mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('coaches.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf
            <div>
                <label class="text-sm font-medium text-slate-400">Nama Pelatih</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500"
                    required>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">No. Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500"
                    required>
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Foto</label>
                <input type="file" name="photo"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Profesi</label>
                <input type="text" name="profession" value="{{ old('profession') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Lisensi</label>
                <input type="text" name="license" value="{{ old('license') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Pendidikan Terakhir</label>
                <input type="text" name="education" value="{{ old('education') }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-400">Pengalaman Melatih</label>
                <textarea name="experience" rows="3"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 outline-none focus:border-emerald-500">{{ old('experience') }}</textarea>
            </div>
            <button type="submit"
                class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-emerald-700 transition">Simpan
                Data</button>
        </form>
    </div>
</x-admin-layout>
