<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Tax;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TaxCalculationService
{
    // Tarif pajak sesuai peraturan Indonesia
    const PPH_FINAL_RATES = [
        'pph_4_2' => 0.5, // PPh 4(2) - UMKM dengan omset < 4.8M
        'pph_25' => 0.5,  // PPh 25 - UMKM dengan omset 4.8M - 50M
        'pph_29' => 0.5,  // PPh 29 - UMKM dengan omset > 50M
    ];

    const PPN_RATES = [
        'ppn_umkm' => 0.11, // PPN untuk UMKM (11%)
        'ppn_normal' => 0.11, // PPN normal (11%)
    ];

    const PTKP_2024 = 54000000; // Penghasilan Tidak Kena Pajak 2024
    const PTKP_UMKM = 45000000; // PTKP khusus UMKM

    /**
     * Hitung semua pajak yang harus dibayar berdasarkan transaksi
     */
    public function calculateAllTaxes(User $user, $startDate = null, $endDate = null)
    {
        if (!$startDate) {
            $startDate = Carbon::now()->startOfYear();
        }
        if (!$endDate) {
            $endDate = Carbon::now()->endOfYear();
        }

        $transactions = $this->getTransactionsForPeriod($user, $startDate, $endDate);
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $netIncome = $totalIncome - $totalExpense;

        $taxes = [];

        // 1. PPh Final (Pajak Penghasilan Final)
        $pphFinal = $this->calculatePPhFinal($user, $totalIncome, $netIncome, $endDate);
        if ($pphFinal['amount'] > 0) {
            $taxes[] = $pphFinal;
        }

        // 2. PPN (Pajak Pertambahan Nilai)
        $ppn = $this->calculatePPN($user, $transactions, $endDate);
        if ($ppn['amount'] > 0) {
            $taxes[] = $ppn;
        }

        // 3. PPh Pasal 25 (Angsuran Pajak)
        $pph25 = $this->calculatePPh25($user, $netIncome, $endDate);
        if ($pph25['amount'] > 0) {
            $taxes[] = $pph25;
        }

        // 4. Pajak Bumi dan Bangunan (PBB) - jika ada aset properti
        $pbb = $this->calculatePBB($user, $endDate);
        if ($pbb['amount'] > 0) {
            $taxes[] = $pbb;
        }

        return [
            'taxes' => $taxes,
            'total_tax' => collect($taxes)->sum('amount'),
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'net_income' => $netIncome,
            'period' => [
                'start' => $startDate,
                'end' => $endDate
            ]
        ];
    }

    /**
     * Hitung PPh Final berdasarkan omset
     */
    private function calculatePPhFinal(User $user, $totalIncome, $netIncome, $periodEndDate = null)
    {
        // Hitung omset tahunan berdasarkan data aktual
        $currentYear = Carbon::now()->year;
        $yearlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereYear('date', $currentYear)
            ->sum('amount');
        
        if ($yearlyIncome <= 0) {
            return [
                'type' => 'pph_final',
                'name' => 'PPh Final',
                'rate' => 0,
                'taxable_amount' => 0,
                'amount' => 0,
                'due_date' => null,
                'description' => 'Tidak ada penghasilan untuk dikenakan pajak'
            ];
        }
        
        if ($yearlyIncome <= 480000000) { // Omset < 4.8M
            $rate = 0.5; // 0.5% dari omset
            $taxableAmount = $totalIncome;
            $taxType = 'PPh Final 0.5% (UMKM)';
        } elseif ($yearlyIncome <= 5000000000) { // Omset 4.8M - 50M
            $rate = 0.5; // 0.5% dari omset
            $taxableAmount = $totalIncome;
            $taxType = 'PPh Final 0.5% (UMKM Menengah)';
        } else { // Omset > 50M
            $rate = 0.5; // 0.5% dari omset
            $taxableAmount = $totalIncome;
            $taxType = 'PPh Final 0.5% (UMKM Besar)';
        }

        $amount = $taxableAmount * $rate / 100;

        // Hitung tanggal jatuh tempo berdasarkan periode pajak
        $dueDate = $this->calculateDueDate($periodEndDate);

        return [
            'type' => 'pph_final',
            'name' => $taxType,
            'rate' => $rate,
            'taxable_amount' => $taxableAmount,
            'amount' => round($amount),
            'due_date' => $dueDate,
            'description' => 'Pajak Penghasilan Final untuk UMKM'
        ];
    }

    /**
     * Hitung PPN berdasarkan transaksi
     */
    private function calculatePPN(User $user, $transactions, $periodEndDate = null)
    {
        // Hitung omset tahunan berdasarkan data aktual
        $currentYear = Carbon::now()->year;
        $yearlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereYear('date', $currentYear)
            ->sum('amount');
        
        // PPN hanya untuk transaksi yang melebihi 4.8M per tahun
        if ($yearlyIncome < 480000000) {
            return [
                'type' => 'ppn',
                'name' => 'PPN',
                'rate' => 0,
                'taxable_amount' => 0,
                'amount' => 0,
                'due_date' => null,
                'description' => 'Tidak wajib PPN (omset < 4.8M)'
            ];
        }

        // Hitung PPN dari transaksi yang kena pajak (semua transaksi income)
        $taxableTransactions = $transactions->where('type', 'income')->sum('amount');

        $rate = 0.11; // 11%
        $amount = $taxableTransactions * $rate;

        // Hitung tanggal jatuh tempo berdasarkan periode pajak
        $dueDate = $this->calculateDueDate($periodEndDate);

        return [
            'type' => 'ppn',
            'name' => 'PPN 11%',
            'rate' => $rate,
            'taxable_amount' => $taxableTransactions,
            'amount' => round($amount),
            'due_date' => $dueDate,
            'description' => 'Pajak Pertambahan Nilai'
        ];
    }

    /**
     * Hitung PPh Pasal 25 (Angsuran Pajak)
     */
    private function calculatePPh25(User $user, $netIncome, $periodEndDate = null)
    {
        // Hitung penghasilan tahunan berdasarkan data aktual
        $currentYear = Carbon::now()->year;
        $yearlyIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereYear('date', $currentYear)
            ->sum('amount');
        
        $yearlyExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereYear('date', $currentYear)
            ->sum('amount');
        
        $annualNetIncome = $yearlyIncome - $yearlyExpense;
        
        // PPh 25 hanya untuk yang sudah wajib pajak
        if ($annualNetIncome < self::PTKP_UMKM) {
            return [
                'type' => 'pph_25',
                'name' => 'PPh Pasal 25',
                'rate' => 0,
                'taxable_amount' => 0,
                'amount' => 0,
                'due_date' => null,
                'description' => 'Tidak wajib PPh 25 (penghasilan < PTKP)'
            ];
        }

        $taxableIncome = max(0, $annualNetIncome - self::PTKP_UMKM);
        $rate = 0.5; // 0.5% untuk UMKM
        $annualTax = $taxableIncome * $rate / 100;
        $monthlyTax = $annualTax / 12;

        // Hitung tanggal jatuh tempo berdasarkan periode pajak
        $dueDate = $this->calculateDueDate($periodEndDate);

        return [
            'type' => 'pph_25',
            'name' => 'PPh Pasal 25',
            'rate' => $rate,
            'taxable_amount' => $taxableIncome,
            'amount' => round($monthlyTax),
            'due_date' => $dueDate,
            'description' => 'Angsuran Pajak Penghasilan'
        ];
    }

    /**
     * Hitung PBB (Pajak Bumi dan Bangunan)
     */
    private function calculatePBB(User $user, $periodEndDate = null)
    {
        // PBB hanya jika ada properti yang dimiliki
        $hasProperty = $user->business_address && 
                      (strpos(strtolower($user->business_address), 'rumah') !== false ||
                       strpos(strtolower($user->business_address), 'gedung') !== false ||
                       strpos(strtolower($user->business_address), 'bangunan') !== false);

        if (!$hasProperty) {
            return [
                'type' => 'pbb',
                'name' => 'PBB',
                'rate' => 0,
                'taxable_amount' => 0,
                'amount' => 0,
                'due_date' => null,
                'description' => 'Tidak ada properti yang dikenakan PBB'
            ];
        }

        // Estimasi PBB berdasarkan alamat usaha
        $estimatedValue = 100000000; // Estimasi nilai properti
        $rate = 0.005; // 0.5% dari NJOP
        $amount = $estimatedValue * $rate;

        // PBB dibayar setahun sekali, jatuh tempo tahun berikutnya
        $dueDate = $periodEndDate ? $periodEndDate->copy()->addYear()->startOfYear() : Carbon::now()->addYear()->startOfYear();

        return [
            'type' => 'pbb',
            'name' => 'PBB',
            'rate' => $rate,
            'taxable_amount' => $estimatedValue,
            'due_date' => $dueDate,
            'amount' => round($amount),
            'description' => 'Pajak Bumi dan Bangunan'
        ];
    }

    /**
     * Hitung tanggal jatuh tempo pajak berdasarkan periode
     */
    private function calculateDueDate($periodEndDate = null)
    {
        if (!$periodEndDate) {
            // Jika tidak ada periode, gunakan bulan saat ini
            return Carbon::now()->addMonth()->day(15);
        }

        // Jatuh tempo adalah tanggal 15 bulan berikutnya dari periode pajak
        // Sesuai PMK Nomor 81 Tahun 2024 (efektif 1 Januari 2025)
        return $periodEndDate->copy()->addMonth()->day(15);
    }

    /**
     * Simpan pajak ke database
     */
    public function saveTaxes(User $user, $taxes, $periodDate = null)
    {
        $savedTaxes = [];
        
        // Gunakan tanggal periode jika disediakan, jika tidak gunakan tanggal saat ini
        $createdAt = $periodDate ? $periodDate : now();
        

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
                $savedTax->created_at = $createdAt;
                $savedTax->updated_at = $createdAt;
                $savedTax->save();

                $savedTaxes[] = $savedTax;
            }
        }

        return $savedTaxes;
    }

    /**
     * Dapatkan transaksi untuk periode tertentu
     */
    private function getTransactionsForPeriod(User $user, $startDate, $endDate)
    {
        return Transaction::where('user_id', $user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    }

    /**
     * Hitung estimasi pajak tahunan
     */
    public function calculateAnnualTaxEstimate(User $user)
    {
        $currentYear = Carbon::now()->year;
        $startDate = Carbon::create($currentYear, 1, 1);
        $endDate = Carbon::create($currentYear, 12, 31);

        return $this->calculateAllTaxes($user, $startDate, $endDate);
    }

    /**
     * Generate reminder untuk pajak yang akan jatuh tempo
     */
    public function generateTaxReminders(User $user)
    {
        $upcomingTaxes = Tax::where('user_id', $user->id)
            ->where('status', 'unpaid')
            ->where('due_date', '<=', Carbon::now()->addDays(30))
            ->get();

        $reminders = [];

        foreach ($upcomingTaxes as $tax) {
            $daysUntilDue = Carbon::now()->diffInDays($tax->due_date, false);
            
            $reminders[] = [
                'tax' => $tax,
                'days_until_due' => $daysUntilDue,
                'urgency' => $daysUntilDue <= 7 ? 'high' : ($daysUntilDue <= 14 ? 'medium' : 'low'),
                'message' => $this->generateReminderMessage($tax, $daysUntilDue)
            ];
        }

        return $reminders;
    }

    /**
     * Generate pesan reminder
     */
    private function generateReminderMessage($tax, $daysUntilDue)
    {
        if ($daysUntilDue < 0) {
            return "Pajak {$tax->name} sudah lewat jatuh tempo! Segera bayar untuk menghindari denda.";
        } elseif ($daysUntilDue == 0) {
            return "Pajak {$tax->name} jatuh tempo hari ini! Segera bayar.";
        } elseif ($daysUntilDue <= 7) {
            return "Pajak {$tax->name} akan jatuh tempo dalam {$daysUntilDue} hari. Segera siapkan pembayaran.";
        } else {
            return "Pajak {$tax->name} akan jatuh tempo dalam {$daysUntilDue} hari.";
        }
    }
}




