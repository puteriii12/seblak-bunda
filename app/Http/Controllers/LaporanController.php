<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'bulan');
        $dateRange = $this->getDateRange($period);
        $startDate = $dateRange['start'];
        $endDate = $dateRange['end'];

        // ===== STATS CARDS =====
        // Total transaksi (orders yang tidak cancelled)
        $totalTransactions = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->count();

        // Total pendapatan
        $totalIncome = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        // Total pengeluaran
        $totalExpense = Pengeluaran::whereBetween('expense_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->sum('amount');

        // ===== DAILY INCOME CHART (Line Chart) =====
        $dailyData = $this->getDailyIncome($startDate, $endDate);

        // ===== INCOME VS EXPENSE CHART (Bar Chart) =====
        $comparisonData = $this->getIncomeVsExpense($startDate, $endDate);

        // ===== PAYMENT METHOD CHART (Doughnut) =====
        $cashCount = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_method', 'cash')
            ->where('status', '!=', 'cancelled')
            ->count();

        $qrisCount = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_method', 'qris')
            ->where('status', '!=', 'cancelled')
            ->count();

        $totalPayment = $cashCount + $qrisCount;
        $cashPercent = $totalPayment > 0 ? round(($cashCount / $totalPayment) * 100) : 0;
        $qrisPercent = $totalPayment > 0 ? round(($qrisCount / $totalPayment) * 100) : 0;

        // ===== FORMAT DATA UNTUK JAVASCRIPT =====
        $chartData = [
            'stats' => [
                'transactions' => $totalTransactions,
                'income' => (int) $totalIncome,
                'expense' => (int) $totalExpense,
            ],
            'daily' => [
                'labels' => $dailyData['labels'],
                'income' => $dailyData['income'],
            ],
            'comparison' => [
                'labels' => $comparisonData['labels'],
                'income' => $comparisonData['income'],
                'expense' => $comparisonData['expense'],
            ],
            'payment' => [
                'cash' => $cashCount,
                'qris' => $qrisCount,
                'cashPercent' => $cashPercent,
                'qrisPercent' => $qrisPercent,
            ],
            'period' => $period,
        ];

        return view('laporan', compact('chartData'));
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
                    'start' => Carbon::parse('2020-01-01')->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
        }
    }

    private function getDailyIncome($startDate, $endDate)
    {
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $income = [];

        $period = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        while ($period <= $end) {
            $dateStr = $period->format('Y-m-d');
            $order = $orders->get($dateStr);

            // Format label berdasarkan periode
            if ($period->diffInDays($startDate) < 7) {
                // Hari: tampilkan jam
                $labels[] = $period->format('d M');
            } else {
                $labels[] = $period->format('d M');
            }

            $income[] = $order ? (int) $order->total : 0;

            $period->addDay();
        }

        return [
            'labels' => $labels,
            'income' => $income
        ];
    }

    private function getIncomeVsExpense($startDate, $endDate)
    {
        // Pendapatan per bulan
        $incomeData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Pengeluaran per bulan
        $expenseData = Pengeluaran::whereBetween('expense_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->selectRaw('DATE_FORMAT(expense_date, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $labels = [];
        $income = [];
        $expense = [];

        $period = Carbon::parse($startDate)->startOfMonth();
        $end = Carbon::parse($endDate);

        while ($period <= $end) {
            $monthStr = $period->format('Y-m');

            $incomeRecord = $incomeData->get($monthStr);
            $expenseRecord = $expenseData->get($monthStr);

            $labels[] = $period->locale('id')->isoFormat('MMM');
            $income[] = $incomeRecord ? (int) $incomeRecord->total : 0;
            $expense[] = $expenseRecord ? (int) $expenseRecord->total : 0;

            $period->addMonth();
        }

        return [
            'labels' => $labels,
            'income' => $income,
            'expense' => $expense
        ];
    }
}