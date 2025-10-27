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
            <?php echo e(__('Manajemen Transaksi')); ?>

        </h2>
            <a href="<?php echo e(route('transactions.create')); ?>" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                Tambah Transaksi
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

            <!-- Filter Form -->
            <div class="dashboard-card overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Filter Transaksi</h3>
                    <form method="GET" action="<?php echo e(route('transactions.index')); ?>" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label for="type" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Tipe</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Semua Tipe</option>
                                <option value="income" <?php echo e(request('type') == 'income' ? 'selected' : ''); ?>>Pemasukan</option>
                                <option value="expense" <?php echo e(request('type') == 'expense' ? 'selected' : ''); ?>>Pengeluaran</option>
                            </select>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Kategori</label>
                            <input type="text" name="category" id="category" value="<?php echo e(request('category')); ?>" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   placeholder="Cari kategori...">
                        </div>
                        <div>
                            <label for="start_date" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" value="<?php echo e(request('start_date')); ?>" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" value="<?php echo e(request('end_date')); ?>" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Filter
                            </button>
                            <a href="<?php echo e(route('transactions.index')); ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <?php if($transactions->count() > 0): ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tipe</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Bukti</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y divide-gray-200">
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($transaction->date->format('d M Y')); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full <?php echo e($transaction->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                    <?php echo e($transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran'); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e($transaction->category); ?>

                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php echo e(Str::limit($transaction->description, 50)); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold <?php echo e($transaction->type == 'income' ? 'text-green-600' : 'text-red-600'); ?>">
                                                <?php echo e($transaction->type == 'income' ? '+' : '-'); ?> Rp <?php echo e(number_format($transaction->amount, 0, ',', '.')); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                <?php if($transaction->proof): ?>
                                                    <a href="<?php echo e(Storage::url($transaction->proof)); ?>" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </a>
                                                <?php else: ?>
                                                    <span style="color: var(--color-text_secondary, #9CA3AF);">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                                                <div class="flex space-x-2">
                                                    <a href="<?php echo e(route('transactions.show', $transaction)); ?>" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                                                    <a href="<?php echo e(route('transactions.edit', $transaction)); ?>" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                    <form action="<?php echo e(route('transactions.destroy', $transaction)); ?>" method="POST" class="inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
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
                            <?php echo e($transactions->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12" style="color: var(--color-text_secondary, #9CA3AF);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium" style="color: var(--color-text, #1F2937);">Belum ada transaksi</h3>
                            <p class="mt-1 text-sm" style="color: var(--color-text_secondary, #6B7280);">Mulai dengan menambahkan transaksi pertama Anda.</p>
                            <div class="mt-6">
                                <a href="<?php echo e(route('transactions.create')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Tambah Transaksi
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

<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/transactions/index.blade.php ENDPATH**/ ?>