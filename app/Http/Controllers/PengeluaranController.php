<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'semua');

        // Tentukan date range
        $dateRange = $this->getDateRange($period);

        // Ambil pengeluaran dengan filter periode
        $pengeluarans = Pengeluaran::whereBetween('expense_date', [$dateRange['start'], $dateRange['end']])
            ->orderBy('expense_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by date
        $groupedExpenses = $pengeluarans->groupBy(function ($pengeluarans) {
            return $pengeluarans->expense_date->format('Y-m-d');
        });

        // Total pengeluaran
        $totalExpense = $pengeluarans->sum('amount');

        return view('pengeluaran', compact('groupedExpenses', 'totalExpense', 'period'));
    }

    public function create()
    {
        return view('tambah_pengeluaran');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        Pengeluaran::create($validated);

        return redirect()->route('index')
            ->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $expense = Pengeluaran::findOrFail($id);
        return view('edit_pengeluaran', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = Pengeluaran::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        $expense->update($validated);

        return redirect()->route('index')
            ->with('success', 'Pengeluaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $expense = Pengeluaran::findOrFail($id);
        $expense->delete();

        return redirect()->route('index')
            ->with('success', 'Pengeluaran berhasil dihapus!');
    }

    private function getDateRange($period)
    {
        $now = Carbon::now();

        switch ($period) {
            case 'hari':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
            case 'minggu':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
            case 'bulan':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
            case 'tahun':
                return [
                    'start' => $now->copy()->startOfYear(),
                    'end' => $now->copy()->endOfYear()
                ];
            default:
                return [
                    'start' => Carbon::parse('2024-01-01')->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
        }
    }
}