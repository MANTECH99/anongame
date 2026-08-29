<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#075E54">
        <link rel="manifest" href="{{ route('manifest') }}">
        <link rel="apple-touch-icon" href="/icons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/icons/icon-192x192.png">

        <title>{{ isset($title) ? $title.' - ' : '' }}{{ config('app.name', 'AnonGame') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen relative flex flex-col items-center justify-center px-4 py-10 bg-gradient-to-br from-emerald-600 via-emerald-600 to-green-700 overflow-hidden">
            <!-- Décoratif blobs -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-32 -left-24 w-96 h-96 bg-green-400/20 rounded-full blur-3xl"></div>

            <a href="{{ route('home') }}" class="relative flex flex-col items-center mb-8">
                <img src="/icons/icon-192x192.png?v=3" alt="AnonGame" class="w-16 h-16 rounded-2xl shadow-2xl ring-4 ring-white/40 mb-3">
                <span class="text-white font-extrabold text-2xl">Anon<span class="text-emerald-300">Game</span></span>
                <span class="text-white/70 text-sm mt-1">Quiz · Devinettes · Anonyme 🇸🇳</span>
            </a>

            <div class="relative w-full max-w-md">
                <div class="bg-white/95 backdrop-blur rounded-3xl shadow-2xl p-7 sm:p-8">
                    {{ $slot }}
                </div>
            </div>

            <p class="relative mt-8 text-white/60 text-xs">© {{ date('Y') }} AnonGame · Jouer n'a jamais été aussi anonyme</p>
        </div>
    </body>
</html>
