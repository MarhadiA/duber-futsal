<x-admin-layout>
    <x-slot:header>Manajemen Jersey & Ukuran Otomatis</x-slot:header>

    <div class="space-y-6 px-2 sm:px-0">
        <!-- Form Input Jersey & Kalkulator Ukuran -->
        <div class="bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl shadow-xl">
            <form action="{{ route('jerseys.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3" onsubmit="cleanRupiahBeforeSubmit(this)">
                @csrf
                <!-- Pilih Siswa -->
                <select name="student_id"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none w-full"
                    required>
                    <option value="">Pilih Siswa</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>

                <!-- Tinggi Badan -->
                <input type="number" name="height" placeholder="Tinggi Badan (cm)"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none w-full"
                    required>

                <!-- Berat Badan -->
                <input type="number" name="weight" placeholder="Berat Badan (kg)"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none w-full"
                    required>

                <!-- Harga (Format Rupiah) -->
                <input type="text" name="price_formatted" placeholder="Harga Jersey (Rp)"
                    class="format-rupiah bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none w-full"
                    required>
                <input type="hidden" name="price" id="price">

                <!-- Bayar Awal / DP (Format Rupiah) -->
                <input type="text" name="paid_amount_formatted" placeholder="Bayar Awal / DP (Rp)"
                    class="format-rupiah bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none w-full">
                <input type="hidden" name="paid_amount" id="paid_amount">

                <!-- Upload Foto -->
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] text-slate-400">Foto / Desain Jersey:</label>
                    <input type="file" name="jersey_photo"
                        class="text-xs text-slate-400 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                </div>

                <div class="lg:col-span-2 flex items-end">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition shadow-lg">
                        ⚡ Generate Ukuran & Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Bagian Kotak Pencarian & Kontrol Tabel -->
        <div
            class="bg-slate-900 border border-slate-800 rounded-2xl p-4 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-72">
                <input type="text" id="searchInput" onkeyup="filterTable()"
                    placeholder="🔍 Cari nama siswa / ukuran..."
                    class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-emerald-500 transition">
            </div>
            <div class="text-xs text-slate-400">
                Menampilkan data secara real-time
            </div>
        </div>

        <!-- Tabel Data Jersey -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[800px]" id="jerseyTable">
                    <thead>
                        <tr
                            class="bg-slate-950/50 border-b border-slate-800 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            <th class="p-4 text-center">No</th>
                            <th class="p-4">Foto</th>
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">TB / BB</th>
                            <th class="p-4">Ukuran (Auto)</th>
                            <th class="p-4">Harga & Dibayar</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm" id="tableBody">
                        @forelse($jerseys as $jersey)
                            <tr class="jersey-row hover:bg-slate-800/40 transition">
                                <td class="p-4 text-center text-slate-400 row-number">{{ $loop->iteration }}</td>
                                <td class="p-4">
                                    @if ($jersey->jersey_photo)
                                        <img src="{{ asset('storage/' . $jersey->jersey_photo) }}" alt="Jersey"
                                            class="w-10 h-10 rounded-xl object-cover border border-slate-700">
                                    @else
                                        <div
                                            class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-xs text-slate-500">
                                            👕</div>
                                    @endif
                                </td>
                                <td class="p-4 font-bold text-white student-name">{{ $jersey->student->name ?? '-' }}
                                </td>
                                <td class="p-4 text-slate-300 text-xs">
                                    {{ $jersey->height }} cm / {{ $jersey->weight }} kg
                                </td>
                                <td class="p-4">
                                    <span
                                        class="bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-bold px-3 py-1 rounded-full size-label">
                                        {{ $jersey->size }}
                                    </span>
                                </td>
                                <td class="p-4 text-xs">
                                    <div class="text-white font-semibold">Rp
                                        {{ number_format($jersey->price, 0, ',', '.') }}</div>
                                    <div class="text-emerald-400">Bayar: Rp
                                        {{ number_format($jersey->paid_amount, 0, ',', '.') }}</div>
                                </td>
                                <td class="p-4 text-center">
                                    @if ($jersey->status == 'paid')
                                        <span
                                            class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold px-3 py-1 rounded-full">Lunas</span>
                                    @elseif($jersey->status == 'partial')
                                        <span
                                            class="bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold px-3 py-1 rounded-full">Bayar
                                            Sebagian</span>
                                    @else
                                        <span
                                            class="bg-red-500/10 text-red-400 border border-red-500/20 text-xs font-bold px-3 py-1 rounded-full">Belum
                                            Bayar</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Update Cepat Pembayaran -->
                                        <form action="{{ route('jerseys.update', $jersey->id) }}" method="POST"
                                            class="flex items-center gap-1"
                                            onsubmit="this.querySelector('.paid-hidden').value = this.querySelector('.paid-formatted').value.replace(/\./g, '')">
                                            @csrf @method('PUT')
                                            <input type="text"
                                                value="{{ number_format($jersey->paid_amount, 0, ',', '.') }}"
                                                class="format-rupiah paid-formatted bg-slate-950 border border-slate-700 text-white text-xs rounded-lg px-2 py-1 w-24"
                                                placeholder="Nominal">
                                            <input type="hidden" name="paid_amount" class="paid-hidden">
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-500 text-white text-xs px-2.5 py-1 rounded-lg">Update</button>
                                        </form>

                                        <form action="{{ route('jerseys.destroy', $jersey->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data jersey ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500/10 hover:bg-red-500 text-red-400 text-xs px-2.5 py-1.5 rounded-lg border border-red-500/20">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="8" class="p-8 text-center text-slate-500">Belum ada data pencatatan
                                    jersey.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Kontrol Pagination JavaScript -->
            <div
                class="p-4 bg-slate-950/40 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
                <div id="paginationInfo">Menampilkan data</div>
                <div class="flex items-center gap-1" id="paginationControls">
                    <!-- Tombol Pagination akan di-generate otomatis oleh JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Script JavaScript untuk Search & Pagination Client-Side -->
    <script>
        let rowsPerPage = 5; // Atur jumlah baris per halaman di sini (misal: 5 data per halaman)
        let currentPage = 1;

        document.addEventListener("DOMContentLoaded", function() {
            setupPagination();
        });

        // Fungsi Pencarian Real-Time
        function filterTable() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll('.jersey-row');

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.setAttribute('data-filtered', 'true');
                } else {
                    row.setAttribute('data-filtered', 'false');
                }
            });

            currentPage = 1; // Reset ke halaman pertama saat mencari
            setupPagination();
        }

        // Fungsi Setup & Render Tombol Paginate
        function setupPagination() {
            let rows = Array.from(document.querySelectorAll('.jersey-row')).filter(row => {
                return row.getAttribute('data-filtered') !== 'false';
            });

            let totalRows = rows.length;
            let totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            // Sembunyikan semua baris, lalu tampilkan sesuai halaman aktif
            document.querySelectorAll('.jersey-row').forEach(row => row.style.display = 'none');

            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;
            let paginatedRows = rows.slice(start, end);

            paginatedRows.forEach(row => row.style.display = '');

            // Info Teks
            let infoText = totalRows === 0 ? "Tidak ada data yang cocok" :
                `Menampilkan ${start + 1} - ${Math.min(end, totalRows)} dari ${totalRows} data`;
            document.getElementById('paginationInfo').innerText = infoText;

            // Render Tombol Pagination
            let controls = document.getElementById('paginationControls');
            controls.innerHTML = '';

            if (totalPages > 1) {
                // Tombol Prev
                let prevBtn = document.createElement('button');
                prevBtn.innerText = '‹ Prev';
                prevBtn.className =
                    `px-3 py-1.5 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 transition ${currentPage === 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}`;
                prevBtn.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        setupPagination();
                    }
                };
                controls.appendChild(prevBtn);

                // Nomor Halaman
                for (let i = 1; i <= totalPages; i++) {
                    let pageBtn = document.createElement('button');
                    pageBtn.innerText = i;
                    pageBtn.className =
                        `px-3 py-1.5 rounded-lg border transition ${i === currentPage ? 'bg-emerald-600 border-emerald-500 text-white font-bold' : 'bg-slate-900 border-slate-700 text-slate-300 hover:bg-slate-800'}`;
                    pageBtn.onclick = () => {
                        currentPage = i;
                        setupPagination();
                    };
                    controls.appendChild(pageBtn);
                }

                // Tombol Next
                let nextBtn = document.createElement('button');
                nextBtn.innerText = 'Next ›';
                nextBtn.className =
                    `px-3 py-1.5 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 transition ${currentPage === totalPages ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}`;
                nextBtn.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        setupPagination();
                    }
                };
                controls.appendChild(nextBtn);
            }
        }

        // Script Format Rupiah
        document.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('format-rupiah')) {
                let value = e.target.value.replace(/[^,\d]/g, '').toString();
                let split = value.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                e.target.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            }
        });

        function cleanRupiahBeforeSubmit(form) {
            let priceFormatted = form.querySelector('input[name="price_formatted"]');
            let priceHidden = form.querySelector('input[name="price"]');
            if (priceFormatted && priceHidden) {
                priceHidden.value = priceFormatted.value.replace(/\./g, '');
            }

            let paidFormatted = form.querySelector('input[name="paid_amount_formatted"]');
            let paidHidden = form.querySelector('input[name="paid_amount"]');
            if (paidFormatted && paidHidden) {
                paidHidden.value = paidFormatted.value.replace(/\./g, '');
            }
        }
    </script>
</x-admin-layout>
