<x-game-layout title="Créer une devinette">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6">🤔 Créer une devinette</h1>

        <form method="POST" action="{{ route('devinette.store') }}" class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                <input type="text" name="title" required class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Ex: L'énigme du pêcheur">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">La question / l'énigme</label>
                <textarea name="question" rows="3" required class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Pose ta devinette ici..."></textarea>
                @error('question')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">La réponse</label>
                <input type="text" name="answer" required class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="La bonne réponse">
                @error('answer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Indice (optionnel)</label>
                <input type="text" name="hint" class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Un petit indice pour aider...">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catégorie</label>
                <select name="category" class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
                    <option value="general">Général</option>
                    <option value="culture">Culture</option>
                    <option value="enigma">Énigmes</option>
                    <option value="maths">Mathématiques</option>
                    <option value="logique">Logique</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition">Publier la devinette</button>
        </form>
    </div>
</x-game-layout>
