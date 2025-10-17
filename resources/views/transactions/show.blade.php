<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
                {{ __('Detail Transaksi') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('transactions.edit', $transaction) }}" 
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <a href="{{ route('transactions.index') }}" 
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
                        <!-- Transaction Details -->
                        <div>
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Informasi Transaksi</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Tipe Transaksi</label>
                                    <span class="mt-1 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $transaction->type == 'income' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                    </span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Kategori</label>
                                    <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $transaction->category }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Jumlah</label>
                                    <p class="mt-1 text-2xl font-bold {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type == 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Tanggal Transaksi</label>
                                    <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $transaction->date->format('d F Y') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Tanggal Dibuat</label>
                                    <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $transaction->created_at->format('d F Y H:i') }}</p>
                                </div>

                                @if($transaction->updated_at != $transaction->created_at)
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Terakhir Diupdate</label>
                                        <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $transaction->updated_at->format('d F Y H:i') }}</p>
                                    </div>
                                @endif

                                @if($transaction->description)
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Deskripsi</label>
                                        <p class="mt-1 text-sm style="color: var(--color-text, #1F2937);"">{{ $transaction->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Proof Section -->
                        <div>
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Bukti Transaksi</h3>
                            
                            @if($transaction->proof)
                                <div class="space-y-4">
                                    <div>
                                        <img src="{{ Storage::url($transaction->proof) }}" 
                                             alt="Bukti Transaksi" 
                                             class="w-full max-w-md rounded-lg shadow-md">
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ Storage::url($transaction->proof) }}" 
                                           target="_blank"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Ukuran Penuh
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                                    <svg class="mx-auto h-12 w-12 style="color: var(--color-text_secondary, #9CA3AF);"" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium style="color: var(--color-text, #1F2937);"">Tidak ada bukti transaksi</h3>
                                    <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Bukti transaksi belum diunggah.</p>
                                    
                                    <!-- Upload Form -->
                                    <form action="{{ route('transactions.upload-proof', $transaction) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                        @csrf
                                        <div class="flex flex-col items-center space-y-2">
                                            <input type="file" name="proof" accept="image/*" required
                                                   class="block w-full text-sm style="color: var(--color-text_secondary, #6B7280);" file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                                Upload Bukti
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.')">
                                    Hapus Transaksi
                                </button>
                            </form>

                            <div class="flex space-x-2">
                                <a href="{{ route('transactions.edit', $transaction) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Transaksi
                                </a>
                                <a href="{{ route('transactions.index') }}" 
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


