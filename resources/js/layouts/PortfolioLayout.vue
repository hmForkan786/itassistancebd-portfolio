<script setup lang="ts">
/**
 * PortfolioLayout — the reusable public application shell.
 *
 * Structure: skip link → header → `<main>` → footer inside a full-height flex
 * column, so the footer sits at the bottom on short pages and follows the
 * content on long ones. The layout renders the active child route, which keeps
 * routing declarative and lets future pages reuse the shell without wrapping.
 */
import { RouterView } from 'vue-router';
import AppFooter from '@/components/layout/AppFooter.vue';
import AppHeader from '@/components/layout/AppHeader.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col bg-white">
        <!-- Keyboard users can bypass the header navigation. -->
        <a
            href="#main-content"
            class="sr-only no-underline focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-50 focus:rounded-field focus:bg-primary-dark focus:px-4 focus:py-2 focus:text-small focus:font-semibold focus:text-white"
        >
            Skip to main content
        </a>

        <AppHeader />

        <main id="main-content" tabindex="-1" class="flex-1">
            <RouterView />
        </main>

        <AppFooter />
    </div>
</template>
