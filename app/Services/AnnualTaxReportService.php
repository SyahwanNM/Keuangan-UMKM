<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Tax;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AnnualTaxReportService
{
    protected $taxCalculationService;

    public function __construct(TaxCalculationService $taxCalculationService)
    {
        $this->taxCalculationService = $taxCalculationService;
    }

    /**
     * Generate laporan pajak tahunan dengan detail per bulan
     */
    public function generateAnnualReport(User $user, $year = null)
    {
        if (!$year) {
            $year = Carbon::now()->year;
        }

        $monthlyReports = [];
        $totalAnnualTax = 0;
        $totalAnnualIncome = 0;
        $totalAnnualExpense = 0;

        // Hitung untuk setiap bulan dalam tahun
        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();

            // Hitung pajak untuk bulan ini
            $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
            
            // Ambil pajak yang sudah tersimpan untuk bulan ini (hanya auto calculated)
            $savedTaxes = Tax::where('user_id', $user->id)
                ->where('is_auto_calculated', true)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

            $monthlyReport = [
                'month' => $month,
                'month_name' => $startDate->format('F'),
                'month_name_id' => $this->getMonthNameIndonesian($month),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'income' => $taxCalculation['total_income'],
                'expense' => $taxCalculation['total_expense'],
                'net_income' => $taxCalculation['net_income'],
                'calculated_tax' => $taxCalculation['total_tax'],
                'saved_taxes' => $savedTaxes,
                'tax_details' => $taxCalculation['taxes'],
                'is_calculated' => $savedTaxes->count() > 0
            ];

            $monthlyReports[] = $monthlyReport;
            $totalAnnualTax += $taxCalculation['total_tax'];
            $totalAnnualIncome += $taxCalculation['total_income'];
            $totalAnnualExpense += $taxCalculation['total_expense'];
        }

        // Hitung pajak tahunan keseluruhan
        $annualTaxCalculation = $this->taxCalculationService->calculateAllTaxes(
            $user, 
            Carbon::create($year, 1, 1)->startOfYear(),
            Carbon::create($year, 12, 31)->endOfYear()
        );

        return [
            'year' => $year,
            'user' => $user,
            'monthly_reports' => $monthlyReports,
            'total_annual_income' => $totalAnnualIncome,
            'total_annual_expense' => $totalAnnualExpense,
            'total_annual_net_income' => $totalAnnualIncome - $totalAnnualExpense,
            'total_annual_tax' => $totalAnnualTax,
            'annual_tax_calculation' => $annualTaxCalculation,
            'summary' => $this->generateSummary($monthlyReports, $totalAnnualTax)
        ];
    }

    /**
     * Auto calculate pajak untuk semua bulan dalam tahun
     */
    public function autoCalculateAllMonths(User $user, $year = null)
    {
        if (!$year) {
            $year = Carbon::now()->year;
        }

        $results = [];
        $totalCalculated = 0;

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();

            // Hapus pajak lama untuk bulan ini
            Tax::where('user_id', $user->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->delete();

            // Hitung pajak untuk bulan ini
            $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
            
            // Simpan pajak baru dengan tanggal periode yang sesuai
            $savedTaxes = $this->taxCalculationService->saveTaxes($user, $taxCalculation['taxes'], $startDate);

            $results[] = [
                'month' => $month,
                'month_name' => $this->getMonthNameIndonesian($month),
                'tax_amount' => $taxCalculation['total_tax'],
                'saved_count' => count($savedTaxes),
                'income' => $taxCalculation['total_income'],
                'expense' => $taxCalculation['total_expense']
            ];

            $totalCalculated += $taxCalculation['total_tax'];
        }

        return [
            'year' => $year,
            'monthly_results' => $results,
            'total_tax_calculated' => $totalCalculated,
            'message' => "Pajak untuk tahun {$year} berhasil dihitung otomatis untuk semua bulan"
        ];
    }

    /**
     * Generate summary untuk laporan
     */
    private function generateSummary($monthlyReports, $totalAnnualTax)
    {
        $monthsWithTax = collect($monthlyReports)->where('calculated_tax', '>', 0)->count();
        $monthsWithoutTax = 12 - $monthsWithTax;
        $averageMonthlyTax = $monthsWithTax > 0 ? $totalAnnualTax / $monthsWithTax : 0;

        return [
            'months_with_tax' => $monthsWithTax,
            'months_without_tax' => $monthsWithoutTax,
            'average_monthly_tax' => $averageMonthlyTax,
            'highest_month_tax' => collect($monthlyReports)->max('calculated_tax'),
            'lowest_month_tax' => collect($monthlyReports)->where('calculated_tax', '>', 0)->min('calculated_tax') ?? 0
        ];
    }

    /**
     * Get nama bulan dalam bahasa Indonesia
     */
    private function getMonthNameIndonesian($month)
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return $months[$month] ?? '';
    }

    /**
     * Get data untuk chart pajak bulanan
     */
    public function getMonthlyTaxChartData($monthlyReports)
    {
        $chartData = [];
        
        foreach ($monthlyReports as $report) {
            $chartData[] = [
                'month' => $report['month_name_id'],
                'tax_amount' => $report['calculated_tax'],
                'income' => $report['income'],
                'expense' => $report['expense'],
                'net_income' => $report['net_income']
            ];
        }

        return $chartData;
    }
}



