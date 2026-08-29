<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="theme-color" content="#10b981">
        <link rel="manifest" href="{{ route('manifest') }}">
        <link rel="apple-touch-icon" href="/icons/apple-touch-icon-180x180.png">
        <title>Message envoyé</title>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-emerald-500 via-emerald-600 to-cyan-700 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl p-8 text-center">
                <div class="text-6xl mb-4">✅</div>
                <h1 class="text-xl font-extrabold text-gray-800 mb-2">Message envoyé !</h1>
                <p class="text-sm text-gray-500 mb-6">Ton message anonyme a bien été délivré. Il restera anonyme. 🤫</p>
                <a href="{{ route('home') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-xl transition">Découvrir AnonGame</a>
            </div>
        </div>
    </body>
</html>
