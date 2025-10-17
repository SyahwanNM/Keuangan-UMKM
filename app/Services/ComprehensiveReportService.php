<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Capital;
use App\Models\Tax;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ComprehensiveReportService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Generate comprehensive report for a specific period
     */
    public function generateReport($period, $startDate = null, $endDate = null)
    {
        // Set date range based on period
        $dateRange = $this->getDateRange($period, $startDate, $endDate);
        $startDate = $dateRange['start'];
        $endDate = $dateRange['end'];

        // Get all data for the period
        $transactions = $this->getTransactions($startDate, $endDate);
        $taxes = $this->getTaxes($startDate, $endDate);
        $capital = $this->getCapital();

        // Calculate financial metrics
        $financialMetrics = $this->calculateFinancialMetrics($transactions, $taxes, $capital, $startDate, $endDate);

        // Generate period-specific data
        $periodData = $this->generatePeriodData($transactions, $period, $startDate, $endDate);

        // Calculate growth metrics
        $growthMetrics = $this->calculateGrowthMetrics($transactions, $period, $startDate, $endDate);

        // Generate insights and recommendations
        $insights = $this->generateInsights($financialMetrics, $growthMetrics, $transactions, $taxes);

        return [
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'financial_metrics' => $financialMetrics,
            'period_data' => $periodData,
            'growth_metrics' => $growthMetrics,
            'insights' => $insights,
            'transactions' => $transactions,
            'taxes' => $taxes,
            'capital' => $capital,
        ];
    }

    /**
     * Get date range based on period
     */
    private function getDateRange($period, $startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            return [
                'start' => Carbon::parse($startDate),
                'end' => Carbon::parse($endDate)
            ];
        }

        switch ($period) {
            case 'daily':
                $date = Carbon::today();
                return [
                    'start' => $date,
                    'end' => $date
                ];
            case 'weekly':
                return [
                    'start' => Carbon::now()->startOfWeek(),
                    'end' => Carbon::now()->endOfWeek()
                ];
            case 'monthly':
                return [
                    'start' => Carbon::now()->startOfMonth(),
                    'end' => Carbon::now()->endOfMonth()
                ];
            case 'yearly':
                return [
                    'start' => Carbon::now()->startOfYear(),
                    'end' => Carbon::now()->endOfYear()
                ];
            default:
                return [
                    'start' => Carbon::now()->startOfMonth(),
                    'end' => Carbon::now()->endOfMonth()
                ];
        }
    }

    /**
     * Get transactions for the period
     */
    private function getTransactions($startDate, $endDate)
    {
        return Transaction::where('user_id', $this->user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * Get taxes for the period
     */
    private function getTaxes($startDate, $endDate)
    {
        return Tax::where('user_id', $this->user->id)
            ->where('is_auto_calculated', true)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
    }

    /**
     * Get capital data
     */
    private function getCapital()
    {
        return Capital::where('user_id', $this->user->id)->get();
    }

    /**
     * Calculate financial metrics
     */
    private function calculateFinancialMetrics($transactions, $taxes, $capital, $startDate, $endDate)
    {
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netProfit = $totalIncome - $totalExpense;
        $totalCapital = $capital->sum('initial_amount');
        $totalTaxes = $taxes->sum('amount');
        $paidTaxes = $taxes->where('status', 'paid')->sum('amount');
        $unpaidTaxes = $taxes->where('status', 'unpaid')->sum('amount');

        // Calculate profit margin
        $profitMargin = $totalIncome > 0 ? ($netProfit / $totalIncome) * 100 : 0;

        // Calculate ROI
        $roi = $totalCapital > 0 ? ($netProfit / $totalCapital) * 100 : 0;

        // Calculate average daily income/expense
        $days = $startDate->diffInDays($endDate) + 1;
        $avgDailyIncome = $totalIncome / $days;
        $avgDailyExpense = $totalExpense / $days;

        return [
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'net_profit' => $netProfit,
            'total_capital' => $totalCapital,
            'total_taxes' => $totalTaxes,
            'paid_taxes' => $paidTaxes,
            'unpaid_taxes' => $unpaidTaxes,
            'profit_margin' => round($profitMargin, 2),
            'roi' => round($roi, 2),
            'avg_daily_income' => round($avgDailyIncome, 2),
            'avg_daily_expense' => round($avgDailyExpense, 2),
            'transaction_count' => $transactions->count(),
            'income_transactions' => $transactions->where('type', 'income')->count(),
            'expense_transactions' => $transactions->where('type', 'expense')->count(),
        ];
    }

    /**
     * Generate period-specific data
     */
    private function generatePeriodData($transactions, $period, $startDate, $endDate)
    {
        $data = [];

        switch ($period) {
            case 'daily':
                $data = $this->generateDailyData($transactions, $startDate);
                break;
            case 'weekly':
                $data = $this->generateWeeklyData($transactions, $startDate, $endDate);
                break;
            case 'monthly':
                $data = $this->generateMonthlyData($transactions, $startDate, $endDate);
                break;
            case 'yearly':
                $data = $this->generateYearlyData($transactions, $startDate, $endDate);
                break;
        }

        return $data;
    }

    /**
     * Generate daily data
     */
    private function generateDailyData($transactions, $date)
    {
        $dateString = $date->format('Y-m-d');
        
        // Filter transactions by date - handle both date and datetime formats
        $dayTransactions = $transactions->filter(function($transaction) use ($dateString) {
            $transactionDate = $transaction->date instanceof \Carbon\Carbon 
                ? $transaction->date->format('Y-m-d')
                : \Carbon\Carbon::parse($transaction->date)->format('Y-m-d');
            return $transactionDate === $dateString;
        });
        
        
        return [
            'period' => $date->format('d M Y'),
            'date' => $dateString,
            'day_name' => $date->format('l'),
            'income' => $dayTransactions->where('type', 'income')->sum('amount'),
            'expense' => $dayTransactions->where('type', 'expense')->sum('amount'),
            'net_income' => $dayTransactions->where('type', 'income')->sum('amount') - $dayTransactions->where('type', 'expense')->sum('amount'),
            'transaction_count' => $dayTransactions->count(),
            'transactions' => $dayTransactions,
            'top_categories' => $this->getTopCategories($dayTransactions),
        ];
    }

    /**
     * Generate weekly data
     */
    private function generateWeeklyData($transactions, $startDate, $endDate)
    {
        $weeklyData = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dayTransactions = $transactions->where('date', $currentDate->format('Y-m-d'));
            
            $weeklyData[] = [
                'period' => $currentDate->format('d M Y'),
                'date' => $currentDate->format('Y-m-d'),
                'day_name' => $currentDate->format('l'),
                'income' => $dayTransactions->where('type', 'income')->sum('amount'),
                'expense' => $dayTransactions->where('type', 'expense')->sum('amount'),
                'net_income' => $dayTransactions->where('type', 'income')->sum('amount') - $dayTransactions->where('type', 'expense')->sum('amount'),
                'transaction_count' => $dayTransactions->count(),
                'transactions' => $dayTransactions,
            ];

            $currentDate->addDay();
        }

        return $weeklyData;
    }

    /**
     * Generate monthly data
     */
    private function generateMonthlyData($transactions, $startDate, $endDate)
    {
        $monthlyData = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $weekStart = $currentDate->copy()->startOfWeek();
            $weekEnd = $currentDate->copy()->endOfWeek();
            
            $weekTransactions = $transactions->whereBetween('date', [$weekStart->format('Y-m-d'), $weekEnd->format('Y-m-d')]);
            
            $monthlyData[] = [
                'period' => 'Week ' . $currentDate->weekOfMonth . ' (' . $weekStart->format('M d') . ' - ' . $weekEnd->format('M d') . ')',
                'week' => 'Week ' . $currentDate->weekOfMonth,
                'week_start' => $weekStart->format('M d'),
                'week_end' => $weekEnd->format('M d'),
                'income' => $weekTransactions->where('type', 'income')->sum('amount'),
                'expense' => $weekTransactions->where('type', 'expense')->sum('amount'),
                'net_income' => $weekTransactions->where('type', 'income')->sum('amount') - $weekTransactions->where('type', 'expense')->sum('amount'),
                'transaction_count' => $weekTransactions->count(),
                'transactions' => $weekTransactions,
            ];

            $currentDate->addWeek();
        }

        return $monthlyData;
    }

    /**
     * Generate yearly data
     */
    private function generateYearlyData($transactions, $startDate, $endDate)
    {
        $yearlyData = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $monthStart = $currentDate->copy()->startOfMonth();
            $monthEnd = $currentDate->copy()->endOfMonth();
            
            $monthTransactions = $transactions->whereBetween('date', [$monthStart->format('Y-m-d'), $monthEnd->format('Y-m-d')]);
            
            $yearlyData[] = [
                'period' => $currentDate->format('F Y'),
                'month' => $currentDate->format('F'),
                'month_number' => $currentDate->month,
                'income' => $monthTransactions->where('type', 'income')->sum('amount'),
                'expense' => $monthTransactions->where('type', 'expense')->sum('amount'),
                'net_income' => $monthTransactions->where('type', 'income')->sum('amount') - $monthTransactions->where('type', 'expense')->sum('amount'),
                'transaction_count' => $monthTransactions->count(),
                'transactions' => $monthTransactions,
                'top_categories' => $this->getTopCategories($monthTransactions),
            ];

            $currentDate->addMonth();
        }

        return $yearlyData;
    }

    /**
     * Calculate growth metrics
     */
    private function calculateGrowthMetrics($transactions, $period, $startDate, $endDate)
    {
        $previousPeriodData = $this->getPreviousPeriodData($period, $startDate, $endDate);
        $currentPeriodData = $this->calculateFinancialMetrics($transactions, collect(), collect(), $startDate, $endDate);

        $incomeGrowth = $this->calculateGrowthRate($previousPeriodData['total_income'], $currentPeriodData['total_income']);
        $expenseGrowth = $this->calculateGrowthRate($previousPeriodData['total_expense'], $currentPeriodData['total_expense']);
        $profitGrowth = $this->calculateGrowthRate($previousPeriodData['net_profit'], $currentPeriodData['net_profit']);

        return [
            'income_growth' => $incomeGrowth,
            'expense_growth' => $expenseGrowth,
            'profit_growth' => $profitGrowth,
            'previous_period' => $previousPeriodData,
        ];
    }

    /**
     * Get previous period data for comparison
     */
    private function getPreviousPeriodData($period, $startDate, $endDate)
    {
        $previousStart = $startDate->copy();
        $previousEnd = $endDate->copy();

        switch ($period) {
            case 'daily':
                $previousStart->subDay();
                $previousEnd->subDay();
                break;
            case 'weekly':
                $previousStart->subWeek();
                $previousEnd->subWeek();
                break;
            case 'monthly':
                $previousStart->subMonth();
                $previousEnd->subMonth();
                break;
            case 'yearly':
                $previousStart->subYear();
                $previousEnd->subYear();
                break;
        }

        $previousTransactions = $this->getTransactions($previousStart, $previousEnd);
        return $this->calculateFinancialMetrics($previousTransactions, collect(), collect(), $previousStart, $previousEnd);
    }

    /**
     * Calculate growth rate percentage
     */
    private function calculateGrowthRate($previous, $current)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }

    /**
     * Get top categories
     */
    private function getTopCategories($transactions, $limit = 5)
    {
        return $transactions->groupBy('category')
            ->map(function ($items) {
                return [
                    'category' => $items->first()->category,
                    'total' => $items->sum('amount'),
                    'count' => $items->count(),
                    'type' => $items->first()->type,
                ];
            })
            ->sortByDesc('total')
            ->take($limit)
            ->values();
    }

    /**
     * Generate insights and recommendations
     */
    private function generateInsights($financialMetrics, $growthMetrics, $transactions, $taxes)
    {
        $insights = [];

        // Profit insights
        if ($financialMetrics['net_profit'] > 0) {
            $insights[] = [
                'type' => 'positive',
                'title' => 'Laba Positif',
                'message' => "Bisnis Anda menghasilkan laba sebesar Rp " . number_format($financialMetrics['net_profit'], 0, ',', '.') . " dengan margin keuntungan " . $financialMetrics['profit_margin'] . "%."
            ];
        } else {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Rugi',
                'message' => "Bisnis Anda mengalami rugi sebesar Rp " . number_format(abs($financialMetrics['net_profit']), 0, ',', '.') . ". Pertimbangkan untuk mengurangi pengeluaran atau meningkatkan pendapatan."
            ];
        }

        // Growth insights
        if ($growthMetrics['income_growth'] > 0) {
            $insights[] = [
                'type' => 'positive',
                'title' => 'Pertumbuhan Pendapatan',
                'message' => "Pendapatan meningkat " . $growthMetrics['income_growth'] . "% dibanding periode sebelumnya."
            ];
        } elseif ($growthMetrics['income_growth'] < 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Penurunan Pendapatan',
                'message' => "Pendapatan menurun " . abs($growthMetrics['income_growth']) . "% dibanding periode sebelumnya."
            ];
        }

        // Tax insights
        if ($financialMetrics['unpaid_taxes'] > 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'Pajak Belum Dibayar',
                'message' => "Anda memiliki kewajiban pajak sebesar Rp " . number_format($financialMetrics['unpaid_taxes'], 0, ',', '.') . " yang belum dibayar."
            ];
        }

        // ROI insights
        if ($financialMetrics['roi'] > 10) {
            $insights[] = [
                'type' => 'positive',
                'title' => 'ROI Baik',
                'message' => "Return on Investment (ROI) Anda sebesar " . $financialMetrics['roi'] . "% menunjukkan performa investasi yang baik."
            ];
        } elseif ($financialMetrics['roi'] < 0) {
            $insights[] = [
                'type' => 'warning',
                'title' => 'ROI Negatif',
                'message' => "Return on Investment (ROI) Anda negatif sebesar " . $financialMetrics['roi'] . "%. Pertimbangkan untuk mengevaluasi strategi bisnis."
            ];
        }

        // Transaction frequency insights
        if ($financialMetrics['transaction_count'] < 10) {
            $insights[] = [
                'type' => 'info',
                'title' => 'Frekuensi Transaksi Rendah',
                'message' => "Anda hanya memiliki " . $financialMetrics['transaction_count'] . " transaksi dalam periode ini. Pertimbangkan untuk meningkatkan aktivitas bisnis."
            ];
        }

        return $insights;
    }
}





