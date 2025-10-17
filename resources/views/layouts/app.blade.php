<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/theme.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" data-theme="{{ $themeName ?? 'light' }}" style="{{ isset($cssVariables) ? collect($cssVariables)->map(function($value, $key) { return $key . ': ' . $value; })->join('; ') : '' }}">
        <div class="min-h-screen flex flex-col theme-bg" style="color: var(--color-text, #1F2937);">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="shadow theme-surface" style="position: relative; z-index: 1;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-footer />
        </div>

        <!-- Logout Confirmation Modal -->
        <x-logout-modal />
        
        <!-- Logout Modal Script -->
        <script src="{{ asset('js/logout-modal.js') }}"></script>
    </body>
</html>