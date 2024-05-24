importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.2.0/workbox-sw.js');

workbox.routing.registerRoute(
  ({request}) => request.destination === 'image',
  new workbox.strategies.NetworkFirst()
);

//cache page with /pwa- prefix
workbox.routing.registerRoute(
  new RegExp('/pwa-'),
  new workbox.strategies.NetworkFirst()
);