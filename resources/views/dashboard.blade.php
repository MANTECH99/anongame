<x-game-layout title="Tableau de bord">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-2">Bonjour, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-6">Que veux-tu faire aujourd'hui ?</p>

        <div class="grid gap-4 sm:grid-cols-2">
            <a href="{{ route('quiz.index') }}" class="bg-gradient-to-br from-rose-600 to-pink-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">🎯</div>
                <h3 class="font-bold">Jouer à un quiz</h3>
                <p class="text-sm text-white/90 mt-1">Teste tes connaissances.</p>
            </a>
            <a href="{{ route('quiz.create') }}" class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">✏️</div>
                <h3 class="font-bold">Créer un quiz</h3>
                <p class="text-sm text-white/90 mt-1">Partage ton propre quiz.</p>
            </a>
            <a href="{{ route('devinette.index') }}" class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">🤔</div>
                <h3 class="font-bold">Devinettes</h3>
                <p class="text-sm text-white/90 mt-1">Résous des énigmes anonymes.</p>
            </a>
            <a href="{{ route('anonymous.dashboard') }}" class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-5 text-white shadow-lg hover:scale-[1.02] transition">
                <div class="text-3xl mb-3">💬</div>
                <h3 class="font-bold">Messages anonymes</h3>
                <p class="text-sm text-white/90 mt-1">Gère tes liens anonymes.</p>
            </a>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-4">
            <a href="{{ route('quiz.my') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition text-center">
                <div class="text-2xl mb-2">📚</div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Mes quiz</span>
            </a>
            <a href="{{ route('devinette.my') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm hover:shadow-md transition text-center">
                <div class="text-2xl mb-2">🗂️</div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Mes devinettes</span>
            </a>
        </div>
    </div>
</x-game-layout>
