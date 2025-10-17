<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - Keuangan UMKM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .glass-form { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .verification-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border: 2px solid #d1d5db;
            border-radius: 12px;
            background: #f9fafb;
            transition: all 0.2s;
        }
        .verification-input:focus {
            border-color: #3b82f6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }
        .verification-input.filled {
            border-color: #10b981;
            background: #ecfdf5;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="glass-form fixed w-full z-50 top-0 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold" style="color: var(--color-text, #1F2937);">Keuangan UMKM</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login.custom') }}" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">Masuk</a>
                    <a href="{{ url('/') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition duration-200">Beranda</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen pt-16">
        <div class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl lg:text-6xl font-extrabold text-white leading-tight mb-6 text-shadow">
                            Verifikasi
                            <span class="text-yellow-300">Email</span><br>
                            Anda
                        </h1>
                        <p class="text-xl text-blue-100 mb-8 leading-relaxed max-w-2xl">
                            Kami telah mengirim kode verifikasi 6 digit ke email Anda. 
                            Silakan masukkan kode tersebut untuk melanjutkan proses reset password.
                        </p>
                        
                        <!-- Info Box -->
                        <div class="bg-white bg-opacity-20 rounded-2xl p-6 backdrop-blur-sm">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-yellow-300 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h3 class="text-white font-semibold mb-2">Penting!</h3>
                                    <ul class="text-blue-100 text-sm space-y-1">
                                        <li>• Kode berlaku selama 15 menit</li>
                                        <li>• Periksa folder spam jika tidak ada di inbox</li>
                                        <li>• Jangan bagikan kode kepada siapapun</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right - Verification Form -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="w-full max-w-md">
                            <div class="glass-form rounded-3xl shadow-2xl p-8 border border-gray-100">
                                <div class="text-center mb-8">
                                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-3xl font-bold" style="color: var(--color-text, #1F2937);" mb-2">Masukkan Kode</h2>
                                    <p style="color: var(--color-text_secondary, #6B7280);">Kode verifikasi telah dikirim ke:</p>
                                    <p class="font-semibold" style="color: var(--color-primary, #3B82F6);">{{ $email ?? session('email') }}</p>
                                </div>

                                @if (session('success'))
                                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-red-800">Terjadi kesalahan:</p>
                                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.verify-code') }}" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email ?? session('email') }}">
                                    
                                    <!-- Verification Code -->
                                    <div>
                                        <label class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);" mb-4 text-center">Kode Verifikasi</label>
                                        <div class="flex justify-center space-x-3 mb-4">
                                            <input type="text" name="verification_code" id="verification_code" maxlength="6" required
                                                class="verification-input" placeholder="000000"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                onkeyup="if(this.value.length === 6) this.form.submit()">
                                        </div>
                                        <p class="text-xs text-center" style="color: var(--color-text_secondary, #6B7280);">Masukkan 6 digit kode verifikasi</p>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl text-lg font-bold hover:shadow-lg transition duration-200">
                                        Verifikasi Kode
                                    </button>
                                </form>

                                <!-- Resend Code -->
                                <div class="mt-6 text-center">
                                    <p style="color: var(--color-text_secondary, #6B7280);" mb-3">Tidak menerima kode?</p>
                                    <form method="POST" action="{{ route('password.resend') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email ?? session('email') }}">
                                        <button type="submit" class="text-blue-600 hover:text-blue-500 font-semibold underline">
                                            Kirim Ulang Kode
                                        </button>
                                    </form>
                                </div>

                                <!-- Back to Forgot Password -->
                                <div class="mt-4 text-center">
                                    <a href="{{ route('password.forgot') }}" class="text-gray-500 hover:text-gray-700 text-sm">
                                        ← Kembali ke lupa password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="fixed top-20 left-10 animate-float" style="animation-delay: 0.5s;">
        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
            <span class="text-2xl">📧</span>
        </div>
    </div>
    
    <div class="fixed bottom-20 right-10 animate-float" style="animation-delay: 1s;">
        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
            <span class="text-3xl">🔢</span>
        </div>
    </div>

    <script>
        // Auto-focus on verification code input
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('verification_code');
            if (input) {
                input.focus();
            }
        });
    </script>

</body>
</html>
