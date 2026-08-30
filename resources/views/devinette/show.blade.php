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
            <form method="POST" action="{{ route('devinette.solve', $devinette->slug) }}" class="flex gap-2" id="devinette-form">
                @csrf
                <input type="text" name="answer" required placeholder="Ta réponse..." id="devinette-answer"
                    class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
                <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 rounded-xl transition">Répondre</button>
            </form>
            <div id="devinette-result" class="hidden mt-3 px-4 py-3 rounded-lg text-sm font-semibold"></div>
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

    @push('scripts')
    <script>
        (function () {
            const form = document.getElementById('devinette-form');
            if (!form) return;

            const result = document.getElementById('devinette-result');
            const input = document.getElementById('devinette-answer');
            const btn = form.querySelector('button');
            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.content : '';

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                if (!input || !result || !token) return;

                const answer = input.value.trim();
                if (!answer) return;

                if (btn) {
                    btn.disabled = true;
                    btn.textContent = '…';
                }
                result.classList.add('hidden');

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': token,
                        },
                        body: new URLSearchParams({ answer: answer, _token: token }),
                    });

                    const data = await res.json();
                    result.classList.remove('hidden');

                    if (data.correct) {
                        result.textContent = 'Bonne réponse ! 🎉';
                        result.className = 'mt-3 px-4 py-3 rounded-lg text-sm font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300';
                    } else {
                        result.textContent = 'Mauvaise réponse, essaie encore !';
                        result.className = 'mt-3 px-4 py-3 rounded-lg text-sm font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300';
                    }
                } catch (err) {
                    result.classList.remove('hidden');
                    result.textContent = 'Erreur lors de l\'envoi, réessaie.';
                    result.className = 'mt-3 px-4 py-3 rounded-lg text-sm font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300';
                } finally {
                    if (btn) {
                        btn.disabled = false;
                        btn.textContent = 'Répondre';
                    }
                }
            });
        })();
    </script>
    @endpush
</x-game-layout>
