<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\AnnualTaxReportService;
use Carbon\Carbon;

class AutoCalculateYearlyTax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tax:auto-calculate-yearly {year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically calculate taxes for all months in a year for all users';

    protected $annualTaxReportService;

    /**
     * Create a new command instance.
     */
    public function __construct(AnnualTaxReportService $annualTaxReportService)
    {
        parent::__construct();
        $this->annualTaxReportService = $annualTaxReportService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $year = $this->argument('year') ?? Carbon::now()->year;
        
        $this->info("Starting automatic yearly tax calculation for year {$year}...");
        
        // Ambil semua user yang aktif
        $users = User::all();
        $processedCount = 0;
        $errorCount = 0;
        $totalTaxCalculated = 0;
        
        foreach ($users as $user) {
            try {
                $this->info("Processing yearly taxes for user: {$user->name} (ID: {$user->id})");
                
                // Hitung pajak untuk semua bulan dalam tahun
                $result = $this->annualTaxReportService->autoCalculateAllMonths($user, $year);
                
                $this->info("  - Calculated taxes for all 12 months");
                $this->info("  - Total tax amount: Rp " . number_format($result['total_tax_calculated'], 0, ',', '.'));
                
                $processedCount++;
                $totalTaxCalculated += $result['total_tax_calculated'];
                
            } catch (\Exception $e) {
                $this->error("Error processing user {$user->name}: " . $e->getMessage());
                $errorCount++;
            }
        }
        
        $this->info("Yearly tax calculation completed!");
        $this->info("Processed: {$processedCount} users");
        $this->info("Errors: {$errorCount} users");
        $this->info("Total tax calculated: Rp " . number_format($totalTaxCalculated, 0, ',', '.'));
        
        return 0;
    }
}