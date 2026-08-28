<x-guest-layout title="Inscription">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-gray-800">Créer ton compte 🎮</h1>
        <p class="text-sm text-gray-500 mt-1">Rejoins la communauté et commence à jouer</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="text-sm font-medium text-gray-700 mb-1.5 block">Nom complet</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Ton nom"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-rose-500 focus:border-rose-500 bg-gray-50 focus:bg-white">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Pseudo -->
        <div>
            <label for="pseudo" class="text-sm font-medium text-gray-700 mb-1.5 block">Pseudo</label>
            <input id="pseudo" type="text" name="pseudo" :value="old('pseudo')" required autofocus autocomplete="pseudo"
                placeholder="Ton pseudo de joueur"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-rose-500 focus:border-rose-500 bg-gray-50 focus:bg-white">
            <x-input-error :messages="$errors->get('pseudo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="text-sm font-medium text-gray-700 mb-1.5 block">Mot de passe</label>
            <div class="relative" x-data="{ show: false }">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    :type="show ? 'text' : 'password'"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-sm outline-none transition focus:ring-2 focus:ring-rose-500 focus:border-rose-500 bg-gray-50 focus:bg-white">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-gray-600 flex items-center">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="text-sm font-medium text-gray-700 mb-1.5 block">Confirmer le mot de passe</label>
            <div class="relative" x-data="{ show: false }">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    :type="show ? 'text' : 'password'"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-sm outline-none transition focus:ring-2 focus:ring-rose-500 focus:border-rose-500 bg-gray-50 focus:bg-white">
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-gray-600 flex items-center">
                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-rose-600/25 mt-2">
            Créer mon compte
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-500">
            Tu as déjà un compte ?
            <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-700">Se connecter</a>
        </p>
    </div>
</x-guest-layout>
