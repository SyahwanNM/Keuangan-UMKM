<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Services\TaxCalculationService;
use App\Services\AnnualTaxReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TaxController extends Controller
{
    protected $taxCalculationService;
    protected $annualTaxReportService;

    public function __construct(TaxCalculationService $taxCalculationService, AnnualTaxReportService $annualTaxReportService)
    {
        $this->taxCalculationService = $taxCalculationService;
        $this->annualTaxReportService = $annualTaxReportService;
    }

    /**
     * Tampilkan halaman utama pajak
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil parameter bulan dan tahun, default ke bulan dan tahun saat ini
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);
        
        // Hitung tanggal mulai dan akhir berdasarkan bulan dan tahun yang dipilih
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
        
        
        // Generate reminders
        $reminders = $this->taxCalculationService->generateTaxReminders($user);
        
        // Estimasi pajak tahunan
        $annualEstimate = $this->taxCalculationService->calculateAnnualTaxEstimate($user);
        
        return view('taxes.index', compact(
            'taxCalculation',
            'reminders',
            'annualEstimate',
            'startDate',
            'endDate',
            'month',
            'year',
            'request'
        ));
    }

    /**
     * Hitung pajak untuk periode tertentu
     */
    public function calculate(Request $request)
    {
        $user = Auth::user();
        
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());
        
        $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
        
        return response()->json($taxCalculation);
    }

    /**
     * Simpan pajak yang dihitung
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
        
        // Hapus pajak lama untuk bulan yang sama
        Tax::where('user_id', $user->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->delete();
        
        // Simpan pajak baru dengan tanggal periode yang sesuai
        $savedTaxes = $this->taxCalculationService->saveTaxes($user, $taxCalculation['taxes'], $startDate);

        $monthName = Carbon::create($year, $month, 1)->format('F Y');
        return redirect()->route('taxes.index', ['month' => $month, 'year' => $year])
            ->with('success', "Pajak untuk {$monthName} berhasil dihitung dan disimpan!");
    }

    /**
     * Tampilkan form create pajak
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Tampilkan detail pajak
     */
    public function show(Tax $tax)
    {
        $this->authorize('view', $tax);
        
        return view('taxes.show', compact('tax'));
    }

    /**
     * Tampilkan form edit pajak
     */
    public function edit(Tax $tax)
    {
        $this->authorize('update', $tax);
        
        return view('taxes.edit', compact('tax'));
    }

    /**
     * Update status pajak
     */
    public function update(Request $request, Tax $tax)
    {
        $request->validate([
            'status' => 'required|in:unpaid,paid,overdue'
        ]);
        
        $tax->update([
            'status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null,
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference
        ]);
        
        return redirect()->back()
            ->with('success', 'Status pajak berhasil diperbarui!');
    }

    /**
     * Hapus pajak
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        
        return redirect()->back()
            ->with('success', 'Pajak berhasil dihapus!');
    }

    /**
     * Export laporan pajak ke PDF
     */
    public function exportPdf(Request $request)
    {
        $user = Auth::user();
        
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
        
        $data = compact(
            'user',
            'taxCalculation',
            'startDate',
            'endDate',
            'month',
            'year'
        );
        
        try {
            $pdf = Pdf::loadView('taxes.pdf', $data);
            $pdf->setPaper('A4', 'portrait');
            
            $monthName = Carbon::create($year, $month, 1)->format('F-Y');
            $filename = "laporan-pajak-{$monthName}.pdf";
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('Tax PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
        }
    }

    /**
     * Generate reminder pajak
     */
    public function generateReminders()
    {
        $user = Auth::user();
        $reminders = $this->taxCalculationService->generateTaxReminders($user);
        
        return response()->json($reminders);
    }

    /**
     * Auto calculate dan simpan pajak bulanan
     */
    public function autoCalculateMonthly(Request $request)
    {
        $user = Auth::user();
        
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
        
        // Hapus pajak lama untuk bulan yang dipilih
        Tax::where('user_id', $user->id)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->delete();
        
        // Simpan pajak baru dengan tanggal periode yang sesuai
        $savedTaxes = $this->taxCalculationService->saveTaxes($user, $taxCalculation['taxes'], $startDate);
        
        $monthName = Carbon::create($year, $month, 1)->format('F Y');
        return response()->json([
            'message' => "Pajak untuk {$monthName} berhasil dihitung dan disimpan otomatis",
            'taxes' => $savedTaxes,
            'total_tax' => $taxCalculation['total_tax'],
            'month' => $month,
            'year' => $year
        ]);
    }

    /**
     * Dashboard pajak
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Statistik pajak
        $totalTaxes = Tax::where('user_id', $user->id)->sum('amount');
        $paidTaxes = Tax::where('user_id', $user->id)->where('status', 'paid')->sum('amount');
        $unpaidTaxes = Tax::where('user_id', $user->id)->where('status', 'unpaid')->sum('amount');
        $overdueTaxes = Tax::where('user_id', $user->id)->where('status', 'overdue')->sum('amount');
        
        // Pajak bulan ini
        $currentMonthTaxes = Tax::where('user_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();
        
        // Estimasi tahunan
        $annualEstimate = $this->taxCalculationService->calculateAnnualTaxEstimate($user);
        
        // Reminders
        $reminders = $this->taxCalculationService->generateTaxReminders($user);
        
        return view('taxes.dashboard', compact(
            'totalTaxes',
            'paidTaxes',
            'unpaidTaxes',
            'overdueTaxes',
            'currentMonthTaxes',
            'annualEstimate',
            'reminders'
        ));
    }

    /**
     * Laporan pajak tahunan
     */
    public function annualReport(Request $request)
    {
        $user = Auth::user();
        $year = $request->get('year', Carbon::now()->year);
        
        $annualReport = $this->annualTaxReportService->generateAnnualReport($user, $year);
        
        return view('taxes.annual-report', compact('annualReport', 'year'));
    }

    /**
     * Auto calculate pajak untuk semua bulan dalam tahun
     */
    public function autoCalculateYearly(Request $request)
    {
        $user = Auth::user();
        $year = $request->get('year', Carbon::now()->year);
        
        $result = $this->annualTaxReportService->autoCalculateAllMonths($user, $year);
        
        return response()->json($result);
    }

    /**
     * Export laporan pajak tahunan ke PDF
     */
    public function exportAnnualPdf(Request $request)
    {
        $user = Auth::user();
        $year = $request->get('year', Carbon::now()->year);
        
        $annualReport = $this->annualTaxReportService->generateAnnualReport($user, $year);
        
        try {
            $pdf = Pdf::loadView('taxes.annual-pdf', compact('annualReport', 'year'));
            $pdf->setPaper('A4', 'portrait');
            
            $filename = "laporan-pajak-tahunan-{$year}-{$user->business_name}.pdf";
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('Annual Tax PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan detail pajak per bulan
     */
    public function monthlyHistory(Request $request)
    {
        $user = Auth::user();
        $year = $request->get('year', Carbon::now()->year);
        
        $monthlyData = [];
        
        // Proses setiap bulan dalam tahun
        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            
            // Ambil transaksi untuk bulan ini
            $transactions = Transaction::where('user_id', $user->id)
                ->whereBetween('date', [$startDate, $endDate])
                ->get();
            
            $income = $transactions->where('type', 'income')->sum('amount');
            $expense = $transactions->where('type', 'expense')->sum('amount');
            $netIncome = $income - $expense;
            
            // Ambil pajak yang sudah tersimpan untuk bulan ini
            $savedTaxes = Tax::where('user_id', $user->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('is_auto_calculated', true)
                ->get();
            
            $totalTax = $savedTaxes->sum('amount');
            
            $monthlyData[] = [
                'month' => $month,
                'month_name' => $startDate->format('F Y'),
                'income' => $income,
                'expense' => $expense,
                'net_income' => $netIncome,
                'total_tax' => $totalTax,
                'has_data' => $income > 0 || $expense > 0 || $totalTax > 0
            ];
        }
        
        return view('taxes.monthly-history', compact('monthlyData', 'year'));
    }

    /**
     * API untuk auto save all taxes
     */
    public function autoSaveAllTaxes(Request $request)
    {
        $user = Auth::user();
        $year = $request->get('year', Carbon::now()->year);
        
        try {
            // Jalankan command auto save all taxes
            \Artisan::call('tax:auto-save-all', [
                '--year' => $year,
                '--force' => true
            ]);
            
            return response()->json([
                'message' => "Pajak untuk tahun {$year} berhasil disimpan otomatis!",
                'success' => true
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Auto Save All Taxes Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan pajak: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    /**
     * Mark tax as paid
     */
    public function markPaid(Tax $tax)
    {
        // Ensure user can only mark their own taxes as paid
        if ($tax->user_id !== Auth::id()) {
            abort(403);
        }

        $tax->update(['status' => 'paid']);

        return redirect()->back()
            ->with('success', 'Pajak berhasil ditandai sebagai sudah dibayar.');
    }
}
