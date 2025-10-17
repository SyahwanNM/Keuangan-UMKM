<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Edit Informasi Usaha') }}
        </h2>
    </x-slot>

    <div class="py-6 theme-bg">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="dashboard-card overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <form action="{{ route('business-info.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4 border-b border-gray-200 pb-2">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('name') border-red-500 @enderror">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Business Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4 border-b border-gray-200 pb-2">Informasi Usaha</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Business Name -->
                                <div>
                                    <label for="business_name" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Nama Usaha</label>
                                    <input type="text" name="business_name" id="business_name" value="{{ old('business_name', $user->business_name) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_name') border-red-500 @enderror">
                                    @error('business_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Business Type -->
                                <div>
                                    <label for="business_type" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Jenis Usaha</label>
                                    <select name="business_type" id="business_type" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_type') border-red-500 @enderror">
                                        <option value="">Pilih Jenis Usaha</option>
                                        <option value="Perdagangan" {{ old('business_type', $user->business_type) == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                                        <option value="Jasa" {{ old('business_type', $user->business_type) == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                        <option value="Manufaktur" {{ old('business_type', $user->business_type) == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                                        <option value="Pertanian" {{ old('business_type', $user->business_type) == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                        <option value="Peternakan" {{ old('business_type', $user->business_type) == 'Peternakan' ? 'selected' : '' }}>Peternakan</option>
                                        <option value="Perikanan" {{ old('business_type', $user->business_type) == 'Perikanan' ? 'selected' : '' }}>Perikanan</option>
                                        <option value="Kuliner" {{ old('business_type', $user->business_type) == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                                        <option value="Teknologi" {{ old('business_type', $user->business_type) == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                        <option value="Lainnya" {{ old('business_type', $user->business_type) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('business_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Business Size -->
                                <div>
                                    <label for="business_size" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Ukuran Usaha</label>
                                    <select name="business_size" id="business_size"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_size') border-red-500 @enderror">
                                        <option value="">Pilih Ukuran Usaha</option>
                                        <option value="Mikro (1-4 karyawan)" {{ old('business_size', $user->business_size) == 'Mikro (1-4 karyawan)' ? 'selected' : '' }}>Mikro (1-4 karyawan)</option>
                                        <option value="Kecil (5-19 karyawan)" {{ old('business_size', $user->business_size) == 'Kecil (5-19 karyawan)' ? 'selected' : '' }}>Kecil (5-19 karyawan)</option>
                                        <option value="Menengah (20-99 karyawan)" {{ old('business_size', $user->business_size) == 'Menengah (20-99 karyawan)' ? 'selected' : '' }}>Menengah (20-99 karyawan)</option>
                                        <option value="Besar (100+ karyawan)" {{ old('business_size', $user->business_size) == 'Besar (100+ karyawan)' ? 'selected' : '' }}>Besar (100+ karyawan)</option>
                                    </select>
                                    @error('business_size')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Business Established -->
                                <div>
                                    <label for="business_established" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Tanggal Berdiri</label>
                                    <input type="date" name="business_established" id="business_established" value="{{ old('business_established', $user->business_established?->format('Y-m-d')) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_established') border-red-500 @enderror">
                                    @error('business_established')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Business Description -->
                            <div class="mt-6">
                                <label for="business_description" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Deskripsi Usaha</label>
                                <textarea name="business_description" id="business_description" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_description') border-red-500 @enderror"
                                          placeholder="Ceritakan tentang usaha Anda...">{{ old('business_description', $user->business_description) }}</textarea>
                                @error('business_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4 border-b border-gray-200 pb-2">Informasi Kontak</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone Number -->
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">No. HP</label>
                                    <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('phone_number') border-red-500 @enderror">
                                    @error('phone_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Business Website -->
                                <div>
                                    <label for="business_website" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Website Usaha</label>
                                    <input type="url" name="business_website" id="business_website" value="{{ old('business_website', $user->business_website) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_website') border-red-500 @enderror"
                                           placeholder="https://example.com">
                                    @error('business_website')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Business Address -->
                            <div class="mt-6">
                                <label for="business_address" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Alamat Usaha</label>
                                <textarea name="business_address" id="business_address" rows="3" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('business_address') border-red-500 @enderror"
                                          placeholder="Alamat lengkap usaha Anda...">{{ old('business_address', $user->business_address) }}</textarea>
                                @error('business_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4 border-b border-gray-200 pb-2">Ubah Password (Opsional)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Current Password -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Password Saat Ini</label>
                                    <input type="password" name="current_password" id="current_password"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('current_password') border-red-500 @enderror">
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Password Baru</label>
                                    <input type="password" name="password" id="password"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                </div>
                            </div>
                            <p class="mt-2 text-sm style="color: var(--color-text_secondary, #6B7280);"">Kosongkan jika tidak ingin mengubah password</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('business-info.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>