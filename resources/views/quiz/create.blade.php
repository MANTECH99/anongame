<x-game-layout title="Créer un quiz">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6">🎯 Créer un quiz</h1>

        <form method="POST" action="{{ route('quiz.store') }}" class="space-y-6"
            x-data="{ questions: [ { question: '', options: ['', '', '', ''], correct: 0 } ] }">
            @csrf

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Titre du quiz</label>
                    <input type="text" name="title" required
                        class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Ex: Culture sénégalaise">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" rows="2"
                        class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Un petit mot sur ton quiz..."></textarea>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catégorie</label>
                    <select name="category" class="mt-1 w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
                        <option value="general">Général</option>
                        <option value="culture">Culture sénégalaise</option>
                        <option value="football">Football</option>
                        <option value="geographie">Géographie</option>
                        <option value="musique">Musique</option>
                        <option value="histoire">Histoire</option>
                    </select>
                </div>
            </div>

            <!-- Questions -->
            <template x-for="(q, qi) in questions" :key="qi">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-gray-800 dark:text-white" x-text="'Question ' + (qi + 1)"></h3>
                        <button type="button" x-show="questions.length > 1" @click="questions.splice(qi, 1)" class="text-red-500 text-sm">Supprimer</button>
                    </div>

                    <div>
                        <input type="text" x-model="q.question" :name="'questions[' + qi + '][question]'" required
                            class="w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5" placeholder="Écris ta question...">
                    </div>

                    <div class="space-y-2">
                        <template x-for="(opt, oi) in q.options" :key="oi">
                            <div class="flex items-center gap-3">
                                <input type="radio" x-model.number="q.correct" :value="oi" class="accent-green-600" :name="'q_' + qi + '_correct'">
                                <input type="text" x-model="q.options[oi]" :name="'questions[' + qi + '][options][]'" required
                                    class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2" :placeholder="'Option ' + (oi + 1)">
                            </div>
                        </template>
                    </div>
                    <p class="text-xs text-gray-400">Coche la bonne réponse (⚪) puis ajoute les autres options.</p>
                    <input type="hidden" x-model.number="q.correct" :name="'questions[' + qi + '][correct]'">
                </div>
            </template>

            <button type="button" @click="questions.push({ question: '', options: ['', '', '', ''], correct: 0 })"
                class="w-full border-2 border-dashed border-emerald-300 text-emerald-600 font-semibold py-3 rounded-xl hover:bg-emerald-50 transition">
                + Ajouter une question
            </button>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition">Publier le quiz</button>
        </form>
    </div>
</x-game-layout>
