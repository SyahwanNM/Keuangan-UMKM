<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - Keuangan UMKM</title>
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
                        <span class="ml-3 text-xl font-bold" style="color: var(--color-text, #1F2937);">Keuangan UMKM</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="<?php echo e(route('login.custom')); ?>" class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">Masuk</a>
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
                            Lupa
                            <span class="text-yellow-300">Password?</span><br>
                            Tidak Perlu Khawatir
                        </h1>
                        <p class="text-xl text-blue-100 mb-8 leading-relaxed max-w-2xl">
                            Kami akan membantu Anda mereset password dengan aman. 
                            Masukkan email Anda dan ikuti langkah-langkah verifikasi.
                        </p>
                        
                        <!-- Features List -->
                        <div class="space-y-4 text-blue-100">
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Verifikasi email yang aman</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Kode verifikasi 6 digit</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Proses cepat dan mudah</span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium">Data tetap aman dan terlindungi</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right - Forgot Password Form -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="w-full max-w-md">
                            <div class="glass-form rounded-3xl shadow-2xl p-8 border border-gray-100">
                                <div class="text-center mb-8">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-3xl font-bold" style="color: var(--color-text, #1F2937);" mb-2">Reset Password</h2>
                                    <p style="color: var(--color-text_secondary, #6B7280);">Masukkan email untuk mendapatkan kode verifikasi</p>
                                </div>

                                <?php if(session('success')): ?>
                                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-green-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-green-800"><?php echo e(session('success')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($errors->any()): ?>
                                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                        <div class="flex">
                                            <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-red-800">Terjadi kesalahan:</p>
                                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('password.send-reset')); ?>" class="space-y-6">
                                    <?php echo csrf_field(); ?>
                                    
                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium" style="color: var(--color-text_secondary, #6B7280);" mb-2">Email</label>
                                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="email"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Masukkan email Anda">
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

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl text-lg font-bold hover:shadow-lg transition duration-200">
                                        Kirim Kode Verifikasi
                                    </button>
                                </form>

                                <!-- Back to Login Link -->
                                <div class="mt-6 text-center">
                                    <p style="color: var(--color-text_secondary, #6B7280);">
                                        Ingat password Anda? 
                                        <a href="<?php echo e(route('login.custom')); ?>" class="text-blue-600 hover:text-blue-500 font-semibold">
                                            Masuk di sini
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
            <span class="text-2xl">🔐</span>
        </div>
    </div>
    
    <div class="fixed bottom-20 right-10 animate-float" style="animation-delay: 1s;">
        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
            <span class="text-3xl">📧</span>
        </div>
    </div>

</body>
</html>
<?php /**PATH D:\Magang\keuangan-UMKM\resources\views/auth/forgot-password-custom.blade.php ENDPATH**/ ?>