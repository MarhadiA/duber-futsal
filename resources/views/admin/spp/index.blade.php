<x-admin-layout>
    <div class="space-y-6">

        <!-- Header & Generator -->
        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-900 p-6 rounded-2xl border border-slate-800">
            <div>
                <h2 class="text-white text-xl font-bold">Rekap SPP Bulanan Siswa</h2>
                <p class="text-slate-400 text-xs mt-1">Pantau status iuran bulanan dan kirim tagihan langsung via
                    WhatsApp.</p>
            </div>



            <!-- Form Generate Tagihan Massal dengan Input Nominal -->

            <!-- Form Generate Tagihan Massal -->
            <form action="{{ route('spp.generate') }}" method="POST"
                class="flex flex-wrap sm:flex-nowrap gap-2 w-full sm:w-auto items-center">
                @csrf
                <!-- Dropdown Bulan -->
                <select name="month"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500"
                    required>
                    <option value="">Pilih Bulan</option>
                    @php
                        $months = [
                            'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember',
                        ];
                        $currentYear = date('Y');
                    @endphp
                    @foreach ($months as $m)
                        @php $value = $m . ' ' . $currentYear; @endphp
                        <option value="{{ $value }}" {{ $month == $value ? 'selected' : '' }}>{{ $value }}
                        </option>
                    @endforeach
                </select>

                <!-- Input Nominal -->
                {{-- <input type="number" name="amount" value="150000" placeholder="Nominal SPP"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500 w-32"
                    required> --}}
                <!-- Input Nominal dengan Format Rupiah -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">Rp</span>
                    <input type="text" id="rupiahInput" placeholder="150.000"
                        class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl pl-9 pr-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500 w-36"
                        value="150.000" required>

                    <!-- Input tersembunyi untuk dikirim ke Controller (berupa angka murni tanpa titik) -->
                    <input type="hidden" name="amount" id="rawAmount" value="150000">
                </div>

                <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-4 py-2 rounded-xl transition shrink-0">
                    ⚡ Generate Massal
                </button>
            </form>
        </div>

        <!-- Filter & Search Bar -->
        <div
            class="bg-slate-900 p-4 rounded-2xl border border-slate-800 flex flex-col sm:flex-row justify-between items-center gap-4">
            {{-- <form action="{{ route('spp.index') }}" method="GET"
                class="flex flex-wrap gap-2 w-full sm:w-auto items-center">
                <span class="text-xs text-slate-400">Pilih Bulan:</span>
                <input type="text" name="month" value="{{ $month }}"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500">

                <select name="status"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="unpaid" {{ $status == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                </select>

                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition">
                    Filter
                </button>
            </form> --}}
            <form action="{{ route('spp.index') }}" method="GET"
                class="flex flex-wrap gap-2 w-full sm:w-auto items-center">
                <span class="text-xs text-slate-400">Pilih Bulan:</span>
                <select name="month" onchange="this.form.submit()"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500">
                    @foreach ($months as $m)
                        @php $value = $m . ' ' . $currentYear; @endphp
                        <option value="{{ $value }}" {{ $month == $value ? 'selected' : '' }}>{{ $value }}
                        </option>
                    @endforeach
                </select>

                <select name="status" onchange="this.form.submit()"
                    class="bg-slate-950 border border-slate-700 text-white text-xs rounded-xl px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="unpaid" {{ $status == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                </select>
            </form>
        </div>

        <!-- Tabel Rekap SPP -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <table class="w-full text-left text-slate-300 text-sm">
                <thead
                    class="bg-slate-950/60 text-slate-400 uppercase text-xs tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Bulan</th>
                        <th class="py-4 px-6">Nominal</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Aksi & WhatsApp Invoice</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse ($students as $student)
                        @php
                            $bill = $student->monthlyBills->first();
                        @endphp
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="py-4 px-6 font-semibold text-white">
                                👤 {{ $student->name }}
                                <div class="text-[11px] text-slate-400 font-normal">No. Telp / WA:
                                    {{ $student->parent_phone ?? 'Tidak ada' }}</div>
                            </td>
                            <td class="py-4 px-6 text-slate-300">
                                {{ $month }}
                            </td>
                            {{-- <td class="py-4 px-6">
                                {{-- <form action="{{ route('spp.update-amount', $bill->id) }}" method="POST"
                                    class="flex items-center gap-1">
                                    @csrf
                                    <input type="number" name="amount" value="{{ $bill->amount ?? 150000 }}"
                                        class="w-28 bg-slate-950 border border-slate-700 text-white text-xs rounded-lg px-2 py-1 outline-none focus:ring-1 focus:ring-emerald-500">
                                    <button type="submit" class="text-emerald-500 hover:text-emerald-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form> --}}
                            {{-- </td> --}}
                            <td class="py-4 px-6 text-white font-medium">
                                @if ($bill)
                                    <span class="text-emerald-400 font-semibold">
                                        Rp {{ number_format($bill->amount, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-slate-500">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if ($bill && $bill->status == 'paid')
                                    <span
                                        class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs px-3 py-1 rounded-full font-semibold">
                                        ✅ Lunas
                                    </span>
                                @else
                                    <span
                                        class="bg-red-500/10 text-red-400 border border-red-500/20 text-xs px-3 py-1 rounded-full font-semibold">
                                        ❌ Belum Bayar
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right flex items-center justify-end gap-2">
                                @if ($bill)
                                    @if ($bill->status == 'paid')
                                        <form action="{{ route('spp.unpaid', $bill->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium px-3 py-1.5 rounded-lg transition"
                                                title="Ubah jadi Belum Lunas">
                                                Batalkan Lunas
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('spp.paid', $bill->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                                Ubah Lunas
                                            </button>
                                        </form>

                                        <!-- TOMBOL LIHAT & KIRIM INVOICE -->
                                        <a href="{{ route('spp.invoice', $bill->id) }}"
                                            class="bg-blue-600/20 text-blue-400 hover:bg-blue-600 hover:text-white border border-blue-500/30 text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                            Lihat & Kirim Invoice
                                        </a>
                                    @endif
                                @else
                                    <span class="text-xs text-slate-500">Belum digenerate</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-slate-500 text-sm">
                                Belum ada data tagihan SPP untuk bulan {{ $month }}. Silakan klik tombol
                                "Generate Tagihan Bulan Ini".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($students->hasPages())
                <div class="p-4 border-t border-slate-800 bg-slate-950/40">
                    {{ $students->links() }}
                </div>
            @endif
        </div>

    </div>
    <script>
        const rupiahInput = document.getElementById('rupiahInput');
        const rawAmount = document.getElementById('rawAmount');

        // Fungsi untuk mengubah angka menjadi format rupiah (contoh: 150000 -> 150.000)
        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // Event listener saat user mengetik di input
        rupiahInput.addEventListener('keyup', function(e) {
            // Tampilkan format rupiah ke input yang dilihat user
            rupiahInput.value = formatRupiah(this.value);

            // Simpan angka murninya (tanpa titik) ke input hidden untuk dikirim ke database
            rawAmount.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</x-admin-layout>
