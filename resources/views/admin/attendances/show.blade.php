<x-admin-layout>
    <x-slot name="header">
        Detail Absensi: {{ $student->name }}
    </x-slot>

    <div class="space-y-6">
        <a href="{{ route('attendances.index') }}" class="text-slate-400 hover:text-white transition text-sm">
            &larr; Kembali ke Rekap
        </a>

        <div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
            <table class="w-full text-left text-white border-collapse">
                <thead class="bg-slate-950 text-slate-400 text-xs uppercase">
                    <tr>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Dicatat Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse($attendances as $attendance)
                        <tr class="hover:bg-slate-800/50">
                            <td class="p-4">{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-1 rounded text-xs font-bold uppercase
                                    {{ $attendance->status == 'present' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                                    {{ $attendance->status == 'permission' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                    {{ $attendance->status == 'sick' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                    {{ $attendance->status == 'alpha' ? 'bg-red-500/20 text-red-400' : '' }}">
                                    {{ $attendance->status }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-400">{{ $attendance->recorded_by }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-slate-400">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
