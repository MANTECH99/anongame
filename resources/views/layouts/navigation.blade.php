<nav class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-40 pwa-safe-top">
    <div class="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="/icons/icon-192x192.png?v=3" alt="AnonGame" class="w-9 h-9 rounded-lg ring-2 ring-emerald-100">
            <span class="font-extrabold text-gray-800 dark:text-white text-base">Anon<span class="text-emerald-600">Game</span></span>
        </a>

        <!-- Center nav (desktop) -->
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('home') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:bg-gray-100' }}">Accueil</a>
            <a href="{{ route('quiz.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('quiz.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:bg-gray-100' }}">Quiz</a>
            <a href="{{ route('devinette.index') }}" class="px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('devinette.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:bg-gray-100' }}">Devinettes</a>
            <a href="{{ route('anonymous.dashboard') }}" class="px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('anonymous.*') ? 'text-emerald-600 bg-emerald-50' : 'text-gray-600 hover:bg-gray-100' }}">Anonyme</a>
        </div>

        <!-- Auth / User menu -->
        <div class="flex items-center gap-3">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900">
                            <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Mon profil</x-dropdown-link>
                        <x-dropdown-link :href="route('anonymous.dashboard')">Mes messages anonymes</x-dropdown-link>
                        <x-dropdown-link :href="route('quiz.create')">Créer un quiz</x-dropdown-link>
                        <x-dropdown-link :href="route('devinette.create')">Créer une devinette</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 px-3 py-2">Connexion</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl transition">S'inscrire</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
