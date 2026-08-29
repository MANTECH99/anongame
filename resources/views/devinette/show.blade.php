<x-game-layout :title="'Devinette - '.$devinette->title">
    <div class="mb-4">
        <a href="{{ route('devinette.index') }}" class="text-sm text-emerald-600">← Toutes les devinettes</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 sm:p-8 shadow-sm max-w-xl mx-auto">
        <div class="text-xs bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 px-3 py-1 rounded-full inline-block mb-4">{{ $devinette->category }}</div>
        <h1 class="text-xl font-extrabold text-gray-800 dark:text-white mb-4">{{ $devinette->title }}</h1>

        <div class="bg-gradient-to-br from-green-50 to-green-50 dark:from-green-900/20 dark:to-green-900/20 rounded-2xl p-6 mb-6">
            <p class="text-gray-700 dark:text-gray-200 text-lg font-medium leading-relaxed">{{ $devinette->question }}</p>
        </div>

        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Ta réponse</label>
                @if($devinette->hint)
                <span class="text-xs text-gray-400">💡 Indice : {{ $devinette->hint }}</span>
                @endif
            </div>
            <form method="POST" action="{{ route('devinette.solve', $devinette->slug) }}" class="flex gap-2">
                @csrf
                <input type="text" name="answer" required placeholder="Ta réponse..."
                    class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
                <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 rounded-xl transition">Répondre</button>
            </form>
        </div>

        <!-- Partage -->
        <form method="POST" action="{{ route('share.devinette', $devinette->slug) }}" class="border-t border-gray-200 dark:border-gray-700 pt-4">
            @csrf
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white mb-2">📤 Défie un ami sur WhatsApp</h3>
            <input type="hidden" name="text" value="🤔 Devinette : {{ $devinette->title }}. Trouve la réponse ! {{ route('devinette.show', $devinette->slug) }}">
            <input type="tel" name="phone" placeholder="Numéro WhatsApp ou laisser vide"
                class="w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5 mb-2">
            <button class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 rounded-xl transition">Partager sur WhatsApp</button>
        </form>
    </div>
</x-game-layout>
