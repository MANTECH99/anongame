<x-game-layout :title="'Résultat'">
    @php
        $percent = $attempt->total > 0 ? round(($attempt->score / $attempt->total) * 100) : 0;
        $emoji = $percent >= 80 ? '🏆' : ($percent >= 50 ? '🎉' : '💪');
    @endphp

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 text-center shadow-sm max-w-lg mx-auto">
        <div class="text-6xl mb-4">{{ $emoji }}</div>
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-1">Quiz : {{ $attempt->quiz->title }}</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Joué par <strong>{{ $attempt->player_name }}</strong></p>

        <div class="text-5xl font-extrabold text-emerald-600 mb-2">{{ $attempt->score }} <span class="text-2xl text-gray-400">/ {{ $attempt->total }}</span></div>
        <div class="text-gray-500 dark:text-gray-400 mb-2">{{ $percent }}% de bonnes réponses</div>

        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-8">
            <div class="bg-gradient-to-r from-emerald-500 to-green-600 h-3 rounded-full" style="width: {{ $percent }}%"></div>
        </div>

        <div class="flex flex-col gap-3">
            <a href="{{ route('quiz.play', $attempt->quiz->slug) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition">🔄 Rejouer</a>
            <a href="{{ route('quiz.rankings', $attempt->quiz->slug) }}" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-white font-semibold py-3 rounded-xl transition">🏆 Voir le classement</a>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-2">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white mb-2">📤 Partage ton score sur WhatsApp</h3>
                <form method="POST" action="{{ route('share.quiz', $attempt->quiz->slug) }}">
                    @csrf
                    <input type="hidden" name="text" value="{{ $emoji }} J'ai fait {{ $attempt->score }}/{{ $attempt->total }} ({{ $percent }}%) au quiz « {{ $attempt->quiz->title }} » ! Peux-tu me battre ? {{ route('quiz.show', $attempt->quiz->slug) }}">
                    <input type="tel" name="phone" placeholder="Numéro ou laisser vide"
                        class="w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5 mb-2">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-xl transition">Partager sur WhatsApp</button>
                </form>
            </div>
        </div>
    </div>

    @if($attempt->answers)
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm max-w-lg mx-auto">
        <h2 class="font-bold text-gray-800 dark:text-white mb-4">📋 Détail des réponses</h2>
        <div class="space-y-3">
            @foreach($attempt->quiz->questions as $q)
            @php
                $detail = collect($attempt->answers)->firstWhere('question_id', $q->id);
            @endphp
            <div class="flex items-center gap-3 text-sm">
                <span class="{{ $detail['correct'] ?? false ? 'text-green-600' : 'text-red-500' }} text-lg">{{ ($detail['correct'] ?? false) ? '✅' : '❌' }}</span>
                <span class="text-gray-700 dark:text-gray-300 flex-1">{{ $q->question }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</x-game-layout>
