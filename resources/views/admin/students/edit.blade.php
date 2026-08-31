<x-admin-layout>
    <x-slot:header>Edit Data Siswa</x-slot:header>

    <div class="max-w-2xl mx-auto bg-slate-900 border border-slate-800 p-8 rounded-3xl shadow-xl">
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-2">Nama Lengkap Anak</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}" required
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-2">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $student->birth_place) }}"
                        required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-2">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}"
                        required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-2">Nama Orang Tua / Wali</label>
                    <input type="text" name="parent_name" value="{{ old('parent_name', $student->parent_name) }}"
                        required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-2">No. WhatsApp Wali</label>
                    <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"
                        required
                        class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 mb-2">Foto Siswa (Biarkan kosong jika tidak
                    ingin diubah)</label>
                @if ($student->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $student->photo) }}" alt="Foto Lama"
                            class="w-16 h-16 rounded-xl object-cover border border-slate-700">
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*"
                    class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-500/10 file:text-emerald-400 hover:file:bg-emerald-500/20 transition">
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3.5 rounded-xl transition shadow-lg shadow-emerald-950 text-sm">
                    Perbarui Data Siswa
                </button>
                <a href="{{ route('students.index') }}"
                    class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold px-6 py-3.5 rounded-xl transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
