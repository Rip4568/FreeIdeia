/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.cookie.split(';').find(row => row.startsWith('XSRF-TOKEN=')).split('=')[1];

export { axios };

/* window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document
  .querySelector('meta[name="csrf-token"]')
  .getAttribute('content'); */

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

/* window.Echo = new Echo({
  broadcaster: 'redis',
  host: import.meta.env.VITE_REDIS_HOST ?? '127.0.0.1',
  port: import.meta.env.VITE_REDIS_PORT ?? 6379,
  key: import.meta.env.VITE_REDIS_KEY ?? 'laravel_database',

  enabledTransports: ['ws', 'wss'],
}); */