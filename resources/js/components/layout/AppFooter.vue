<script setup lang="ts">
/**
 * AppFooter — dark site footer using the approved footer tokens.
 *
 * Contains brand, footer navigation and copyright only. Social links are
 * intentionally omitted because no verified profile URLs exist yet; adding
 * invented accounts would mislead visitors. The block can take an extra row
 * once real URLs are approved.
 */
import { RouterLink, useRoute } from 'vue-router';
import { BaseContainer } from '@/components/ui';
import { mainNavigation, type NavItem } from './navigation';

const route = useRoute();

const isActive = (item: NavItem): boolean => {
    if (item.path !== '/') {
        return route.path === item.path;
    }

    if (route.path !== '/') {
        return false;
    }

    return item.hash ? route.hash === item.hash : route.hash === '';
};

const isCurrentPage = (item: NavItem): 'page' | 'location' | undefined => {
    if (!isActive(item)) {
        return undefined;
    }

    if (item.hash) {
        return 'location';
    }

    return route.path === item.path ? 'page' : undefined;
};

const linkClasses = (item: NavItem): string[] => [
    'inline-flex rounded-field text-small no-underline transition-colors duration-150',
    isActive(item)
        ? 'font-medium text-footer-text'
        : 'text-footer-muted hover:text-footer-text',
];

const currentYear: number = new Date().getFullYear();
</script>

<template>
    <footer class="mt-auto bg-footer text-footer-text">
        <BaseContainer class="flex flex-col gap-10 py-12 sm:flex-row sm:items-start sm:justify-between">
            <!-- Brand -->
            <div class="max-w-sm">
                <RouterLink
                    to="/"
                    class="inline-flex items-center gap-2.5 rounded-field no-underline"
                >
                    <span
                        aria-hidden="true"
                        class="grid size-9 place-items-center rounded-field bg-white/10 text-footer-text"
                    >
                        <svg class="size-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path d="m4.5 10.5 3.5 3.5 7.5-8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>

                    <span class="font-display text-small font-bold text-footer-text">IT Assistance BD</span>

                    <span class="sr-only">— home</span>
                </RouterLink>

                <p class="mt-4 text-small text-footer-muted">
                    Portfolio of IT Assistance BD.
                </p>
            </div>

            <!-- Footer navigation -->
            <nav aria-labelledby="footer-navigation-heading">
                <h2 id="footer-navigation-heading" class="text-tiny font-semibold tracking-widest uppercase text-footer-muted">
                    Navigate
                </h2>

                <ul class="mt-4 grid grid-cols-2 gap-x-10 gap-y-2 sm:grid-cols-1">
                    <li v-for="item in mainNavigation" :key="item.label">
                        <RouterLink
                            :to="item.to"
                            :aria-current="isCurrentPage(item)"
                            :class="linkClasses(item)"
                        >
                            {{ item.label }}
                        </RouterLink>
                    </li>
                </ul>
            </nav>
        </BaseContainer>

        <div class="border-t border-white/10">
            <BaseContainer class="py-5">
                <p class="text-tiny text-footer-muted">
                    &copy; {{ currentYear }} IT Assistance BD. All rights reserved.
                </p>
            </BaseContainer>
        </div>
    </footer>
</template>
