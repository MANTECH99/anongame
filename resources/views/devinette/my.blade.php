<x-game-layout title="Mes devinettes">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">🤔 Mes devinettes</h1>
        <a href="{{ route('devinette.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">+ Créer</a>
    </div>

    @if($devinettes->count())
    <div class="space-y-4">
        @foreach($devinettes as $d)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm flex items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-gray-800 dark:text-white">{{ $d->title }}</h3>
                <div class="flex items-center gap-3 mt-1 text-xs text-gray-400">
                    <span>🎯 {{ $d->success_rate }}% de réussite</span>
                    <span>⚔️ {{ $d->challenges }} défis</span>
                </div>
            </div>
            <a href="{{ route('devinette.show', $d->slug) }}" class="text-sm text-emerald-600 font-semibold px-3 py-1.5 hover:bg-emerald-50 rounded-lg">Voir</a>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl">
        <div class="text-5xl mb-4">🤔</div>
        <p class="text-gray-500 mb-4">Tu n'as pas encore créé de devinette.</p>
        <a href="{{ route('devinette.create') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition">Créer ma première devinette</a>
    </div>
    @endif
</x-game-layout>
