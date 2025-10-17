<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Laporan Harian') }} - {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Date Filter -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border mb-6" style="border-color: var(--color-border, #F3F4F6);">
                <div class="p-6">
                    <form method="GET" action="{{ route('reports.daily') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div>
                            <label for="date" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Pilih Tanggal</label>
                            <input type="date" name="date" id="date" value="{{ $date }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl"
                                    style="cursor: pointer; pointer-events: auto; user-select: none;">
                                🔍 Lihat Laporan
                            </button>
                        </div>
                        <div class="flex items-end">
                            <a href="{{ route('reports.export-pdf', ['period' => 'daily', 'start_date' => $date, 'end_date' => $date]) }}" 
                               class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm transition-all duration-300 shadow-lg hover:shadow-xl inline-block"
                               style="text-decoration: none; cursor: pointer;">
                                📄 Export PDF
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Daily Summary -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Pemasukan -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-emerald-500">
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
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Pemasukan</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-success, #10B981);">Rp {{ number_format($transformedData['totalIncome'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-rose-500">
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
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Pengeluaran</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-danger, #EF4444);">Rp {{ number_format($transformedData['totalExpense'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laba/Rugi -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 {{ $transformedData['netIncome'] >= 0 ? 'border-indigo-500' : 'border-amber-500' }}">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 {{ $transformedData['netIncome'] >= 0 ? 'bg-gradient-to-r from-indigo-100 to-blue-100' : 'bg-gradient-to-r from-amber-100 to-yellow-100' }} rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: {{ $transformedData['netIncome'] >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">{{ $transformedData['netIncome'] >= 0 ? 'Laba' : 'Rugi' }}</p>
                                <p class="text-2xl font-semibold" style="color: {{ $transformedData['netIncome'] >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)' }};">
                                    {{ $transformedData['netIncome'] >= 0 ? '+' : '' }}Rp {{ number_format($transformedData['netIncome'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Transaksi -->
                <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-purple-500">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-100 to-indigo-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: var(--color-primary, #8B5CF6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Transaksi</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-primary, #8B5CF6);">{{ $transformedData['details']->first()['transaction_count'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            @if(isset($transformedData['details']) && $transformedData['details']->first() && count($transformedData['details']->first()['top_categories'] ?? []) > 0)
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border mb-6" style="border-color: var(--color-border, #F3F4F6);">
                <div class="p-6">
                    <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">🏆 Top Kategori Hari Ini</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($transformedData['details']->first()['top_categories'] as $category)
                        <div class="p-4 rounded-lg" style="background: {{ $category['type'] == 'income' ? 'var(--color-success-light, #D1FAE5)' : 'var(--color-danger-light, #FEE2E2)' }}; border-color: {{ $category['type'] == 'income' ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)' }};">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-lg" style="color: {{ $category['type'] == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)' }};">
                                        {{ $category['category'] }}
                                    </h4>
                                    <p class="text-sm font-semibold" style="color: {{ $category['type'] == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)' }};">
                                        {{ $category['count'] }} transaksi
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold" style="color: {{ $category['type'] == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)' }};">
                                        Rp {{ number_format($category['total'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Daily Transactions -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border" style="border-color: var(--color-border, #F3F4F6);">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">📋 Detail Transaksi Hari Ini</h3>
                    
                    @if($transformedData['details']->first()['transaction_count'] > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Waktu</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tipe</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                    @foreach($transformedData['details']->first()['transactions'] as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                            {{ $transaction->created_at->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full" style="background: {{ $transaction->type == 'income' ? 'var(--color-success-light, #D1FAE5)' : 'var(--color-danger-light, #FEE2E2)' }}; color: {{ $transaction->type == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)' }};">
                                                {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                            {{ $transaction->category }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                            {{ Str::limit($transaction->description, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: {{ $transaction->type == 'income' ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)' }};">
                                            {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 style="color: var(--color-text_secondary, #9CA3AF);"" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium style="color: var(--color-text, #1F2937);"">Tidak ada transaksi</h3>
                            <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Tidak ada transaksi pada tanggal {{ \Carbon\Carbon::parse($date)->format('d F Y') }}.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 flex justify-center space-x-4">
                <a href="{{ route('reports.index') }}" 
                   class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl inline-block"
                   style="text-decoration: none; cursor: pointer;">
                    ← Kembali ke Laporan Komprehensif
                </a>
                
                <a href="{{ route('transactions.create') }}" 
                   class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl inline-block"
                   style="text-decoration: none; cursor: pointer;">
                    ➕ Tambah Transaksi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>









