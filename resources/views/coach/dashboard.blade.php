<x-admin-layout>
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800 text-white shadow-xl">
            <h1 class="text-2xl font-black mb-2">Selamat Datang, Pelatih {{ auth()->user()->name }}! 👋</h1>
            <p class="text-slate-400 text-sm">Gunakan panel ini untuk memantau data absensi, rapot siswa, data siswa, dan
                transaksi keuangan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('students.index') }}"
                class="bg-slate-900 p-5 rounded-2xl border border-slate-800 hover:border-emerald-500 transition block">
                <p class="text-slate-400 text-xs">Total Siswa</p>
                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalStudents }}</h3>
                <span class="text-emerald-400 text-xs mt-3 inline-block">&rarr; Kelola Data Siswa</span>
            </a>
            <a href="{{ route('grades.index') }}"
                class="bg-slate-900 p-5 rounded-2xl border border-slate-800 hover:border-emerald-500 transition block">
                <p class="text-slate-400 text-xs">Total Penilaian/Rapot</p>
                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalGrades }}</h3>
                <span class="text-emerald-400 text-xs mt-3 inline-block">&rarr; Kelola Rapot</span>
            </a>
            <a href="{{ route('attendances.index') }}"
                class="bg-slate-900 p-5 rounded-2xl border border-slate-800 hover:border-emerald-500 transition block">
                <p class="text-slate-400 text-xs">Rekap Absensi</p>
                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalAttendances }}</h3>
                <span class="text-emerald-400 text-xs mt-3 inline-block">&rarr; Kelola Absen</span>
            </a>
        </div>
    </div>
</x-admin-layout>
