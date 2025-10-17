<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Edit Pajak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 style="color: var(--color-text, #1F2937);"">
                    <form method="POST" action="{{ route('taxes.update', $tax) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Status Pajak</label>
                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="unpaid" {{ $tax->status === 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="paid" {{ $tax->status === 'paid' ? 'selected' : '' }}>Lunas</option>
                                <option value="overdue" {{ $tax->status === 'overdue' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Metode Pembayaran</label>
                            <input type="text" name="payment_method" value="{{ $tax->payment_method }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Referensi Pembayaran</label>
                            <input type="text" name="payment_reference" value="{{ $tax->payment_reference }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <a href="{{ route('taxes.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Pajak</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $tax->name) }}" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-300 @enderror"
                                   placeholder="Contoh: PPN, PPh 21, PPh 23, PBB">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">Jenis pajak umum:</p>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    @foreach(['PPN', 'PPh 21', 'PPh 23', 'PBB', 'Pajak Daerah', 'Pajak Bulanan'] as $taxType)
                                        <button type="button" onclick="document.getElementById('name').value='{{ $taxType }}'"
                                                class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                                            {{ $taxType }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pajak (Rp)</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $tax->amount) }}" required min="0" step="0.01"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('amount') border-red-300 @enderror"
                                   placeholder="0">
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Jatuh Tempo</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $tax->due_date->format('Y-m-d')) }}" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('due_date') border-red-300 @enderror">
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                            <select name="status" id="status" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-300 @enderror">
                                <option value="">Pilih Status</option>
                                <option value="unpaid" {{ old('status', $tax->status) == 'unpaid' ? 'selected' : '' }}>Belum Dibayar</option>
                                <option value="paid" {{ old('status', $tax->status) == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('taxes.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Pajak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


