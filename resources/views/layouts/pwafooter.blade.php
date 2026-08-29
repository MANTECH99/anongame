<script>
    // PWA Service Worker registration
    // Force-describe any old/stale service worker so cached pages never survive.
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

    // PWA Install prompt
    let deferredPrompt = null;
    const installPrompt = document.getElementById('pwa-install');
    const installBtn = document.getElementById('pwa-install-btn');
    const dismissBtn = document.getElementById('pwa-dismiss-btn');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        setTimeout(() => {
            if (installPrompt) installPrompt.classList.remove('hidden');
        }, 3000);
    });

    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                deferredPrompt = null;
                if (installPrompt) installPrompt.classList.add('hidden');
            }
        });
    }

    if (dismissBtn) {
        dismissBtn.addEventListener('click', () => {
            if (installPrompt) installPrompt.classList.add('hidden');
        });
    }

    window.addEventListener('appinstalled', () => {
        if (installPrompt) installPrompt.classList.add('hidden');
    });
</script>
