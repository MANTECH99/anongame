<x-game-layout title="Quiz">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">🎯 Quiz</h1>
        <a href="{{ route('quiz.create') }}" class="bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">+ Créer</a>
    </div>

    <!-- Filtres -->
    <form method="GET" class="flex gap-2 mb-6">
        <select name="category" class="text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-3 py-2">
            <option value="all">Toutes catégories</option>
            @foreach($categories as $key => $label)
            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
            class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2">
        <button class="bg-gray-800 dark:bg-gray-700 text-white text-sm font-semibold px-4 rounded-xl">Filtrer</button>
    </form>

    @if($quizzes->count())
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($quizzes as $quiz)
        <a href="{{ route('quiz.show', $quiz->slug) }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between gap-2">
                <h3 class="font-bold text-gray-800 dark:text-white">{{ $quiz->title }}</h3>
                <span class="shrink-0 text-xs bg-rose-100 dark:bg-rose-900/40 dark:text-rose-300 text-rose-700 px-2 py-1 rounded-full">{{ $categories[$quiz->category] ?? $quiz->category }}</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">{{ $quiz->description }}</p>
            <div class="flex items-center justify-between mt-4 text-xs text-gray-400">
                <span>📝 {{ $quiz->questions_count }} questions</span>
                <span>▶️ {{ $quiz->plays }} joués</span>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $quizzes->appends(request()->query())->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <div class="text-5xl mb-4">🎯</div>
        <p class="text-gray-500">Aucun quiz trouvé.</p>
    </div>
    @endif
</x-game-layout>
