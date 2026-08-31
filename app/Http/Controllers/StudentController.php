<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $query = Student::query();

        // Filter Pencarian (Nama Siswa atau Orang Tua)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('parent_name', 'like', "%{$search}%");
            });
        }

        // Filter Rentang Tanggal Lahir
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('birth_date', [$request->input('start_date'), $request->input('end_date')]);
        }

        // Ambil data dengan paginasi 10 data per halaman & pertahankan query string URL
        $students = $query->latest()->paginate(10)->withQueryString();

        return view('admin.students.index', compact('students'));
    }


    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student-photos', 'public');
        }

        // Ambil tahun dari tanggal lahir secara otomatis
        $birthYear = date('Y', strtotime($request->birth_date));

        Student::create([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'birth_year' => $birthYear,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'photo' => $photoPath,
            'status' => 'active',
        ]);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Menampilkan form edit siswa
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    // Memperbarui data siswa di database
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = $student->photo;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $photoPath = $request->file('photo')->store('student-photos', 'public');
        }

        $birthYear = date('Y', strtotime($request->birth_date));

        $student->update([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'birth_year' => $birthYear,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'photo' => $photoPath,
        ]);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Fungsi untuk mengubah status aktif/nonaktif siswa
    public function toggleStatus(Student $student)
    {
        $student->status = $student->status === 'active' ? 'inactive' : 'active';
        $student->save();

        return back()->with('success', 'Status siswa berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        $student->delete();
        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
