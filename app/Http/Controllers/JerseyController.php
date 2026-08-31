<?php

namespace App\Http\Controllers;

use App\Models\Jersey;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JerseyController extends Controller
{
    // Fungsi pintar menentukan ukuran berdasarkan TB, BB, dan Usia
    private function calculateJerseySize($student, $height, $weight)
    {
        // Ambil usia otomatis dari tanggal lahir siswa (jika ada, default 12 tahun)
        $age = $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->age : 12;

        // 1. KATEGORI ANAK-ANAK (SD: Usia 6 - 11 Tahun)
        if ($age <= 8 && $height < 130 && $weight < 28) {
            return 'S Kids';
        } elseif ($age <= 10 && $height < 142 && $weight < 35) {
            return 'M Kids';
        } elseif ($age <= 12 && $height < 152 && $weight < 42) {
            return 'L Kids';
        }

        // 2. KATEGORI REMAJA (SMP / SMA: Usia 13 - 17 Tahun)
        if ($height >= 150 && $height < 160 && $weight < 50) {
            return 'S Junior';
        } elseif ($height >= 158 && $height < 168 && $weight < 58) {
            return 'M Junior';
        } elseif ($height >= 165 && $height < 172 && $weight < 65) {
            return 'L Junior';
        }

        // 3. KATEGORI DEWASA (Usia 18+ Tahun atau Umum)
        if ($height < 165 && $weight < 60) {
            return 'S Dewasa';
        } elseif ($height >= 160 && $height < 170 && $weight >= 55 && $weight < 70) {
            return 'M Dewasa';
        } elseif ($height >= 168 && $height < 178 && $weight >= 65 && $weight < 80) {
            return 'L Dewasa';
        } elseif ($height >= 175 && $height < 185 && $weight >= 75 && $weight < 90) {
            return 'XL Dewasa';
        } else {
            return 'XXL / Jumbo';
        }
    }

    public function index(Request $request)
    {
        $query = Jersey::with('student');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $jerseys = $query->latest()->paginate(10);
        $students = Student::where('status', 'active')->get();

        return view('admin.jerseys.index', compact('jerseys', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'jersey_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $student = Student::findOrFail($request->student_id);

        // 1. Generate ukuran otomatis
        $size = $this->calculateJerseySize($student, $request->height, $request->weight);

        // 2. Upload foto jersey jika ada
        $photoPath = null;
        if ($request->hasFile('jersey_photo')) {
            $photoPath = $request->file('jersey_photo')->store('jerseys', 'public');
        }

        $price = $request->price;
        $paid = $request->paid_amount ?? 0;

        // Tentukan status pembayaran
        if ($paid <= 0) {
            $status = 'unpaid';
        } elseif ($paid < $price) {
            $status = 'partial';
        } else {
            $status = 'paid';
        }

        Jersey::create([
            'student_id' => $request->student_id,
            'height' => $request->height,
            'weight' => $request->weight,
            'size' => $size,
            'jersey_photo' => $photoPath,
            'price' => $price,
            'paid_amount' => $paid,
            'status' => $status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('jerseys.index')->with('success', 'Ukuran jersey berhasil di-generate otomatis.');
    }

    public function update(Request $request, Jersey $jersey)
    {
        $request->validate([
            'paid_amount' => 'required|numeric',
        ]);

        $paid = $request->paid_amount;
        $price = $jersey->price;

        if ($paid <= 0) {
            $status = 'unpaid';
        } elseif ($paid < $price) {
            $status = 'partial';
        } else {
            $status = 'paid';
        }

        $jersey->update([
            'paid_amount' => $paid,
            'status' => $status,
        ]);

        return back()->with('success', 'Status pembayaran jersey diperbarui.');
    }

    public function destroy(Jersey $jersey)
    {
        $jersey->delete();
        return back()->with('success', 'Data jersey berhasil dihapus.');
    }
}
