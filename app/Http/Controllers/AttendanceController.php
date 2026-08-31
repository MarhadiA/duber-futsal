<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Menampilkan halaman rekap absensi
    public function index(Request $request)
    {
        // Default rentang tanggal: 1 bulan terakhir atau dari input user
        $startDate = $request->get('start_date', date('Y-m-01'));
        $endDate = $request->get('end_date', date('Y-m-t'));
        $search = $request->get('search');

        $students = Student::where('status', 'active')
            ->when($search, function ($query, $search) {
                // Pencarian berdasarkan nama siswa atau nama orang tua/wali
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('parent_name', 'like', "%{$search}%");
                });
            })
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            }])
            ->orderBy('name', 'asc')
            ->paginate(10) // Menampilkan 10 siswa per halaman
            ->withQueryString(); // Mempertahankan parameter URL saat berpindah halaman

        return view('admin.attendances.index', compact('students', 'startDate', 'endDate', 'search'));
    }

    // public function create(Request $request)
    // {
    //     $date = $request->get('date', date('Y-m-d'));
    //     $search = $request->get('search');

    //     // Mengambil siswa aktif dengan filter pencarian jika ada
    //     $students = Student::where('status', 'active')
    //         ->when($search, function ($query, $search) {
    //             $query->where('name', 'like', "%{$search}%");
    //         })
    //         ->orderBy('name', 'asc')
    //         ->get();

    //     // Ambil data absensi yang sudah tercatat pada tanggal tersebut
    //     $attendances = Attendance::where('date', $date)->get()->keyBy('student_id');

    //     return view('admin.attendances.create', compact('students', 'date', 'attendances', 'search'));
    // }
    public function create(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));

        $query = Student::where('status', 'active'); // Sesuaikan dengan kriteria siswa aktif Anda

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Menggunakan paginate agar pagination muncul dan tidak berat jika siswa banyak
        $students = $query->paginate(10)->withQueryString();

        // Ambil data absensi yang sudah tersimpan pada tanggal tersebut untuk siswa di halaman ini
        $studentIds = $students->pluck('id');
        $attendances = Attendance::where('date', $date)
            ->whereIn('student_id', $studentIds)
            ->get()
            ->keyBy('student_id');

        // return view('attendances.create', compact('students', 'attendances', 'date'));
        // return view('attendance.create', compact('students', 'attendances', 'date'));
        return view('admin.attendances.create', compact('students', 'attendances', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendances' => 'required|array',
        ]);

        $recordedByName = auth()->User()->name ?? 'Admin';

        foreach ($request->attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'status' => $data['status'] ?? 'present',
                    'recorded_by' => $recordedByName,
                ]
            );
        }

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil disimpan!');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        // Mengambil semua riwayat absensi siswa tersebut diurutkan dari yang terbaru
        $attendances = Attendance::where('student_id', $id)
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.attendances.show', compact('student', 'attendances'));
    }
}
