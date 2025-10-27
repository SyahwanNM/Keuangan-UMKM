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
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            <?php echo e(__('Laporan & Analitik Keuangan')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <a href="<?php echo e(route('reports.daily')); ?>" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border hover:shadow-xl transition-all duration-300 text-center p-6" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="text-3xl mb-2">📅</div>
                    <h3 class="font-semibold style="color: var(--color-text, #1F2937);"">Laporan Harian</h3>
                    <p class="text-sm style="color: var(--color-text_secondary, #6B7280);" mt-1">Detail transaksi harian</p>
                </a>
                
                <a href="<?php echo e(route('reports.weekly')); ?>" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border hover:shadow-xl transition-all duration-300 text-center p-6" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="text-3xl mb-2">📊</div>
                    <h3 class="font-semibold style="color: var(--color-text, #1F2937);"">Laporan Mingguan</h3>
                    <p class="text-sm style="color: var(--color-text_secondary, #6B7280);" mt-1">Analisis mingguan</p>
                </a>
                
                <a href="<?php echo e(route('reports.monthly')); ?>" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border hover:shadow-xl transition-all duration-300 text-center p-6" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="text-3xl mb-2">📈</div>
                    <h3 class="font-semibold style="color: var(--color-text, #1F2937);"">Laporan Bulanan</h3>
                    <p class="text-sm style="color: var(--color-text_secondary, #6B7280);" mt-1">Ringkasan bulanan</p>
                </a>
                
                <a href="<?php echo e(route('reports.yearly')); ?>" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border hover:shadow-xl transition-all duration-300 text-center p-6" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="text-3xl mb-2">📋</div>
                    <h3 class="font-semibold style="color: var(--color-text, #1F2937);"">Laporan Tahunan</h3>
                    <p class="text-sm style="color: var(--color-text_secondary, #6B7280);" mt-1">Overview tahunan</p>
                </a>
            </div>

            <!-- Custom Period Filter -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border mb-6" style="border-color: var(--color-border, #F3F4F6);">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Laporan Periode Kustom</h3>
                    <form method="GET" action="<?php echo e(route('reports.index')); ?>" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" 
                          style="position: relative; z-index: 10; pointer-events: auto;" 
                          id="report-form">
                        <div>
                            <label for="start_date" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" value="<?php echo e($startDate); ?>" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" value="<?php echo e($endDate); ?>" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg mr-2 transition-all duration-300 shadow-lg hover:shadow-xl"
                                    style="cursor: pointer; pointer-events: auto; user-select: none;">
                                Generate Laporan
                            </button>
                        </div>
                        <div class="flex items-end">
                            <a href="<?php echo e(route('reports.export-pdf', request()->query())); ?>" 
                               class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-all duration-300 shadow-lg hover:shadow-xl inline-block"
                               style="text-decoration: none; cursor: pointer;">
                                Export PDF
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Modal -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-violet-500 hover:shadow-xl transition-all duration-300 hover:border-violet-600">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-r from-violet-100 to-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Modal</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-primary, #8B5CF6);">Rp <?php echo e(number_format($totalCapital, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pemasukan -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-emerald-500 hover:shadow-xl transition-all duration-300 hover:border-emerald-600">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-r from-emerald-100 to-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: var(--color-success, #10B981);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Pemasukan</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-success, #10B981);">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-rose-500 hover:shadow-xl transition-all duration-300 hover:border-rose-600">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-r from-rose-100 to-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: var(--color-danger, #EF4444);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Pengeluaran</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-danger, #EF4444);">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laba/Rugi Bersih -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 <?php echo e($netProfit >= 0 ? 'border-indigo-500' : 'border-amber-500'); ?> hover:shadow-xl transition-all duration-300 <?php echo e($netProfit >= 0 ? 'hover:border-indigo-600' : 'hover:border-amber-600'); ?>">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 <?php echo e($netProfit >= 0 ? 'bg-gradient-to-r from-indigo-100 to-blue-100' : 'bg-gradient-to-r from-amber-100 to-yellow-100'); ?> rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: <?php echo e($netProfit >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)'); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);"><?php echo e($netProfit >= 0 ? 'Laba' : 'Rugi'); ?> Bersih</p>
                                <p class="text-2xl font-semibold" style="color: <?php echo e($netProfit >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)'); ?>;">
                                    <?php echo e($netProfit >= 0 ? '+' : ''); ?>Rp <?php echo e(number_format($netProfit, 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Trend Chart -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Tren Pemasukan & Pengeluaran</h3>
                        <canvas id="trendChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Category Pie Charts -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Pengeluaran per Kategori</h3>
                        <canvas id="expensePieChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Category Analysis -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Income by Category -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Pemasukan per Kategori</h3>
                        <?php if($incomeByCategory->count() > 0): ?>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $incomeByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: var(--color-success-light, #D1FAE5);">
                                        <span class="font-bold text-lg" style="color: var(--color-success-dark, #065F46);"><?php echo e($category); ?></span>
                                        <span class="font-bold text-lg" style="color: var(--color-success-dark, #065F46);">Rp <?php echo e(number_format($amount, 0, ',', '.')); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="style="color: var(--color-text_secondary, #6B7280);" text-center py-4">Tidak ada data pemasukan</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Expense by Category -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Pengeluaran per Kategori</h3>
                        <?php if($expenseByCategory->count() > 0): ?>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $expenseByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: var(--color-danger-light, #FEE2E2);">
                                        <span class="font-bold text-lg" style="color: var(--color-danger-dark, #991B1B);"><?php echo e($category); ?></span>
                                        <span class="font-bold text-lg" style="color: var(--color-danger-dark, #991B1B);">Rp <?php echo e(number_format($amount, 0, ',', '.')); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-center py-4" style="color: var(--color-text_secondary, #6B7280);">Tidak ada data pengeluaran</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Insights & Analysis (if available) -->
            <?php if(isset($reportData) && count($reportData['insights']) > 0): ?>
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border mb-6" style="border-color: var(--color-border, #F3F4F6);">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">💡 Insights & Analisis</h3>
                    <div class="space-y-3">
                        <?php $__currentLoopData = $reportData['insights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start p-4 rounded-lg" style="background: <?php echo e($insight['type'] == 'positive' ? 'var(--color-success-light, #D1FAE5)' : ($insight['type'] == 'warning' ? 'var(--color-warning-light, #FEF3C7)' : 'var(--color-primary-light, #DBEAFE)')); ?>; border-color: <?php echo e($insight['type'] == 'positive' ? 'var(--color-success, #10B981)' : ($insight['type'] == 'warning' ? 'var(--color-warning, #F59E0B)' : 'var(--color-primary, #3B82F6)')); ?>;">
                            <div class="flex-shrink-0">
                                <?php if($insight['type'] == 'positive'): ?>
                                    <svg class="w-5 h-5" style="color: var(--color-success, #10B981);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                <?php elseif($insight['type'] == 'warning'): ?>
                                    <svg class="w-5 h-5" style="color: var(--color-warning, #F59E0B);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                <?php else: ?>
                                    <svg class="w-5 h-5" style="color: var(--color-primary, #3B82F6);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-bold" style="color: <?php echo e($insight['type'] == 'positive' ? 'var(--color-success-dark, #065F46)' : ($insight['type'] == 'warning' ? 'var(--color-warning-dark, #92400E)' : 'var(--color-primary-dark, #1E40AF)')); ?>;">
                                    <?php echo e($insight['title']); ?>

                                </h4>
                                <p class="text-sm font-semibold mt-1" style="color: <?php echo e($insight['type'] == 'positive' ? 'var(--color-success-dark, #065F46)' : ($insight['type'] == 'warning' ? 'var(--color-warning-dark, #92400E)' : 'var(--color-primary-dark, #1E40AF)')); ?>;">
                                    <?php echo e($insight['message']); ?>

                                </p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Detailed Transactions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Detail Transaksi (<?php echo e($transactions->count()); ?> transaksi)</h3>
                    
                    <?php if($transactions->count() > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tipe</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($transaction->date->format('d M Y')); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full" style="background: <?php echo e($transaction->type == 'income' ? 'var(--color-success-light, #D1FAE5)' : 'var(--color-danger-light, #FEE2E2)'); ?>; color: <?php echo e($transaction->type == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)'); ?>;">
                                                    <?php echo e($transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran'); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($transaction->category); ?>

                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e(Str::limit($transaction->description, 50)); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: <?php echo e($transaction->type == 'income' ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)'); ?>;">
                                                <?php echo e($transaction->type == 'income' ? '+' : '-'); ?> Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 style="color: var(--color-text_secondary, #9CA3AF);"" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium style="color: var(--color-text, #1F2937);"">Tidak ada transaksi</h3>
                            <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Tidak ada transaksi dalam periode yang dipilih.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const dailyData = <?php echo json_encode($dailyData, 15, 512) ?>;
        
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: dailyData.map(item => item.date_formatted),
                datasets: [{
                    label: 'Pemasukan',
                    data: dailyData.map(item => item.income),
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.1
                }, {
                    label: 'Pengeluaran',
                    data: dailyData.map(item => item.expense),
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Expense Pie Chart
        const expensePieCtx = document.getElementById('expensePieChart').getContext('2d');
        const expenseByCategory = <?php echo json_encode($expenseByCategory, 15, 512) ?>;
        
        if (Object.keys(expenseByCategory).length > 0) {
            new Chart(expensePieCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(expenseByCategory),
                    datasets: [{
                        data: Object.values(expenseByCategory),
                        backgroundColor: [
                            '#ef4444', '#f97316', '#eab308', '#22c55e', 
                            '#3b82f6', '#8b5cf6', '#ec4899', '#6b7280'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        } else {
            expensePieCtx.canvas.style.display = 'none';
            expensePieCtx.canvas.parentNode.innerHTML += '<p class="style="color: var(--color-text_secondary, #6B7280);" text-center py-4">Tidak ada data pengeluaran</p>';
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            
            // Debug form submission
            const form = document.getElementById('report-form');
            if (form) {
                console.log('Form found:', form);
                console.log('Form action:', form.action);
                console.log('Form method:', form.method);
                
                form.addEventListener('submit', function(e) {
                    console.log('Form submitted');
                    console.log('Form data:', new FormData(form));
                    
                    // Prevent any interference
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    
                    // Let the form submit naturally
                    return true;
                });
            } else {
                console.error('Form not found!');
            }
            
            // Debug button click
            const generateButton = document.querySelector('button[type="submit"]');
            if (generateButton) {
                console.log('Generate button found:', generateButton);
                
                generateButton.addEventListener('click', function(e) {
                    console.log('Generate button clicked');
                    console.log('Button type:', this.type);
                    console.log('Form:', this.form);
                    
                    // Prevent any interference
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    
                    // Let the button work naturally
                    return true;
                });
            }
        });
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
<?php endif; ?>

<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/reports/index.blade.php ENDPATH**/ ?>