<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Laporan Mingguan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Date Range -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: var(--color-surface, #FFFFFF);">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Laporan Mingguan</h3>
                            <p class="text-sm style="color: var(--color-text_secondary, #6B7280);"">
                                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('reports.index') }}" 
                               class="text-white font-bold py-2 px-4 rounded" style="background: var(--color-text_secondary, #6B7280);" onmouseover="this.style.background='var(--color-text, #1F2937)'" onmouseout="this.style.background='var(--color-text_secondary, #6B7280)'">
                                ← Kembali
                            </a>
                            <a href="{{ route('reports.export-pdf', ['period' => 'weekly', 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                               class="text-white font-bold py-2 px-4 rounded" style="background: var(--color-danger, #EF4444);" onmouseover="this.style.background='var(--color-danger-dark, #DC2626)'" onmouseout="this.style.background='var(--color-danger, #EF4444)'">
                                📄 Export PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: var(--color-success-light, #D1FAE5);">
                                    <svg class="w-5 h-5" style="color: var(--color-success, #10B981);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Total Pemasukan</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">Rp {{ number_format($transformedData['totalIncome'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: var(--color-danger-light, #FEE2E2);">
                                    <svg class="w-5 h-5" style="color: var(--color-danger, #EF4444);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Total Pengeluaran</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">Rp {{ number_format($transformedData['totalExpense'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: {{ $transformedData['netIncome'] >= 0 ? 'var(--color-primary-light, #DBEAFE)' : 'var(--color-danger-light, #FEE2E2)' }};">
                                    <svg class="w-5 h-5" style="color: {{ $transformedData['netIncome'] >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-danger, #EF4444)' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Laba/Rugi Bersih</p>
                                <p class="text-2xl font-semibold" style="color: {{ $transformedData['netIncome'] >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-danger, #EF4444)' }};">
                                    Rp {{ number_format($transformedData['netIncome'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: var(--color-surface, #FFFFFF);">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: var(--color-primary-light, #DBEAFE);">
                                    <svg class="w-5 h-5" style="color: var(--color-primary, #8B5CF6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Jumlah Hari</p>
                                <p class="text-2xl font-semibold style="color: var(--color-text, #1F2937);"">{{ $transformedData['details']->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Breakdown -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6" style="background: var(--color-surface, #FFFFFF);">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Detail Harian</h3>
                    
                    @if($transformedData['details']->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Pemasukan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Pengeluaran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Laba/Rugi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                    @foreach($transformedData['details'] as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-text, #1F2937);">
                                            {{ $detail['period'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-success, #10B981);">
                                            Rp {{ number_format($detail['income'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: var(--color-danger, #EF4444);">
                                            Rp {{ number_format($detail['expense'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: {{ $detail['net_income'] >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-danger, #EF4444)' }};">
                                            Rp {{ number_format($detail['net_income'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                            {{ $detail['transactions']->count() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 style="color: var(--color-text_secondary, #9CA3AF);"" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium style="color: var(--color-text, #1F2937);"">Tidak ada data</h3>
                            <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Tidak ada transaksi untuk periode ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Insights -->
            @if(isset($transformedData['insights']) && count($transformedData['insights']) > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">💡 Insights & Analisis</h3>
                    <div class="space-y-3">
                        @foreach($transformedData['insights'] as $insight)
                        <div class="flex items-start p-4 rounded-lg" style="background: {{ $insight['type'] == 'positive' ? 'var(--color-success-light, #D1FAE5)' : ($insight['type'] == 'warning' ? 'var(--color-warning-light, #FEF3C7)' : 'var(--color-primary-light, #DBEAFE)') }}; border-color: {{ $insight['type'] == 'positive' ? 'var(--color-success, #10B981)' : ($insight['type'] == 'warning' ? 'var(--color-warning, #F59E0B)' : 'var(--color-primary, #3B82F6)') }};">
                            <div class="flex-shrink-0">
                                @if($insight['type'] == 'positive')
                                    <svg class="w-5 h-5" style="color: var(--color-success, #10B981);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @elseif($insight['type'] == 'warning')
                                    <svg class="w-5 h-5" style="color: var(--color-warning, #F59E0B);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" style="color: var(--color-primary, #3B82F6);" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-bold" style="color: {{ $insight['type'] == 'positive' ? 'var(--color-success-dark, #065F46)' : ($insight['type'] == 'warning' ? 'var(--color-warning-dark, #92400E)' : 'var(--color-primary-dark, #1E40AF)') }};">
                                    {{ $insight['title'] }}
                                </h4>
                                <p class="text-sm font-semibold mt-1" style="color: {{ $insight['type'] == 'positive' ? 'var(--color-success-dark, #065F46)' : ($insight['type'] == 'warning' ? 'var(--color-warning-dark, #92400E)' : 'var(--color-primary-dark, #1E40AF)') }};">
                                    {{ $insight['message'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>












