<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Tambah Modal Baru') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('capitals.store') }}" method="POST">
                        @csrf

                        <!-- Initial Amount -->
                        <div class="mb-4">
                            <label for="initial_amount" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Jumlah Modal (Rp)</label>
                            <input type="number" name="initial_amount" id="initial_amount" value="{{ old('initial_amount') }}" required min="0" step="0.01"
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
                                      placeholder="Jelaskan sumber modal dan tujuan penggunaannya...">{{ old('description') }}</textarea>
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
                        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800">Tentang Modal Usaha</h4>
                                    <p class="text-sm text-blue-600 mt-1">
                                        Modal adalah dana yang digunakan untuk memulai atau mengembangkan usaha. 
                                        Pencatatan modal yang akurat membantu Anda menghitung ROI (Return on Investment) 
                                        dan mengetahui seberapa efektif penggunaan modal dalam menghasilkan keuntungan.
                                    </p>
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
                                Simpan Modal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


