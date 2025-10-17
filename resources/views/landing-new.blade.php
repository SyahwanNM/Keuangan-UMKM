<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keuangan UMKM - Solusi Manajemen Keuangan Terlengkap untuk UMKM Indonesia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-card { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .gradient-green { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .gradient-yellow { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .feature-card { transition: all 0.3s ease; }
        .feature-card:hover { transform: translateY(-8px); }
        .glass-nav { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); }
        .text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%); }
        .section-spacing { padding: 100px 0; }
        .container-custom { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        @media (max-width: 768px) { 
            .section-spacing { padding: 60px 0; }
            .container-custom { padding: 0 15px; }
        }
        
        /* Theme responsive adjustments */
        @media (max-width: 640px) {
            .glass-nav {
                backdrop-filter: blur(10px);
            }
        }
    </style>
</head>
<body class="antialiased bg-white">
    <!-- Navigation -->
    <nav class="glass-nav fixed w-full z-50 top-0 border-b border-gray-100">
        <div class="container-custom">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold style="color: var(--color-text, #1F2937);"">Keuangan UMKM</span>
                    </div>
                </div>
                <div class="hidden sm:flex items-center space-x-8">
                    <a href="#beranda" class="style="color: var(--color-text_secondary, #6B7280);" hover:text-blue-600 font-medium transition">Beranda</a>
                    <a href="#fitur" class="style="color: var(--color-text_secondary, #6B7280);" hover:text-blue-600 font-medium transition">Fitur Lengkap</a>
                    <a href="#laporan" class="style="color: var(--color-text_secondary, #6B7280);" hover:text-blue-600 font-medium transition">Laporan</a>
                    <a href="#bantuan" class="style="color: var(--color-text_secondary, #6B7280);" hover:text-blue-600 font-medium transition">Bantuan</a>
                </div>
                <div class="flex items-center space-x-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition duration-200">Dashboard</a>
                        @else
                            <a href="{{ route('login.custom') }}" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register.custom') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition duration-200">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-hero section-spacing pt-32">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-white leading-tight mb-6 text-shadow">
                        Kelola Keuangan UMKM 
                        <span class="text-yellow-300">dengan Mudah & Akurat</span><br>
                        Solusi Terlengkap untuk Manajemen Keuangan Bisnis
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 leading-relaxed max-w-2xl">
                        Platform manajemen keuangan khusus UMKM yang memudahkan pencatatan transaksi, 
                        analisis keuangan, dan pelaporan pajak. Tingkatkan efisiensi bisnis Anda dengan 
                        tools keuangan yang powerful namun mudah digunakan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-12">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition duration-200 shadow-lg">
                                Buka Dashboard
                            </a>
                        @else
                    <a href="{{ route('register.custom') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition duration-200 shadow-lg">
                        Daftar
                    </a>
                    <a href="{{ route('login.custom') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-white hover:text-blue-600 transition duration-200">
                        Masuk
                    </a>
                        @endauth
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6 text-blue-100">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Pencatatan Transaksi Real-time</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Analisis Keuangan & ROI Otomatis</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Manajemen Pajak Terintegrasi</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Laporan Keuangan Lengkap</span>
                        </div>
                    </div>
                </div>
                
                <!-- Dashboard Preview -->
                <div class="flex justify-center lg:justify-end">
                    <div class="relative animate-float">
                        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 max-w-lg">
                            <!-- Browser Header -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                </div>
                                <div class="text-sm style="color: var(--color-text_secondary, #6B7280);" font-medium">Keuangan UMKM</div>
                                <div class="text-sm style="color: var(--color-text_secondary, #9CA3AF);"">Manajemen Keuangan UMKM</div>
                            </div>
                            
                            <!-- Dashboard Content -->
                            <div class="space-y-6">
                                <!-- Navigation Tabs -->
                                <div class="flex space-x-4 text-sm">
                                    <span class="text-blue-600 font-semibold border-b-2 border-blue-600 pb-1">Dashboard</span>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Transaksi</span>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Pajak</span>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Modal</span>
                                    <span class="style="color: var(--color-text_secondary, #6B7280);"">Laporan</span>
                                </div>
                                
                                <!-- Stats Cards -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-green-50 p-4 rounded-xl border border-green-100">
                                        <div class="text-xs text-green-600 font-semibold mb-1">Pemasukan Bulan Ini</div>
                                        <div class="text-lg font-bold text-green-700">Rp 15.750.000</div>
                                        <div class="text-xs text-green-500">+18% vs bulan lalu</div>
                                    </div>
                                    <div class="bg-red-50 p-4 rounded-xl border border-red-100">
                                        <div class="text-xs text-red-600 font-semibold mb-1">Pengeluaran Bulan Ini</div>
                                        <div class="text-lg font-bold text-red-700">Rp 8.200.000</div>
                                        <div class="text-xs text-red-500">+5% vs bulan lalu</div>
                                    </div>
                                </div>
                                
                                <!-- Financial Summary -->
                                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                                    <div class="text-xs text-blue-600 font-semibold mb-1">Laba Bersih Bulan Ini</div>
                                    <div class="text-2xl font-bold text-blue-700">Rp 7.550.000</div>
                                    <div class="text-xs text-blue-500">ROI: 12.5%</div>
                                </div>
                                
                                <!-- Transaction List -->
                                <div class="space-y-3">
                                    <div class="text-sm font-semibold style="color: var(--color-text_secondary, #6B7280);" mb-3">Transaksi Terbaru</div>
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="text-sm font-medium">Penjualan Produk A</div>
                                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Hari ini</div>
                                        </div>
                                        <div class="text-sm font-bold text-green-600">+Rp 2.500.000</div>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="text-sm font-medium">Beban Operasional</div>
                                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Kemarin</div>
                                        </div>
                                        <div class="text-sm font-bold text-red-600">-Rp 1.200.000</div>
                                    </div>
                                </div>
                                
                                <!-- Chart Area -->
                                <div class="h-24 bg-gradient-to-r from-blue-100 to-purple-100 rounded-xl flex items-center justify-center border border-blue-200">
                                    <span class="text-sm font-medium style="color: var(--color-text_secondary, #6B7280);"">📊 Analisis Keuangan UMKM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section-spacing bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold style="color: var(--color-text, #1F2937);" mb-4">
                    Mengapa UMKM Perlu Manajemen Keuangan yang Baik?
                </h2>
                <p class="text-xl style="color: var(--color-text_secondary, #6B7280);" max-w-3xl mx-auto">
                    Manajemen keuangan yang tepat adalah kunci sukses UMKM. Dapatkan kontrol penuh atas cash flow, 
                    analisis profitabilitas, dan kepatuhan pajak dengan solusi terintegrasi.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-2">📊 Kontrol Cash Flow Real-time</h3>
                                <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Pantau arus kas masuk dan keluar secara real-time. Hindari masalah likuiditas dengan monitoring keuangan yang akurat dan terintegrasi.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707v11a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-2">📈 Analisis Profitabilitas & ROI</h3>
                                <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Dapatkan insight mendalam tentang performa bisnis dengan analisis ROI otomatis, tren penjualan, dan identifikasi peluang pertumbuhan.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-2">📋 Kepatuhan Pajak & Pelaporan</h3>
                                <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Kelola PPN, PPh, dan kewajiban pajak lainnya dengan mudah. Generate laporan pajak otomatis dan pastikan kepatuhan regulasi yang berlaku.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Illustration -->
                <div class="flex justify-center">
                    <div class="relative">
                        <!-- AI Robot Illustration -->
                        <div class="w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <div class="w-64 h-64 bg-white rounded-full flex items-center justify-center">
                                <div class="text-6xl">🤖</div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-lg p-4 animate-float" style="animation-delay: 0.5s;">
                            <div class="text-sm font-semibold style="color: var(--color-text_secondary, #6B7280);"">Laporan</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Transaksi</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Jurnal Umum</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Buku Besar</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Neraca Saldo</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Laba Rugi</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Perubahan Modal</div>
                            <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Neraca</div>
                        </div>
                        
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg p-4 animate-float" style="animation-delay: 1s;">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold">Dashboard</div>
                                    <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Real-time</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="section-spacing">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold style="color: var(--color-text, #1F2937);" mb-4">
                    Fitur Manajemen Keuangan UMKM yang
                    <span class="text-blue-600">Lengkap & Terintegrasi</span>
                </h2>
                <p class="text-xl style="color: var(--color-text_secondary, #6B7280);" max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola keuangan UMKM dalam satu platform yang powerful!
                </p>
            </div>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="feature-card bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="w-16 h-16 gradient-card rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-3">Dashboard Keuangan UMKM</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Pantau performa keuangan bisnis secara real-time dengan grafik interaktif, analisis cash flow, dan metrik kunci UMKM.</p>
                </div>
                
                <div class="feature-card bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="w-16 h-16 gradient-green rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-3">Pencatatan Transaksi UMKM</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Catat pemasukan dan pengeluaran dengan sistem kategorisasi otomatis, upload bukti transaksi, dan filter pencarian yang canggih.</p>
                </div>
                
                <div class="feature-card bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="w-16 h-16 gradient-yellow rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707v11a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-3">Laporan Keuangan UMKM</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">Generate laporan keuangan lengkap: Laba Rugi, Neraca, Arus Kas, dan analisis ROI khusus untuk kebutuhan UMKM.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Financial Analysis Section -->
    <section class="section-spacing bg-gradient-to-r from-green-400 to-blue-500">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left - Financial Dashboard Preview -->
                <div class="flex justify-center lg:justify-start">
                    <div class="relative">
                        <div class="w-80 h-96 bg-white rounded-3xl shadow-2xl p-6">
                            <!-- Phone Header -->
                            <div class="flex justify-center mb-4">
                                <div class="w-16 h-1 bg-gray-300 rounded-full"></div>
                            </div>
                            
                            <!-- App Content -->
                            <div class="space-y-4">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-2">
                                        <span class="text-2xl">📊</span>
                                    </div>
                                    <h3 class="font-bold style="color: var(--color-text, #1F2937);"">Analisis Keuangan UMKM</h3>
                                    <p class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Pantau performa bisnis Anda</p>
                                </div>
                                
                                <!-- Financial Metrics -->
                                <div class="space-y-3">
                                    <div class="bg-green-50 p-3 rounded-xl">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Pemasukan Bulan Ini</span>
                                            <span class="text-xs text-green-500">+18%</span>
                                        </div>
                                        <div class="text-lg font-bold text-green-700">Rp 15.750.000</div>
                                        <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">vs bulan lalu</div>
                                    </div>
                                    
                                    <div class="bg-red-50 p-3 rounded-xl">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Pengeluaran Bulan Ini</span>
                                            <span class="text-xs text-red-500">+5%</span>
                                        </div>
                                        <div class="text-lg font-bold text-red-700">Rp 8.200.000</div>
                                        <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">vs bulan lalu</div>
                                    </div>
                                    
                                    <div class="bg-blue-50 p-3 rounded-xl">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium">Laba Bersih</span>
                                            <span class="text-xs text-blue-500">ROI 12.5%</span>
                                        </div>
                                        <div class="text-xl font-bold text-blue-700">Rp 7.550.000</div>
                                        <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Profit margin 48%</div>
                                    </div>
                                </div>
                                
                                <button class="w-full bg-blue-500 text-white py-3 rounded-xl font-semibold">
                                    Lihat Detail Laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right - Content -->
                <div class="text-white">
                    <h2 class="text-3xl lg:text-4xl font-extrabold mb-6">
                        Tingkatkan Profitabilitas UMKM hingga 40%
                    </h2>
                    <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                        Dengan analisis keuangan yang mendalam, Anda dapat mengidentifikasi peluang 
                        penghematan dan peningkatan pendapatan yang signifikan untuk bisnis UMKM.
                    </p>
                    
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-6">
                        <h3 class="text-xl font-bold mb-4">Insight Keuangan Cerdas untuk UMKM</h3>
                        <p class="text-blue-100 leading-relaxed">
                            Dapatkan rekomendasi bisnis yang actionable berdasarkan analisis data keuangan 
                            real-time. Optimalkan cash flow, kurangi biaya operasional, dan tingkatkan ROI.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Easy to Use Section -->
    <section class="section-spacing bg-yellow-400">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div>
                    <h2 class="text-3xl lg:text-4xl font-extrabold style="color: var(--color-text, #1F2937);" mb-6">
                        Mudah digunakan untuk UMKM!
                    </h2>
                    <p class="text-lg style="color: var(--color-text_secondary, #6B7280);" mb-8 leading-relaxed">
                        Platform manajemen keuangan UMKM didesain khusus untuk pemilik bisnis yang ingin 
                        mengelola keuangan dengan mudah, baik yang baru memulai maupun yang sudah mapan.
                    </p>
                </div>
                
                <!-- Right - Financial Management Interface -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-96 h-80 bg-white rounded-3xl shadow-2xl p-6">
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Dashboard UMKM</div>
                                <div class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">Kelola Bisnis</div>
                            </div>
                            
                            <div class="text-2xl font-bold style="color: var(--color-text, #1F2937);" mb-6">Rp 7.550.000</div>
                            
                            <!-- Financial Cards -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <div class="bg-green-100 p-4 rounded-xl">
                                    <div class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1">Pemasukan</div>
                                    <div class="font-bold text-green-700">Rp 15.750.000</div>
                                </div>
                                <div class="bg-red-100 p-4 rounded-xl">
                                    <div class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1">Pengeluaran</div>
                                    <div class="font-bold text-red-700">Rp 8.200.000</div>
                                </div>
                            </div>
                            
                            <!-- Financial Summary -->
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Laba Bersih Bulan Ini</span>
                                    <span class="text-sm font-medium text-blue-600">ROI 12.5%</span>
                                </div>
                                <div class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-2">Rp 7.550.000</div>
                                <div class="text-sm style="color: var(--color-text_secondary, #6B7280);"">Profit margin 48% - Excellent!</div>
                                
                                <!-- Progress Bar -->
                                <div class="mt-3 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-green-400 to-blue-400 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Icons -->
                        <div class="absolute -top-4 -right-4 w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center animate-float">
                            <span class="text-2xl">💰</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Multi User & Support Section -->
    <section class="section-spacing bg-gray-50">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="space-y-12">
                    <!-- Multi User -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-6 flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold style="color: var(--color-text, #1F2937);" mb-3">👥 Multi User</h3>
                            <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                Keuangan UMKM adalah aplikasi akuntansi yang dapat diakses oleh beberapa 
                                karyawan Kamu dengan hak akses masing-masing
                            </p>
                        </div>
                    </div>
                    
                    <!-- Easy to Use -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-6 flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold style="color: var(--color-text, #1F2937);" mb-3">👍 Kemudahan Penggunaan</h3>
                            <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                Keuangan UMKM hadir dengan antarmuka yang sederhana dan mudah dipahami. 
                                Kami percaya bahwa akuntansi seharusnya tidak membingungkan. Dengan 
                                langkah-langkah yang intuitif, Kamu akan merasa lebih percaya diri dalam 
                                mengelola keuangan bisnis Kamu.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Customer Service -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-6 flex-shrink-0">
                            <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 110 19.5 9.75 9.75 0 010-19.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold style="color: var(--color-text, #1F2937);" mb-3">🎧 Dukungan Customer Service</h3>
                            <p class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                Tim Customer Service kami selalu siap membantu Kamu. Jika Kamu 
                                mengalami kesulitan atau pertanyaan seputar penggunaan aplikasi, kami 
                                akan dengan senang hati membantu Kamu melalui Whatsapp
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Illustration -->
                <div class="flex justify-center">
                    <div class="relative">
                        <!-- Main Device -->
                        <div class="w-80 h-96 bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
                            <!-- Header -->
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11h4v-6h6v6h4V7l-7-5z"></path>
                                    </svg>
                                </div>
                                <span class="font-semibold style="color: var(--color-text, #1F2937);"">Tambah Perusahaan</span>
                            </div>
                            
                            <!-- Form Fields -->
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1 block">Nama Perusahaan</label>
                                    <input type="text" value="PT Nama Perusahaan Kamu" class="w-full p-3 border border-gray-200 rounded-lg text-sm" readonly>
                                </div>
                                
                                <div>
                                    <label class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1 block">Mata Uang</label>
                                    <select class="w-full p-3 border border-gray-200 rounded-lg text-sm" disabled>
                                        <option>Indonesian Rupiah</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1 block">IDR</label>
                                </div>
                                
                                <div>
                                    <label class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1 block">Zona Waktu *</label>
                                    <input type="text" value="(GMT+07:00) Bangkok, Hanoi, Jakarta" class="w-full p-3 border border-gray-200 rounded-lg text-sm" readonly>
                                </div>
                                
                                <div>
                                    <label class="text-sm style="color: var(--color-text_secondary, #6B7280);" mb-1 block">Alamat *</label>
                                    <textarea class="w-full p-3 border border-gray-200 rounded-lg text-sm h-20" readonly>Jl. Kertajaya no 2a, Sukolilo, Surabaya</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Financial Chart -->
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center animate-float">
                            <div class="text-3xl">📊</div>
                        </div>
                        
                        <!-- Floating Analytics -->
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl shadow-lg p-4 animate-float" style="animation-delay: 0.5s;">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold">Analytics</div>
                                    <div class="text-xs style="color: var(--color-text_secondary, #6B7280);"">Real-time data</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Laporan Section -->
    <section id="laporan" class="section-spacing bg-white">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold style="color: var(--color-text, #1F2937);" mb-6">
                    Laporan Keuangan yang Komprehensif
                </h2>
                <p class="text-xl style="color: var(--color-text_secondary, #6B7280);" leading-relaxed max-w-3xl mx-auto">
                    Dapatkan insight mendalam tentang performa keuangan bisnis Anda dengan berbagai jenis laporan yang tersedia
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Laporan Harian -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-4">Laporan Harian</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" mb-6">Pantau cash flow harian, pemasukan, dan pengeluaran setiap hari untuk kontrol keuangan yang ketat</p>
                    <ul class="text-sm style="color: var(--color-text_secondary, #6B7280);" space-y-2 text-left">
                        <li>• Ringkasan transaksi harian</li>
                        <li>• Cash flow real-time</li>
                        <li>• Notifikasi transaksi penting</li>
                    </ul>
                </div>

                <!-- Laporan Bulanan -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-4">Laporan Bulanan</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" mb-6">Analisis performa keuangan bulanan dengan breakdown kategori dan trend pertumbuhan</p>
                    <ul class="text-sm style="color: var(--color-text_secondary, #6B7280);" space-y-2 text-left">
                        <li>• P&L statement bulanan</li>
                        <li>• Analisis kategori pengeluaran</li>
                        <li>• Trend pertumbuhan bisnis</li>
                    </ul>
                </div>

                <!-- Laporan Tahunan -->
                <div class="bg-gradient-to-br from-purple-50 to-violet-100 rounded-2xl p-8 text-center hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold style="color: var(--color-text, #1F2937);" mb-4">Laporan Tahunan</h3>
                    <p class="style="color: var(--color-text_secondary, #6B7280);" mb-6">Evaluasi performa keuangan tahunan dengan analisis ROI dan perencanaan strategis</p>
                    <ul class="text-sm style="color: var(--color-text_secondary, #6B7280);" space-y-2 text-left">
                        <li>• Annual financial summary</li>
                        <li>• ROI dan profit margin</li>
                        <li>• Perencanaan tahun depan</li>
                    </ul>
                </div>
            </div>

            <!-- Export Options -->
            <div class="mt-16 text-center">
                <h3 class="text-2xl font-bold style="color: var(--color-text, #1F2937);" mb-8">Export & Download</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-2">Export PDF</h4>
                        <p class="style="color: var(--color-text_secondary, #6B7280);"">Download laporan dalam format PDF untuk keperluan formal dan presentasi</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold style="color: var(--color-text, #1F2937);" mb-2">Export Excel</h4>
                        <p class="style="color: var(--color-text_secondary, #6B7280);"">Export data ke Excel untuk analisis lebih lanjut dan manipulasi data</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Help & FAQ Section -->
    <section id="bantuan" class="section-spacing bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold style="color: var(--color-text, #1F2937);" mb-6">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-xl style="color: var(--color-text_secondary, #6B7280);" leading-relaxed max-w-3xl mx-auto">
                    Temukan jawaban untuk pertanyaan umum seputar cara menggunakan platform Keuangan UMKM
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="space-y-6">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq1')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Bagaimana cara mendaftar dan memulai menggunakan platform?</h3>
                                <svg id="faq1-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq1-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Untuk memulai menggunakan platform Keuangan UMKM, ikuti langkah-langkah berikut:</p>
                                <ol class="list-decimal list-inside space-y-2 ml-4">
                                    <li>Klik tombol "Daftar Sekarang" di halaman utama</li>
                                    <li>Isi formulir pendaftaran dengan data usaha Anda (nama, jenis usaha, alamat, dll)</li>
                                    <li>Verifikasi email yang dikirim ke alamat email Anda</li>
                                    <li>Login ke dashboard dan mulai mengelola keuangan UMKM Anda</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq2')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Bagaimana cara mencatat transaksi pemasukan dan pengeluaran?</h3>
                                <svg id="faq2-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq2-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Mencatat transaksi sangat mudah dengan langkah berikut:</p>
                                <ol class="list-decimal list-inside space-y-2 ml-4">
                                    <li>Masuk ke menu "Transaksi" di dashboard</li>
                                    <li>Klik tombol "Tambah Transaksi"</li>
                                    <li>Pilih jenis transaksi (Pemasukan/Pengeluaran)</li>
                                    <li>Isi kategori, jumlah, deskripsi, dan tanggal transaksi</li>
                                    <li>Upload bukti transaksi (opsional)</li>
                                    <li>Klik "Simpan" untuk menyimpan transaksi</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq3')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Bagaimana cara mengelola pajak dan kewajiban perpajakan?</h3>
                                <svg id="faq3-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq3-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Platform ini membantu Anda mengelola kewajiban pajak dengan fitur:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li><strong>Pencatatan Pajak:</strong> Catat berbagai jenis pajak (PPN, PPh, dll)</li>
                                    <li><strong>Status Pembayaran:</strong> Tandai pajak sebagai "Lunas" atau "Belum Lunas"</li>
                                    <li><strong>Jatuh Tempo:</strong> Set reminder untuk tanggal jatuh tempo pajak</li>
                                    <li><strong>Laporan Pajak:</strong> Generate laporan untuk keperluan pelaporan ke DJP</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq4')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Bagaimana cara melihat laporan keuangan dan analisis bisnis?</h3>
                                <svg id="faq4-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq4-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Platform menyediakan berbagai laporan keuangan yang dapat Anda akses:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li><strong>Dashboard:</strong> Ringkasan keuangan harian, bulanan, dan tahunan</li>
                                    <li><strong>Laporan Periodik:</strong> Pilih periode (harian, mingguan, bulanan, tahunan)</li>
                                    <li><strong>Analisis Kategori:</strong> Breakdown pengeluaran berdasarkan kategori</li>
                                    <li><strong>Export Data:</strong> Download laporan dalam format PDF atau Excel</li>
                                    <li><strong>Grafik Visual:</strong> Chart dan grafik untuk analisis trend</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq5')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Apakah data keuangan saya aman dan terjamin kerahasiaannya?</h3>
                                <svg id="faq5-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq5-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Keamanan data adalah prioritas utama kami dengan implementasi:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li><strong>Enkripsi Data:</strong> Semua data dienkripsi dengan standar industri</li>
                                    <li><strong>Backup Otomatis:</strong> Data Anda tersimpan aman dengan backup berkala</li>
                                    <li><strong>Akses Terbatas:</strong> Hanya Anda yang dapat mengakses data keuangan</li>
                                    <li><strong>SSL Certificate:</strong> Koneksi aman untuk semua transaksi</li>
                                    <li><strong>Compliance:</strong> Mengikuti standar keamanan internasional</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <button class="w-full px-8 py-6 text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset" onclick="toggleFAQ('faq6')">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold style="color: var(--color-text, #1F2937);"">Bagaimana cara menghitung laba rugi dan ROI bisnis saya?</h3>
                                <svg id="faq6-icon" class="w-6 h-6 style="color: var(--color-text_secondary, #6B7280);" transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </button>
                        <div id="faq6-content" class="hidden px-8 pb-6">
                            <div class="style="color: var(--color-text_secondary, #6B7280);" leading-relaxed">
                                <p class="mb-4">Platform secara otomatis menghitung metrik keuangan penting:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li><strong>Laba Bersih:</strong> Pemasukan - (Pengeluaran + Pajak)</li>
                                    <li><strong>ROI (Return on Investment):</strong> (Laba Bersih / Modal) × 100%</li>
                                    <li><strong>Cash Flow:</strong> Arus kas masuk dan keluar real-time</li>
                                    <li><strong>Break Even Point:</strong> Titik impas bisnis Anda</li>
                                    <li><strong>Trend Analysis:</strong> Analisis perkembangan bisnis dari waktu ke waktu</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="mt-12 text-center">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">Masih Ada Pertanyaan?</h3>
                        <p class="text-blue-100 mb-6">Tim support kami siap membantu Anda 24/7</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="mailto:support@keuanganumkm.com" class="bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 transition duration-200">
                                📧 Email Support
                            </a>
                            <a href="tel:+6281234567890" class="border-2 border-white text-white px-6 py-3 rounded-xl font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                                📞 Call Center
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-spacing btn-primary">
        <div class="container-custom text-center">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-6">
                Siap Mengelola Keuangan UMKM Anda?
            </h2>
            <p class="text-xl text-blue-100 mb-10 leading-relaxed max-w-3xl mx-auto">
                Bergabunglah dengan ribuan UMKM yang sudah merasakan kemudahan mengelola keuangan dengan platform kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 px-10 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition duration-200 shadow-lg">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-10 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition duration-200 shadow-lg">
                        Daftar Sekarang - Gratis
                    </a>
                    <a href="{{ route('login.custom') }}" class="border-2 border-white text-white px-10 py-4 rounded-xl text-lg font-bold hover:bg-white hover:text-blue-600 transition duration-200">
                        Masuk
                    </a>
                @endauth
            </div>
            <p class="text-blue-200 font-medium">
                ✨ Gratis selamanya • 🔒 Data aman • 📱 Mobile friendly • 🚀 Siap pakai
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 section-spacing text-white">
        <div class="container-custom">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">Keuangan UMKM</span>
                    </div>
                    <div class="space-y-2 text-blue-100">
                        <p class="font-semibold">PT Maju Bersama Alia</p>
                        <p>District 8, Treasury Tower Lt. 6 Unit F</p>
                        <p>Jl. Jend Sudirman Kav. 52-53, SCBD Lot 28 Jakarta Selatan 12190</p>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="flex space-x-4 mt-6">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition cursor-pointer">
                            <span class="text-lg">📷</span>
                        </div>
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition cursor-pointer">
                            <span class="text-lg">📘</span>
                        </div>
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition cursor-pointer">
                            <span class="text-lg">📺</span>
                        </div>
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition cursor-pointer">
                            <span class="text-lg">🐦</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Keuangan UMKM</h3>
                    <ul class="space-y-2 text-blue-100">
                        <li><a href="#" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition">Keamanan</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Layanan Pengaduan Konsumen</h3>
                    <div class="space-y-3 text-blue-100">
                        <div class="flex items-center">
                            <span class="mr-2">📞</span>
                            <span>+62 859-5180-5793</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">📞</span>
                            <span>+62 217989671</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">✉️</span>
                            <span>admin@keuanganumkm.id</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <p class="font-semibold mb-2">Direktorat Jenderal Perlindungan Konsumen dan Tertib Niaga Kementerian Perdagangan RI</p>
                        <p class="text-blue-100">WhatsApp Ditjen PKTN: +62 853 1111 1010</p>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter -->
            <div class="border-t border-blue-500 pt-8 mb-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h3 class="font-bold text-lg mb-2">Dapetin info dan promo dari Keuangan UMKM</h3>
                    </div>
                    <div class="flex w-full md:w-auto">
                        <input type="email" placeholder="Email kamu" class="flex-1 md:w-64 px-4 py-3 rounded-l-xl style="color: var(--color-text, #1F2937);"">
                        <button class="bg-green-400 style="color: var(--color-text, #1F2937);" px-6 py-3 rounded-r-xl font-semibold hover:bg-green-300 transition">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-blue-500 pt-8 text-center text-blue-200">
                <p>© {{ date('Y') }} All rights reserved</p>
            </div>
        </div>
    </footer>

    <!-- Smooth scrolling -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // FAQ Toggle Function
        function toggleFAQ(faqId) {
            const content = document.getElementById(faqId + '-content');
            const icon = document.getElementById(faqId + '-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>
</html>
