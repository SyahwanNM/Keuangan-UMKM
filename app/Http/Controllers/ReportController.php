<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Tax;
use App\Models\Capital;
use App\Services\ComprehensiveReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Debug logging
        \Log::info('ReportController::index called', [
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'all_params' => $request->all()
        ]);
        
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Set default date range (current month)
        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        // Get transactions in date range
        $transactions = Transaction::where('user_id', Auth::id())
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        // Calculate statistics
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        // Get capital and taxes
        $totalCapital = Capital::where('user_id', Auth::id())->sum('initial_amount');
        $totalTaxes = Tax::where('user_id', Auth::id())
            ->where('is_auto_calculated', true)
            ->where('status', 'unpaid')
            ->sum('amount');

        // Category analysis
        $incomeByCategory = $transactions->where('type', 'income')
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        $expenseByCategory = $transactions->where('type', 'expense')
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        // Daily trend for charts
        $dailyData = [];
        $currentDate = Carbon::parse($startDate);
        $endDateCarbon = Carbon::parse($endDate);

        while ($currentDate <= $endDateCarbon) {
            $dayTransactions = $transactions->where('date', $currentDate->format('Y-m-d'));
            $dailyData[] = [
                'date' => $currentDate->format('Y-m-d'),
                'date_formatted' => $currentDate->format('M d'),
                'income' => $dayTransactions->where('type', 'income')->sum('amount'),
                'expense' => $dayTransactions->where('type', 'expense')->sum('amount'),
            ];
            $currentDate->addDay();
        }

        return view('reports.index', compact(
            'startDate',
            'endDate',
            'transactions',
            'totalIncome',
            'totalExpense',
            'netProfit',
            'totalCapital',
            'totalTaxes',
            'incomeByCategory',
            'expenseByCategory',
            'dailyData'
        ));
    }

    public function getData(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Set default date range based on period
        if (!$startDate || !$endDate) {
            switch ($period) {
                case 'daily':
                    $startDate = Carbon::today()->format('Y-m-d');
                    $endDate = Carbon::today()->format('Y-m-d');
                    break;
                case 'weekly':
                    $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
                    break;
                case 'yearly':
                    $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
                    break;
                default: // monthly
                    $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                    break;
            }
        }

        // Get transactions in date range
        $transactions = Transaction::where('user_id', Auth::id())
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        // Calculate statistics
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netProfit = $totalIncome - $totalExpense;

        // Category analysis
        $incomeByCategory = $transactions->where('type', 'income')
            ->groupBy('category')
            ->map(function ($items, $category) {
                return [
                    'category' => $category,
                    'amount' => $items->sum('amount')
                ];
            })->values();

        $expenseByCategory = $transactions->where('type', 'expense')
            ->groupBy('category')
            ->map(function ($items, $category) {
                return [
                    'category' => $category,
                    'amount' => $items->sum('amount')
                ];
            })->values();

        return response()->json([
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netProfit' => $netProfit,
            'incomeByCategory' => $incomeByCategory,
            'expenseByCategory' => $expenseByCategory,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Set default date range based on period
        if (!$startDate || !$endDate) {
            switch ($period) {
                case 'daily':
                    $startDate = Carbon::today()->format('Y-m-d');
                    $endDate = Carbon::today()->format('Y-m-d');
                    break;
                case 'weekly':
                    $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
                    break;
                case 'yearly':
                    $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
                    break;
                default: // monthly
                    $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                    $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                    break;
            }
        }

        // Get data for PDF
        $transactions = Transaction::where('user_id', Auth::id())
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'desc')
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netProfit = $totalIncome - $totalExpense;
        $totalCapital = Capital::where('user_id', Auth::id())->sum('initial_amount');

        $incomeByCategory = $transactions->where('type', 'income')
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        $expenseByCategory = $transactions->where('type', 'expense')
            ->groupBy('category')
            ->map(function ($items) {
                return $items->sum('amount');
            });

        // Validate data to prevent PDF errors
        if ($transactions->isEmpty()) {
            $transactions = collect([]);
        }
        
        // Ensure all required data is present
        $totalIncome = $totalIncome ?? 0;
        $totalExpense = $totalExpense ?? 0;
        $netProfit = $netProfit ?? 0;
        $totalCapital = $totalCapital ?? 0;

        // Format period name for display
        $periodNames = [
            'daily' => 'Harian',
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan'
        ];

        $periodName = $periodNames[$period] ?? 'Bulanan';
        $user = Auth::user();

        $data = compact(
            'period',
            'periodName',
            'startDate',
            'endDate',
            'transactions',
            'totalIncome',
            'totalExpense',
            'netProfit',
            'totalCapital',
            'incomeByCategory',
            'expenseByCategory',
            'user'
        );

        try {
            $pdf = Pdf::loadView('reports.pdf', $data);
            $pdf->setPaper('A4', 'portrait');
            
            $filename = 'laporan-keuangan-' . $period . '-' . $startDate . '-to-' . $endDate . '.pdf';
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        // For now, we'll return a simple response
        // In a real implementation, you would use Laravel Excel
        return response()->json([
            'message' => 'Excel export feature will be implemented with Laravel Excel package',
            'status' => 'coming_soon'
        ]);
    }

    /**
     * Generate daily report
     */
    public function daily(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        
        // Use ComprehensiveReportService for better analysis
        $reportService = new ComprehensiveReportService(Auth::user());
        $reportData = $reportService->generateReport('daily', $date, $date);

        // Transform data to match view expectations
        $transformedData = [
            'totalIncome' => $reportData['financial_metrics']['total_income'],
            'totalExpense' => $reportData['financial_metrics']['total_expense'],
            'netIncome' => $reportData['financial_metrics']['net_profit'],
            'details' => collect([$reportData['period_data']]),
            'insights' => $reportData['insights']
        ];


        return view('reports.daily', compact('transformedData', 'date'));
    }

    /**
     * Generate weekly report
     */
    public function weekly(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfWeek()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfWeek()->format('Y-m-d'));
        
        // Use ComprehensiveReportService for better analysis
        $reportService = new ComprehensiveReportService(Auth::user());
        $reportData = $reportService->generateReport('weekly', $startDate, $endDate);

        // Transform data to match view expectations
        $transformedData = [
            'totalIncome' => $reportData['financial_metrics']['total_income'],
            'totalExpense' => $reportData['financial_metrics']['total_expense'],
            'netIncome' => $reportData['financial_metrics']['net_profit'],
            'details' => collect($reportData['period_data']),
            'insights' => $reportData['insights']
        ];

        // Debug: Log the structure
        \Log::info('Weekly Report Data Structure:', [
            'period_data_count' => count($reportData['period_data']),
            'first_period_data' => $reportData['period_data'][0] ?? 'No data',
            'transformed_data' => $transformedData
        ]);

        return view('reports.weekly', compact('transformedData', 'startDate', 'endDate'));
    }

    /**
     * Generate monthly report
     */
    public function monthly(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        // Use ComprehensiveReportService for better analysis
        $reportService = new ComprehensiveReportService(Auth::user());
        $reportData = $reportService->generateReport('monthly', $startDate, $endDate);

        // Transform data to match view expectations
        $transformedData = [
            'totalIncome' => $reportData['financial_metrics']['total_income'],
            'totalExpense' => $reportData['financial_metrics']['total_expense'],
            'netIncome' => $reportData['financial_metrics']['net_profit'],
            'details' => collect($reportData['period_data']),
            'insights' => $reportData['insights']
        ];

        return view('reports.monthly', compact('transformedData', 'month', 'year', 'startDate', 'endDate'));
    }

    /**
     * Generate yearly report
     */
    public function yearly(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        
        $startDate = Carbon::create($year, 1, 1)->startOfYear();
        $endDate = Carbon::create($year, 12, 31)->endOfYear();
        
        // Use ComprehensiveReportService for better analysis
        $reportService = new ComprehensiveReportService(Auth::user());
        $reportData = $reportService->generateReport('yearly', $startDate, $endDate);

        // Transform data to match view expectations
        $transformedData = [
            'totalIncome' => $reportData['financial_metrics']['total_income'],
            'totalExpense' => $reportData['financial_metrics']['total_expense'],
            'netIncome' => $reportData['financial_metrics']['net_profit'],
            'details' => collect($reportData['period_data']),
            'insights' => $reportData['insights']
        ];

        return view('reports.yearly', compact('transformedData', 'year', 'startDate', 'endDate'));
    }
}
