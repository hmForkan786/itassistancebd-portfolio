/**
 * Vue application entry point.
 *
 * Mounts the root component into `#app` (see resources/views/app.blade.php),
 * registering Pinia (state) and Vue Router (routing) before mounting.
 *
 * The stock Laravel files `app.js` and `bootstrap.js` are intentionally left
 * in place but are no longer part of the Vite build; Axios is provided through
 * `services/http.ts` instead of a window global.
 */
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { pinia } from './stores';

createApp(App).use(pinia).use(router).mount('#app');
