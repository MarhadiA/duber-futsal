<x-admin-layout>
    <x-slot:header>Kelola Data Siswa</x-slot:header>

    <div class="space-y-6 px-2 sm:px-0">
        <!-- Bagian Header, Pencarian, Filter & Tombol Aksi -->
        <div class="bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl shadow-xl flex flex-col gap-5">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-emerald-500"></i> Daftar Anggota Akademi
                    </h2>
                    <p class="text-slate-400 text-xs sm:text-sm">Kelola informasi anggota, status keaktifan, dan tahun
                        kelahiran.</p>
                </div>

                <a href="{{ route('students.create') }}"
                    class="bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition shadow-lg shadow-emerald-950 flex items-center justify-center gap-2 whitespace-nowrap w-full lg:w-auto">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tambah Siswa Baru</span>
                </a>
            </div>

            <!-- Baris Filter dan Pencarian -->
            <div
                class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 pt-4 border-t border-slate-800">
                <!-- Form Live Search -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 w-full lg:max-w-md">
                    <div class="relative w-full">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" id="search-input" value="{{ request('search') }}"
                            placeholder="Cari nama siswa atau orang tua..."
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-2 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition">
                    </div>
                </div>

                <!-- Form Filter Rentang Tanggal Lahir -->
                <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 w-full lg:w-auto">
                    <div class="flex items-center gap-1.5 w-full sm:w-auto text-slate-400">
                        <div class="relative w-full">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500">
                                <i class="fa-regular fa-calendar text-xs"></i>
                            </span>
                            <input type="date" id="start-date" value="{{ request('start_date') }}"
                                class="bg-slate-950 border border-slate-800 rounded-xl pl-9 pr-3 py-2 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500 transition w-full">
                        </div>
                        <span class="text-slate-500 text-xs shrink-0">s/d</span>
                        <div class="relative w-full">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500">
                                <i class="fa-regular fa-calendar text-xs"></i>
                            </span>
                            <input type="date" id="end-date" value="{{ request('end_date') }}"
                                class="bg-slate-950 border border-slate-800 rounded-xl pl-9 pr-3 py-2 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500 transition w-full">
                        </div>
                    </div>
                    <button type="button" id="reset-filter"
                        class="bg-slate-950 hover:bg-slate-800 text-slate-400 hover:text-white text-xs sm:text-sm px-3.5 py-2 rounded-xl transition border border-slate-800 shrink-0 flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-right text-[10px]"></i> Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Bagian Tabel Data & Paginasi (Dibungkus ID untuk AJAX) -->
        <div id="student-table-container"
            class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr
                            class="bg-slate-950/50 border-b border-slate-800 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            <th class="p-3 sm:p-4 w-12 text-center">No</th>
                            <th class="p-3 sm:p-4">Foto</th>
                            <th class="p-3 sm:p-4">Nama & TTL</th>
                            <th class="p-3 sm:p-4">Usia</th>
                            <th class="p-3 sm:p-4">Wali & WhatsApp</th>
                            <th class="p-3 sm:p-4 text-center">Status</th>
                            <th class="p-3 sm:p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse ($students as $student)
                            <tr class="hover:bg-slate-800/40 transition">
                                <td class="p-3 sm:p-4 text-center text-slate-400 font-medium">
                                    {{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                                </td>
                                <td class="p-3 sm:p-4">
                                    @if ($student->photo)
                                        <img src="{{ asset('storage/' . $student->photo) }}" alt="Foto"
                                            class="w-10 h-10 rounded-xl object-cover border border-slate-700">
                                    @else
                                        <div
                                            class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-slate-400">
                                            <i class="fa-solid fa-user text-sm"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3 sm:p-4 font-bold text-white">
                                    {{ $student->name }}
                                    <span class="block text-xs font-normal text-slate-400">
                                        <i
                                            class="fa-solid fa-location-dot text-[10px] text-slate-500 mr-1"></i>{{ $student->birth_place ?? '-' }},
                                        {{ $student->birth_date ? date('d-m-Y', strtotime($student->birth_date)) : '-' }}
                                    </span>
                                </td>
                                <td class="p-3 sm:p-4">
                                    @if ($student->birth_date)
                                        @php
                                            $age = \Carbon\Carbon::parse($student->birth_date)->age;
                                        @endphp
                                        <span
                                            class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                                            {{ $age }} Tahun
                                        </span>
                                    @elseif ($student->birth_year)
                                        @php
                                            $age = date('Y') - $student->birth_year;
                                        @endphp
                                        <span
                                            class="bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap">
                                            ~{{ $age }} Tahun (Est)
                                        </span>
                                    @else
                                        <span class="text-slate-500 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="p-3 sm:p-4 text-slate-300">
                                    {{ $student->parent_name }}
                                    <span class="block text-xs text-slate-400">
                                        <a href="https://wa.me/{{ $student->parent_phone }}" target="_blank"
                                            class="hover:text-emerald-400 underline flex items-center gap-1 mt-0.5">
                                            <i class="fa-brands fa-whatsapp text-emerald-500 text-xs"></i>
                                            {{ $student->parent_phone }}
                                        </a>
                                    </span>
                                </td>
                                <!-- Tombol Toggle Status Modern -->
                                <td class="p-3 sm:p-4 text-center">
                                    <button type="button"
                                        onclick="toggleStatus(this, '{{ route('students.toggleStatus', $student->id) }}')"
                                        class="relative inline-flex h-6 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $student->status === 'active' ? 'bg-emerald-500 shadow-lg shadow-emerald-500/30' : 'bg-slate-700' }}"
                                        role="switch"
                                        aria-checked="{{ $student->status === 'active' ? 'true' : 'false' }}">
                                        <span class="sr-only">Toggle Status</span>
                                        <span
                                            class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow-md ring-0 transition duration-200 ease-in-out {{ $student->status === 'active' ? 'translate-x-6' : 'translate-x-0' }}">
                                            <span
                                                class="absolute inset-0 flex h-full w-full items-center justify-center text-[9px] font-bold {{ $student->status === 'active' ? 'text-emerald-600' : 'text-slate-500' }}">
                                                {{ $student->status === 'active' ? 'ON' : 'OFF' }}
                                            </span>
                                        </span>
                                    </button>
                                </td>
                                <td class="p-3 sm:p-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5 sm:gap-2">
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-white border border-amber-500/20 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition flex items-center gap-1">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i> Edit
                                        </a>

                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white border border-red-500/20 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition flex items-center gap-1">
                                                <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-500">
                                    <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                    Tidak ada data siswa yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            @if ($students->hasPages())
                <div
                    class="px-6 py-4 bg-slate-950/50 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-400">
                        Menampilkan
                        <span class="font-semibold text-white">{{ $students->firstItem() }}</span> sampai
                        <span class="font-semibold text-white">{{ $students->lastItem() }}</span> dari
                        <span class="font-semibold text-white">{{ $students->total() }}</span> data siswa
                    </div>
                    <div>
                        {{ $students->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Script JavaScript Terintegrasi -->
    <script>
        let searchTimer;

        function fetchStudents(url = "{{ route('students.index') }}") {
            const search = document.getElementById('search-input').value;
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;

            // Buat objek URL berdasarkan target URL yang dikirim (bisa dari pagination page 2, 3, dst)
            const fetchUrl = new URL(url, window.location.origin);

            // Pertahankan atau masukkan parameter filter
            if (search) fetchUrl.searchParams.set('search', search);
            else fetchUrl.searchParams.delete('search');

            if (startDate) fetchUrl.searchParams.set('start_date', startDate);
            else fetchUrl.searchParams.delete('start_date');

            if (endDate) fetchUrl.searchParams.set('end_date', endDate);
            else fetchUrl.searchParams.delete('end_date');

            fetch(fetchUrl.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContainer = doc.getElementById('student-table-container');

                    if (newContainer) {
                        document.getElementById('student-table-container').innerHTML = newContainer.innerHTML;
                    }
                    window.history.pushState({}, '', fetchUrl.toString());
                })
                .catch(error => console.error('Error:', error));
        }

        // Live Search dengan Debounce
        document.getElementById('search-input').addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => fetchStudents(), 300);
        });

        // Filter Tanggal
        document.getElementById('start-date').addEventListener('change', () => fetchStudents());
        document.getElementById('end-date').addEventListener('change', () => fetchStudents());

        // Reset Filter
        document.getElementById('reset-filter').addEventListener('click', function() {
            document.getElementById('search-input').value = '';
            document.getElementById('start-date').value = '';
            document.getElementById('end-date').value = '';
            fetchStudents();
        });

        // Toggle Status Instan (Optimistic UI)
        function toggleStatus(button, url) {
            const knob = button.querySelector('span.transform');
            const label = knob.querySelector('span');
            const isActive = button.classList.contains('bg-emerald-500');

            if (isActive) {
                button.classList.remove('bg-emerald-500', 'shadow-lg', 'shadow-emerald-500/30');
                button.classList.add('bg-slate-700');
                knob.classList.remove('translate-x-6');
                knob.classList.add('translate-x-0');
                label.textContent = 'OFF';
                label.classList.remove('text-emerald-600');
                label.classList.add('text-slate-500');
                button.setAttribute('aria-checked', 'false');
            } else {
                button.classList.remove('bg-slate-700');
                button.classList.add('bg-emerald-500', 'shadow-lg', 'shadow-emerald-500/30');
                knob.classList.remove('translate-x-0');
                knob.classList.add('translate-x-6');
                label.textContent = 'ON';
                label.classList.remove('text-slate-500');
                label.classList.add('text-emerald-600');
                button.setAttribute('aria-checked', 'true');
            }

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        _method: 'PATCH'
                    })
                })
                .catch(error => {
                    console.error('Error:', error);
                    fetchStudents(window.location.href);
                });
        }

        // Tangkap klik pagination secara global (Mendukung link pagination Laravel manapun)
        document.addEventListener('click', function(e) {
            const paginationLink = e.target.closest(
                '#student-table-container nav a, #student-table-container .pagination a');
            if (paginationLink) {
                e.preventDefault();
                fetchStudents(paginationLink.href);
            }
        });
    </script>
</x-admin-layout>
