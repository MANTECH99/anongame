const CACHE_NAME = 'anongame-v8';
const APP_SHELL = [
    '/icons/icon-192x192.png',
    '/icons/icon-512x512.png',
    '/icons/maskable-192x192.png',
    '/icons/maskable-512x512.png',
    '/manifest.webmanifest'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(APP_SHELL))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        // Delete EVERY old cache (v5/v6/v7...) so no stale HTML page ever survives.
        caches.keys().then((keys) =>
            Promise.all(keys.map((key) => caches.delete(key)))
        ).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET') return;

    const url = new URL(request.url);

    // NEVER cache HTML pages (they contain per-user/session content).
    const hasExtension = /\.\w{2,5}(\?|$)/.test(url.pathname);
    const isHtml = request.headers.get('accept')?.includes('text/html')
        || !hasExtension;

    if (isHtml) {
        // Serve straight from network. Also proactively purge any cached copy.
        event.respondWith(
            caches.open(CACHE_NAME).then((cache) =>
                cache.delete(request).catch(() => {}).then(() => fetch(request))
            )
        );
        return;
    }

    // Assets (js/css/images/fonts) only: stale-while-revalidate.
    event.respondWith(
        caches.match(request).then((cached) => {
            const fetchPromise = fetch(request)
                .then((response) => {
                    if (response && response.status === 200 && request.url.startsWith(self.location.origin)) {
                        const clone = response.clone();
                        caches.open(CACHE_NAME).then((cache) => cache.put(request, clone));
                    }
                    return response;
                })
                .catch(() => cached);
            return cached || fetchPromise;
        })
    );
});
