{{-- <!-- Script untuk Handler WhatsApp & CSS Print Helper -->
<script>
    function sendWhatsApp(dbPhone, message) {
        let phone = dbPhone;
        if (!phone || phone.trim() === '') {
            let inputPhone = prompt(
                "Nomor WhatsApp siswa di database belum ada. Masukkan nomor tujuan (Contoh: 08123456789):");
            if (!inputPhone) return;
            phone = inputPhone.replace(/[^0-9]/g, '');
            if (phone.startsWith('0')) {
                phone = '62' + phone.substring(1);
            }
        }
        let encodedMessage = encodeURIComponent(message);
        window.open(`https://wa.me/${phone}?text=${encodedMessage}`, '_blank');
    }
</script>

<style>
    @media print {

        /* Atur ukuran kertas otomatis ke A4 dan hilangkan margin bawaan browser */
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }

        /* Sembunyikan sidebar, navbar atas, dan elemen layout admin bawaan */
        aside,
        nav,
        header,
        footer,
        .print\:hidden {
            display: none !important;
        }

        /* Pastikan background & container utama tampil bersih penuh */
        body {
            background-color: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact;
            /* Agar warna latar/tabel ikut tercetak */
        }

        /* Hilangkan shadow agar pas di kertas */
        .print\:shadow-none {
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Tombol Navigasi & Kirim WA (Sembunyikan saat diprint) -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 print:hidden">
            <a href="{{ route('grades.index') }}"
                class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition w-full sm:w-auto text-center">
                &larr; Kembali ke Daftar
            </a>

            <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto justify-end">
                @php
                    $rawPhone = $student->parent_phone ?? '';
                    $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
                    if (substr($cleanPhone, 0, 1) === '0') {
                        $cleanPhone = '62' + substr($cleanPhone, 1);
                    }

                    $pdfLink = route('grades.pdf', $student->id);
                    $waMessage = "Halo Kak/Bapak/Ibu wali dari *{$student->name}*,\n\nBerikut adalah rapot perkembangan akademi terbaru. Anda dapat mengunduh file PDF resminya melalui tautan berikut:\n{$pdfLink}\n\nTerima kasih! \u26BD";
                @endphp

                <!-- Tombol Kirim WhatsApp -->
                <button type="button" onclick="sendWhatsApp('{{ $cleanPhone }}', {{ json_encode($waMessage) }})"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-lg shadow-emerald-600/20 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span>Kirim ke WhatsApp</span>
                </button>

                <!-- Tombol Download PDF -->
                <a href="{{ route('grades.pdf', $student->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-lg shadow-blue-600/20 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Download PDF</span>
                </a>

                <!-- Tombol Cetak Browser -->
                <button onclick="window.print()"
                    class="bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    <span>Cetak</span>
                </button>
            </div>
        </div>

        <!-- LEMBAR RAPOT UTAMA -->
        <div
            class="bg-white text-slate-900 p-6 sm:p-12 rounded-2xl shadow-2xl border border-slate-200 print:shadow-none print:border-none print:p-0">

            <!-- Kop Surat Akademi -->
            <div class="text-center border-b-2 border-slate-900 pb-6 mb-6">
                <h1 class="text-xl sm:text-2xl font-black uppercase tracking-wider text-slate-900">AKADEMI SEPAKBOLA /
                    OLAHRAGA
                </h1>
                <p class="text-xs text-slate-600 mt-1">Laporan Perkembangan & Penilaian Kompetensi Siswa (E-Rapot)</p>
            </div>

            <!-- Identitas Siswa -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl mb-6 text-sm border border-slate-200">
                <div>
                    <p class="text-slate-500 text-xs">Nama Siswa</p>
                    <p class="font-bold text-slate-900 text-base">{{ $student->name }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-slate-500 text-xs">Tanggal Cetak</p>
                    <p class="font-bold text-slate-900">{{ date('d M Y') }}</p>
                </div>
            </div>

            <!-- Daftar Nilai per Periode -->
            @forelse($gradesByPeriod as $period => $grades)
                <div class="mb-8">
                    <h3
                        class="text-xs sm:text-sm font-bold bg-slate-900 text-white px-4 py-2.5 rounded-t-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1">
                        <span>Periode: {{ $period }}</span>
                        <span class="text-[11px] sm:text-xs font-normal text-slate-300">
                            @if ($grades->first()->start_date && $grades->first()->end_date)
                                ({{ date('d M Y', strtotime($grades->first()->start_date)) }} -
                                {{ date('d M Y', strtotime($grades->first()->end_date)) }})
                            @endif
                        </span>
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-slate-300 text-sm min-w-[550px]">
                            <thead>
                                <tr class="bg-slate-100 text-slate-700 text-xs uppercase">
                                    <th class="border border-slate-300 py-2.5 px-4 w-12 text-center">No</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Aspek Penilaian</th>
                                    <th class="border border-slate-300 py-2.5 px-4 text-center w-28">Skor (0-100)</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Pelatih Penilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $index => $grade)
                                    <tr>
                                        <!-- Nomor -->
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-medium text-slate-900">
                                            {{ $index + 1 }}
                                        </td>

                                        <!-- Aspek Penilaian -->
                                        <td class="border border-slate-300 py-2.5 px-4 font-medium text-slate-900">
                                            {{ $grade->aspect }}
                                        </td>

                                        <!-- Skor -->
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-bold text-emerald-600">
                                            {{ $grade->score }}
                                        </td>

                                        <!-- Pelatih Penilai & Tombol Edit -->
                                        <td class="border border-slate-300 py-2.5 px-4 text-slate-600 text-xs">
                                            <div class="flex justify-between items-center gap-2">
                                                <span>{{ $grade->coach_name ?? 'Pelatih' }}</span>
                                                <a href="{{ route('grades.edit', $grade->id) }}"
                                                    class="bg-amber-500/10 text-amber-500 hover:bg-amber-500/20 px-2.5 py-1 rounded text-xs font-semibold print:hidden transition inline-flex items-center gap-1 shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Rata-rata & Catatan -->
                    <div
                        class="bg-slate-50 border-x border-b border-slate-300 p-4 rounded-b-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                        <div>
                            <span class="font-semibold text-slate-700">Catatan Pelatih:</span>
                            <p class="text-slate-600 italic mt-0.5">
                                "{{ $grades->first()->notes ?? 'Tidak ada catatan khusus.' }}"</p>
                        </div>
                        <div class="sm:text-right shrink-0">
                            <span class="text-slate-500">Rata-rata Skor:</span>
                            <span
                                class="text-base font-black text-slate-900 ml-2">{{ number_format($grades->avg('score'), 1) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 py-8">Belum ada catatan nilai untuk siswa ini.</p>
            @endforelse

            <!-- Tanda Tangan -->
            <div
                class="mt-12 sm:mt-16 flex flex-col sm:flex-row justify-between items-center sm:items-start text-xs pt-8 gap-10 sm:gap-4">
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Orang Tua / Wali Siswa</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</p>
                </div>
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Pelatih / Kepala Akademi</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">(
                        {{ auth()->user()->name ?? 'Administrator' }} )</p>
                </div>
            </div>

        </div>

    </div>
</x-admin-layout> --}}
<!-- Script untuk Handler Dropdown, WhatsApp, & Print -->
{{-- <script>
    function updateSelectedReport() {
        const select = document.getElementById('periodSelector');
        const selectedOption = select.options[select.selectedIndex];
        const selectedPeriod = select.value;
        const pdfBaseUrl = select.getAttribute('data-pdf-url');
        const studentName = select.getAttribute('data-student-name');
        const studentPhone = select.getAttribute('data-student-phone');

        // 1. Sembunyikan semua blok periode, tampilkan hanya yang dipilih
        document.querySelectorAll('.report-period-block').forEach(el => {
            if (el.getAttribute('data-period') === selectedPeriod) {
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        });

        // 2. Update teks keterangan periode aktif saat print/pdf
        const printTextEl = document.getElementById('printActivePeriodText');
        if (printTextEl) printTextEl.innerText = "Laporan Perkembangan Siswa Periode: " + selectedPeriod;

        // 3. Update link Tombol Download PDF
        const pdfBtn = document.getElementById('btnDownloadPdf');
        if (pdfBtn) pdfBtn.href = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;

        // 4. Update Pesan WhatsApp & Tombol Kirim WA
        const waBtn = document.getElementById('btnSendWa');
        if (waBtn) {
            const pdfLinkWithPeriod = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;
            const waMessage =
                `Halo Kak/Bapak/Ibu wali dari *${studentName}*,\n\nBerikut adalah rapot perkembangan akademi periode *${selectedPeriod}*. Anda dapat mengunduh file PDF resminya melalui tautan berikut:\n${pdfLinkWithPeriod}\n\nTerima kasih! \u26BD`;

            waBtn.setAttribute('onclick', `sendWhatsApp('${studentPhone}', ${JSON.stringify(waMessage)})`);
        }
    }

    function sendWhatsApp(dbPhone, message) {
        let phone = dbPhone;
        if (!phone || phone.trim() === '') {
            let inputPhone = prompt("Nomor WhatsApp belum tersedia. Masukkan nomor tujuan (Contoh: 08123456789):");
            if (!inputPhone) return;
            phone = inputPhone.replace(/[^0-9]/g, '');
            if (phone.startsWith('0')) {
                phone = '62' + phone.substring(1);
            }
        }
        let encodedMessage = encodeURIComponent(message);
        window.open(`https://wa.me/${phone}?text=${encodedMessage}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSelectedReport(); // Jalankan saat halaman pertama kali dimuat
    });
</script>

<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }

        aside,
        nav,
        header,
        footer,
        .print\:hidden {
            display: none !important;
        }

        body {
            background-color: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact;
        }

        .print\:shadow-none {
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        @php
            $rawPhone = $student->parent_phone ?? '';
            $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
            if (substr($cleanPhone, 0, 1) === '0') {
                $cleanPhone = '62' + substr($cleanPhone, 1);
            }
            $pdfBaseRoute = route('grades.pdf', $student->id);
            // Ambil daftar kunci periode dari data $gradesByPeriod
            $availablePeriods = array_keys($gradesByPeriod->toArray());
            $defaultPeriod = count($availablePeriods) > 0 ? $availablePeriods[0] : '';
        @endphp

        <!-- Panel Kontrol & Navigasi (Sembunyikan saat diprint) -->
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-800 p-4 rounded-2xl shadow-md print:hidden">
            <a href="{{ route('grades.index') }}"
                class="bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition w-full md:w-auto text-center">
                &larr; Kembali
            </a>

            <!-- Dropdown Pilihan Periode Rapot -->
            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-xs text-slate-300 font-medium shrink-0">Pilih Periode:</span>
                <select id="periodSelector" onchange="updateSelectedReport()" data-pdf-url="{{ $pdfBaseRoute }}"
                    data-student-name="{{ $student->name }}" data-student-phone="{{ $cleanPhone }}"
                    class="bg-slate-900 text-white text-xs font-semibold px-3 py-2 rounded-xl border border-slate-700 focus:outline-none focus:border-emerald-500 w-full md:w-48">
                    @forelse($gradesByPeriod as $period => $grades)
                        <option value="{{ $period }}">{{ $period }}</option>
                    @empty
                        <option value="">Tidak ada periode</option>
                    @endforelse
                </select>
            </div>

            <!-- Tombol Aksi (WhatsApp, PDF, Cetak) -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto justify-end">
                <!-- Tombol Kirim WhatsApp -->
                <button type="button" id="btnSendWa"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span>Kirim WA</span>
                </button>

                <!-- Tombol Download PDF -->
                <a id="btnDownloadPdf" href="{{ $pdfBaseRoute }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>PDF</span>
                </a>

                <!-- Tombol Cetak Browser -->
                <button onclick="window.print()"
                    class="bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    <span>Cetak</span>
                </button>
            </div>
        </div>

        <!-- LEMBAR RAPOT UTAMA -->
        <div
            class="bg-white text-slate-900 p-6 sm:p-12 rounded-2xl shadow-2xl border border-slate-200 print:shadow-none print:border-none print:p-0">

            <!-- Kop Surat Akademi -->
            <div class="text-center border-b-2 border-slate-900 pb-6 mb-6">
                <h1 class="text-xl sm:text-2xl font-black uppercase tracking-wider text-slate-900">AKADEMI SEPAKBOLA /
                    OLAHRAGA</h1>
                <p class="text-xs text-slate-600 mt-1">Laporan Perkembangan & Penilaian Kompetensi Siswa (E-Rapot)</p>
            </div>

            <!-- Identitas Siswa -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl mb-6 text-sm border border-slate-200">
                <div>
                    <p class="text-slate-500 text-xs">Nama Siswa</p>
                    <p class="font-bold text-slate-900 text-base">{{ $student->name }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-slate-500 text-xs">Tanggal Cetak</p>
                    <p class="font-bold text-slate-900">{{ date('d M Y') }}</p>
                </div>
            </div>

            <!-- Keterangan Periode Aktif untuk Print/PDF -->
            <div id="printActivePeriodText"
                class="hidden print:block text-center mb-6 text-sm font-semibold text-slate-800 border border-slate-300 bg-slate-50 p-3 rounded-lg">
                Laporan Perkembangan Siswa
            </div>

            <!-- Looping Semua Periode (Disembunyikan/Ditampilkan lewat JS secara dinamis) -->
            @forelse($gradesByPeriod as $period => $grades)
                <div class="report-period-block mb-8" data-period="{{ $period }}">
                    <h3
                        class="text-xs sm:text-sm font-bold bg-slate-900 text-white px-4 py-2.5 rounded-t-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1">
                        <span>Periode: {{ $period }}</span>
                        <span class="text-[11px] sm:text-xs font-normal text-slate-300">
                            @if ($grades->first()->start_date && $grades->first()->end_date)
                                ({{ date('d M Y', strtotime($grades->first()->start_date)) }} -
                                {{ date('d M Y', strtotime($grades->first()->end_date)) }})
                            @endif
                        </span>
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-slate-300 text-sm min-w-[550px]">
                            <thead>
                                <tr class="bg-slate-100 text-slate-700 text-xs uppercase">
                                    <th class="border border-slate-300 py-2.5 px-4 w-12 text-center">No</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Aspek Penilaian</th>
                                    <th class="border border-slate-300 py-2.5 px-4 text-center w-28">Skor (0-100)</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Pelatih Penilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $index => $grade)
                                    <tr>
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-medium text-slate-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="border border-slate-300 py-2.5 px-4 font-medium text-slate-900">
                                            {{ $grade->aspect }}
                                        </td>
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-bold text-emerald-600">
                                            {{ $grade->score }}
                                        </td>
                                        <td class="border border-slate-300 py-2.5 px-4 text-slate-600 text-xs">
                                            <div class="flex justify-between items-center gap-2">
                                                <span>{{ $grade->coach_name ?? 'Pelatih' }}</span>
                                                <a href="{{ route('grades.edit', $grade->id) }}"
                                                    class="bg-amber-500/10 text-amber-500 hover:bg-amber-500/20 px-2.5 py-1 rounded text-xs font-semibold print:hidden transition inline-flex items-center gap-1 shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Rata-rata & Catatan -->
                    <div
                        class="bg-slate-50 border-x border-b border-slate-300 p-4 rounded-b-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                        <div>
                            <span class="font-semibold text-slate-700">Catatan Pelatih:</span>
                            <p class="text-slate-600 italic mt-0.5">
                                "{{ $grades->first()->notes ?? 'Tidak ada catatan khusus.' }}"</p>
                        </div>
                        <div class="sm:text-right shrink-0">
                            <span class="text-slate-500">Rata-rata Skor:</span>
                            <span
                                class="text-base font-black text-slate-900 ml-2">{{ number_format($grades->avg('score'), 1) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 py-8">Belum ada catatan nilai untuk siswa ini.</p>
            @endforelse

            <!-- Tanda Tangan -->
            <div
                class="mt-12 sm:mt-16 flex flex-col sm:flex-row justify-between items-center sm:items-start text-xs pt-8 gap-10 sm:gap-4">
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Orang Tua / Wali Siswa</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</p>
                </div>
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Pelatih / Kepala Akademi</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">(
                        {{ auth()->user()->name ?? 'Administrator' }} )</p>
                </div>
            </div>

        </div>

    </div>
</x-admin-layout> --}}

<!-- Script untuk Handler Dropdown, WhatsApp, & Print -->
{{-- <script>
    function updateSelectedReport() {
        const select = document.getElementById('periodSelector');
        if (!select) return;

        const selectedOption = select.options[select.selectedIndex];
        const selectedPeriod = select.value;
        const pdfBaseUrl = select.getAttribute('data-pdf-url');
        const studentName = select.getAttribute('data-student-name');

        // Ambil nomor HP langsung dari atribut data (sudah dibersihkan di PHP)
        let studentPhone = select.getAttribute('data-student-phone');

        // 1. Sembunyikan semua blok periode, tampilkan hanya yang dipilih
        document.querySelectorAll('.report-period-block').forEach(el => {
            if (el.getAttribute('data-period') === selectedPeriod) {
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        });

        // 2. Update teks keterangan periode aktif saat print/pdf
        const printTextEl = document.getElementById('printActivePeriodText');
        if (printTextEl) printTextEl.innerText = "Laporan Perkembangan Siswa Periode: " + selectedPeriod;

        // 3. Update link Tombol Download PDF
        const pdfBtn = document.getElementById('btnDownloadPdf');
        if (pdfBtn) pdfBtn.href = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;

        // 4. Update Pesan WhatsApp & Tombol Kirim WA
        const waBtn = document.getElementById('btnSendWa');
        if (waBtn) {
            const pdfLinkWithPeriod = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;
            const waMessage =
                `Halo Kak/Bapak/Ibu wali dari *${studentName}*,\n\nBerikut adalah rapot perkembangan akademi periode *${selectedPeriod}*. Anda dapat mengunduh file PDF resminya melalui tautan berikut:\n${pdfLinkWithPeriod}\n\nTerima kasih! \u26BD`;

            // Simpan data nomor telepon dan pesan ke atribut tombol agar mudah dipanggil
            waBtn.onclick = function() {
                sendWhatsApp(studentPhone, waMessage);
            };
        }
    }

    function sendWhatsApp(dbPhone, message) {
        let phone = dbPhone;

        // Jika nomor HP kosong di database, minta admin memasukkannya lewat prompt
        if (!phone || phone.trim() === '' || phone === 'null') {
            let inputPhone = prompt(
                "Nomor WhatsApp orang tua belum terdaftar di database. Masukkan nomor tujuan (Contoh: 08123456789):"
            );
            if (!inputPhone) return;
            phone = inputPhone.replace(/[^0-9]/g, '');
        }

        // Format nomor HP ke standar Internasional (62...)
        if (phone.startsWith('0')) {
            phone = '62' + phone.substring(1);
        }

        let encodedMessage = encodeURIComponent(message);
        window.open(`https://wa.me/${phone}?text=${encodedMessage}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSelectedReport(); // Jalankan saat halaman pertama kali dimuat
    });
</script> --}}
<script>
    function updateSelectedReport() {
        const select = document.getElementById('periodSelector');
        if (!select) return;

        const selectedPeriod = select.value;
        const pdfBaseUrl = select.getAttribute('data-pdf-url');
        const studentName = select.getAttribute('data-student-name');
        let studentPhone = select.getAttribute('data-student-phone');

        // Toggle tampilan blok periode
        document.querySelectorAll('.report-period-block').forEach(el => {
            el.style.display = (el.getAttribute('data-period') === selectedPeriod) ? 'block' : 'none';
        });

        // Update teks print
        const printTextEl = document.getElementById('printActivePeriodText');
        if (printTextEl) printTextEl.innerText = "Laporan Perkembangan Siswa Periode: " + selectedPeriod;

        // Update URL download PDF
        const pdfBtn = document.getElementById('btnDownloadPdf');
        if (pdfBtn) pdfBtn.href = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;

        // Update Handler Tombol WhatsApp
        const waBtn = document.getElementById('btnSendWa');
        if (waBtn) {
            const pdfLinkWithPeriod = `${pdfBaseUrl}?period=${encodeURIComponent(selectedPeriod)}`;
            const waMessage =
                `Halo Kak/Bapak/Ibu wali dari *${studentName}*,\n\nBerikut adalah rapot perkembangan akademi periode *${selectedPeriod}*. Anda dapat mengunduh file PDF resminya melalui tautan berikut:\n${pdfLinkWithPeriod}\n\nTerima kasih! \u26BD`;

            waBtn.onclick = function() {
                sendWhatsApp(studentPhone, waMessage);
            };
        }
    }

    function sendWhatsApp(dbPhone, message) {
        let phone = dbPhone;

        if (!phone || phone.trim() === '' || phone === 'null') {
            let inputPhone = prompt(
                "Nomor WhatsApp orang tua belum terdaftar. Masukkan nomor tujuan (Contoh: 08123456789):");
            if (!inputPhone) return;
            phone = inputPhone.replace(/[^0-9]/g, '');
        }

        if (phone.startsWith('0')) {
            phone = '62' + phone.substring(1);
        }

        window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSelectedReport();
    });
</script>

<style>
    @media print {
        @page {
            size: A4 portrait;
            margin: 1.5cm;
        }

        aside,
        nav,
        header,
        footer,
        .print\:hidden {
            display: none !important;
        }

        body {
            background-color: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact;
        }

        .print\:shadow-none {
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<x-admin-layout>
    <div class="max-w-4xl mx-auto space-y-6">

        @php
            // Mengambil dari kolom 'parent_phone' sesuai model Student
            $rawPhone = $student->parent_phone ?? '';
            $cleanPhone = preg_replace('/[^0-9]/', '', $rawPhone);
            if (substr($cleanPhone, 0, 1) === '0') {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            }

            $pdfBaseRoute = route('grades.pdf', $student->id);
            $availablePeriods = array_keys($gradesByPeriod->toArray());
        @endphp


        <!-- Panel Kontrol & Navigasi (Sembunyikan saat diprint) -->
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-slate-800 p-4 rounded-2xl shadow-md print:hidden">
            <a href="{{ route('grades.index') }}"
                class="bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition w-full md:w-auto text-center">
                &larr; Kembali
            </a>

            <!-- Dropdown Pilihan Periode Rapot -->
            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-xs text-slate-300 font-medium shrink-0">Pilih Periode:</span>
                <select id="periodSelector" onchange="updateSelectedReport()" data-pdf-url="{{ $pdfBaseRoute }}"
                    data-student-name="{{ $student->name }}" data-student-phone="{{ $cleanPhone }}"
                    class="bg-slate-900 text-white text-xs font-semibold px-3 py-2 rounded-xl border border-slate-700 focus:outline-none focus:border-emerald-500 w-full md:w-48">
                    @forelse($gradesByPeriod as $period => $grades)
                        <option value="{{ $period }}">{{ $period }}</option>
                    @empty
                        <option value="">Tidak ada periode</option>
                    @endforelse
                </select>
            </div>

            <!-- Tombol Aksi (WhatsApp, PDF, Cetak) -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto justify-end">
                <!-- Tombol Kirim WhatsApp -->
                <button type="button" id="btnSendWa"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span>Kirim WA</span>
                </button>

                <!-- Tombol Download PDF -->
                <a id="btnDownloadPdf" href="{{ $pdfBaseRoute }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>PDF</span>
                </a>

                <!-- Tombol Cetak Browser -->
                <button onclick="window.print()"
                    class="bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold px-3 py-2.5 rounded-xl shadow transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    <span>Cetak</span>
                </button>
            </div>
        </div>

        <!-- LEMBAR RAPOT UTAMA -->
        <div
            class="bg-white text-slate-900 p-6 sm:p-12 rounded-2xl shadow-2xl border border-slate-200 print:shadow-none print:border-none print:p-0">

            <!-- Kop Surat Akademi -->
            <div class="text-center border-b-2 border-slate-900 pb-6 mb-6">
                <h1 class="text-xl sm:text-2xl font-black uppercase tracking-wider text-slate-900">DUBER FUTSAL AKADEMI
                </h1>
                <p class="text-xs text-slate-600 mt-1">Laporan Perkembangan & Penilaian Kompetensi Siswa (E-Rapot)</p>
            </div>

            <!-- Identitas Siswa -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-4 rounded-xl mb-6 text-sm border border-slate-200">
                <div>
                    <p class="text-slate-500 text-xs">Nama Siswa</p>
                    <p class="font-bold text-slate-900 text-base">{{ $student->name }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-slate-500 text-xs">Tanggal Cetak</p>
                    <p class="font-bold text-slate-900">{{ date('d M Y') }}</p>
                </div>
            </div>

            <!-- Keterangan Periode Aktif untuk Print/PDF -->
            <div id="printActivePeriodText"
                class="hidden print:block text-center mb-6 text-sm font-semibold text-slate-800 border border-slate-300 bg-slate-50 p-3 rounded-lg">
                Laporan Perkembangan Siswa
            </div>

            <!-- Looping Semua Periode -->
            @forelse($gradesByPeriod as $period => $grades)
                <div class="report-period-block mb-8" data-period="{{ $period }}">
                    <h3
                        class="text-xs sm:text-sm font-bold bg-slate-900 text-white px-4 py-2.5 rounded-t-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1">
                        <span>Periode: {{ $period }}</span>
                        <span class="text-[11px] sm:text-xs font-normal text-slate-300">
                            @if ($grades->first()->start_date && $grades->first()->end_date)
                                ({{ date('d M Y', strtotime($grades->first()->start_date)) }} -
                                {{ date('d M Y', strtotime($grades->first()->end_date)) }})
                            @endif
                        </span>
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse border border-slate-300 text-sm min-w-[550px]">
                            <thead>
                                <tr class="bg-slate-100 text-slate-700 text-xs uppercase">
                                    <th class="border border-slate-300 py-2.5 px-4 w-12 text-center">No</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Aspek Penilaian</th>
                                    <th class="border border-slate-300 py-2.5 px-4 text-center w-28">Skor (0-100)</th>
                                    <th class="border border-slate-300 py-2.5 px-4">Pelatih Penilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $index => $grade)
                                    <tr>
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-medium text-slate-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="border border-slate-300 py-2.5 px-4 font-medium text-slate-900">
                                            {{ $grade->aspect }}
                                        </td>
                                        <td
                                            class="border border-slate-300 py-2.5 px-4 text-center font-bold text-emerald-600">
                                            {{ $grade->score }}
                                        </td>
                                        <td class="border border-slate-300 py-2.5 px-4 text-slate-600 text-xs">
                                            <div class="flex justify-between items-center gap-2">
                                                <span>{{ $grade->coach_name ?? 'Pelatih' }}</span>
                                                <a href="{{ route('grades.edit', $grade->id) }}"
                                                    class="bg-amber-500/10 text-amber-500 hover:bg-amber-500/20 px-2.5 py-1 rounded text-xs font-semibold print:hidden transition inline-flex items-center gap-1 shrink-0">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Rata-rata & Catatan -->
                    <div
                        class="bg-slate-50 border-x border-b border-slate-300 p-4 rounded-b-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                        <div>
                            <span class="font-semibold text-slate-700">Catatan Pelatih:</span>
                            <p class="text-slate-600 italic mt-0.5">
                                "{{ $grades->first()->notes ?? 'Tidak ada catatan khusus.' }}"</p>
                        </div>
                        <div class="sm:text-right shrink-0">
                            <span class="text-slate-500">Rata-rata Skor:</span>
                            <span
                                class="text-base font-black text-slate-900 ml-2">{{ number_format($grades->avg('score'), 1) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 py-8">Belum ada catatan nilai untuk siswa ini.</p>
            @endforelse

            <!-- Tanda Tangan -->
            <div
                class="mt-12 sm:mt-16 flex flex-col sm:flex-row justify-between items-center sm:items-start text-xs pt-8 gap-10 sm:gap-4">
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Orang Tua / Wali Siswa</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">( &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; )</p>
                </div>
                <div class="text-center w-full sm:w-auto">
                    <p class="mb-12 sm:mb-16">Pelatih / Kepala Akademi</p>
                    <p class="font-bold border-b border-slate-400 pb-1 px-8">(
                        {{ auth()->user()->name ?? 'Administrator' }} )</p>
                </div>
            </div>

        </div>
        <!-- Bagian Section Chart Berdasarkan Aspek -->
        <!-- Bagian Section Chart Kombinasi Bar & Line (Maksimal 6 Bulan Terakhir) -->
        <div class="card border shadow-sm rounded-4 overflow-hidden mb-4" style="background-color: #ffffff;">
            <div
                class="card-header bg-transparent border-bottom pt-4 px-4 pb-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="fw-bold mb-1" style="color: #212529;">Grafik Perkembangan Aspek</h5>
                    <p class="small mb-0" style="color: #6c757d;">Visualisasi skor siswa (Maksimal 6 Bulan Terakhir)
                    </p>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <div class="input-group input-group-sm shadow-sm rounded-pill overflow-hidden border"
                        style="background-color: #f8f9fa;">
                        <span class="input-group-text border-0 px-3"
                            style="background-color: #f8f9fa; color: #6c757d;">
                            <i class="fas fa-filter"></i>
                        </span>
                        <select id="aspectPeriodSelector"
                            class="form-select border-0 fw-semibold py-2 pe-4 shadow-none"
                            style="cursor: pointer; background-color: #f8f9fa; color: #212529;"
                            onchange="updateAspectChart()">
                            @php
                                $allAspects = collect();
                                foreach ($gradesByPeriod as $period => $grades) {
                                    foreach ($grades as $grade) {
                                        $allAspects->push($grade->aspect);
                                    }
                                }
                                $uniqueAspects = $allAspects->unique()->values();
                            @endphp

                            @foreach ($uniqueAspects as $aspect)
                                <option value="{{ $aspect }}" {{ $loop->first ? 'selected' : '' }}>
                                    {{ $aspect }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-body px-4 pb-4 pt-3" style="background-color: #ffffff;">
                <div style="position: relative; height: 380px; width: 100%;">
                    <canvas id="studentAspectChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Script Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            let aspectChart = null;
            const rawGradesData = @json($gradesByPeriod);

            function initAspectChart(selectedAspect) {
                const ctx = document.getElementById('studentAspectChart').getContext('2d');

                let periods = [];
                let scores = [];

                // 1. Ambil semua data dari database
                for (const [period, grades] of Object.entries(rawGradesData)) {
                    const found = grades.find(item => item.aspect === selectedAspect);
                    if (found) {
                        periods.push(period);
                        scores.push(found.score);
                    }
                }

                // 2. POTONG HANYA 6 DATA TERAKHIR DI SINI
                if (periods.length > 6) {
                    periods = periods.slice(-6);
                    scores = scores.slice(-6);
                }

                if (aspectChart) {
                    aspectChart.destroy();
                }

                let barGradient = ctx.createLinearGradient(0, 0, 0, 350);
                barGradient.addColorStop(0, 'rgba(99, 102, 241, 0.85)');
                barGradient.addColorStop(1, 'rgba(168, 85, 247, 0.3)');

                aspectChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: periods, // Menggunakan data yang sudah dipotong 6 terakhir
                        datasets: [{
                                type: 'bar',
                                label: 'Skor Bar',
                                data: scores, // Menggunakan data yang sudah dipotong 6 terakhir
                                backgroundColor: barGradient,
                                borderColor: 'rgba(99, 102, 241, 1)',
                                borderWidth: 2,
                                borderRadius: 8,
                                barThickness: 'flex',
                                maxBarThickness: 50
                            },
                            {
                                type: 'line',
                                label: 'Tren Garis',
                                data: scores, // Menggunakan data yang sudah dipotong 6 terakhir
                                borderColor: '#ef4444',
                                backgroundColor: '#ef4444',
                                borderWidth: 3,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                tension: 0.2
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                titleFont: {
                                    size: 13,
                                    weight: 'bold',
                                    color: '#ffffff'
                                },
                                bodyFont: {
                                    size: 13,
                                    color: '#ffffff'
                                },
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        return ` Skor: ${context.raw}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                grid: {
                                    color: 'rgba(226, 232, 240, 0.8)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#475569',
                                    font: {
                                        size: 11,
                                        weight: '500'
                                    },
                                    padding: 8
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#1e293b',
                                    font: {
                                        size: 12,
                                        weight: '600'
                                    },
                                    padding: 8
                                }
                            }
                        }
                    }
                });
            }

            function updateAspectChart() {
                const select = document.getElementById('aspectPeriodSelector');
                if (!select) return;
                initAspectChart(select.value);
            }

            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('aspectPeriodSelector');
                const initialAspect = select ? select.value : null;
                if (initialAspect) {
                    initAspectChart(initialAspect);
                }
            });
        </script>
    </div>
</x-admin-layout>
