<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Tambah Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-card overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Tipe Transaksi</label>
                            <select name="type" id="type" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('type') border-red-300 @enderror">
                                <option value="">Pilih Tipe</option>
                                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Kategori</label>
                            <select name="category" id="category" required 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('category') border-red-300 @enderror">
                                <option value="">Pilih Kategori</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Custom Category Input -->
                            <div class="mt-2">
                                <label for="custom_category" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-1">Atau masukkan kategori custom:</label>
                                <input type="text" name="custom_category" id="custom_category" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Masukkan kategori custom...">
                            </div>
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Jumlah (Rp)</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required min="0" step="0.01"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('amount') border-red-300 @enderror"
                                   placeholder="0">
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Tanggal Transaksi</label>
                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('date') border-red-300 @enderror">
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-300 @enderror"
                                      placeholder="Deskripsi detail transaksi...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Proof -->
                        <div class="mb-6">
                            <label for="proof" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Bukti Transaksi (Opsional)</label>
                            <input type="file" name="proof" id="proof" accept="image/*"
                                   class="block w-full text-sm style="color: var(--color-text_secondary, #6B7280);" file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('proof') border-red-300 @enderror">
                            <p class="mt-1 text-sm style="color: var(--color-text_secondary, #6B7280);"">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                            @error('proof')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('transactions.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Kategori yang sudah ditentukan
        const categories = {
            income: [
                'Penjualan Produk',
                'Penjualan Jasa',
                'Pendapatan Lain-lain',
                'Komisi',
                'Bunga Bank',
                'Dividen',
                'Hibah',
                'Subsidi Pemerintah',
                'Pendapatan Online',
                'Pendapatan Offline'
            ],
            expense: [
                'Bahan Baku',
                'Transportasi',
                'Listrik',
                'Air',
                'Internet',
                'Telepon',
                'Sewa Tempat',
                'Gaji Karyawan',
                'Peralatan',
                'Pemeliharaan',
                'Pajak',
                'Asuransi',
                'Pemasaran',
                'Administrasi',
                'Lain-lain'
            ]
        };

        // Fungsi untuk mengisi dropdown kategori
        function updateCategories() {
            const typeSelect = document.getElementById('type');
            const categorySelect = document.getElementById('category');
            const customCategoryInput = document.getElementById('custom_category');
            
            // Clear existing options
            categorySelect.innerHTML = '<option value="">Pilih Kategori</option>';
            
            if (typeSelect.value) {
                const typeCategories = categories[typeSelect.value] || [];
                
                typeCategories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category;
                    option.textContent = category;
                    categorySelect.appendChild(option);
                });
            }
        }

        // Event listener untuk perubahan tipe transaksi
        document.getElementById('type').addEventListener('change', updateCategories);
        
        // Event listener untuk custom category
        document.getElementById('custom_category').addEventListener('input', function() {
            const categorySelect = document.getElementById('category');
            if (this.value.trim()) {
                categorySelect.value = this.value.trim();
            }
        });

        // Event listener untuk dropdown category
        document.getElementById('category').addEventListener('change', function() {
            const customCategoryInput = document.getElementById('custom_category');
            if (this.value) {
                customCategoryInput.value = '';
            }
        });

        // Initialize categories on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCategories();
        });
    </script>
</x-app-layout>

