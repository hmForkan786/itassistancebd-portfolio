<script setup lang="ts">
/**
 * Root Vue component.
 *
 * Intentionally minimal: it only renders the active route. Layouts, the public
 * site shell and the admin shell are added by later modules.
 */
import { RouterView } from 'vue-router';
</script>

<template>
    <RouterView />
</template>
