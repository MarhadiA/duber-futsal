<x-admin-layout>
    <div class="max-w-2xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-white text-xl font-bold">Preview Invoice</h2>
            <a href="{{ route('spp.index') }}" class="text-slate-400 hover:text-white text-sm transition">← Kembali ke
                Rekap</a>
        </div>

        <!-- Kartu Preview -->
        <div class="bg-slate-900 border border-slate-800 p-8 rounded-2xl shadow-2xl">
            <div class="text-center mb-8 border-b border-slate-800 pb-6">
                <h1 class="text-emerald-400 font-bold text-2xl">Duber Futsal Academy</h1>
                <p class="text-slate-400 text-sm mt-1">Invoice Resmi Pembayaran SPP Bulanan</p>
            </div>

            <div class="space-y-4 text-slate-300">
                <div class="flex justify-between border-b border-slate-800/60 pb-3">
                    <span class="text-slate-400">Nama Siswa:</span>
                    <span class="font-semibold text-white">👤 {{ $bill->student->name }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-800/60 pb-3">
                    <span class="text-slate-400">Nama Orang Tua:</span>
                    <span class="font-semibold text-white">👥 {{ $bill->student->parent_name ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-800/60 pb-3">
                    <span class="text-slate-400">Periode Bulan:</span>
                    <span class="font-semibold text-white">{{ $bill->month }}</span>
                </div>
                <div class="flex justify-between border-b border-slate-800/60 pb-3">
                    <span class="text-slate-400">Status Saat Ini:</span>
                    <span
                        class="font-bold uppercase {{ $bill->status == 'paid' ? 'text-emerald-400' : 'text-red-400' }}">
                        {{ $bill->status == 'paid' ? 'Lunas' : 'Belum Bayar' }}
                    </span>
                </div>
                <div class="flex justify-between border-b border-slate-800/60 pb-3 text-lg font-bold text-white">
                    <span class="text-slate-400">Total Tagihan:</span>
                    <span class="text-emerald-400">Rp {{ number_format($bill->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Cek & Validasi No WA -->
            <div class="mt-8 bg-slate-950 p-4 rounded-xl border border-slate-800">
                <p class="text-xs text-slate-400 mb-2">Tujuan Nomor WhatsApp Orang Tua:</p>
                <input type="text" value="{{ $bill->student->parent_phone ?? 'Belum ada nomor HP' }}"
                    class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-3 py-2 text-sm font-mono"
                    disabled>
                <p class="text-[11px] text-slate-500 mt-2">
                    * Pastikan nomor di atas benar. Jika salah, silakan edit melalui menu <b>Data Siswa</b>.
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8">
                @php
                    $phone = preg_replace('/^0/', '62', $bill->student->parent_phone ?? '');
                    $amountFormatted = 'Rp ' . number_format($bill->amount, 0, ',', '.');
                    $waText = urlencode(
                        "Halo Kak/Orang Tua dari *{$bill->student->name}*,\n\nBerikut adalah *Invoice Tagihan SPP Duber Futsal Academy* untuk periode *{$bill->month}*.\n\nTotal Tagihan: *{$amountFormatted}*\nStatus: *BELUM LUNAS*\n\nMohon segera melakukan pembayaran melalui transfer ke:\n🏦 BCA: 1234567890 a.n Duber Futsal\n\nJika sudah melakukan pembayaran, mohon kirimkan bukti transfer ke nomor ini. Terima kasih! ⚽",
                    );
                @endphp

                @if ($bill->student->parent_phone)
                    <a href="https://wa.me/{{ $phone }}?text={{ $waText }}" target="_blank"
                        class="flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-900/20">
                        💬 Kirim Invoice ke WhatsApp
                    </a>
                @else
                    <button
                        class="w-full bg-slate-800 text-slate-500 py-3 rounded-xl cursor-not-allowed text-xs font-semibold"
                        disabled>
                        Lengkapi No. HP Orang Tua Terlebih Dahulu
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
