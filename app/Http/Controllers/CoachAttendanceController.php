<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\CoachAttendance;

class CoachAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $coaches = Coach::all();
        $attendances = CoachAttendance::where('date', $date)->get()->keyBy('coach_id');

        return view('admin.coach_attendances.index', compact('coaches', 'attendances', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendances' => 'required|array',
        ]);

        $date = $request->input('date');

        foreach ($request->input('attendances') as $coachId => $data) {
            CoachAttendance::updateOrCreate(
                ['coach_id' => $coachId, 'date' => $date],
                [
                    'status' => $data['status'] ?? 'Alpha',
                    'notes' => $data['notes'] ?? null,
                ]
            );
        }

        return redirect()->route('coach-attendances.index', ['date' => $date])
            ->with('success', 'Absensi pelatih berhasil disimpan!');
    }
    public function show(Request $request, $coachId)
    {
        $coach = Coach::findOrFail($coachId);
        $month = $request->input('month', date('Y-m'));

        $attendances = CoachAttendance::where('coach_id', $coachId)
            ->where('date', 'like', "$month%")
            ->orderBy('date', 'desc')
            ->get();

        $stats = [
            'Hadir' => $attendances->where('status', 'Hadir')->count(),
            'Izin' => $attendances->where('status', 'Izin')->count(),
            'Alpha' => $attendances->where('status', 'Alpha')->count(),
        ];

        return view('admin.coach_attendances.show', compact('coach', 'attendances', 'month', 'stats'));
    }
}
