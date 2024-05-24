(function () {
    if ('serviceWorker' in navigator) {
        //disable home cache
        navigator.serviceWorker.getRegistrations().then(function (registrations) {
            for (var i = 0; i < registrations.length; i++) {
                registrations[i].unregister();
                console.log('unregistering service worker');
            }
        });
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/static/js/sw.js')
                .then(function (registration) {
                    console.log('Service Worker Registered');
                    return registration;
                })
                .catch(function (err) {
                    console.error('Unable to register service worker.', err);
                });
            navigator.serviceWorker.ready.then(function (registration) {
                console.log('Service Worker Ready');
            });
        });
    }
})();

