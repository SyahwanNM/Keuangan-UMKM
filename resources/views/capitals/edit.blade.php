<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Edit Modal') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('capitals.update', $capital) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Initial Amount -->
                        <div class="mb-4">
                            <label for="initial_amount" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Jumlah Modal (Rp)</label>
                            <input type="number" name="initial_amount" id="initial_amount" value="{{ old('initial_amount', $capital->initial_amount) }}" required min="0" step="0.01"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('initial_amount') border-red-300 @enderror"
                                   placeholder="0">
                            @error('initial_amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Masukkan jumlah modal yang akan diinvestasikan ke dalam usaha.</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Deskripsi Modal</label>
                            <textarea name="description" id="description" rows="4" required
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 @enderror"
                                      placeholder="Jelaskan sumber modal dan tujuan penggunaannya...">{{ old('description', $capital->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <div class="mt-2">
                                <p class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Contoh deskripsi modal:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-1">
                                    @foreach([
                                        'Modal awal usaha dari tabungan pribadi',
                                        'Investasi dari investor/partner',
                                        'Pinjaman modal usaha dari bank',
                                        'Modal tambahan untuk ekspansi',
                                        'Dana hibah atau grant usaha',
                                        'Modal dari penjualan aset'
                                    ] as $example)
                                        <button type="button" onclick="document.getElementById('description').value='{{ $example }}'"
                                                class="text-left px-2 py-1 text-xs bg-gray-100 style="color: var(--color-text_secondary, #6B7280);" rounded hover:bg-gray-200">
                                            {{ $example }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800">Peringatan</h4>
                                    <p class="text-sm text-yellow-600 mt-1">
                                        Mengubah jumlah modal akan mempengaruhi perhitungan ROI (Return on Investment) 
                                        dan statistik keuangan lainnya. Pastikan data yang dimasukkan sudah benar.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Current Info -->
                        <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <h4 class="text-sm font-medium style="color: var(--color-text, #1F2937);" mb-2">Informasi Saat Ini</h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Tanggal Dibuat:</span>
                                    <span class="font-medium">{{ $capital->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Terakhir Diupdate:</span>
                                    <span class="font-medium">{{ $capital->updated_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('capitals.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Modal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


