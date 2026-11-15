import { createPinia } from 'pinia';

/**
 * Single Pinia instance shared by the Vue application.
 *
 * Feature stores are introduced together with the features that need them;
 * no application store is defined in this installation module.
 */
export const pinia = createPinia();
