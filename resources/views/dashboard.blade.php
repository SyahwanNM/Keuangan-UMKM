<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--color-text, #1F2937);">
            {{ __('Dashboard Keuangan UMKM') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Business Info Card -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">Informasi Usaha</h3>
                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4" style="color: var(--color-primary, #3B82F6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Nama Usaha</p>
                            <p class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">{{ $user->business_name ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Jenis Usaha</p>
                            <p class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">{{ $user->business_type ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">No. HP</p>
                            <p class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">{{ $user->phone_number ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Alamat Usaha</p>
                            <p class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">{{ $user->business_address ? Str::limit($user->business_address, 30) : 'Belum diisi' }}</p>
                        </div>
                    </div>
                    @if($user->business_address)
                        <div class="mt-4 p-4 rounded-lg" style="background: var(--color-surface, #F9FAFB);">
                            <p class="text-sm font-medium mb-1" style="color: var(--color-text_secondary, #6B7280);">Alamat Lengkap:</p>
                            <p style="color: var(--color-text, #1F2937);">{{ $user->business_address }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Pemasukan Hari Ini -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-emerald-500 hover:shadow-xl transition-all duration-300 hover:border-emerald-600">
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
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Pemasukan Hari Ini</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-text, #1F2937);">Rp {{ number_format($todayIncome, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengeluaran Hari Ini -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-rose-500 hover:shadow-xl transition-all duration-300 hover:border-rose-600">
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
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Pengeluaran Hari Ini</p>
                                <p class="text-2xl font-semibold" style="color: var(--color-text, #1F2937);">Rp {{ number_format($todayExpense, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laba/Rugi Bulan Ini -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 {{ $monthlyProfit >= 0 ? 'border-indigo-500' : 'border-amber-500' }} hover:shadow-xl transition-all duration-300 {{ $monthlyProfit >= 0 ? 'hover:border-indigo-600' : 'hover:border-amber-600' }}">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 {{ $monthlyProfit >= 0 ? 'bg-gradient-to-r from-indigo-100 to-blue-100' : 'bg-gradient-to-r from-amber-100 to-yellow-100' }} rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: {{ $monthlyProfit >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">{{ $monthlyProfit >= 0 ? 'Laba' : 'Rugi' }} Bulan Ini</p>
                                <p class="text-2xl font-semibold" style="color: {{ $monthlyProfit >= 0 ? 'var(--color-primary, #3B82F6)' : 'var(--color-warning, #F59E0B)' }};">
                                    Rp {{ number_format(abs($monthlyProfit), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Modal -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 border-violet-500 hover:shadow-xl transition-all duration-300 hover:border-violet-600">
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
                                <p class="text-2xl font-semibold" style="color: var(--color-text, #1F2937);">Rp {{ number_format($totalCapital, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saldo Saat Ini -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border-l-4 {{ $currentBalance >= 0 ? 'border-emerald-500' : 'border-red-500' }} hover:shadow-xl transition-all duration-300 {{ $currentBalance >= 0 ? 'hover:border-emerald-600' : 'hover:border-red-600' }}">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 {{ $currentBalance >= 0 ? 'bg-gradient-to-r from-emerald-100 to-green-100' : 'bg-gradient-to-r from-red-100 to-rose-100' }} rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4" style="color: {{ $currentBalance >= 0 ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Saldo Saat Ini</p>
                                <p class="text-2xl font-semibold" style="color: {{ $currentBalance >= 0 ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)' }};">
                                    Rp {{ number_format($currentBalance, 0, ',', '.') }}
                                </p>
                                <p class="text-xs mt-1" style="color: var(--color-text_secondary, #6B7280);">
                                    {{ $currentBalance >= 0 ? 'Positif' : 'Negatif' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Breakdown Saldo -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border hover:shadow-xl transition-all duration-300" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Breakdown Saldo</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm" style="color: var(--color-text_secondary, #6B7280);">Modal Awal</span>
                                <span class="text-sm font-semibold" style="color: var(--color-text, #1F2937);">+ Rp {{ number_format($totalCapital, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm" style="color: var(--color-text_secondary, #6B7280);">Total Pemasukan</span>
                                <span class="text-sm font-semibold" style="color: var(--color-success, #10B981);">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm" style="color: var(--color-text_secondary, #6B7280);">Total Pengeluaran</span>
                                <span class="text-sm font-semibold" style="color: var(--color-danger, #EF4444);">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</span>
                            </div>
                            <hr style="border-color: var(--color-border, #E5E7EB);">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium" style="color: var(--color-text, #1F2937);">Saldo Akhir</span>
                                <span class="text-sm font-bold" style="color: {{ $currentBalance >= 0 ? 'var(--color-success, #10B981)' : 'var(--color-danger, #EF4444)' }};">
                                    Rp {{ number_format($currentBalance, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Chart -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Grafik Pemasukan & Pengeluaran (7 Hari Terakhir)</h3>
                        <canvas id="incomeExpenseChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Pajak yang Akan Jatuh Tempo -->
                <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border" style="border-color: var(--color-border, #F3F4F6);">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">Pajak Akan Jatuh Tempo</h3>
                            <div class="flex gap-2">
                                <button type="button" 
                                        id="dashboardAutoCalculateBtn"
                                        class="text-xs font-bold py-1 px-3 rounded transition duration-150 ease-in-out"
                                        style="background: #8B5CF6; color: white;"
                                        onmouseover="this.style.background='#7C3AED'"
                                        onmouseout="this.style.background='#8B5CF6'">
                                    🔄 Hitung Otomatis
                                </button>
                                <a href="{{ route('taxes.index') }}" class="text-sm font-medium" style="color: var(--color-primary, #3B82F6);" onmouseover="this.style.color='var(--color-primary-dark, #1D4ED8)'" onmouseout="this.style.color='var(--color-primary, #3B82F6)'">Kelola Pajak</a>
                            </div>
                        </div>
                        @if($upcomingTaxes->count() > 0)
                            <div class="space-y-3">
                                @foreach($upcomingTaxes as $tax)
                                    <div class="flex items-center justify-between p-3 rounded-lg" style="background: var(--color-surface, #FEF3C7);">
                                        <div>
                                            <p class="font-medium" style="color: var(--color-text, #1F2937);">{{ $tax->name }}</p>
                                            <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">Jatuh tempo: {{ $tax->due_date->format('d M Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold" style="color: var(--color-text, #1F2937);">Rp {{ number_format($tax->amount, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center py-4" style="color: var(--color-text_secondary, #6B7280);">Tidak ada pajak yang akan jatuh tempo</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="stat-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold" style="color: var(--color-text, #1F2937);">Transaksi Terbaru</h3>
                        <a href="{{ route('transactions.index') }}" class="text-sm font-medium" style="color: var(--color-primary, #3B82F6);" onmouseover="this.style.color='var(--color-primary-dark, #1D4ED8)'" onmouseout="this.style.color='var(--color-primary, #3B82F6)'">Lihat Semua</a>
                    </div>
                    @if($recentTransactions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                <thead style="background: var(--color-surface, #F8FAFC);">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Tipe</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--color-text, #1F2937);">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody style="background: var(--color-surface, #FFFFFF);" class="divide-y" style="border-color: var(--color-border, #E5E7EB);">
                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                {{ $transaction->date->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                {{ $transaction->category }}
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium" style="color: var(--color-text, #1F2937);">
                                                {{ Str::limit($transaction->description, 50) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full" style="background: {{ $transaction->type == 'income' ? 'var(--color-success-light, #D1FAE5)' : 'var(--color-danger-light, #FEE2E2)' }}; color: {{ $transaction->type == 'income' ? 'var(--color-success-dark, #065F46)' : 'var(--color-danger-dark, #991B1B)' }};">
                                                    {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                                </span>
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
                        <p class="text-center py-4" style="color: var(--color-text_secondary, #6B7280);">Belum ada transaksi</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
        const chartData = @json($chartData);
        
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(item => item.date),
                datasets: [{
                    label: 'Pemasukan',
                    data: chartData.map(item => item.income),
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.1
                }, {
                    label: 'Pengeluaran',
                    data: chartData.map(item => item.expense),
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
        
        // Auto Calculate Pajak di Dashboard
        document.getElementById('dashboardAutoCalculateBtn').addEventListener('click', function() {
            const button = this;
            const originalText = button.innerHTML;
            
            // Tampilkan loading
            button.innerHTML = '⏳ Menghitung...';
            button.disabled = true;
            
            // Panggil API auto-calculate
            fetch('{{ route("taxes.auto-calculate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // Tampilkan notifikasi sukses
                    showNotification('success', data.message);
                    
                    // Reload halaman untuk menampilkan hasil
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification('error', 'Terjadi kesalahan saat menghitung pajak');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan saat menghitung pajak');
            })
            .finally(() => {
                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;
            });
        });
        
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
</x-app-layout>
