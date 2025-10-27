<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl style="color: var(--color-text, #1F2937);" leading-tight">
            {{ __('Tema & Tampilan') }}
        </h2>
    </x-slot>

        <div class="py-6 theme-bg" style="color: var(--color-text, #1F2937); position: relative; z-index: 1;">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('theme.update') }}" method="POST" id="theme-form">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Theme Settings -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Theme Selection -->
                        <div class="overflow-hidden shadow-lg sm:rounded-xl theme-surface" style="border: 1px solid var(--color-text_secondary, #6B7280); position: relative; z-index: 2;">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Tema Dasar</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="theme" value="light" {{ $preferences->theme == 'light' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->theme == 'light' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200">
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-white border-2 border-gray-300 rounded-lg mx-auto mb-2"></div>
                                                <div class="text-sm font-medium style="color: var(--color-text, #1F2937);"">Terang</div>
                                                <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Tema terang standar</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="theme" value="dark" {{ $preferences->theme == 'dark' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->theme == 'dark' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200">
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-gray-800 border-2 border-gray-600 rounded-lg mx-auto mb-2"></div>
                                                <div class="text-sm font-medium style="color: var(--color-text, #1F2937);"">Gelap</div>
                                                <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Tema gelap untuk mata</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="theme" value="auto" {{ $preferences->theme == 'auto' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->theme == 'auto' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200">
                                            <div class="text-center">
                                                <div class="w-12 h-12 bg-gradient-to-r from-white to-gray-800 border-2 border-gray-400 rounded-lg mx-auto mb-2"></div>
                                                <div class="text-sm font-medium style="color: var(--color-text, #1F2937);"">Otomatis</div>
                                                <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Ikuti sistem</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Color Scheme -->
                        <div class="overflow-hidden shadow-lg sm:rounded-xl theme-surface" style="border: 1px solid var(--color-text_secondary, #6B7280); position: relative; z-index: 2;">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Skema Warna</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                                    @php
                                        $colorSchemes = [
                                            'blue' => ['name' => 'Biru', 'primary' => '#3B82F6', 'secondary' => '#1E40AF'],
                                            'green' => ['name' => 'Hijau', 'primary' => '#10B981', 'secondary' => '#047857'],
                                            'purple' => ['name' => 'Ungu', 'primary' => '#8B5CF6', 'secondary' => '#7C3AED'],
                                            'red' => ['name' => 'Merah', 'primary' => '#EF4444', 'secondary' => '#DC2626'],
                                            'orange' => ['name' => 'Orange', 'primary' => '#F97316', 'secondary' => '#EA580C'],
                                        ];
                                    @endphp
                                    @foreach($colorSchemes as $key => $colors)
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="color_scheme" value="{{ $key }}" {{ $preferences->color_scheme == $key ? 'checked' : '' }} class="sr-only">
                                            <div class="p-4 border-2 rounded-lg {{ $preferences->color_scheme == $key ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200">
                                                <div class="text-center">
                                                    <div class="w-8 h-8 rounded-full mx-auto mb-2" style="background: linear-gradient(45deg, {{ $colors['primary'] }}, {{ $colors['secondary'] }})"></div>
                                                    <div class="text-sm font-medium" style="color: var(--color-text, #1F2937);">{{ $colors['name'] }}</div>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Font Size -->
                        <div class="overflow-hidden shadow-lg sm:rounded-xl theme-surface" style="border: 1px solid var(--color-text_secondary, #6B7280); position: relative; z-index: 2;">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4" style="color: var(--color-text, #1F2937);">Ukuran Font</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="font_size" value="small" {{ $preferences->font_size == 'small' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->font_size == 'small' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200 text-center">
                                            <div class="text-sm font-medium" style="color: var(--color-text, #1F2937);">Kecil</div>
                                            <div class="text-xs" style="color: var(--color-text_secondary, #6B7280);">14px</div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="font_size" value="medium" {{ $preferences->font_size == 'medium' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->font_size == 'medium' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200 text-center">
                                            <div class="text-base font-medium" style="color: var(--color-text, #1F2937);">Sedang</div>
                                            <div class="text-xs" style="color: var(--color-text_secondary, #6B7280);">16px</div>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="font_size" value="large" {{ $preferences->font_size == 'large' ? 'checked' : '' }} class="sr-only">
                                        <div class="p-4 border-2 rounded-lg {{ $preferences->font_size == 'large' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200 text-center">
                                            <div class="text-lg font-medium" style="color: var(--color-text, #1F2937);">Besar</div>
                                            <div class="text-xs" style="color: var(--color-text_secondary, #6B7280);">18px</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Sidebar Settings -->
                    <div class="space-y-6">

                        <!-- Display Options -->
                       

                        <!-- Format Settings -->
                        <div class="overflow-hidden shadow-lg sm:rounded-xl theme-surface" style="border: 1px solid var(--color-text_secondary, #6B7280); position: relative; z-index: 2;">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-4">Format Data</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Format Tanggal</label>
                                        <select name="date_format" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="d-m-Y" {{ $preferences->date_format == 'd-m-Y' ? 'selected' : '' }}>DD-MM-YYYY</option>
                                            <option value="m/d/Y" {{ $preferences->date_format == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                            <option value="Y-m-d" {{ $preferences->date_format == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Format Waktu</label>
                                        <select name="time_format" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="24" {{ $preferences->time_format == '24' ? 'selected' : '' }}>24 Jam</option>
                                            <option value="12" {{ $preferences->time_format == '12' ? 'selected' : '' }}>12 Jam (AM/PM)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Format Angka</label>
                                        <select name="number_format" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="dot" {{ $preferences->number_format == 'dot' ? 'selected' : '' }}>Titik (1.000.000)</option>
                                            <option value="comma" {{ $preferences->number_format == 'comma' ? 'selected' : '' }}>Koma (1,000,000)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <button type="button" onclick="resetTheme()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Reset ke Default
                        </button>
                        <button type="button" onclick="previewTheme()" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Preview
                        </button>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function resetTheme() {
            if (confirm('Apakah Anda yakin ingin mereset tema ke pengaturan default?')) {
                // Show loading state
                const resetButton = document.querySelector('button[onclick="resetTheme()"]');
                const originalText = resetButton.textContent;
                resetButton.textContent = 'Mereset...';
                resetButton.disabled = true;
                
                fetch('{{ route("theme.reset") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    console.log('Reset response status:', response.status);
                    console.log('Reset response headers:', response.headers);
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.status);
                    }
                    
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Response is not JSON. Content-Type: ' + contentType);
                    }
                    
                    return response.json();
                })
                .then(data => {
                    console.log('Reset response data:', data);
                    
                    if (data.success) {
                        alert('Tema berhasil direset!');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan saat mereset tema: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Reset error:', error);
                    alert('Terjadi kesalahan saat mereset tema: ' + error.message);
                })
                .finally(() => {
                    // Reset button state
                    resetButton.textContent = originalText;
                    resetButton.disabled = false;
                });
            }
        }

        function previewTheme() {
            const formData = new FormData(document.getElementById('theme-form'));
            const data = Object.fromEntries(formData);
            
            // Debug: Log preview data
            console.log('Preview data:', data);
            
            // Show loading state
            const previewButton = document.querySelector('button[onclick="previewTheme()"]');
            const originalText = previewButton.textContent;
            previewButton.textContent = 'Mempersiapkan...';
            previewButton.disabled = true;
            
            fetch('{{ route("theme.preview") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => {
                console.log('Preview response status:', response.status);
                console.log('Preview response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Response is not JSON. Content-Type: ' + contentType);
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Preview response data:', data);
                
                if (data.success && data.css_variables) {
                    // Apply preview styles
                    const root = document.documentElement;
                    Object.entries(data.css_variables).forEach(([key, value]) => {
                        root.style.setProperty(key, value);
                    });
                    
                    alert('Preview tema diterapkan! Refresh halaman untuk melihat perubahan permanen.');
                } else {
                    alert('Terjadi kesalahan saat preview tema: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Preview error:', error);
                alert('Terjadi kesalahan saat preview tema: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                previewButton.textContent = originalText;
                previewButton.disabled = false;
            });
        }

        // Auto-save on change
        document.querySelectorAll('input[type="radio"], input[type="checkbox"], select').forEach(element => {
            element.addEventListener('change', function() {
                // Optional: Auto-save functionality
                console.log('Theme preference changed:', this.name, this.value);
                
                // Visual feedback for selection
                if (this.type === 'radio') {
                    // Remove selected state from other radio buttons in same group
                    document.querySelectorAll(`input[name="${this.name}"]`).forEach(radio => {
                        radio.closest('label').classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50');
                    });
                    
                    // Add selected state to current radio button
                    this.closest('label').classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');
                }
                
                // Check if form is valid
                const form = document.getElementById('theme-form');
                const isValid = form.checkValidity();
                console.log('Form is valid:', isValid);
            });
        });

        // Form submission with error handling
        document.getElementById('theme-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Debug: Log form data
            console.log('Form data:', data);
            
            // Debug: Log all form data
            console.log('All form data:', data);
            console.log('Form data keys:', Object.keys(data));
            
            // Debug: Check each field
            Object.keys(data).forEach(field => {
                console.log(`Field ${field}:`, data[field], 'exists:', !!data[field]);
            });
            
            // Handle checkbox fields that might not be present if unchecked
            if (!data.show_animations) data.show_animations = '0';
            if (!data.show_tooltips) data.show_tooltips = '0';
            
            // Filter out empty values and only send fields that have values
            const filteredData = {};
            Object.keys(data).forEach(key => {
                if (data[key] && data[key] !== '' && data[key] !== '0') {
                    filteredData[key] = data[key];
                }
            });
            
            console.log('Filtered data to send:', filteredData);
            
            // Check if at least one field is being updated
            if (Object.keys(filteredData).length === 0) {
                alert('Tidak ada perubahan yang akan disimpan. Silakan pilih setidaknya satu pengaturan untuk diubah.');
                return;
            }
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.textContent = 'Menyimpan...';
            submitButton.disabled = true;
            
            fetch('{{ route("theme.update") }}', {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(filteredData),
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Response is not JSON. Content-Type: ' + contentType);
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                
                if (data.success) {
                    alert('Tema berhasil diperbarui!');
                    location.reload();
                } else {
                    alert('Terjadi kesalahan saat memperbarui tema: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui tema: ' + error.message);
            })
            .finally(() => {
                // Reset button state
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            });
        });

        // Initialize visual feedback on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add selected state to checked radio buttons
            document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                radio.closest('label').classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');
            });
            
            // Debug: Log form state
            const form = document.getElementById('theme-form');
            console.log('Form initialized:', form);
            console.log('Form elements:', form.elements);
            
            // Check if all required fields are filled
            const requiredFields = form.querySelectorAll('[required]');
            console.log('Required fields:', requiredFields.length);
            
            requiredFields.forEach(field => {
                console.log('Required field:', field.name, 'value:', field.value, 'valid:', field.validity.valid);
            });
        });

        // Apply theme changes in real-time
        function applyThemeChanges() {
            const formData = new FormData(document.getElementById('theme-form'));
            const data = Object.fromEntries(formData);
            
            // Filter out empty values
            const filteredData = {};
            Object.keys(data).forEach(key => {
                if (data[key] && data[key] !== '' && data[key] !== '0') {
                    filteredData[key] = data[key];
                }
            });
            
            // Handle checkbox fields
            if (!filteredData.show_animations) filteredData.show_animations = '0';
            if (!filteredData.show_tooltips) filteredData.show_tooltips = '0';
            
            // Apply CSS variables immediately
            if (filteredData.theme || filteredData.color_scheme) {
                // Create temporary preferences for preview
                const tempPreferences = {
                    theme: filteredData.theme || '{{ $preferences->theme }}',
                    color_scheme: filteredData.color_scheme || '{{ $preferences->color_scheme }}',
                    font_size: filteredData.font_size || '{{ $preferences->font_size }}'
                };
                
                // Apply theme colors based on color scheme
                const colorSchemes = {
                    'blue': {
                        '--color-primary': '#3B82F6',
                        '--color-secondary': '#1E40AF',
                        '--color-accent': '#60A5FA',
                        '--color-background': '#F8FAFC',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    },
                    'green': {
                        '--color-primary': '#10B981',
                        '--color-secondary': '#047857',
                        '--color-accent': '#34D399',
                        '--color-background': '#F0FDF4',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    },
                    'purple': {
                        '--color-primary': '#8B5CF6',
                        '--color-secondary': '#7C3AED',
                        '--color-accent': '#A78BFA',
                        '--color-background': '#FAF5FF',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    },
                    'red': {
                        '--color-primary': '#EF4444',
                        '--color-secondary': '#DC2626',
                        '--color-accent': '#F87171',
                        '--color-background': '#FEF2F2',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    },
                    'orange': {
                        '--color-primary': '#F97316',
                        '--color-secondary': '#EA580C',
                        '--color-accent': '#FB923C',
                        '--color-background': '#FFF7ED',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    },
                };
                
                // Apply theme-specific colors first
                if (tempPreferences.theme === 'dark') {
                    // Enhanced dark theme colors with gradients
                    const darkColors = {
                        '--color-primary': '#60A5FA',
                        '--color-secondary': '#3B82F6',
                        '--color-accent': '#93C5FD',
                        '--color-background': 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                        '--color-surface': 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                        '--color-text': '#F1F5F9',
                        '--color-text_secondary': '#CBD5E1',
                    };
                    
                    const root = document.documentElement;
                    Object.entries(darkColors).forEach(([key, value]) => {
                        root.style.setProperty(key, value);
                    });
                } else if (tempPreferences.theme === 'light') {
                    // Light theme colors
                    const lightColors = {
                        '--color-primary': '#3B82F6',
                        '--color-secondary': '#1E40AF',
                        '--color-accent': '#60A5FA',
                        '--color-background': '#F8FAFC',
                        '--color-surface': '#FFFFFF',
                        '--color-text': '#1F2937',
                        '--color-text_secondary': '#6B7280',
                    };
                    
                    const root = document.documentElement;
                    Object.entries(lightColors).forEach(([key, value]) => {
                        root.style.setProperty(key, value);
                    });
                }
                
                // Then apply color scheme overrides
                if (tempPreferences.color_scheme) {
                    const colors = colorSchemes[tempPreferences.color_scheme] || colorSchemes['blue'];
                    const root = document.documentElement;
                    
                    // Override primary colors
                    root.style.setProperty('--color-primary', colors['--color-primary']);
                    root.style.setProperty('--color-secondary', colors['--color-secondary']);
                    root.style.setProperty('--color-accent', colors['--color-accent']);
                    
                    // For dark theme, keep background and surface dark, only change accent colors
                    // Background and surface remain dark with subtle color accents via CSS
                }
                
                // Update data-theme attribute
                document.body.setAttribute('data-theme', tempPreferences.theme);
            }
        }

        // Add event listeners for real-time theme changes
        document.querySelectorAll('input[type="radio"], select').forEach(element => {
            element.addEventListener('change', applyThemeChanges);
        });
    </script>
</x-app-layout>




