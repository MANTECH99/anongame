<x-game-layout title="Accueil">
    <!-- Hero -->
    <section class="rounded-3xl overflow-hidden relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-emerald-600 to-green-700"></div>
        <div class="relative px-6 py-10 sm:py-14 text-white">
            <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight mb-3">Joue, défie et partage <span class="text-emerald-300">anonymement</span></h1>
            <p class="text-white/90 mb-6 max-w-md text-sm sm:text-base">Crée des quiz, résous des devinettes, envoie des messages anonymes et partage tout sur WhatsApp. 🇸🇳</p>
            <div class="flex gap-2 sm:gap-3">
                <a href="{{ route('quiz.index') }}" class="flex-1 bg-white text-emerald-600 font-semibold px-3 sm:px-5 py-2.5 rounded-xl hover:bg-emerald-50 transition whitespace-nowrap text-center text-sm sm:text-base">🎯 Jouer à un quiz</a>
                <a href="{{ route('devinette.index') }}" class="flex-1 bg-white/20 border border-white/50 text-white font-semibold px-3 sm:px-5 py-2.5 rounded-xl hover:bg-white/30 transition whitespace-nowrap text-center text-sm sm:text-base">🤔 Défier un ami</a>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="grid grid-cols-3 gap-3 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 text-center shadow-sm">
            <p class="text-2xl font-extrabold text-emerald-600">{{ number_format($stats['quizzes']) }}</p>
            <p class="text-xs text-gray-500">Quiz</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 text-center shadow-sm">
            <p class="text-2xl font-extrabold text-green-600">{{ number_format($stats['devinettes']) }}</p>
            <p class="text-xs text-gray-500">Devinettes</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 text-center shadow-sm">
            <p class="text-2xl font-extrabold text-emerald-500">{{ number_format($stats['players']) }}</p>
            <p class="text-xs text-gray-500">Parties jouées</p>
        </div>
    </section>

    <!-- Modes -->
    <section class="mb-8">
        <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-3">Choisis ton mode de jeu</h2>
        <div class="grid gap-4 sm:grid-cols-3">
            <a href="{{ route('quiz.index') }}" class="bg-gradient-to-br from-emerald-600 to-emerald-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">🎯</div>
                <h3 class="font-bold text-lg">Quiz</h3>
                <p class="text-sm text-white/90 mt-1">Teste tes connaissances et défie tes amis.</p>
            </a>
            <a href="{{ route('devinette.index') }}" class="bg-gradient-to-br from-green-600 to-green-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">🤔</div>
                <h3 class="font-bold text-lg">Devinettes</h3>
                <p class="text-sm text-white/90 mt-1">Envoie des devinettes anonymes à tes amis.</p>
            </a>
            <a href="{{ route('anonymous.dashboard') }}" class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">💬</div>
                <h3 class="font-bold text-lg">Messages anonymes</h3>
                <p class="text-sm text-white/90 mt-1">Reçois ce que les gens pensent vraiment.</p>
            </a>
        </div>
    </section>

    <!-- Quiz populaires -->
    @if($quizzes->count())
    <section class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Quiz populaires</h2>
            <a href="{{ route('quiz.index') }}" class="text-sm font-semibold text-emerald-600">Voir tout →</a>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($quizzes as $quiz)
            <a href="{{ route('quiz.show', $quiz->slug) }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-bold text-gray-800 dark:text-white">{{ $quiz->title }}</h3>
                    <span class="shrink-0 text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">{{ $quiz->category }}</span>
                </div>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $quiz->description }}</p>
                <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                    <span>📝 {{ $quiz->questions_count }} questions</span>
                    <span>▶️ {{ $quiz->plays }} parties</span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Devinettes -->
    @if($devinettes->count())
    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Nouvelles devinettes</h2>
            <a href="{{ route('devinette.index') }}" class="text-sm font-semibold text-emerald-600">Voir tout →</a>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($devinettes as $d)
            <a href="{{ route('devinette.show', $d->slug) }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-bold text-gray-800 dark:text-white">{{ $d->title }}</h3>
                </div>
                <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $d->question }}</p>
                <div class="mt-3 text-xs text-gray-400">
                    @if($d->challenges > 0)
                    <span>🎯 Taux de réussite : {{ $d->success_rate }}%</span>
                    @else
                    <span>🎯 Pas encore résolue</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</x-game-layout>
