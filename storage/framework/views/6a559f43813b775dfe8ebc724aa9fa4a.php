<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--color-text, #1F2937);">
            <?php echo e(__('Manajemen Pajak')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12" style="background: var(--color-background, #F8FAFC); min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tax Calculation Form -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: var(--color-surface, #FFFFFF); border: 1px solid var(--color-text_secondary, #E5E7EB);">
                <div class="p-6" style="color: var(--color-text, #1F2937);">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">Kalkulasi Pajak Otomatis</h3>
                        <div class="text-sm font-medium px-3 py-1 rounded-full" style="background: rgba(59, 130, 246, 0.1); color: #1E40AF;">
                            📅 <?php echo e($startDate->format('F Y')); ?>

                        </div>
                    </div>
                    
                    <form method="GET" action="<?php echo e(route('taxes.index')); ?>" class="mb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2" style="color: var(--color-text_secondary, #6B7280);">
                                    Pilih Bulan
                                </label>
                                <select name="month" 
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        style="border-color: var(--color-text_secondary, #D1D5DB); background: var(--color-surface, #FFFFFF); color: var(--color-text, #1F2937);">
                                    <option value="1" <?php echo e($startDate->month == 1 ? 'selected' : ''); ?>>Januari</option>
                                    <option value="2" <?php echo e($startDate->month == 2 ? 'selected' : ''); ?>>Februari</option>
                                    <option value="3" <?php echo e($startDate->month == 3 ? 'selected' : ''); ?>>Maret</option>
                                    <option value="4" <?php echo e($startDate->month == 4 ? 'selected' : ''); ?>>April</option>
                                    <option value="5" <?php echo e($startDate->month == 5 ? 'selected' : ''); ?>>Mei</option>
                                    <option value="6" <?php echo e($startDate->month == 6 ? 'selected' : ''); ?>>Juni</option>
                                    <option value="7" <?php echo e($startDate->month == 7 ? 'selected' : ''); ?>>Juli</option>
                                    <option value="8" <?php echo e($startDate->month == 8 ? 'selected' : ''); ?>>Agustus</option>
                                    <option value="9" <?php echo e($startDate->month == 9 ? 'selected' : ''); ?>>September</option>
                                    <option value="10" <?php echo e($startDate->month == 10 ? 'selected' : ''); ?>>Oktober</option>
                                    <option value="11" <?php echo e($startDate->month == 11 ? 'selected' : ''); ?>>November</option>
                                    <option value="12" <?php echo e($startDate->month == 12 ? 'selected' : ''); ?>>Desember</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2" style="color: var(--color-text_secondary, #6B7280);">
                                    Pilih Tahun
                                </label>
                                <select name="year" 
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        style="border-color: var(--color-text_secondary, #D1D5DB); background: var(--color-surface, #FFFFFF); color: var(--color-text, #1F2937);">
                                    <?php for($i = date('Y') - 2; $i <= date('Y') + 1; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($startDate->year == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit" 
                                        class="w-full font-bold py-2 px-4 rounded transition duration-150 ease-in-out"
                                        style="background: var(--color-primary, #3B82F6); color: white;"
                                        onmouseover="this.style.background='var(--color-secondary, #1E40AF)'"
                                        onmouseout="this.style.background='var(--color-primary, #3B82F6)'">
                                    🔍 Lihat Perhitungan
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="flex gap-2 flex-wrap">
                        <a href="<?php echo e(route('taxes.export-pdf', ['month' => $startDate->month, 'year' => $startDate->year])); ?>" 
                           class="font-bold py-2 px-4 rounded transition duration-150 ease-in-out inline-block"
                           style="background: #EF4444; color: white; text-decoration: none; cursor: pointer;"
                           onmouseover="this.style.background='#DC2626'"
                           onmouseout="this.style.background='#EF4444'">
                            📄 Export PDF
                        </a>
                        
                        <a href="<?php echo e(route('taxes.annual-report')); ?>" 
                           class="font-bold py-2 px-4 rounded transition duration-150 ease-in-out inline-block"
                           style="background: #7C3AED; color: white; text-decoration: none; cursor: pointer;"
                           onmouseover="this.style.background='#6D28D9'"
                           onmouseout="this.style.background='#7C3AED'">
                            📈 Laporan Tahunan
                        </a>
                    </div>
                </div>
            </div>


            <!-- Tax Calculation Results -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: var(--color-surface, #FFFFFF); border: 1px solid var(--color-text_secondary, #E5E7EB);">
                <div class="p-6" style="color: var(--color-text, #1F2937);">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Hasil Kalkulasi Pajak</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="p-4 rounded-lg" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2);">
                            <h4 class="text-sm font-medium" style="color: #1E40AF;">Total Pemasukan</h4>
                            <p class="text-2xl font-bold" style="color: #1E40AF;">
                                Rp <?php echo e(number_format($taxCalculation['total_income'], 0, ',', '.')); ?>

                            </p>
                        </div>
                        <div class="p-4 rounded-lg" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2);">
                            <h4 class="text-sm font-medium" style="color: #DC2626;">Total Pengeluaran</h4>
                            <p class="text-2xl font-bold" style="color: #DC2626;">
                                Rp <?php echo e(number_format($taxCalculation['total_expense'], 0, ',', '.')); ?>

                            </p>
                        </div>
                        <div class="p-4 rounded-lg" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
                            <h4 class="text-sm font-medium" style="color: #059669;">Laba Bersih</h4>
                            <p class="text-2xl font-bold" style="color: #059669;">
                                Rp <?php echo e(number_format($taxCalculation['net_income'], 0, ',', '.')); ?>

                            </p>
                        </div>
                        <div class="p-4 rounded-lg" style="background: rgba(147, 51, 234, 0.1); border: 1px solid rgba(147, 51, 234, 0.2);">
                            <h4 class="text-sm font-medium" style="color: #7C3AED;">Total Pajak</h4>
                            <p class="text-2xl font-bold" style="color: #7C3AED;">
                                Rp <?php echo e(number_format($taxCalculation['total_tax'], 0, ',', '.')); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Tax Details -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: var(--color-accent, #F3F4F6);">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text_secondary, #6B7280); border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                        Jenis Pajak
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text_secondary, #6B7280); border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                        Tarif
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text_secondary, #6B7280); border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                        Dasar Pengenaan
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text_secondary, #6B7280); border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                        Jumlah Pajak
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text_secondary, #6B7280); border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                        Jatuh Tempo
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="background: var(--color-surface, #FFFFFF);">
                                <?php $__currentLoopData = $taxCalculation['taxes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-bottom: 1px solid var(--color-text_secondary, #E5E7EB);">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium" style="color: var(--color-text, #1F2937);"><?php echo e($tax['name']); ?></div>
                                        <div class="text-sm" style="color: var(--color-text_secondary, #6B7280);"><?php echo e($tax['description']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--color-text, #1F2937);">
                                        <?php echo e($tax['rate']); ?>%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($tax['taxable_amount'], 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($tax['amount'], 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: var(--color-text, #1F2937);">
                                        <?php echo e(\Carbon\Carbon::parse($tax['due_date'])->format('d M Y')); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pengingat Pajak -->
            <?php
                // Ambil pajak dari bulan sebelumnya yang belum dibayar
                $currentMonth = \Carbon\Carbon::now()->month;
                $currentYear = \Carbon\Carbon::now()->year;
                $previousMonth = $currentMonth - 1;
                $previousYear = $currentYear;
                
                // Jika bulan sekarang adalah Januari, maka bulan sebelumnya adalah Desember tahun lalu
                if ($previousMonth == 0) {
                    $previousMonth = 12;
                    $previousYear = $currentYear - 1;
                }
                
                // Ambil pajak dari bulan sebelumnya yang belum dibayar
                $overdueTaxes = \App\Models\Tax::where('user_id', auth()->id())
                    ->where('is_auto_calculated', true)
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->where('status', '!=', 'paid')
                    ->orderBy('due_date', 'asc')
                    ->get();
            ?>

            <?php if($overdueTaxes->count() > 0): ?>
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%); border: 1px solid #FCA5A5;">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold" style="color: #DC2626;">⚠️ Pengingat Pajak Bulan <?php echo e(\Carbon\Carbon::create()->month($previousMonth)->format('F')); ?></h3>
                            <p class="text-sm" style="color: #B91C1C;">
                                Ada <?php echo e($overdueTaxes->count()); ?> pajak dari bulan <?php echo e(\Carbon\Carbon::create()->month($previousMonth)->format('F')); ?> yang belum dibayar
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <?php $__currentLoopData = $overdueTaxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg p-4 border border-red-200">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        <div>
                                            <h4 class="font-semibold text-sm" style="color: var(--color-text, #1F2937);"><?php echo e($tax->name); ?></h4>
                                            <p class="text-xs" style="color: var(--color-text_secondary, #6B7280);"><?php echo e($tax->description); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-sm" style="color: #DC2626;">
                                        Rp <?php echo e(number_format($tax->amount, 0, ',', '.')); ?>

                                    </div>
                                    <div class="text-xs" style="color: #B91C1C;">
                                        Jatuh tempo: <?php echo e(\Carbon\Carbon::parse($tax->due_date)->format('d M Y')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- History Pajak -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF); border: 1px solid var(--color-text_secondary, #E5E7EB);">
                <div class="p-6" style="color: var(--color-text, #1F2937);">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">📚 History Pajak</h3>
                            <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">
                                Daftar pajak yang telah dihitung dan disimpan berdasarkan bulan dan tahun
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="text-sm font-medium" style="color: var(--color-text, #1F2937);">Tahun:</label>
                            <form method="GET" action="<?php echo e(route('taxes.index')); ?>" class="flex items-center gap-2">
                                <select name="history_year" onchange="this.form.submit()" 
                                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                                        style="background: var(--color-surface, #FFFFFF); color: var(--color-text, #1F2937);">
                                    <?php for($i = date('Y') - 2; $i <= date('Y') + 1; $i++): ?>
                                        <option value="<?php echo e($i); ?>" <?php echo e($i == ($request->get('history_year', date('Y'))) ? 'selected' : ''); ?>>
                                            <?php echo e($i); ?>

                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    <?php
                        // Ambil tahun dari request untuk history, default ke tahun berjalan
                        $selectedYear = $request->get('history_year', date('Y'));
                        
                        // Ambil pajak otomatis untuk tahun yang dipilih, dikelompokkan berdasarkan bulan/tahun
                        $taxHistory = \App\Models\Tax::where('user_id', auth()->id())
                            ->where('is_auto_calculated', true)
                            ->whereYear('created_at', $selectedYear)
                            ->orderBy('created_at', 'desc')
                            ->get()
                            ->groupBy(function($tax) {
                                return $tax->created_at->format('Y-m');
                            });
                    ?>
                    
                    <?php if($taxHistory->count() > 0): ?>
                    <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Bulan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jenis Pajak</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jatuh Tempo</th>
                                </tr>
                            </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y divide-gray-200">
                                    <?php $__currentLoopData = $taxHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monthYear => $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $monthName = \Carbon\Carbon::createFromFormat('Y-m', $monthYear)->format('F Y');
                                        ?>
                                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php if($index === 0): ?>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);" rowspan="<?php echo e($taxes->count()); ?>">
                                                    <?php echo e($monthName); ?>

                                                </td>
                                            <?php endif; ?>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($tax->name); ?>

                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($tax->description); ?>

                                    </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($tax->amount, 0, ',', '.')); ?>

                                    </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                        <?php echo e($tax->due_date->format('d M Y')); ?>

                                    </td>
                                </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <div class="text-4xl mb-4">📋</div>
                            <h4 class="text-lg font-semibold mb-2" style="color: var(--color-text, #1F2937);">
                                <?php if($selectedYear == date('Y')): ?>
                                    Belum Ada History Pajak Tahun <?php echo e($selectedYear); ?>

                                <?php else: ?>
                                    Tidak Ada Pajak untuk Tahun <?php echo e($selectedYear); ?>

                                <?php endif; ?>
                            </h4>
                            <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">
                                <?php if($selectedYear == date('Y')): ?>
                                    Mulai hitung pajak untuk melihat history di sini
                                <?php else: ?>
                                    Pilih tahun lain atau hitung pajak untuk tahun <?php echo e($selectedYear); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function showNotification(type, message) {
            // Buat elemen notifikasi
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <span class="mr-2">${type === 'success' ? '✅' : '❌'}</span>
                    <span>${message}</span>
                </div>
            `;
            
            // Tambahkan ke body
            document.body.appendChild(notification);
            
            // Hapus setelah 3 detik
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Magang\keuangan-UMKM\resources\views/taxes/index.blade.php ENDPATH**/ ?>