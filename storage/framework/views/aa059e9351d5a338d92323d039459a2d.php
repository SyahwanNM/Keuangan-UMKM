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
            <h2 class="font-semibold text-xl leading-tight" style="color: var(--color-text, #1F2937);">
                <?php echo e(__('Manajemen Modal')); ?>

            </h2>
            <a href="<?php echo e(route('capitals.create')); ?>" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                Tambah Modal
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Modal -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-purple-500" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Modal Awal</p>
                                <p class="text-2xl font-semibold text-purple-600">Rp <?php echo e(number_format($totalCapital, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pemasukan -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Pemasukan</p>
                                <p class="text-2xl font-semibold text-green-600">Rp <?php echo e(number_format($totalIncome, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Total Pengeluaran</p>
                                <p class="text-2xl font-semibold text-red-600">Rp <?php echo e(number_format($totalExpense, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Saldo Saat Ini -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg border-l-4 <?php echo e($currentBalance >= 0 ? 'border-blue-500' : 'border-yellow-500'); ?>" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 <?php echo e($currentBalance >= 0 ? 'bg-blue-100' : 'bg-yellow-100'); ?> rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 <?php echo e($currentBalance >= 0 ? 'text-blue-600' : 'text-yellow-600'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Saldo Saat Ini</p>
                                <p class="text-2xl font-semibold <?php echo e($currentBalance >= 0 ? 'text-blue-600' : 'text-yellow-600'); ?>">
                                    Rp <?php echo e(number_format($currentBalance, 0, ',', '.')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROI Card -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: var(--color-surface, #FFFFFF);">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">Return on Investment (ROI)</h3>
                            <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">Persentase keuntungan dari modal yang diinvestasikan</p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold <?php echo e($roi >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                                <?php echo e($roi >= 0 ? '+' : ''); ?><?php echo e(number_format($roi, 2)); ?>%
                            </p>
                            <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">
                                <?php echo e($roi >= 0 ? 'Keuntungan' : 'Kerugian'); ?>: Rp <?php echo e(number_format($currentBalance - $totalCapital, 0, ',', '.')); ?>

                            </p>
                        </div>
                    </div>
                    
                    <!-- ROI Progress Bar -->
                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm mb-1" style="color: var(--color-text_secondary, #6B7280);">
                            <span>Modal Awal</span>
                            <span>Saldo Saat Ini</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <?php
                                $percentage = $totalCapital > 0 ? min(($currentBalance / $totalCapital) * 100, 200) : 0;
                                $barColor = $roi >= 0 ? 'bg-green-500' : 'bg-red-500';
                            ?>
                            <div class="<?php echo e($barColor); ?> h-3 rounded-full transition-all duration-300" 
                                 style="width: <?php echo e(max($percentage, 5)); ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Capital List -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Riwayat Modal</h3>
                    
                    <?php if($capitals->count() > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah Modal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y divide-gray-200">
                                    <?php $__currentLoopData = $capitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $capital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($capital->created_at->format('d M Y')); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-600">
                                                Rp <?php echo e(number_format($capital->initial_amount, 0, ',', '.')); ?>

                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e(Str::limit($capital->description, 80)); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                                                <div class="flex space-x-2">
                                                    <a href="<?php echo e(route('capitals.show', $capital)); ?>" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                                                    <a href="<?php echo e(route('capitals.edit', $capital)); ?>" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                    <form action="<?php echo e(route('capitals.destroy', $capital)); ?>" method="POST" class="inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus modal ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            <?php echo e($capitals->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12" style="color: var(--color-text_secondary, #9CA3AF);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium" style="color: var(--color-text, #1F2937);">Belum ada modal</h3>
                            <p class="mt-1 text-sm" style="color: var(--color-text_secondary, #6B7280);">Mulai dengan menambahkan modal awal usaha Anda.</p>
                            <div class="mt-6">
                                <a href="<?php echo e(route('capitals.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Tambah Modal
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
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

<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/capitals/index.blade.php ENDPATH**/ ?>