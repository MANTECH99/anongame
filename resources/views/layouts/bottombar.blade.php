<nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 pb-[env(safe-area-inset-bottom)]">
    <div class="grid grid-cols-4 h-16">
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-0.5 {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10"></path></svg>
            <span class="text-[10px] font-medium">Accueil</span>
        </a>
        <a href="{{ route('quiz.index') }}" class="flex flex-col items-center justify-center gap-0.5 {{ request()->routeIs('quiz.*') ? 'text-emerald-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-[10px] font-medium">Quiz</span>
        </a>
        <a href="{{ route('devinette.index') }}" class="flex flex-col items-center justify-center gap-0.5 {{ request()->routeIs('devinette.*') ? 'text-emerald-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
            <span class="text-[10px] font-medium">Devinettes</span>
        </a>
        <a href="{{ auth()->check() ? route('anonymous.dashboard') : route('anonymous.dashboard') }}" class="flex flex-col items-center justify-center gap-0.5 {{ request()->routeIs('anonymous.*') ? 'text-emerald-600' : 'text-gray-500' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="text-[10px] font-medium">Anonyme</span>
        </a>
    </div>
</nav>
