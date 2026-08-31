<x-admin-layout>
    <x-slot:header>Kelola Data Cash Flow</x-slot:header>

    <div class="space-y-6">

        <!-- 1. KARTU RINGKASAN KEUANGAN -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pemasukan</p>
                    <h3 class="text-xl sm:text-2xl font-black text-emerald-400">Rp
                        {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-400 text-xl">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>

            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Pengeluaran</p>
                    <h3 class="text-xl sm:text-2xl font-black text-red-400">Rp
                        {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                </div>
                <div
                    class="w-12 h-12 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center justify-center text-red-400 text-xl">
                    <i class="fa-solid fa-chart-column"></i>
                </div>
            </div>

            <div
                class="bg-slate-900 border border-slate-800 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Saldo Bersih</p>
                    <h3 class="text-xl sm:text-2xl font-black text-sky-400">Rp
                        {{ number_format($balance, 0, ',', '.') }}</h3>
                </div>
                <div
                    class="w-12 h-12 bg-sky-500/10 border border-sky-500/20 rounded-xl flex items-center justify-center text-sky-400 text-xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
        </div>

        <!-- 2. FORM FILTER & PENCARIAN -->
        <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl shadow-xl">
            <form method="GET" action="{{ route('cash-flow.index') }}"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 items-end">
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Tipe Transaksi</label>
                    <select name="type"
                        class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Transaksi</option>
                        <option value="income" {{ $type == 'income' ? 'selected' : '' }}>Pemasukan Saja</option>
                        <option value="expense" {{ $type == 'expense' ? 'selected' : '' }}>Pengeluaran Saja</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Cari Kata Kunci</label>
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari kategori, nama..."
                        class="w-full bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl py-2.5 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i> Filter Data
                    </button>
                </div>
            </form>
        </div>

        <!-- 3. FORM TAMBAH TRANSAKSI -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-plus text-emerald-400"></i> Catat Transaksi Baru
            </h3>

            <form action="{{ route('cash-flow.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Tipe Transaksi -->
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Tipe Transaksi</label>
                        <select name="type"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                            <option value="income">Pemasukan (+)</option>
                            <option value="expense">Pengeluaran (-)</option>
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Kategori</label>
                        <input type="text" name="category" placeholder="Contoh: SPP / Gaji Pelatih"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                            required>
                    </div>

                    <!-- Nama Terkait dengan Rekomendasi Siswa / Pelatih -->
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Nama Terkait (Opsional)</label>
                        <input type="text" name="name" list="name_suggestions"
                            placeholder="Ketik atau pilih nama..."
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">

                        <datalist id="name_suggestions">
                            @if (isset($students))
                                @foreach ($students as $student)
                                    <option value="{{ $student->name }}">Siswa</option>
                                @endforeach
                            @endif

                            @if (isset($coaches))
                                @foreach ($coaches as $coach)
                                    <option value="{{ $coach->name }}">Pelatih</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <!-- Nominal -->
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Nominal (Rp)</label>
                        <input type="number" name="amount" placeholder="Contoh: 150000"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Tanggal -->
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Tanggal</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}"
                            class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition"
                            required>
                    </div>

                    <!-- Deskripsi / Keterangan -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Deskripsi / Keterangan Tambahan
                            (Opsional)</label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <input type="text" name="description"
                                placeholder="Contoh: Pembayaran iuran bulan Mei / Beli bola futsal baru"
                                class="w-full bg-slate-950 border border-slate-700 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 outline-none transition">
                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl px-6 py-2.5 shadow-lg shadow-emerald-600/20 transition shrink-0 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- 4. TABEL RIWAYAT TRANSAKSI DENGAN VANILLA JS PAGINATION -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h3 class="text-lg font-bold text-white">Riwayat Transaksi Keuangan</h3>

                <!-- Pilihan Jumlah Baris per Halaman -->
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <span>Tampilkan:</span>
                    <select id="rows-per-page"
                        class="bg-slate-950 border border-slate-700 text-white rounded-xl px-3 py-1.5 outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>data</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-slate-300 text-sm">
                    <thead
                        class="bg-slate-950/60 text-slate-400 uppercase text-xs tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="py-4 px-6">Tanggal</th>
                            <th class="py-4 px-6">Kategori & Tipe</th>
                            <th class="py-4 px-6">Nama Terkait</th>
                            <th class="py-4 px-6">Keterangan</th>
                            <th class="py-4 px-6 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60" id="transaction-table-body">
                        @forelse ($transactions as $trx)
                            <tr class="trx-row hover:bg-slate-800/40 transition">
                                <td class="py-4 px-6 text-slate-400 text-xs whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar text-slate-500"></i>
                                        {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-white block">{{ $trx->category }}</span>
                                    <span
                                        class="text-[10px] uppercase font-bold tracking-wider {{ $trx->type == 'income' ? 'text-emerald-400' : 'text-red-400' }}">
                                        {{ $trx->type == 'income' ? '● Pemasukan' : '● Pengeluaran' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-medium text-white">
                                    @if ($trx->name)
                                        <span class="inline-flex items-center gap-1.5">
                                            <i class="fa-regular fa-user text-slate-400 text-xs"></i>
                                            {{ $trx->name }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-slate-400 text-xs">
                                    {{ $trx->description ?? '-' }}
                                </td>
                                <td
                                    class="py-4 px-6 text-right font-bold {{ $trx->type == 'income' ? 'text-emerald-400' : 'text-red-400' }} whitespace-nowrap">
                                    {{ $trx->type == 'income' ? '+' : '-' }} Rp
                                    {{ number_format($trx->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr id="empty-row">
                                <td colspan="5" class="text-center py-12 text-slate-500 text-sm">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="fa-solid fa-folder-open text-3xl text-slate-600"></i>
                                        <p>Belum ada catatan transaksi keuangan pada periode ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Navigasi Pagination Vanilla JS & Info -->
            <div
                class="p-4 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-400">
                <div id="table-info">
                    Menampilkan <span class="font-bold text-white" id="info-start">0</span>
                    sampai <span class="font-bold text-white" id="info-end">0</span>
                    dari <span class="font-bold text-white" id="info-total">0</span> data transaksi
                </div>

                <!-- Tombol Halaman -->
                <div class="flex items-center gap-1.5" id="pagination-buttons">
                    <!-- Tombol Navigasi akan digenerate otomatis oleh script di bawah -->
                </div>
            </div>
        </div>

        <!-- Skrip Vanilla JavaScript untuk Pagination -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tableBody = document.getElementById("transaction-table-body");
                const rows = tableBody.querySelectorAll(".trx-row");
                const rowsPerPageSelect = document.getElementById("rows-per-page");
                const paginationContainer = document.getElementById("pagination-buttons");

                const infoStart = document.getElementById("info-start");
                const infoEnd = document.getElementById("info-end");
                const infoTotal = document.getElementById("info-total");

                let currentPage = 1;
                let rowsPerPage = parseInt(rowsPerPageSelect.value);
                let totalRows = rows.length;

                function displayTable() {
                    let totalPages = Math.ceil(totalRows / rowsPerPage) || 1;
                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    let start = (currentPage - 1) * rowsPerPage;
                    let end = start + rowsPerPage;

                    // Tampilkan/Sembunyikan baris sesuai halaman aktif
                    rows.forEach((row, index) => {
                        if (index >= start && index < end) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });

                    // Update teks informasi data
                    infoStart.textContent = totalRows > 0 ? start + 1 : 0;
                    infoEnd.textContent = Math.min(end, totalRows);
                    infoTotal.textContent = totalRows;

                    renderPaginationControls(totalPages);
                }

                function renderPaginationControls(totalPages) {
                    paginationContainer.innerHTML = "";
                    if (totalPages <= 1) return;

                    // Tombol First
                    let firstBtn = createButton('<i class="fa-solid fa-angles-left"></i>', () => {
                        currentPage = 1;
                        displayTable();
                    }, currentPage === 1);
                    paginationContainer.appendChild(firstBtn);

                    // Tombol Prev
                    let prevBtn = createButton('<i class="fa-solid fa-angle-left"></i> Prev', () => {
                        currentPage--;
                        displayTable();
                    }, currentPage === 1);
                    paginationContainer.appendChild(prevBtn);

                    // Tombol Nomor Halaman
                    for (let i = 1; i <= totalPages; i++) {
                        let pageBtn = document.createElement("button");
                        pageBtn.innerHTML = i;
                        pageBtn.className = `w-8 h-8 rounded-lg transition flex items-center justify-center ${
                    currentPage === i
                        ? "bg-emerald-600 text-white font-bold"
                        : "bg-slate-800 hover:bg-slate-700 text-slate-300"
                }`;
                        pageBtn.addEventListener("click", () => {
                            currentPage = i;
                            displayTable();
                        });
                        paginationContainer.appendChild(pageBtn);
                    }

                    // Tombol Next
                    let nextBtn = createButton('Next <i class="fa-solid fa-angle-right"></i>', () => {
                        currentPage++;
                        displayTable();
                    }, currentPage === totalPages);
                    paginationContainer.appendChild(nextBtn);

                    // Tombol Last
                    let lastBtn = createButton('<i class="fa-solid fa-angles-right"></i>', () => {
                        currentPage = totalPages;
                        displayTable();
                    }, currentPage === totalPages);
                    paginationContainer.appendChild(lastBtn);
                }

                function createButton(htmlContent, onClickCallback, isDisabled) {
                    let btn = document.createElement("button");
                    btn.innerHTML = htmlContent;
                    btn.className =
                        "px-3 py-1.5 bg-slate-800 hover:bg-slate-700 disabled:opacity-40 disabled:cursor-not-allowed text-white rounded-lg transition flex items-center gap-1";
                    btn.disabled = isDisabled;
                    btn.addEventListener("click", onClickCallback);
                    return btn;
                }

                // Event listener saat pilihan "Tampilkan X data" diubah
                rowsPerPageSelect.addEventListener("change", function() {
                    rowsPerPage = parseInt(this.value);
                    currentPage = 1;
                    displayTable();
                });

                // Jalankan saat pertama kali dimuat
                displayTable();
            });
        </script>
</x-admin-layout>
