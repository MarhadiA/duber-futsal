<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBill;
use App\Models\Student;
use Illuminate\Http\Request;

class SppController extends Controller
{
    // Menampilkan halaman rekap SPP bulanan
    public function index(Request $request)
    {
        // Default bulan menggunakan bulan & tahun saat ini (misal: Agustus 2026)
        $month = $request->input('month', now()->translatedFormat('F Y'));
        $status = $request->input('status');

        $students = Student::with(['monthlyBills' => function ($query) use ($month) {
            $query->where('month', $month);
        }])
            ->when($status, function ($query) use ($status, $month) {
                if ($status == 'paid') {
                    $query->whereHas('monthlyBills', function ($q) use ($month) {
                        $q->where('month', $month)->where('status', 'paid');
                    });
                } elseif ($status == 'unpaid') {
                    $query->whereDoesntHave('monthlyBills', function ($q) use ($month) {
                        $q->where('month', $month)->where('status', 'paid');
                    });
                }
            })
            ->paginate(10)
            ->appends(['month' => $month, 'status' => $status]);

        return view('admin.spp.index', compact('students', 'month', 'status'));
    }

    // Generate tagihan massal untuk semua siswa pada bulan tertentu
    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|string',
            'amount' => 'required|numeric|min:0', // Validasi nominal
        ]);

        $month = $request->input('month');
        $amount = $request->input('amount');
        $students = Student::all();

        foreach ($students as $student) {
            MonthlyBill::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'month' => $month,
                ],
                [
                    'amount' => $amount, // Menggunakan nominal yang diinput admin
                    // Status dibiarkan atau di-set default jika belum ada
                ]
            );
        }

        return redirect()->route('spp.index', ['month' => $month])
            ->with('success', 'Tagihan SPP bulan ' . $month . ' berhasil digenerate dengan nominal Rp ' . number_format($amount, 0, ',', '.'));
    }

    // Mengubah status tagihan menjadi Lunas
    public function markAsPaid($id)
    {
        $bill = MonthlyBill::findOrFail($id);
        $bill->update(['status' => 'paid']);

        return back()->with('success', 'Status SPP berhasil diubah menjadi Lunas.');
    }

    // Mengubah status tagihan menjadi Belum Lunas
    public function markAsUnpaid($id)
    {
        $bill = MonthlyBill::findOrFail($id);
        $bill->update(['status' => 'unpaid']);

        return back()->with('success', 'Status SPP diubah menjadi Belum Bayar.');
    }

    // Menampilkan halaman Preview Invoice sebelum dikirim ke WhatsApp
    public function showInvoice($id)
    {
        $bill = MonthlyBill::with('student')->findOrFail($id);

        // Sesuaikan nama view di bawah ini dengan file blade yang Anda gunakan
        // Jika menggunakan 'invoice.blade.php', arahkan ke 'admin.spp.invoice'
        // Jika menggunakan 'show.blade.php', arahkan ke 'admin.spp.show'
        return view('admin.spp.show', compact('bill'));
    }
    public function updateAmount(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric']);

        $bill = MonthlyBill::findOrFail($id);
        $bill->update(['amount' => $request->amount]);

        return back()->with('success', 'Nominal SPP berhasil diperbarui.');
    }
}
