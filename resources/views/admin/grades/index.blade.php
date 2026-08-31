<x-admin-layout>
    <x-slot:header>Kelola Rapot Siswa</x-slot:header>

    <!-- Header & Search -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-slate-400 text-sm">Daftar penilaian dan rapot perkembangan siswa akademi.</p>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <!-- Kotak Pencarian JavaScript Real-Time -->
            <div class="w-full sm:w-64 relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari nama siswa..."
                    class="bg-slate-900 border border-slate-700 text-white text-sm rounded-xl ps-10 pe-4 py-2.5 w-full focus:ring-2 focus:ring-emerald-500 outline-none">
            </div>

            <a href="{{ route('grades.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition flex items-center gap-2 text-sm whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Rapot</span>
            </a>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-slate-300 text-sm" id="gradeTable">
                <thead
                    class="bg-slate-950/60 text-slate-400 uppercase text-xs tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-4 px-6 w-16 text-center">No</th>
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Jumlah Periode Rapot</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60" id="tableBody">
                    @forelse ($students as $index => $student)
                        <tr class="grade-row hover:bg-slate-800/40 transition">
                            <td class="py-4 px-6 text-center text-slate-500 row-number">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-4 px-6 font-bold text-white student-name">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span>{{ $student->name }}</span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-xs">
                                <span
                                    class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-semibold px-3 py-1 rounded-full">
                                    {{ $student->grades->groupBy('period')->count() }} Periode Tercatat
                                </span>
                            </td>

                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('grades.show', $student->id) }}"
                                        class="bg-blue-500/10 hover:bg-blue-500 hover:text-white text-blue-400 border border-blue-500/20 px-3 py-2 rounded-xl transition text-xs font-semibold flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        <span>Detail Rapot</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="4" class="text-center py-12 text-slate-500">Data siswa atau rapot tidak
                                ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Kontrol Pagination JavaScript yang Responsif -->
        <div
            class="px-4 sm:px-6 py-4 bg-slate-950/40 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
            <div id="paginationInfo" class="text-center sm:text-left">Menampilkan data</div>
            <div class="flex flex-wrap items-center justify-center gap-1.5" id="paginationControls"></div>
        </div>
    </div>

    <!-- Script JavaScript untuk Search & Pagination Client-Side -->
    <script>
        let rowsPerPage = 5; // Jumlah data per halaman
        let currentPage = 1;

        document.addEventListener("DOMContentLoaded", function() {
            setupPagination();
        });

        function filterTable() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll('.grade-row');

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if (text.includes(filter)) {
                    row.setAttribute('data-filtered', 'true');
                } else {
                    row.setAttribute('data-filtered', 'false');
                }
            });

            currentPage = 1;
            setupPagination();
        }

        function setupPagination() {
            let rows = Array.from(document.querySelectorAll('.grade-row')).filter(row => {
                return row.getAttribute('data-filtered') !== 'false';
            });

            let totalRows = rows.length;
            let totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            document.querySelectorAll('.grade-row').forEach(row => row.style.display = 'none');

            let start = (currentPage - 1) * rowsPerPage;
            let end = start + rowsPerPage;
            let paginatedRows = rows.slice(start, end);

            paginatedRows.forEach(row => row.style.display = '');

            let infoText = totalRows === 0 ? "Tidak ada data yang cocok" :
                `Menampilkan ${start + 1} - ${Math.min(end, totalRows)} dari ${totalRows} data`;
            document.getElementById('paginationInfo').innerText = infoText;

            let controls = document.getElementById('paginationControls');
            controls.innerHTML = '';

            if (totalPages > 1) {
                // Tombol Prev
                let prevBtn = document.createElement('button');
                prevBtn.innerText = '‹ Prev';
                prevBtn.className =
                    `px-2.5 py-1.5 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 transition ${currentPage === 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}`;
                prevBtn.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        setupPagination();
                    }
                };
                controls.appendChild(prevBtn);

                // Tombol Angka Halaman
                for (let i = 1; i <= totalPages; i++) {
                    let pageBtn = document.createElement('button');
                    pageBtn.innerText = i;
                    pageBtn.className =
                        `px-3 py-1.5 rounded-lg border transition text-xs font-medium ${i === currentPage ? 'bg-emerald-600 border-emerald-500 text-white font-bold' : 'bg-slate-900 border-slate-700 text-slate-300 hover:bg-slate-800'}`;
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
                    `px-2.5 py-1.5 rounded-lg border border-slate-700 bg-slate-900 text-slate-300 transition ${currentPage === totalPages ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-800'}`;
                nextBtn.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        setupPagination();
                    }
                };
                controls.appendChild(nextBtn);
            }
        }
    </script>
</x-admin-layout>
