<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Tax;
use App\Models\Capital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $currentMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Statistik hari ini
        $todayIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereDate('date', $today)
            ->sum('amount');

        $todayExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereDate('date', $today)
            ->sum('amount');

        // Statistik bulan ini
        $monthlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereBetween('date', [$currentMonth, $endOfMonth])
            ->sum('amount');

        $monthlyExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereBetween('date', [$currentMonth, $endOfMonth])
            ->sum('amount');

        // Total pajak yang belum dibayar
        $unpaidTaxes = Tax::where('user_id', $user->id)
            ->where('status', 'unpaid')
            ->sum('amount');

        // Total modal
        $totalCapital = Capital::where('user_id', $user->id)
            ->sum('initial_amount');

        // Total pemasukan dan pengeluaran sepanjang masa
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        // Saldo saat ini (Modal + Pemasukan - Pengeluaran)
        $currentBalance = $totalCapital + $totalIncome - $totalExpense;

        // Laba/rugi bulan ini
        $monthlyProfit = $monthlyIncome - ($monthlyExpense + $unpaidTaxes);

        // Data untuk grafik (7 hari terakhir)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $income = Transaction::where('user_id', $user->id)
                ->where('type', 'income')
                ->whereDate('date', $date)
                ->sum('amount');
            $expense = Transaction::where('user_id', $user->id)
                ->where('type', 'expense')
                ->whereDate('date', $date)
                ->sum('amount');
            
            $chartData[] = [
                'date' => $date->format('M d'),
                'income' => $income,
                'expense' => $expense,
            ];
        }

        // Transaksi terbaru
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pajak yang akan jatuh tempo
        $upcomingTaxes = Tax::where('user_id', $user->id)
            ->where('status', 'unpaid')
            ->where('due_date', '>=', Carbon::today())
            ->where('due_date', '<=', Carbon::today()->addDays(30))
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'user',
            'todayIncome',
            'todayExpense',
            'monthlyIncome',
            'monthlyExpense',
            'unpaidTaxes',
            'totalCapital',
            'totalIncome',
            'totalExpense',
            'currentBalance',
            'monthlyProfit',
            'chartData',
            'recentTransactions',
            'upcomingTaxes'
        ));
    }
}
