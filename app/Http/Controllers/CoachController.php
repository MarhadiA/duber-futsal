<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Transaction;

class CoachController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalGrades = Grade::count();
        $totalAttendances = Attendance::count();

        return view('coach.dashboard', compact('totalStudents', 'totalGrades', 'totalAttendances'));
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $coaches = \App\Models\Coach::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('profession', 'like', "%{$search}%")
                ->orWhere('license', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10) // Tampilkan 10 data per halaman
            ->withQueryString(); // Agar parameter search tetap aman saat pindah halaman

        return view('admin.coaches.index', compact('coaches'));
    }

    // Menampilkan form tambah pelatih
    public function create()
    {
        return view('admin.coaches.create');
    }

    // Menyimpan data pelatih baru ke database
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'license'    => 'nullable|string|max:255',
            'education'  => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        Coach::create($data);

        return redirect()->route('coaches.index')->with('success', 'Data pelatih berhasil ditambahkan!');
    }

    // Menampilkan form edit pelatih
    public function edit(Coach $coach)
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    // Mengupdate data pelatih
    public function update(Request $request, Coach $coach)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'license'    => 'nullable|string|max:255',
            'education'  => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($coach->photo) {
                Storage::disk('public')->delete($coach->photo);
            }
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $coach->update($data);

        return redirect()->route('coaches.index')->with('success', 'Data pelatih berhasil diupdate!');
    }

    // Menghapus data pelatih
    public function destroy(Coach $coach)
    {
        if ($coach->photo) {
            Storage::disk('public')->delete($coach->photo);
        }

        $coach->delete();

        return redirect()->route('coaches.index')->with('success', 'Data pelatih berhasil dihapus!');
    }
}
