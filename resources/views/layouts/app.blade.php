<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KnightCRM') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-knight-800 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ route('home') }}" class="text-2xl font-bold hover:opacity-90">KnightCRM</a>
                            </div>
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-2">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none focus:bg-knight-700 transition {{ request()->routeIs('dashboard') ? 'bg-knight-700' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('leads.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none focus:bg-knight-700 transition {{ request()->routeIs('leads.*') ? 'bg-knight-700' : '' }}">
                                Leads
                            </a>
                            <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none focus:bg-knight-700 transition {{ request()->routeIs('clients.*') ? 'bg-knight-700' : '' }}">
                                Clients
                            </a>
                            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none focus:bg-knight-700 transition {{ request()->routeIs('tasks.*') ? 'bg-knight-700' : '' }}">
                                Tasks
                            </a>
                            <a href="{{ route('reminders.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none focus:bg-knight-700 transition {{ request()->routeIs('reminders.*') ? 'bg-knight-700' : '' }}">
                                Reminders
                            </a>
                        </div>
                        </div>
                        <div class="flex items-center">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none transition">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white hover:bg-knight-700 focus:outline-none transition">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="ml-2 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium leading-5 text-white bg-knight-600 hover:bg-knight-700 focus:outline-none transition">
                                    Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if (session()->has('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>

