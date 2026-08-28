<x-game-layout :title="'Messages - '.$link->title">
    <div class="mb-4">
        <a href="{{ route('anonymous.dashboard') }}" class="text-sm text-rose-600">← Mes liens</a>
    </div>

    @if($link->messages->count())
    <div class="space-y-4">
        <h1 class="text-xl font-extrabold text-gray-800 dark:text-white mb-4">💬 {{ $link->message_count }} messages reçus</h1>

        @foreach($link->messages as $message)
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm {{ $message->is_read ? '' : 'border-2 border-rose-200 dark:border-rose-800' }}">
            <div class="flex items-center justify-between mb-2">
                <div class="text-xs text-gray-400">
                    <span class="{{ $message->is_read ? '' : 'font-semibold text-rose-600' }}">{{ $message->sender_name }}</span>
                    · {{ \Illuminate\Support\Carbon::parse($message->created_at)->diffForHumans() }}
                </div>
                @if(!$message->is_read)
                <span class="text-xs bg-rose-100 text-rose-700 px-2 py-0.5 rounded-full font-semibold">Nouveau</span>
                @endif
            </div>
            <p class="text-gray-700 dark:text-gray-300">{{ $message->content }}</p>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-500 mb-4">Aucun message pour le moment.</p>
        <a href="{{ route('share.anonymous', $link->slug) }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-xl transition">
            Partage ton lien sur WhatsApp
        </a>
    </div>
    @endif
</x-game-layout>
