<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

        <title>{{ config('app.name', 'Rotto Tattoo Studio') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Background with gradient and pattern -->
        <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-red-900 relative overflow-hidden">
            <!-- Background pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23DC2626" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
            
            <!-- Content -->
            <div class="relative z-10 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 min-h-screen">
                <!-- Logo Section -->
                <div class="mb-8 text-center animate-fade-in">
                    <a href="/" class="inline-block group">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-red-600 to-black rounded-full flex items-center justify-center shadow-xl group-hover:shadow-red-500/30 transition-all duration-300 transform group-hover:scale-105 border border-red-500/30">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-white">
                            Rotto Tattoo Studio
                        </h1>
                        <p class="text-gray-300 mt-2 font-medium">Arte en tu piel</p>
                    </a>
                </div>

                <!-- Auth Card -->
                <div class="w-full sm:max-w-md animate-slide-up">
                    <div class="glass rounded-2xl p-8 shadow-2xl border border-red-500/20 bg-black/20 backdrop-blur-sm">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} Rotto Tattoo Studio. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </body>
</html>
