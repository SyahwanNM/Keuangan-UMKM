<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Detail Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 style="color: var(--color-text, #1F2937);"">
                    <h3 class="text-lg font-semibold mb-4">{{ $tax->name }}</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Jenis Pajak:</strong> {{ $tax->name }}</p>
                            <p><strong>Jumlah:</strong> Rp {{ number_format($tax->amount, 0, ',', '.') }}</p>
                            <p><strong>Tarif:</strong> {{ $tax->rate }}%</p>
                            <p><strong>Dasar Pengenaan:</strong> Rp {{ number_format($tax->taxable_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p><strong>Status:</strong> 
                                <span class="px-2 py-1 rounded text-sm 
                                    @if($tax->status === 'paid') bg-green-100 text-green-800
                                    @elseif($tax->status === 'overdue') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($tax->status) }}
                                </span>
                            </p>
                            <p><strong>Jatuh Tempo:</strong> {{ $tax->due_date->format('d M Y') }}</p>
                            <p><strong>Deskripsi:</strong> {{ $tax->description }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('taxes.index') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Pajak
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pajak') }}
            </h2>
            <div class="flex space-x-2">
                @if($tax->status == 'unpaid')
                    <form action="{{ route('taxes.mark-paid', $tax) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                onclick="return confirm('Tandai pajak ini sebagai sudah dibayar?')">
                            Tandai Sudah Dibayar
                        </button>
                    </form>
                @endif
                <a href="{{ route('taxes.edit', $tax) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('taxes.index') }}" 
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tax Details -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pajak</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Pajak</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $tax->name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jumlah Pajak</label>
                                    <p class="mt-1 text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($tax->amount, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                                    <span class="mt-1 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $tax->status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $tax->status == 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $tax->due_date->format('d F Y') }}</p>
                                    @if($tax->status == 'unpaid')
                                        @if($tax->due_date < now())
                                            <p class="text-red-600 text-sm font-medium">
                                                ⚠️ Overdue ({{ $tax->due_date->diffForHumans() }})
                                            </p>
                                        @else
                                            <p class="text-gray-500 text-sm">
                                                {{ $tax->due_date->diffForHumans() }}
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $tax->created_at->format('d F Y H:i') }}</p>
                                </div>

                                @if($tax->updated_at != $tax->created_at)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $tax->updated_at->format('d F Y H:i') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status & Actions -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status & Aksi</h3>
                            
                            <div class="space-y-4">
                                <!-- Status Card -->
                                <div class="p-4 rounded-lg {{ $tax->status == 'paid' ? 'bg-green-50 border border-green-200' : ($tax->due_date < now() ? 'bg-red-50 border border-red-200' : 'bg-yellow-50 border border-yellow-200') }}">
                                    @if($tax->status == 'paid')
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-green-800 font-medium">Pajak Sudah Dibayar</span>
                                        </div>
                                        <p class="text-green-600 text-sm mt-1">Pajak ini telah diselesaikan.</p>
                                    @elseif($tax->due_date < now())
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                            <span class="text-red-800 font-medium">Pajak Overdue</span>
                                        </div>
                                        <p class="text-red-600 text-sm mt-1">Pajak ini sudah melewati batas waktu pembayaran.</p>
                                    @else
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-yellow-800 font-medium">Menunggu Pembayaran</span>
                                        </div>
                                        <p class="text-yellow-600 text-sm mt-1">Pajak ini belum dibayar dan masih dalam batas waktu.</p>
                                    @endif
                                </div>

                                <!-- Quick Actions -->
                                @if($tax->status == 'unpaid')
                                    <div class="space-y-2">
                                        <h4 class="font-medium text-gray-900">Aksi Cepat</h4>
                                        <form action="{{ route('taxes.mark-paid', $tax) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                                    onclick="return confirm('Tandai pajak ini sebagai sudah dibayar?')">
                                                ✅ Tandai Sudah Dibayar
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                <!-- Reminder -->
                                @if($tax->status == 'unpaid' && $tax->due_date->diffInDays(now()) <= 7)
                                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-blue-800 text-sm font-medium">Pengingat</span>
                                        </div>
                                        <p class="text-blue-600 text-sm mt-1">
                                            Pajak ini akan jatuh tempo dalam {{ $tax->due_date->diffInDays(now()) }} hari.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <form action="{{ route('taxes.destroy', $tax) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Yakin ingin menghapus pajak ini? Tindakan ini tidak dapat dibatalkan.')">
                                    Hapus Pajak
                                </button>
                            </form>

                            <div class="flex space-x-2">
                                <a href="{{ route('taxes.edit', $tax) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Pajak
                                </a>
                                <a href="{{ route('taxes.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


