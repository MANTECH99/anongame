const CACHE_NAME = 'anongame-v7';
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
        caches.keys().then((keys) =>
            Promise.all(
                keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
            )
        ).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET') return;

    const url = new URL(request.url);

    // Never cache HTML pages (they contain per-user/session content) nor sw.js.
    const isHtml = request.headers.get('accept')?.includes('text/html')
        || url.pathname === '/'
        || !url.pathname.includes('.');
    if (isHtml || url.pathname.endsWith('/sw.js') || url.pathname === '/manifest.webmanifest') {
        event.respondWith(fetch(request));
        return;
    }

    // Assets (js/css/images/icons): stale-while-revalidate.
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
