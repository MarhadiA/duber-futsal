<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', date('Y-m-01'));
        $endDate = $request->get('end_date', date('Y-m-t'));
        $type = $request->get('type');
        $search = $request->get('search');

        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('category', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(15)
            ->withQueryString();

        $totalIncome = Transaction::where('type', 'income')->whereBetween('date', [$startDate, $endDate])->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->whereBetween('date', [$startDate, $endDate])->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // AMBIL DATA SISWA DAN PELATIH UNTUK REKOMENDASI NAMA
        $students = \App\Models\Student::select('name')->orderBy('name', 'asc')->get();
        $coaches = \App\Models\Coach::select('name')->orderBy('name', 'asc')->get();

        return view('admin.cash_flow.index', compact(
            'transactions',
            'startDate',
            'endDate',
            'type',
            'search',
            'totalIncome',
            'totalExpense',
            'balance',
            'students',
            'coaches'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'name' => 'nullable|string|max:255', // Boleh diisi nama bebas atau dikosongkan
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Transaction::create([
            'type' => $request->type,
            'category' => $request->category,
            'name' => $request->name,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
            'recorded_by' => auth()->user()->name ?? 'Admin',
        ]);

        return back()->with('success', 'Transaksi berhasil disimpan!');
    }
}
