{{-- <x-admin-layout>
    <div class="max-w-3xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800 shadow-xl">
        <h2 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
            <span>📋</span> Input Penilaian & Rapot Siswa
        </h2>

        <form action="{{ route('grades.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Pilih Siswa -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Pilih Siswa</label>
                    <select name="student_id"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Periode -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Nama Periode</label>
                    <input type="text" name="period" placeholder="Contoh: Periode Agustus 2026"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>

                <!-- Rentang Tanggal -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Dari Tanggal</label>
                        <input type="date" name="start_date"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-2 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Sampai</label>
                        <input type="date" name="end_date"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-2 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                    </div>
                </div>
            </div>

            <!-- Bagian Baris Aspek & Skor Dinamis -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="text-xs font-medium text-slate-400 uppercase tracking-wider">Daftar Aspek &
                        Nilai</label>
                    <button type="button" id="addRow"
                        class="bg-slate-800 hover:bg-slate-700 text-emerald-400 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                        + Tambah Baris Aspek
                    </button>
                </div>

                <div id="aspectContainer" class="space-y-3">
                    <!-- Baris Pertama -->
                    <div class="flex gap-3 items-center aspect-row">
                        <input type="text" name="aspects[]" placeholder="Nama Aspek (Contoh: Passing / Dribbling)"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                        <input type="number" name="scores[]" placeholder="Skor (0-100)"
                            class="w-36 bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                        <button type="button"
                            class="remove-row bg-red-500/10 text-red-400 hover:bg-red-500/20 px-3 py-2.5 rounded-xl text-sm transition">❌</button>
                    </div>
                </div>
            </div>

            <!-- Catatan Pelatih -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Catatan Keseluruhan / Evaluasi
                    Pelatih</label>
                <textarea name="notes" rows="3" placeholder="Tulis catatan perkembangan siswa secara keseluruhan di sini..."
                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                <a href="{{ route('grades.index') }}"
                    class="bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition">Simpan
                    Semua Nilai</button>
            </div>
        </form>
    </div>

    <!-- Script JavaScript untuk Tambah/Hapus Baris Dinamis -->
    <script>
        document.getElementById('addRow').addEventListener('click', function() {
            let container = document.getElementById('aspectContainer');
            let newRow = document.createElement('div');
            newRow.className = 'flex gap-3 items-center aspect-row';
            newRow.innerHTML = `
                <input type="text" name="aspects[]" placeholder="Nama Aspek (Contoh: Shooting / Fisik)" class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500" required>
                <input type="number" name="scores[]" placeholder="Skor (0-100)" class="w-36 bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500" required>
                <button type="button" class="remove-row bg-red-500/10 text-red-400 hover:bg-red-500/20 px-3 py-2.5 rounded-xl text-sm transition">❌</button>
            `;
            container.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                let rows = document.querySelectorAll('.aspect-row');
                if (rows.length > 1) {
                    e.target.closest('.aspect-row').remove();
                } else {
                    alert('Minimal harus ada 1 aspek penilaian.');
                }
            }
        });
    </script>
</x-admin-layout> --}}
<x-admin-layout>
    <div class="max-w-3xl mx-auto bg-slate-900 p-6 rounded-2xl border border-slate-800 shadow-xl">
        <h2 class="text-white text-xl font-bold mb-6 flex items-center gap-2">
            <span>📋</span> Input Penilaian & Rapot Siswa
        </h2>

        <form action="{{ route('grades.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Input Nama Siswa (Bisa diketik & Ada rekomendasi list) -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Nama Siswa</label>
                    <input type="text" name="student_name" list="student_list"
                        placeholder="Ketik atau pilih nama siswa..."
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required autocomplete="off">

                    <!-- Datalist untuk memunculkan daftar siswa saat diketik -->
                    <datalist id="student_list">
                        @foreach ($students as $student)
                            <option value="{{ $student->name }}">
                        @endforeach
                    </datalist>
                    <p class="text-[10px] text-slate-500 mt-1">Ketik nama siswa, jika baru akan otomatis terdaftar.</p>
                </div>

                <!-- Nama Periode -->
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Nama Periode</label>
                    <input type="text" name="period" placeholder="Contoh: Periode Agustus 2026"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                        required>
                </div>

                <!-- Rentang Tanggal -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Dari Tanggal</label>
                        <input type="date" name="start_date"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-2 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Sampai</label>
                        <input type="date" name="end_date"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-2 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                    </div>
                </div>
            </div>

            <!-- Bagian Baris Aspek & Skor Dinamis -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="text-xs font-medium text-slate-400 uppercase tracking-wider">Daftar Aspek &
                        Nilai</label>
                    <button type="button" id="addRow"
                        class="bg-slate-800 hover:bg-slate-700 text-emerald-400 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                        + Tambah Baris Aspek
                    </button>
                </div>

                <div id="aspectContainer" class="space-y-3">
                    <!-- Baris Pertama -->
                    <div class="flex gap-3 items-center aspect-row">
                        <input type="text" name="aspects[]" placeholder="Nama Aspek (Contoh: Passing / Dribbling)"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                        <input type="number" name="scores[]" placeholder="Skor (0-100)"
                            class="w-36 bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"
                            required>
                        <button type="button"
                            class="remove-row bg-red-500/10 text-red-400 hover:bg-red-500/20 px-3 py-2.5 rounded-xl text-sm transition">❌</button>
                    </div>
                </div>
            </div>

            <!-- Catatan Pelatih -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Catatan Keseluruhan / Evaluasi
                    Pelatih</label>
                <textarea name="notes" rows="3" placeholder="Tulis catatan perkembangan siswa secara keseluruhan di sini..."
                    class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                <a href="{{ route('grades.index') }}"
                    class="bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Batal</a>
                <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition">Simpan
                    Semua Nilai</button>
            </div>
        </form>
    </div>

    <!-- Script JavaScript untuk Tambah/Hapus Baris Dinamis -->
    <script>
        document.getElementById('addRow').addEventListener('click', function() {
            let container = document.getElementById('aspectContainer');
            let newRow = document.createElement('div');
            newRow.className = 'flex gap-3 items-center aspect-row';
            newRow.innerHTML = `
                <input type="text" name="aspects[]" placeholder="Nama Aspek (Contoh: Shooting / Fisik)" class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500" required>
                <input type="number" name="scores[]" placeholder="Skor (0-100)" class="w-36 bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500" required>
                <button type="button" class="remove-row bg-red-500/10 text-red-400 hover:bg-red-500/20 px-3 py-2.5 rounded-xl text-sm transition">❌</button>
            `;
            container.appendChild(newRow);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                let rows = document.querySelectorAll('.aspect-row');
                if (rows.length > 1) {
                    e.target.closest('.aspect-row').remove();
                } else {
                    alert('Minimal harus ada 1 aspek penilaian.');
                }
            }
        });
    </script>
</x-admin-layout>
