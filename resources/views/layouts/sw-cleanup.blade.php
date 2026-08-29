<script>
    // Force-remove any old/stale service worker and its cached pages so the app
    // always reflects the real server state (fixes the "ghost account" bug
    // where /anon kept showing the last logged-in user after logout).
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', async () => {
            try {
                const registrations = await navigator.serviceWorker.getRegistrations();
                for (const reg of registrations) {
                    await reg.unregister();
                }
            } catch (e) { /* ignore */ }
            try {
                await navigator.serviceWorker.register('/sw.js');
            } catch (e) { /* ignore */ }
        });
    }
</script>
