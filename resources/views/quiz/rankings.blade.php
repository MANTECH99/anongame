<x-game-layout :title="'Classement - '.$quiz->title">
    <div class="mb-4">
        <a href="{{ route('quiz.show', $quiz->slug) }}" class="text-sm text-emerald-600">← Retour au quiz</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm">
        <h1 class="text-xl font-extrabold text-gray-800 dark:text-white mb-1">🏆 Classement — {{ $quiz->title }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Top {{ $attempts->count() }} joueurs</p>

        @if($attempts->count())
        <div class="space-y-3">
            @foreach($attempts as $index => $attempt)
            <div class="flex items-center gap-4 p-3 rounded-2xl {{ $index === 0 ? 'bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-700' : 'bg-gray-50 dark:bg-gray-700/40' }}">
                <span class="w-8 text-center font-bold text-lg {{ $index === 0 ? 'text-emerald-500' : ($index === 1 ? 'text-gray-400' : ($index === 2 ? 'text-orange-400' : 'text-gray-400')) }}">
                    {{ $index === 0 ? '🥇' : ($index === 1 ? '🥈' : ($index === 2 ? '🥉' : $index + 1)) }}
                </span>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $attempt->player_name }}</p>
                    <p class="text-xs text-gray-400">{{ \Illuminate\Support\Carbon::parse($attempt->created_at)->diffForHumans() }}</p>
                </div>
                <span class="font-extrabold text-emerald-600">{{ $attempt->score }}/{{ $attempt->total }}</span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 py-8">Pas encore de joueurs. Sois le premier ! 🚀</p>
        @endif
    </div>
</x-game-layout>
