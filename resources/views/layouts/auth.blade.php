<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trim($__env->yieldContent('title')) ? $__env->yieldContent('title') . ' - ' : '' }}{{ config('app.name', 'KnightCRM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full">
            <div class="max-w-md mx-auto w-full space-y-8">
                <div>
                    <a href="{{ route('home') }}" class="block text-center text-4xl font-bold text-knight-800 hover:opacity-90">KnightCRM</a>
                    @hasSection('heading')
                        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                            @yield('heading')
                        </h2>
                    @endif
                    @hasSection('subheading')
                        <p class="mt-2 text-center text-sm text-gray-600">
                            @yield('subheading')
                        </p>
                    @endif
                </div>

                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>


