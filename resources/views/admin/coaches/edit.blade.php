<x-admin-layout>
    <x-slot:header>Edit Data Pelatih: {{ $coach->name }}</x-slot:header>

    <div class="max-w-2xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800">

        <!-- Tampilkan error jika ada -->
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('coaches.update', $coach->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 text-white">
            @csrf
            @method('PUT')

            <!-- Foto Preview -->
            @if ($coach->photo)
                <div class="mb-4">
                    <p class="text-xs text-slate-400 mb-2">Foto Saat Ini:</p>
                    <img src="{{ asset('storage/' . $coach->photo) }}"
                        class="w-24 h-24 object-cover rounded-xl border border-slate-700">
                </div>
            @endif

            <div>
                <label class="text-sm font-medium text-slate-400">Nama Pelatih</label>
                <input type="text" name="name" value="{{ old('name', $coach->name) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none"
                    required>
            </div>

            <!-- WAJIB ADA: Input Nomor Telepon -->
            <div>
                <label class="text-sm font-medium text-slate-400">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $coach->phone) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none"
                    required>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Ubah Foto (Opsional)</label>
                <input type="file" name="photo"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-slate-400">Profesi</label>
                    <input type="text" name="profession" value="{{ old('profession', $coach->profession) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-400">Lisensi</label>
                    <input type="text" name="license" value="{{ old('license', $coach->license) }}"
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Pendidikan Terakhir</label>
                <input type="text" name="education" value="{{ old('education', $coach->education) }}"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-400">Pengalaman Melatih</label>
                <textarea name="experience" rows="4"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 focus:border-emerald-500 outline-none">{{ old('experience', $coach->experience) }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <a href="{{ route('coaches.index') }}"
                    class="bg-slate-800 text-slate-300 px-6 py-2.5 rounded-xl hover:bg-slate-700 transition">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 text-white px-6 py-2.5 rounded-xl hover:bg-emerald-700 transition font-bold">Update
                    Data</button>
            </div>
        </form>
    </div>
</x-admin-layout>
