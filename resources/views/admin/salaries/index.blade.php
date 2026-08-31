<x-admin-layout>
    <x-slot:header>Rekap Gaji Pelatih (Berdasarkan Rentang Tanggal)</x-slot:header>

    <div class="space-y-6">
        <div
            class="bg-slate-900 border border-slate-800 p-4 sm:p-6 rounded-2xl flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4">
            <form method="GET" action="{{ route('salaries.index') }}"
                class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="flex items-center gap-2">
                    <label class="text-xs text-slate-400 whitespace-nowrap">Dari:</label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-xs text-slate-400 whitespace-nowrap">Sampai:</label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition text-center">Filter</button>
            </form>

            <button onclick="openModal()"
                class="bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-calculator"></i> Hitung Gaji Periode Ini
            </button>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr
                            class="border-b border-slate-800 text-slate-400 text-xs uppercase tracking-wider bg-slate-950/50">
                            <th class="p-4">Nama Pelatih</th>
                            <th class="p-4 text-center">Total Hadir (Periode Ini)</th>
                            <th class="p-4">Honor / Sesi</th>
                            <th class="p-4">Total Gaji</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse($coaches as $coach)
                            @php
                                $salary = $salaries[$coach->id] ?? null;
                            @endphp
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="p-4 font-medium text-white">{{ $coach->name }}</td>
                                <td class="p-4 text-center font-bold text-emerald-400">
                                    {{ $salary->total_sessions ?? 0 }} Sesi</td>
                                <td class="p-4 text-slate-300">Rp
                                    {{ number_format($salary->fee_per_session ?? 0, 0, ',', '.') }}</td>
                                <td class="p-4 font-extrabold text-white">Rp
                                    {{ number_format($salary->total_salary ?? 0, 0, ',', '.') }}</td>
                                <td class="p-4 text-center">
                                    @if ($salary && $salary->status === 'Paid')
                                        <span
                                            class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full text-xs font-semibold">Lunas</span>
                                    @else
                                        <span
                                            class="bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-semibold">Belum
                                            Dibayar</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if ($salary && $salary->status === 'Unpaid')
                                        <form action="{{ route('salaries.paid', $salary->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-emerald-600/10 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                Tandai Lunas
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-500 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-slate-500">Belum ada data pelatih.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Input Honor Per Sesi dengan Format Rupiah -->
    <div id="salaryModal"
        class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center hidden p-4">
        <div class="bg-slate-900 border border-slate-800 w-full max-w-md p-6 rounded-2xl space-y-4 shadow-2xl">
            <h3 class="text-lg font-bold text-white">Generate Gaji Pelatih</h3>
            <p class="text-xs text-slate-400">Sistem akan menghitung total kehadiran status "Hadir" dari tanggal <span
                    class="text-emerald-400 font-semibold">{{ $startDate }}</span> sampai <span
                    class="text-emerald-400 font-semibold">{{ $endDate }}</span>.</p>

            <form action="{{ route('salaries.generate') }}" method="POST" class="space-y-4"
                onsubmit="cleanRupiahBeforeSubmit(this)">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">

                <!-- Input yang terlihat oleh user -->
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-2">Honor Per Sesi Mengajar (Rp)</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500 text-sm font-semibold">Rp</span>
                        <input type="text" id="formatted_fee" required placeholder="75.000"
                            oninput="formatRupiahInput(this)"
                            class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-12 pr-4 py-2.5 text-white text-sm focus:outline-none focus:border-emerald-500">
                    </div>
                    <!-- Input tersembunyi yang dikirim ke controller berupa angka murni -->
                    <input type="hidden" name="fee_per_session" id="raw_fee">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal()"
                        class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-xl text-xs font-semibold transition">Batal</button>
                    <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-500 text-white px-4 py-2 rounded-xl text-xs font-semibold transition">Proses
                        Hitung</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('salaryModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('salaryModal').classList.add('hidden');
        }

        // Fungsi otomatis format angka ke Rupiah saat diketik
        function formatRupiahInput(input) {
            let value = input.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = rupiah;

            // Simpan angka murni (tanpa titik) ke input hidden untuk dikirim ke backend
            document.getElementById('raw_fee').value = value.replace(/\./g, '');
        }

        // Bersihkan format sebelum form disubmit
        function cleanRupiahBeforeSubmit(form) {
            let rawInput = document.getElementById('raw_fee');
            if (!rawInput.value) {
                rawInput.value = document.getElementById('formatted_fee').value.replace(/\./g, '');
            }
        }
    </script>
</x-admin-layout>
