@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#075E54">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="AnonGame">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="manifest" href="{{ route('manifest') }}">
        <link rel="apple-touch-icon" href="/icons/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/icons/icon-192x192.png">

        <title>{{ $title ? $title.' - ' : '' }}{{ config('app.name', 'AnonGame') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <main class="flex-1 pb-24 max-w-5xl w-full mx-auto px-4 sm:px-6 py-6">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
                @endif
                {{ $slot }}
            </main>

            @include('layouts.bottombar')

            <!-- PWA Install prompt -->
            <div id="pwa-install" class="hidden fixed bottom-20 inset-x-0 z-50 px-4">
                <div class="max-w-sm mx-auto bg-white rounded-2xl shadow-2xl border border-gray-200 p-4">
                    <p class="font-semibold text-gray-800 text-sm mb-2">📲 Installe AnonGame sur ton téléphone</p>
                    <p class="text-xs text-gray-500 mb-3">Joue hors-ligne et accède à tes jeux plus vite.</p>
                    <div class="flex gap-2">
                        <button id="pwa-install-btn" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-2 rounded-xl transition">Installer</button>
                        <button id="pwa-dismiss-btn" class="px-4 text-sm text-gray-600 font-semibold py-2 rounded-xl hover:bg-gray-100">Plus tard</button>
                    </div>
                </div>
            </div>

            @include('layouts.pwafooter')
        </div>
        @stack('scripts')
    </body>
</html>
