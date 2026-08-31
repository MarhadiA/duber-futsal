<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Coach;
use App\Models\Transaction;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KPI / Angka Ringkasan
        $totalStudents = Student::count();
        $totalCoaches = Coach::count();

        $currentMonth = date('m');
        $currentYear = date('Y');

        $totalIncome = Transaction::where('type', 'income')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('amount');

        $totalExpense = Transaction::where('type', 'expense')
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('amount');

        $netBalance = $totalIncome - $totalExpense;

        // Persentase kehadiran bulan ini
        $totalAttendances = Attendance::whereMonth('date', $currentMonth)->count();
        $presentAttendances = Attendance::whereMonth('date', $currentMonth)->where('status', 'present')->count();
        $attendanceRate = $totalAttendances > 0 ? round(($presentAttendances / $totalAttendances) * 100, 1) : 0;

        // 2. Data untuk Tabel Terbaru
        $recentTransactions = Transaction::orderBy('date', 'desc')->take(5)->get();
        $recentStudents = Student::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalCoaches',
            'totalIncome',
            'totalExpense',
            'netBalance',
            'attendanceRate',
            'recentTransactions',
            'recentStudents'
        ));
    }
}
