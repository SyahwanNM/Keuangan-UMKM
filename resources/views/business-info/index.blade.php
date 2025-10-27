<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Informasi Usaha') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Business Overview Card -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 mb-6">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                        <h3 class="text-2xl font-bold style="color: var(--color-text, #1F2937);"">Informasi Usaha</h3>
                        <a href="{{ route('business-info.edit') }}" 
                           class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                            Edit Informasi
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Basic Info -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" border-b border-gray-200 pb-2">Informasi Dasar</h4>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Nama Usaha</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->business_name ?? 'Belum diisi' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Jenis Usaha</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->business_type ?? 'Belum diisi' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Ukuran Usaha</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->business_size ?? 'Belum diisi' }}</p>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" border-b border-gray-200 pb-2">Kontak</h4>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Nama Pemilik</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Email</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">No. HP</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">{{ $user->phone_number ?? 'Belum diisi' }}</p>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" border-b border-gray-200 pb-2">Informasi Tambahan</h4>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Tanggal Berdiri</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">
                                    {{ $user->business_established ? $user->business_established->format('d M Y') : 'Belum diisi' }}
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">Website</label>
                                <p class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">
                                    @if($user->business_website)
                                        <a href="{{ $user->business_website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            {{ $user->business_website }}
                                        </a>
                                    @else
                                        Belum diisi
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-6">
                        <label class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Alamat Usaha</label>
                        <p class="text-lg font-semibold mt-1" style="color: var(--color-text, #1F2937);">{{ $user->business_address ?? 'Belum diisi' }}</p>
                    </div>

                    <!-- Description -->
                    @if($user->business_description)
                        <div class="mt-6">
                            <label class="text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);">Deskripsi Usaha</label>
                            <p class="mt-1 bg-gray-50 p-4 rounded-lg" style="color: var(--color-text, #1F2937);">{{ $user->business_description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <a href="{{ route('business-info.edit') }}" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 p-6 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-2">Edit Informasi</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);"">Ubah data usaha dan profil</p>
                </a>

                <a href="{{ route('dashboard') }}" 
                   class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 p-6 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-2">Dashboard</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);"">Kembali ke dashboard utama</p>
                </a>
            </div>

            <!-- Business Summary -->
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Ringkasan Usaha</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->transactions()->count() }}</div>
                            <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Total Transaksi</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">Rp {{ number_format($user->transactions()->where('type', 'income')->sum('amount'), 0, ',', '.') }}</div>
                            <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Total Pemasukan</div>
                        </div>
                        <div class="text-center p-4 bg-red-50 rounded-lg">
                            <div class="text-2xl font-bold text-red-600">Rp {{ number_format($user->transactions()->where('type', 'expense')->sum('amount'), 0, ',', '.') }}</div>
                            <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Total Pengeluaran</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $user->capitals()->count() }}</div>
                            <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Modal Awal</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>