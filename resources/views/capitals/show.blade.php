<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
                {{ __('Detail Modal') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('capitals.edit', $capital) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('capitals.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Capital Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Informasi Modal</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Jumlah Modal</label>
                                <p class="mt-1 text-3xl font-bold text-purple-600">
                                    Rp {{ number_format($capital->initial_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Deskripsi</label>
                                <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);" bg-gray-50 p-3 rounded-lg">
                                    {{ $capital->description }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Tanggal Dibuat</label>
                                    <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $capital->created_at->format('d F Y') }}</p>
                                    <p class="text-xs style="color: var(--color-text_secondary, #6B7280);"">{{ $capital->created_at->format('H:i') }} WIB</p>
                                </div>

                                @if($capital->updated_at != $capital->created_at)
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Terakhir Diupdate</label>
                                        <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $capital->updated_at->format('d F Y') }}</p>
                                        <p class="text-xs style="color: var(--color-text_secondary, #6B7280);"">{{ $capital->updated_at->format('H:i') }} WIB</p>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Umur Modal</label>
                                <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">
                                    {{ $capital->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Impact Analysis -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Analisis Dampak Modal</h3>
                        
                        @php
                            $user = Auth::user();
                            $totalCapital = $user->capitals->sum('initial_amount');
                            $totalIncome = $user->transactions()->where('type', 'income')->sum('amount');
                            $totalExpense = $user->transactions()->where('type', 'expense')->sum('amount');
                            $currentBalance = $totalCapital + $totalIncome - $totalExpense;
                            $capitalPercentage = $totalCapital > 0 ? ($capital->initial_amount / $totalCapital) * 100 : 0;
                            $roi = $totalCapital > 0 ? (($currentBalance - $totalCapital) / $totalCapital) * 100 : 0;
                        @endphp

                        <div class="space-y-4">
                            <!-- Capital Contribution -->
                            <div class="p-4 bg-purple-50 border border-purple-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-purple-800">Kontribusi Modal</h4>
                                        <p class="text-xs text-purple-600">Dari total modal keseluruhan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-purple-600">{{ number_format($capitalPercentage, 1) }}%</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="w-full bg-purple-200 rounded-full h-2">
                                        <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $capitalPercentage }}%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- ROI Impact -->
                            <div class="p-4 {{ $roi >= 0 ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium {{ $roi >= 0 ? 'text-green-800' : 'text-red-800' }}">
                                            Return on Investment
                                        </h4>
                                        <p class="text-xs {{ $roi >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            Keuntungan dari seluruh modal
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold {{ $roi >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $roi >= 0 ? '+' : '' }}{{ number_format($roi, 2) }}%
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Total Modal</p>
                                    <p class="text-sm font-semibold style="color: var(--color-text, #1F2937);"">
                                        Rp {{ number_format($totalCapital, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Saldo Saat Ini</p>
                                    <p class="text-sm font-semibold {{ $currentBalance >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Rp {{ number_format($currentBalance, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Performance Indicator -->
                            <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-blue-800">Performa Modal</h4>
                                        <p class="text-sm text-blue-600 mt-1">
                                            @if($roi > 20)
                                                Sangat baik! Modal Anda memberikan return yang tinggi.
                                            @elseif($roi > 10)
                                                Baik! Modal Anda memberikan return yang positif.
                                            @elseif($roi > 0)
                                                Cukup baik, modal Anda masih menguntungkan.
                                            @else
                                                Perlu evaluasi strategi bisnis untuk meningkatkan ROI.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <form action="{{ route('capitals.destroy', $capital) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Yakin ingin menghapus modal ini? Tindakan ini akan mempengaruhi perhitungan ROI dan tidak dapat dibatalkan.')">
                                Hapus Modal
                            </button>
                        </form>

                        <div class="flex space-x-2">
                            <a href="{{ route('capitals.edit', $capital) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit Modal
                            </a>
                            <a href="{{ route('capitals.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


