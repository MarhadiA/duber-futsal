<x-admin-layout>
    <div class="max-w-2xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800 shadow-xl">
        <h2 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
            <span>✏️</span> Edit Penilaian Siswa
        </h2>

        <form action="{{ route('grades.update', $grade->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Pilih Siswa -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Nama Siswa</label>
                <select name="student_id"
                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                    required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Aspek Penilaian -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Aspek Penilaian</label>
                    <input type="text" name="aspect" value="{{ $grade->aspect }}"
                        placeholder="Contoh: Passing / Dribbling"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>
                <!-- Skor -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Skor (0-100)</label>
                    <input type="number" name="score" value="{{ $grade->score }}" placeholder="0-100"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>
            </div>

            <!-- Periode -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Periode / Bulan</label>
                <input type="text" name="period" value="{{ $grade->period }}" placeholder="Contoh: Agustus 2026"
                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                    required>
            </div>

            <!-- Catatan Pelatih -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Catatan Pelatih</label>
                <textarea name="notes" rows="3" placeholder="Tulis catatan evaluasi..."
                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500">{{ $grade->notes }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                <a href="{{ route('grades.show', $grade->student_id) }}"
                    class="bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
