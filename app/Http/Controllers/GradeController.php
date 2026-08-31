<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Attendance;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil seluruh data siswa beserta nilai & periodenya tanpa paginate backend
        $students = Student::with('grades')->latest()->get();

        return view('admin.grades.index', compact('students'));
    }
    public function create()
    {
        $students = Student::all();
        return view('admin.grades.create', compact('students'));
    }

    public function downloadPdf(Request $request, $studentId)
    {
        // 1. Ambil data siswa beserta relasi nilainya
        $student = Student::with('grades')->findOrFail($studentId);

        // 2. Ambil parameter periode dari request (jika ada)
        $selectedPeriod = $request->input('period');

        // 3. Kelompokkan nilai berdasarkan periode
        $gradesByPeriod = $student->grades->groupBy('period');

        // 4. Jika periode dipilih, filter koleksi agar hanya berisi periode tersebut
        if ($selectedPeriod && $gradesByPeriod->has($selectedPeriod)) {
            $gradesByPeriod = collect([$selectedPeriod => $gradesByPeriod->get($selectedPeriod)]);
        }

        // 5. Load view khusus PDF (resources/views/admin/grades/pdf.blade.php)
        $pdf = Pdf::loadView('admin.grades.pdf', compact('student', 'gradesByPeriod', 'selectedPeriod'));

        // 6. Atur ukuran kertas
        $pdf->setPaper('a4', 'portrait');

        // 7. Buat nama file PDF yang ramah dibaca
        $periodSuffix = $selectedPeriod ? '_' . str_replace(' ', '_', $selectedPeriod) : '';
        $fileName = 'Rapot_' . str_replace(' ', '_', $student->name) . $periodSuffix . '.pdf';

        // 8. Unduh file PDF ke browser
        return $pdf->download($fileName);
    }

    // public function show($id)
    // {
    //     $student = Student::with('grades')->findOrFail($id);

    //     // Kelompokkan nilai berdasarkan periode (jika ada beberapa periode)
    //     $gradesByPeriod = $student->grades->groupBy('period');

    //     return view('admin.grades.show', compact('student', 'gradesByPeriod'));
    // }
    public function show($id)
    {
        $student = Student::with('grades')->findOrFail($id);

        $gradesByPeriod = $student->grades->groupBy('period');

        // Ambil daftar unik periode sebagai label (Sumbu X)
        $chartLabels = $student->grades->pluck('period')->unique()->values();

        // Ambil daftar unik aspek untuk pilihan filter
        $aspects = $student->grades->pluck('aspect')->unique()->values();

        $allDatasets = [];
        $colors = ['#10b981', '#38bdf8', '#f59e0b', '#a855f7', '#ec4899', '#6366f1'];

        foreach ($aspects as $index => $aspect) {
            $scores = $chartLabels->map(function ($period) use ($student, $aspect) {
                return $student->grades
                    ->where('period', $period)
                    ->where('aspect', $aspect)
                    ->avg('score') ?? 0;
            });

            $allDatasets[] = [
                'label' => $aspect,
                'data' => $scores,
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 6,
            ];
        }

        return view('admin.grades.show', compact('student', 'gradesByPeriod', 'chartLabels', 'allDatasets', 'aspects'));
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        return view('admin.grades.edit', compact('grade', 'students'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'aspect' => 'required|string',
            'score' => 'required|numeric|min:0|max:100',
            'period' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update([
            'student_id' => $request->student_id,
            'aspect' => $request->aspect,
            'score' => $request->score,
            'period' => $request->period,
            'notes' => $request->notes,
        ]);

        return redirect()->route('grades.show', $grade->student_id)->with('success', 'Nilai berhasil diperbarui!');
    }
}
