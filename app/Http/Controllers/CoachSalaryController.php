<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\CoachSalary;
use App\Models\CoachAttendance;

class CoachSalaryController extends Controller
{
    public function index(Request $request)
    {
        // Default rentang tanggal (misal: awal bulan sampai hari ini)
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // Identifikasi periode untuk disimpan (misal: "2026-08-01 s.d 2026-08-25")
        $periodKey = $startDate . '_to_' . $endDate;

        $coaches = Coach::all();
        // Ambil data gaji berdasarkan periode tanggal tersebut
        $salaries = CoachSalary::where('month', $periodKey)->get()->keyBy('coach_id');

        return view('admin.salaries.index', compact('coaches', 'salaries', 'startDate', 'endDate', 'periodKey'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'fee_per_session' => 'required|numeric|min:0'
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $feePerSession = $request->input('fee_per_session');

        $periodKey = $startDate . '_to_' . $endDate;
        $coaches = Coach::all();

        foreach ($coaches as $coach) {
            // Hitung total hadir dalam rentang tanggal yang dipilih
            $totalSessions = CoachAttendance::where('coach_id', $coach->id)
                ->whereBetween('date', [$startDate, $endDate])
                ->where('status', 'Hadir')
                ->count();

            $totalSalary = $totalSessions * $feePerSession;

            CoachSalary::updateOrCreate(
                ['coach_id' => $coach->id, 'month' => $periodKey],
                [
                    'total_sessions' => $totalSessions,
                    'fee_per_session' => $feePerSession,
                    'total_salary' => $totalSalary,
                ]
            );
        }

        return redirect()->route('salaries.index', ['start_date' => $startDate, 'end_date' => $endDate])
            ->with('success', 'Gaji pelatih berhasil dihitung berdasarkan rentang tanggal!');
    }

    public function markAsPaid($id)
    {
        $salary = CoachSalary::findOrFail($id);
        $salary->update(['status' => 'Paid']);

        return back()->with('success', 'Status gaji pelatih diubah menjadi Lunas.');
    }
}
