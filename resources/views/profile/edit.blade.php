<x-game-layout title="Mon profil">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6">👤 Mon profil</h1>

        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm mb-6">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Informations</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm mb-6">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Mot de passe</h2>
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm">
            <h2 class="text-lg font-bold text-red-600 mb-4">Supprimer le compte</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-game-layout>
