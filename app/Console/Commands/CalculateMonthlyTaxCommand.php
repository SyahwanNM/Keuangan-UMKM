<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Tax;
use App\Services\TaxCalculationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CalculateMonthlyTaxCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tax:calculate-monthly {--month=} {--year=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Otomatis menghitung dan menyimpan pajak bulanan untuk semua user';

    protected $taxCalculationService;

    public function __construct(TaxCalculationService $taxCalculationService)
    {
        parent::__construct();
        $this->taxCalculationService = $taxCalculationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Memulai perhitungan pajak bulanan otomatis...');

        // Tentukan bulan dan tahun yang akan diproses
        $month = $this->option('month') ?: Carbon::now()->subMonth()->month;
        $year = $this->option('year') ?: Carbon::now()->subMonth()->year;
        $force = $this->option('force');

        $this->info("📅 Memproses pajak untuk bulan: {$month}/{$year}");

        // Validasi tanggal
        if ($month < 1 || $month > 12) {
            $this->error('❌ Bulan tidak valid. Gunakan 1-12.');
            return 1;
        }

        if ($year < 2020 || $year > Carbon::now()->year) {
            $this->error('❌ Tahun tidak valid.');
            return 1;
        }

        // Jangan proses bulan yang sama dengan bulan saat ini
        if (!$force && $month == Carbon::now()->month && $year == Carbon::now()->year) {
            $this->warn('⚠️  Tidak dapat memproses bulan saat ini. Gunakan --force untuk memaksa.');
            return 1;
        }

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        // Ambil semua user yang aktif
        $users = User::where('email_verified_at', '!=', null)->get();
        
        if ($users->isEmpty()) {
            $this->warn('⚠️  Tidak ada user yang ditemukan.');
            return 0;
        }

        $this->info("👥 Ditemukan {$users->count()} user untuk diproses.");

        $totalProcessed = 0;
        $totalTaxes = 0;
        $errors = [];

        foreach ($users as $user) {
            try {
                $this->info("🔄 Memproses user: {$user->name} ({$user->email})");

                // Cek apakah sudah ada pajak untuk bulan ini
                $existingTaxes = Tax::where('user_id', $user->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->where('is_auto_calculated', true)
                    ->count();

                if ($existingTaxes > 0 && !$force) {
                    $this->warn("  ⚠️  Pajak untuk {$user->name} sudah ada untuk bulan {$month}/{$year}. Lewati...");
                    continue;
                }

                // Hitung pajak untuk user ini
                $taxCalculation = $this->taxCalculationService->calculateAllTaxes($user, $startDate, $endDate);

                if (empty($taxCalculation['taxes'])) {
                    $this->warn("  ℹ️  Tidak ada pajak yang harus dibayar untuk {$user->name}.");
                    continue;
                }

                // Hapus pajak lama jika ada (hanya yang auto calculated)
                if ($force) {
                    Tax::where('user_id', $user->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('is_auto_calculated', true)
                        ->delete();
                }

                // Simpan pajak baru
                $savedTaxes = $this->saveAutoCalculatedTaxes($user, $taxCalculation['taxes'], $startDate);

                $userTotalTax = collect($savedTaxes)->sum('amount');
                $totalTaxes += $userTotalTax;
                $totalProcessed++;

                $this->info("  ✅ Berhasil menyimpan " . count($savedTaxes) . " pajak untuk {$user->name} (Total: Rp " . number_format($userTotalTax, 0, ',', '.') . ")");

                // Log aktivitas
                Log::info("Auto calculated taxes for user {$user->id} ({$user->name}) for {$month}/{$year}", [
                    'user_id' => $user->id,
                    'month' => $month,
                    'year' => $year,
                    'taxes_count' => count($savedTaxes),
                    'total_amount' => $userTotalTax
                ]);

            } catch (\Exception $e) {
                $error = "Error processing user {$user->name}: " . $e->getMessage();
                $errors[] = $error;
                $this->error("  ❌ {$error}");
                
                Log::error("Error in auto tax calculation for user {$user->id}", [
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        // Tampilkan ringkasan
        $this->newLine();
        $this->info('📊 RINGKASAN PERHITUNGAN PAJAK BULANAN');
        $this->info('=====================================');
        $this->info("📅 Periode: {$startDate->format('F Y')}");
        $this->info("👥 User diproses: {$totalProcessed}");
        $this->info("💰 Total pajak: Rp " . number_format($totalTaxes, 0, ',', '.'));
        $this->info("❌ Error: " . count($errors));

        if (!empty($errors)) {
            $this->newLine();
            $this->warn('⚠️  ERRORS:');
            foreach ($errors as $error) {
                $this->warn("  - {$error}");
            }
        }

        $this->newLine();
        $this->info('✅ Perhitungan pajak bulanan selesai!');

        return 0;
    }

    /**
     * Simpan pajak yang dihitung otomatis
     */
    private function saveAutoCalculatedTaxes($user, $taxes, $periodDate)
    {
        $savedTaxes = [];
        
        foreach ($taxes as $tax) {
            if ($tax['amount'] > 0) {
                $savedTax = new Tax();
                $savedTax->user_id = $user->id;
                $savedTax->type = $tax['type'];
                $savedTax->name = $tax['name'];
                $savedTax->amount = $tax['amount'];
                $savedTax->rate = $tax['rate'];
                $savedTax->taxable_amount = $tax['taxable_amount'];
                $savedTax->due_date = $tax['due_date'];
                $savedTax->description = $tax['description'];
                $savedTax->status = 'unpaid';
                $savedTax->is_auto_calculated = true; // Tandai sebagai pajak otomatis
                $savedTax->created_at = $periodDate;
                $savedTax->updated_at = $periodDate;
                $savedTax->save();

                $savedTaxes[] = $savedTax;
            }
        }

        return $savedTaxes;
    }
}
