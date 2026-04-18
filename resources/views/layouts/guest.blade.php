<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value'); @endphp
        @if ($appLogo)
            <link rel="icon" type="image/x-icon" href="{{ Storage::url($appLogo) }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-300 p-4">
            <!-- Background decoration -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/10 dark:bg-primary-500/5 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-600/10 dark:bg-primary-600/5 rounded-full blur-3xl"></div>
            </div>

            <div class="relative w-full max-w-md">
                <!-- Logo Section -->
                <div class="text-center mb-8 animate-fade-in">
                    @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value'); @endphp
                    @if ($appLogo)
                        <img src="{{ Storage::url($appLogo) }}" alt="Cellcom Logo" class="w-20 auto object-contain mx-auto mb-4 transform hover:scale-105 transition-all duration-300">
                    @else
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-3xl shadow-2xl mb-4 transform hover:scale-105 transition-all duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Cellcom Service</h1>
                    <p class="text-gray-600 dark:text-gray-400">Sistem Manajemen Service Center</p>
                </div>

                <!-- Login Card -->
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl rounded-3xl overflow-hidden border border-gray-200/50 dark:border-gray-700/50 animate-slide-up">
                    <div class="p-8">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Dark Mode Toggle -->
                <div class="mt-6 text-center">
                    <button @click="darkMode = !darkMode" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-sm font-medium" x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>
