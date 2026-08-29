<x-guest-layout title="Mot de passe oublié">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-gray-800">Mot de passe oublié ? 🔑</h1>
        <p class="text-sm text-gray-500 mt-1">Pas de souci ! Indique ton email et on t'envoie un lien de réinitialisation.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-medium text-gray-700 mb-1.5 block">Adresse email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                placeholder="ton@email.com"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm outline-none transition focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 focus:bg-white">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-600 hover:from-emerald-700 hover:to-emerald-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-emerald-600/25">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <div class="mt-6 pt-5 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-500">
            <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">← Retour à la connexion</a>
        </p>
    </div>
</x-guest-layout>
