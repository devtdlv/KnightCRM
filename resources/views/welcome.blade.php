<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KnightCRM — A Tiny CRM for Freelancers</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Top Nav -->
        <nav class="bg-knight-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-xl font-bold hover:opacity-90">KnightCRM</a>
                <div class="space-x-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-medium hover:bg-knight-700">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-knight-600 hover:bg-knight-700">Register</a>
                </div>
            </div>
        </nav>

        <main class="flex-1">
            <!-- Hero -->
            <section class="relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-knight-50 to-white"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
                    <div class="grid lg:grid-cols-2 gap-10 items-center">
                        <div>
                            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                                A tiny, trustworthy CRM for freelancers
                            </h1>
                            <p class="mt-5 text-lg text-gray-600">
                                Track leads, manage clients, stay on top of tasks, and never miss a follow-up.
                                Built with Tailwind & Livewire for a fast, modern workflow.
                            </p>
                            <div class="mt-8 flex flex-wrap gap-3">
                                <a href="{{ route('register') }}" class="px-6 py-3 bg-knight-600 text-white rounded-lg hover:bg-knight-700">
                                    Get Started — It’s free
                                </a>
                                <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-50">
                                    Sign In
                                </a>
                            </div>
                            <div class="mt-6 text-sm text-gray-500">
                                No bloat. No noise. Just the essentials: leads, clients, tasks, reminders, CSV export.
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                            <div class="h-64 sm:h-72 w-full rounded-lg bg-gray-100 grid place-items-center text-gray-400">
                            <img src="{{ asset('images/dashboard-preview.jpeg') }}"
                                alt="KnightCRM dashboard preview"
                                class="h-64 sm:h-72 w-full rounded-lg object-cover shadow-md">
                            </div>
                            <ul class="mt-6 grid grid-cols-2 gap-3 text-sm text-gray-700">
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> Leads pipeline</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> Client notes</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> Tasks & priorities</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> Email reminders</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> CSV export</li>
                                <li class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-knight-600"></span> Clean, fast UI</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section class="py-16 bg-white border-t border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center">Everything you need — nothing you don’t</h2>
                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Leads Pipeline</h3>
                            <p class="mt-2 text-sm text-gray-600">Move leads through statuses and track value and source. Quick edits with Livewire.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Client Notes</h3>
                            <p class="mt-2 text-sm text-gray-600">Keep conversations, decisions, and context attached to clients.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Task Tracking</h3>
                            <p class="mt-2 text-sm text-gray-600">Priorities, due dates, and visual cues for what’s next.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Email Reminders</h3>
                            <p class="mt-2 text-sm text-gray-600">Scheduler-driven reminders so follow-ups never slip.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">CSV Export</h3>
                            <p class="mt-2 text-sm text-gray-600">Export leads and clients anytime for backups or sharing.</p>
                        </div>
                        <div class="p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Fast & Minimal</h3>
                            <p class="mt-2 text-sm text-gray-600">Tailwind + Livewire UI for speed and simplicity.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How it works -->
            <section class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl font-bold text-gray-900 text-center">How it works</h2>
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-white rounded-xl border border-gray-100">
                            <p class="text-sm font-semibold text-knight-600">Step 1</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">Add leads & clients</h3>
                            <p class="mt-2 text-sm text-gray-600">Create leads with value and source, add clients with key details.</p>
                        </div>
                        <div class="p-6 bg-white rounded-xl border border-gray-100">
                            <p class="text-sm font-semibold text-knight-600">Step 2</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">Work your pipeline</h3>
                            <p class="mt-2 text-sm text-gray-600">Update statuses as you progress. Capture notes and create tasks.</p>
                        </div>
                        <div class="p-6 bg-white rounded-xl border border-gray-100">
                            <p class="text-sm font-semibold text-knight-600">Step 3</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">Follow up & win</h3>
                            <p class="mt-2 text-sm text-gray-600">Set reminders, hit deadlines, and close deals with clarity.</p>
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-knight-600 text-white rounded-lg hover:bg-knight-700">
                            Create your account
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="py-8 border-t border-gray-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-500">© {{ date('Y') }} KnightCRM</p>
                <div class="text-sm text-gray-500">
                    Built with Laravel, Livewire, and Tailwind CSS
                </div>
            </div>
        </footer>
    </div>
</body>
</html>


