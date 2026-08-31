<x-admin-layout>
    <x-slot:header>Absensi Harian Pelatih</x-slot:header>

    <div class="space-y-6">
        <!-- Filter Tanggal -->
        <div class="bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl">
            <form method="GET" action="{{ route('coach-attendances.index') }}"
                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <label class="text-sm text-slate-400">Pilih Tanggal:</label>
                <input type="date" name="date" value="{{ $date }}"
                    class="bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500 w-full sm:w-auto">
                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition text-center">Muat</button>
            </form>
        </div>

        <!-- Form Input Kehadiran -->
        <form action="{{ route('coach-attendances.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">

            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr
                                class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider bg-slate-950/50">
                                <th class="p-4">Nama Pelatih</th>
                                <th class="p-4 text-center w-40">Status Kehadiran</th>
                                <th class="p-4">Keterangan / Sesi Latihan</th>
                                <th class="p-4 text-center">Aksi / Riwayat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 text-sm">
                            @forelse($coaches as $coach)
                                @php
                                    $attendance = $attendances[$coach->id] ?? null;
                                    $currentStatus = $attendance ? $attendance->status : 'Hadir';
                                    $currentNotes = $attendance ? $attendance->notes : '';
                                @endphp
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="p-4 font-medium text-white whitespace-nowrap">{{ $coach->name }}</td>
                                    <td class="p-4 text-center">
                                        <select name="attendances[{{ $coach->id }}][status]"
                                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-emerald-500">
                                            <option value="Hadir" {{ $currentStatus === 'Hadir' ? 'selected' : '' }}>
                                                Hadir</option>
                                            <option value="Izin" {{ $currentStatus === 'Izin' ? 'selected' : '' }}>
                                                Izin</option>
                                            <option value="Alpha" {{ $currentStatus === 'Alpha' ? 'selected' : '' }}>
                                                Alpha</option>
                                        </select>
                                    </td>
                                    <td class="p-4">
                                        <input type="text" name="attendances[{{ $coach->id }}][notes]"
                                            value="{{ $currentNotes }}" placeholder="Catatan sesi..."
                                            class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-white text-xs focus:outline-none focus:border-emerald-500">
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('coach-attendances.show', $coach->id) }}"
                                            class="bg-slate-800 hover:bg-slate-700 text-emerald-400 border border-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold transition inline-flex items-center gap-1.5">
                                            <i class="fa-solid fa-eye"></i> Lihat Riwayat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-6 text-center text-slate-500">Belum ada data pelatih.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tombol Simpan Responsive -->
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl text-sm font-semibold transition shadow-lg flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi Pelatih
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.placeholder = 'Cari nama pelatih...';
            searchInput.className =
                'bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500 w-full md:w-72 mb-4';

            // Sisipkan input search di atas tabel
            const tableContainer = document.querySelector('.overflow-x-auto').parentNode;
            tableContainer.parentNode.insertBefore(searchInput, tableContainer);

            const tbody = document.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const rowsPerPage = 5; // Atur jumlah baris per halaman di sini
            let currentPage = 1;

            // Elemen kontainer pagination
            const paginationContainer = document.createElement('div');
            paginationContainer.className = 'flex justify-between items-center mt-4 text-xs text-slate-400';
            tableContainer.parentNode.appendChild(paginationContainer);

            function displayTable(filteredRows) {
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                rows.forEach(row => row.style.display = 'none');
                filteredRows.slice(start, end).forEach(row => row.style.display = '');

                renderPagination(filteredRows.length);
            }

            function renderPagination(totalRows) {
                paginationContainer.innerHTML = '';
                const totalPages = Math.ceil(totalRows / rowsPerPage) || 1;

                const infoText = document.createElement('span');
                infoText.innerText = `Menampilkan halaman ${currentPage} dari ${totalPages}`;
                paginationContainer.appendChild(infoText);

                const btnWrapper = document.createElement('div');
                btnWrapper.className = 'flex gap-2';

                const prevBtn = document.createElement('button');
                prevBtn.type = 'button';
                prevBtn.innerText = 'Sebelumnya';
                prevBtn.className =
                    'bg-slate-800 hover:bg-slate-700 text-white px-3 py-1.5 rounded-lg disabled:opacity-50';
                prevBtn.disabled = currentPage === 1;
                prevBtn.onclick = () => {
                    if (currentPage > 1) {
                        currentPage--;
                        filterAndPaginate();
                    }
                };
                btnWrapper.appendChild(prevBtn);

                const nextBtn = document.createElement('button');
                nextBtn.type = 'button';
                nextBtn.innerText = 'Berikutnya';
                nextBtn.className =
                    'bg-slate-800 hover:bg-slate-700 text-white px-3 py-1.5 rounded-lg disabled:opacity-50';
                nextBtn.disabled = currentPage === totalPages;
                nextBtn.onclick = () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        filterAndPaginate();
                    }
                };
                btnWrapper.appendChild(nextBtn);

                paginationContainer.appendChild(btnWrapper);
            }

            function filterAndPaginate() {
                const query = searchInput.value.toLowerCase();
                const filteredRows = rows.filter(row => {
                    const name = row.querySelector('td').innerText.toLowerCase();
                    return name.includes(query);
                });
                displayTable(filteredRows);
            }

            searchInput.addEventListener('input', () => {
                currentPage = 1;
                filterAndPaginate();
            });

            filterAndPaginate();
        });
    </script>
</x-admin-layout>
