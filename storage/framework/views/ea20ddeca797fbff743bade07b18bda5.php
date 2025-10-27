<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/theme.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased" data-theme="<?php echo e($themeName ?? 'light'); ?>" style="<?php echo e(isset($cssVariables) ? collect($cssVariables)->map(function($value, $key) { return $key . ': ' . $value; })->join('; ') : ''); ?>">
        <div class="min-h-screen flex flex-col theme-bg" style="color: var(--color-text, #1F2937);">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="shadow theme-surface" style="position: relative; z-index: 1;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main class="flex-1">
                <?php echo e($slot); ?>

            </main>

            <!-- Footer -->
            <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
        </div>

        <!-- Logout Confirmation Modal -->
        <?php if (isset($component)) { $__componentOriginal83340feff6d97b732118289e3a5a928b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal83340feff6d97b732118289e3a5a928b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logout-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logout-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal83340feff6d97b732118289e3a5a928b)): ?>
<?php $attributes = $__attributesOriginal83340feff6d97b732118289e3a5a928b; ?>
<?php unset($__attributesOriginal83340feff6d97b732118289e3a5a928b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal83340feff6d97b732118289e3a5a928b)): ?>
<?php $component = $__componentOriginal83340feff6d97b732118289e3a5a928b; ?>
<?php unset($__componentOriginal83340feff6d97b732118289e3a5a928b); ?>
<?php endif; ?>
        
        <!-- Logout Modal Script -->
        <script src="<?php echo e(asset('js/logout-modal.js')); ?>"></script>
    </body>
</html><?php /**PATH D:\Magang\keuangan-UMKM\resources\views/layouts/app.blade.php ENDPATH**/ ?>