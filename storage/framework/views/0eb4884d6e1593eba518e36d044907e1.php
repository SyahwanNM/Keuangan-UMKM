<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Keuangan UMKM</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .glass-form { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary:hover { background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .text-shadow { text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
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
                        <span class="ml-3 text-xl font-bold style="color: var(--color-text, #1F2937);"">Keuangan UMKM</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('register.custom')); ?>" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">Daftar</a>
                    <a href="<?php echo e(url('/')); ?>" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition duration-200">Beranda</a>
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
                            Selamat Datang
                            <span class="text-yellow-300">Kembali</span><br>
                            di Keuangan UMKM
                        </h1>
                        <p class="text-xl text-blue-100 mb-8 leading-relaxed max-w-2xl">
                            Akses dashboard keuangan UMKM Anda dan kelola bisnis 
                            dengan lebih efisien dan profesional.
                        </p>
                        
                        <!-- Features List -->
                        <div class="space-y-4 text-blue-100">
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Dashboard keuangan real-time</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Analisis profitabilitas bisnis</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Laporan pajak otomatis</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Data tersimpan aman di cloud</span>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Right - Login Form -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="w-full max-w-md">
                            <div class="glass-form rounded-3xl shadow-2xl p-8 border border-gray-100">
                                <div class="text-center mb-8">
                                    <h2 class="text-3xl font-bold style="color: var(--color-text, #1F2937);" mb-2">Masuk ke Akun</h2>
                                    <p class="style="color: var(--color-text_secondary, #6B7280);"">Akses dashboard keuangan UMKM Anda</p>
                                </div>

                                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                                    <?php echo csrf_field(); ?>
                                    
                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Email</label>
                                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="admin@umkm.com">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <label for="password" class="block text-sm font-medium style="color: var(--color-text_secondary, #6B7280);" mb-2">Password</label>
                                        <input id="password" type="password" name="password" required autocomplete="current-password"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="••••••••">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input id="remember_me" name="remember" type="checkbox" 
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="remember_me" class="ml-2 text-sm style="color: var(--color-text_secondary, #6B7280);"">
                                                Ingat saya
                                            </label>
                                        </div>
                                        <a href="<?php echo e(route('password.forgot')); ?>" class="text-sm text-blue-600 hover:text-blue-500 font-medium">
                                            Lupa password?
                                        </a>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl text-lg font-bold hover:shadow-lg transition duration-200">
                                        Masuk ke Dashboard
                                    </button>
                                </form>


                                <!-- Register Link -->
                                <div class="mt-6 text-center">
                                    <p class="style="color: var(--color-text_secondary, #6B7280);"">
                                        Belum punya akun? 
                                        <a href="<?php echo e(route('register.custom')); ?>" class="text-blue-600 hover:text-blue-500 font-semibold">
                                            Daftar di sini
                                        </a>
                                    </p>
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
            <span class="text-2xl">📊</span>
        </div>
    </div>
    
    <div class="fixed bottom-20 right-10 animate-float" style="animation-delay: 1s;">
        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
            <span class="text-3xl">💰</span>
        </div>
    </div>

</body>
</html>
<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/auth/login-custom.blade.php ENDPATH**/ ?>