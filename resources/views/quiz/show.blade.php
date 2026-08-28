<x-game-layout :title="$quiz->title">
    <div class="mb-4">
        <a href="{{ route('quiz.index') }}" class="text-sm text-rose-600">← Tous les quiz</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <div class="text-xs bg-rose-100 dark:bg-rose-900/40 text-rose-700 dark:text-rose-300 px-3 py-1 rounded-full inline-block mb-3">{{ $quiz->category }}</div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 dark:text-white mb-2">{{ $quiz->title }}</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">{{ $quiz->description }}</p>

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-8">
            <span>📝 {{ $total }} questions</span>
            <span>▶️ {{ $quiz->plays }} parties jouées</span>
            @if($quiz->user)
            <span>👤 créé par {{ $quiz->user->name }}</span>
            @endif
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('quiz.play', $quiz->slug) }}" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold px-6 py-3 rounded-xl transition">▶️ Jouer maintenant</a>
            <a href="{{ route('quiz.rankings', $quiz->slug) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 font-semibold px-6 py-3 rounded-xl transition">🏆 Classement</a>
        </div>
    </div>

    <!-- Partage WhatsApp -->
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm">
        <h2 class="font-bold text-gray-800 dark:text-white mb-3">📤 Défie tes amis sur WhatsApp</h2>
        <form method="POST" action="{{ route('share.quiz', $quiz->slug) }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="tel" name="phone" placeholder="Numéro WhatsApp (77...) ou laisser vide"
                class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
            <input type="hidden" name="text" value="🎯 Défi quiz : {{ $quiz->title }} ! Peux-tu battre mon score ? {{ route('quiz.show', $quiz->slug) }}">
            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl transition inline-flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                Partager
            </button>
        </form>
        <p class="text-xs text-gray-400 mt-2">Laisse le numéro vide pour générer un lien WhatsApp général que tu peux copier.</p>
    </div>
</x-game-layout>
