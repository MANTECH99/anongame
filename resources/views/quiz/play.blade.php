<x-game-layout :title="'Jouer - '.$quiz->title">
    <div class="mb-4">
        <a href="{{ route('quiz.show', $quiz->slug) }}" class="text-sm text-rose-600">← Retour</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 sm:p-8 shadow-sm">
        <h1 class="text-xl sm:text-2xl font-extrabold text-gray-800 dark:text-white mb-1">{{ $quiz->title }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ $quiz->questions->count() }} questions · 10 pts chacune</p>

        <!-- Pseudo optionnel -->
        <form method="POST" action="{{ route('quiz.submit', $quiz->slug) }}">
            @csrf
            <div class="mb-6">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Ton pseudo (optionnel)</label>
                <input type="text" name="player_name" value="{{ old('player_name', auth()->user()->name ?? '') }}"
                    placeholder="Anonyme" class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
            </div>

            <div class="space-y-6">
                @foreach($quiz->questions as $index => $question)
                <div class="border border-gray-200 dark:border-gray-700 rounded-2xl p-5">
                    <p class="font-semibold text-gray-800 dark:text-white mb-4">
                        <span class="text-rose-600">{{ $index + 1 }}.</span> {{ $question->question }}
                    </p>
                    <div class="space-y-2">
                        @foreach($question->options as $optIndex => $option)
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $optIndex }}" class="accent-rose-600" required>
                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ $option }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <button type="submit" class="mt-6 w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-xl transition">Valider mes réponses ✅</button>
        </form>
    </div>
</x-game-layout>
