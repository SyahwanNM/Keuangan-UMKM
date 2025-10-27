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
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
                <?php echo e(__('Laporan Pajak Tahunan')); ?> - <?php echo e($year); ?>

            </h2>
            <div class="flex space-x-2">
                <a href="<?php echo e(route('taxes.export-annual-pdf', ['year' => $year])); ?>" 
                   class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-all duration-300 shadow-lg hover:shadow-xl inline-block"
                   style="text-decoration: none; cursor: pointer;">
                    📄 Export PDF Tahunan
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Year Selector -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 mb-6">
                <div class="p-6">
                    <form method="GET" action="<?php echo e(route('taxes.annual-report')); ?>" class="flex items-center gap-4">
                        <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Pilih Tahun:</label>
                        <select name="year" onchange="this.form.submit()" 
                                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <?php for($i = date('Y') - 2; $i <= date('Y') + 1; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e($i == $year ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Total Pemasukan</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">
                                    Rp <?php echo e(number_format($annualReport['total_annual_income'], 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Total Pengeluaran</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">
                                    Rp <?php echo e(number_format($annualReport['total_annual_expense'], 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Laba Bersih</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-text, #1F2937);">
                                    Rp <?php echo e(number_format($annualReport['total_annual_net_income'], 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Total Pajak</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">
                                    Rp <?php echo e(number_format($annualReport['total_annual_tax'], 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Tax Chart -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Grafik Pajak Bulanan</h3>
                    <canvas id="monthlyTaxChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Monthly Details Table -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Detail Pajak Per Bulan</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead style="background: var(--color-surface, #F8FAFC);">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Pemasukan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Pengeluaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Laba Bersih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Pajak Dihitung</th>
                                </tr>
                            </thead>
                            <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y divide-gray-200">
                                <?php $__currentLoopData = $annualReport['monthly_reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monthly): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);">
                                        <?php echo e($monthly['month_name_id']); ?> <?php echo e($year); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($monthly['income'], 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($monthly['expense'], 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($monthly['net_income'], 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);">
                                        Rp <?php echo e(number_format($monthly['calculated_tax'], 0, ',', '.')); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Tax Chart
        const monthlyData = <?php echo json_encode($annualReport['monthly_reports'], 15, 512) ?>;
        const chartData = {
            labels: monthlyData.map(item => item.month_name_id),
            datasets: [{
                label: 'Pajak (Rp)',
                data: monthlyData.map(item => item.calculated_tax),
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
                borderColor: 'rgba(147, 51, 234, 1)',
                borderWidth: 2,
                tension: 0.1
            }, {
                label: 'Pemasukan (Rp)',
                data: monthlyData.map(item => item.income),
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 2,
                tension: 0.1
            }]
        };

        const ctx = document.getElementById('monthlyTaxChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: chartData,
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

        function showNotification(type, message) {
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
            
            document.body.appendChild(notification);
            
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
<?php endif; ?>



<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/taxes/annual-report.blade.php ENDPATH**/ ?>