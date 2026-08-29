<x-game-layout :title="'Messages - '.$link->title">
    <div class="mb-4">
        <a href="{{ route('anonymous.dashboard') }}" class="text-sm text-rose-600">← Mes liens</a>
    </div>

    @if($link->messages->count())
    <div class="space-y-4" x-data="{ selected: null, replyOpen: false, reply: '' }">
        <h1 class="text-xl font-extrabold text-gray-800 dark:text-white mb-4">💬 {{ $link->message_count }} messages reçus</h1>

        @foreach($link->messages as $message)
        <div @click="selected = @js([
            'content' => $message->content,
            'sender' => $message->sender_name,
            'time' => \Illuminate\Support\Carbon::parse($message->created_at)->diffForHumans(),
            'read' => (bool) $message->is_read,
        ])"
            class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm cursor-pointer hover:shadow-md transition {{ $message->is_read ? '' : 'border-2 border-rose-200 dark:border-rose-800' }}">
            <div class="flex items-center justify-between mb-2">
                <div class="text-xs text-gray-400">
                    <span class="{{ $message->is_read ? '' : 'font-semibold text-rose-600' }}">{{ $message->sender_name }}</span>
                    · {{ \Illuminate\Support\Carbon::parse($message->created_at)->diffForHumans() }}
                </div>
                <div class="flex items-center gap-2">
                    @if(!$message->is_read)
                    <span class="text-xs bg-rose-100 text-rose-700 px-2 py-0.5 rounded-full font-semibold">Nouveau</span>
                    @endif
                    <span class="text-xs text-rose-500 font-semibold">Voir →</span>
                </div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 line-clamp-2">{{ $message->content }}</p>
        </div>
        @endforeach

        <!-- Message detail modal -->
        <div x-show="selected" x-cloak class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50" @keydown.escape.window="selected = null">
            <div class="bg-white dark:bg-gray-800 w-full sm:max-w-lg max-h-[92vh] overflow-y-auto rounded-t-3xl sm:rounded-3xl shadow-2xl" @click.stop>
                <div class="sticky top-0 bg-white dark:bg-gray-800 z-10 px-5 pt-4 pb-2 flex items-center justify-between">
                    <h3 class="font-extrabold text-gray-800 dark:text-white">💬 Message</h3>
                    <button @click="selected = null" class="text-gray-400 hover:text-gray-600 text-xl leading-none">✕</button>
                </div>

                <div class="px-5 text-xs text-gray-400 mb-3">
                    <span class="font-semibold text-rose-500" x-text="selected.sender"></span> · <span x-text="selected.time"></span>
                </div>

                <!-- Shareable image card (preview) -->
                <div x-ref="shareCard" :data-message="selected.content" :data-sender="selected.sender" class="relative mx-auto max-w-[300px] rounded-3xl overflow-hidden shadow-lg ring-1 ring-black/5 bg-gradient-to-b from-rose-600 via-pink-600 to-purple-700 px-6 pb-6 pt-5 text-center min-h-[360px] flex flex-col">
                    <div class="absolute -top-6 -right-8 w-28 h-28 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 rounded-full bg-white/10"></div>
                    <div class="relative flex flex-col flex-1">
                        <div class="w-[60px] h-[60px] mx-auto mb-3 rounded-[18px] bg-white text-violet-700 text-4xl font-extrabold flex items-center justify-center shadow-lg">?</div>
                        <div class="text-white font-extrabold text-xl leading-tight drop-shadow">Bienvenue sur AnonGame</div>
                        <div class="text-white/85 text-xs mt-1" x-text="selected.sender ? 'Message de ' + selected.sender : 'Message anonyme'"></div>
                        <div class="flex-1 flex items-center justify-center py-6">
                            <p class="text-white text-xl font-semibold whitespace-pre-wrap break-words leading-relaxed" x-text="selected.content"></p>
                        </div>
                        <div class="card-footer border-t border-white/25 pt-3 text-center">
                            <div class="text-[11px] font-bold uppercase tracking-widest text-white/75">AnonGame · Quiz · Devinettes</div>
                            <div class="text-[10px] text-white/50 mt-0.5">Jouer n'a jamais été aussi anonyme</div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-5 pt-4 pb-5 space-y-2">
                    <button @click="shareMessageImage($refs.shareCard)"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                        Partager en image
                    </button>

                    <button @click="downloadMessageImage($refs.shareCard, 'message-anongame.png')"
                        class="w-full border-2 border-rose-500 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 font-bold py-3 rounded-xl transition inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Télécharger l'image
                    </button>

                    <button @click="replyOpen = true"
                        class="w-full border-2 border-green-500 text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 font-bold py-3 rounded-xl transition">
                        Répondre
                    </button>
                </div>
            </div>
        </div>

        <!-- Reply bottom sheet -->
        <div x-show="replyOpen" x-cloak class="fixed inset-0 z-[60] flex items-end justify-center bg-black/50" @click="replyOpen = false">
            <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-t-3xl p-6 pb-8" @click.stop>
                <div class="w-10 h-1.5 rounded-full bg-gray-300 mx-auto mb-5"></div>
                <h3 class="font-extrabold text-gray-800 dark:text-white mb-3">Répondre</h3>
                <textarea x-model="reply" rows="4" placeholder="Écris ta réponse..."
                    class="w-full text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-rose-500"></textarea>
                <button @click="replyOpen = false; shareMessageImage($refs.shareCard, { reply: reply })"
                    :disabled="!reply.trim()"
                    class="w-full bg-green-500 hover:bg-green-600 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 rounded-xl transition inline-flex items-center justify-center gap-2 mt-4">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                    Envoyer la réponse en image
                </button>
            </div>
        </div>
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
