<x-guest-layout title="Connexion">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-gray-800">Content de te revoir 👋</h1>
        <p class="text-sm text-gray-500 mt-1">Connecte-toi pour continuer à jouer</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Pseudo -->
        <div>
            <label for="pseudo" class="text-sm font-medium text-gray-700 mb-1.5 block">Pseudo</label>
            <input id="pseudo" type="text" name="pseudo" :value="old('pseudo')" required autofocus autocomplete="pseudo"
                placeholder="Ton pseudo"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 focus:bg-white">
            <x-input-error :messages="$errors->get('pseudo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="text-sm font-medium text-gray-700">Mot de passe</label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-medium text-emerald-600 hover:text-emerald-700">Mot de passe oublié ?</a>
                @endif
            </div>
            <div class="relative" x-data="{ show: false }">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    :type="show ? 'text' : 'password'"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-sm outline-none transition focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 focus:bg-white">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-gray-600 flex items-center">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <label for="remember_me" class="inline-flex items-center gap-2.5">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 w-4 h-4">
            <span class="text-sm text-gray-600">Se souvenir de moi</span>
        </label>

        <button type="submit"
            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-600 hover:from-emerald-700 hover:to-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-600/25">
            Se connecter
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-500">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Créer un compte</a>
        </p>
    </div>

    <a href="{{ route('home') }}" class="block text-center mt-4 text-xs text-gray-400 hover:text-gray-500">← Retour à l'accueil</a>
</x-guest-layout>
