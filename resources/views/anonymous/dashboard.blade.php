<x-game-layout title="Messages anonymes">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">💬 Messages anonymes</h1>
    </div>

    <!-- Créer un lien -->
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-sm mb-6">
        <h2 class="font-bold text-gray-800 dark:text-white mb-2">Créer un nouveau lien anonyme</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Partage ce lien sur WhatsApp pour recevoir des messages anonymes.</p>
        <form method="POST" action="{{ route('anonymous.store') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="title" placeholder="Titre du lien (ex: Posé-moi des questions)"
                class="flex-1 text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-2.5">
            <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">+ Créer</button>
        </form>
    </div>

    @if($links->count())
    <div class="space-y-4">
        @foreach($links as $link)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-3">
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-white">{{ $link->title }}</h3>
                    <p class="text-xs text-gray-400">{{ $link->message_count }} messages reçus · {{ $link->unreadCount() }} non lus</p>
                </div>
                <div class="flex items-center gap-1">
                    <span class="inline-block w-2.5 h-2.5 rounded-full {{ $link->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                    <span class="text-xs text-gray-500">{{ $link->is_active ? 'Actif' : 'Inactif' }}</span>
                </div>
            </div>

            <!-- Lien de partage -->
            <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-700/40 rounded-xl p-2 mb-3">
                <input type="text" readonly value="{{ route('anonymous.send', $link->slug) }}" class="flex-1 bg-transparent text-xs text-gray-600 dark:text-gray-300 outline-none px-2">
                <button onclick="navigator.clipboard.writeText('{{ route('anonymous.send', $link->slug) }}').then(()=>this.textContent='✓ Copié');" class="text-xs bg-gray-200 dark:bg-gray-600 px-3 py-1.5 rounded-lg font-medium">Copier</button>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('share.anonymous', $link->slug) }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2 rounded-xl transition inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                    WhatsApp
                </a>
                <a href="{{ route('anonymous.messages', $link) }}" class="{{ $link->unreadCount() ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600' }} text-{{ $link->unreadCount() ? 'white' : 'gray-700 dark:text-white' }} text-sm font-semibold py-2 px-4 rounded-xl transition">
                    Voir les messages @if($link->unreadCount()) ({{ $link->unreadCount() }}) @endif
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl">
        <div class="text-5xl mb-4">💬</div>
        <p class="text-gray-500">Crée ton premier lien pour commencer à recevoir des messages anonymes.</p>
    </div>
    @endif
</x-game-layout>
