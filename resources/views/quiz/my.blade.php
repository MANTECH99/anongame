<x-game-layout title="Mes quiz">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">📚 Mes quiz</h1>
        <a href="{{ route('quiz.create') }}" class="bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">+ Créer</a>
    </div>

    @if($quizzes->count())
    <div class="space-y-4">
        @foreach($quizzes as $quiz)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm flex items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-gray-800 dark:text-white">{{ $quiz->title }}</h3>
                <div class="flex items-center gap-3 mt-1 text-xs text-gray-400">
                    <span>📝 {{ $quiz->questions_count }} questions</span>
                    <span>▶️ {{ $quiz->plays }} joués</span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('quiz.show', $quiz->slug) }}" class="text-sm text-rose-600 font-semibold px-3 py-1.5 hover:bg-rose-50 rounded-lg">Voir</a>
                <a href="{{ route('quiz.rankings', $quiz->slug) }}" class="text-sm text-gray-600 font-semibold px-3 py-1.5 hover:bg-gray-100 rounded-lg">Classement</a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl">
        <div class="text-5xl mb-4">📚</div>
        <p class="text-gray-500 mb-4">Tu n'as pas encore créé de quiz.</p>
        <a href="{{ route('quiz.create') }}" class="inline-block bg-rose-600 hover:bg-rose-700 text-white font-semibold px-6 py-3 rounded-xl transition">Créer mon premier quiz</a>
    </div>
    @endif
</x-game-layout>
