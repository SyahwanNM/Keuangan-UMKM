<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\TaxCalculationService;
use Carbon\Carbon;

class AutoCalculateMonthlyTax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tax:auto-calculate-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically calculate monthly taxes for all users based on their income for the current month';

    protected $taxCalculationService;

    /**
     * Create a new command instance.
     */
    public function __construct(TaxCalculationService $taxCalculationService)
    {
        parent::__construct();
        $this->taxCalculationService = $taxCalculationService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting automatic monthly tax calculation...');
        
        // Ambil semua user yang aktif
        $users = User::all();
        $processedCount = 0;
        $errorCount = 0;
        
        foreach ($users as $user) {
            try {
                $this->info("Processing taxes for user: {$user->name} (ID: {$user->id})");
                
                // Hitung pajak untuk bulan ini
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                
                $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);
                
                // Hapus pajak lama untuk bulan ini
                \App\Models\Tax::where('user_id', $user->id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->delete();
                
                // Simpan pajak baru
                $savedTaxes = $this->taxCalculationService->saveTaxes($user, $taxCalculation['taxes']);
                
                $this->info("  - Calculated " . count($savedTaxes) . " tax entries");
                $this->info("  - Total tax amount: Rp " . number_format($taxCalculation['total_tax'], 0, ',', '.'));
                
                $processedCount++;
                
            } catch (\Exception $e) {
                $this->error("Error processing user {$user->name}: " . $e->getMessage());
                $errorCount++;
            }
        }
        
        $this->info("Tax calculation completed!");
        $this->info("Processed: {$processedCount} users");
        $this->info("Errors: {$errorCount} users");
        
        return 0;
    }
}