<x-game-layout title="Devinettes">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">🤔 Devinettes</h1>
        <a href="{{ route('devinette.create') }}" class="bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">+ Créer</a>
    </div>

    <!-- Filtres -->
    <form method="GET" class="flex flex-wrap gap-2 mb-6 items-center">
        <select name="category" class="text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-3 py-2 shrink-0">
            <option value="all">Toutes catégories</option>
            @foreach($categories as $key => $label)
            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <button class="shrink-0 whitespace-nowrap bg-gray-800 dark:bg-gray-700 text-white text-sm font-semibold px-4 py-2 rounded-xl">Filtrer</button>
    </form>

    @if($devinettes->count())
    <div class="grid gap-4 sm:grid-cols-2">
        @foreach($devinettes as $d)
        <a href="{{ route('devinette.show', $d->slug) }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between gap-2">
                <h3 class="font-bold text-gray-800 dark:text-white">{{ $d->title }}</h3>
                <span class="shrink-0 text-xs bg-purple-100 dark:bg-purple-900/40 dark:text-purple-300 text-purple-700 px-2 py-1 rounded-full">{{ $categories[$d->category] ?? $d->category }}</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">{{ $d->question }}</p>
            <div class="mt-3 text-xs text-gray-400">
                @if($d->challenges > 0)
                <span>🎯 {{ $d->success_rate }}% de réussite · {{ $d->challenges }} défis</span>
                @else
                <span>🎯 Pas encore résolue</span>
                @endif
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $devinettes->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <div class="text-5xl mb-4">🤔</div>
        <p class="text-gray-500">Aucune devinette trouvée.</p>
    </div>
    @endif
</x-game-layout>
