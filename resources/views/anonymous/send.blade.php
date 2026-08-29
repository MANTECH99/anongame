<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="theme-color" content="#10b981">
        <link rel="manifest" href="{{ route('manifest') }}">
        <link rel="apple-touch-icon" href="/icons/apple-touch-icon-180x180.png">
        <title>Message anonyme - {{ config('app.name') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-emerald-500 via-emerald-600 to-cyan-700 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-2xl p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white text-3xl mb-4">💬</div>
                    <h1 class="text-xl font-extrabold text-gray-800">Envoie un message anonyme</h1>
                    <p class="text-sm text-gray-500 mt-1">Reste anonyme, dis ce que tu penses vraiment.</p>
                </div>

                <form method="POST" action="{{ route('anonymous.submit', $link->slug) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-gray-700">Ton message</label>
                        <textarea name="content" required rows="4" maxlength="1000" placeholder="Écris ton message ici..."
                            class="mt-1 w-full text-sm border border-gray-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition">Envoyer anonymement</button>
                </form>

                <a href="{{ route('home') }}" class="block text-center mt-4 text-xs text-gray-400">Propulsé par {{ config('app.name') }}</a>
            </div>
        </div>
    </body>
</html>
