<script setup lang="ts">
/**
 * AppHeader — sticky site header with desktop navigation and a mobile menu.
 *
 * Navigation is a plain list of router links (no clickable divs). The mobile
 * panel is a disclosure: the toggle exposes `aria-expanded`/`aria-controls`, the
 * menu closes on link selection, on Escape (returning focus to the toggle), on
 * route changes and when the viewport reaches the desktop breakpoint.
 */
import { nextTick, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { RouterLink, useRoute } from 'vue-router';
import { BaseContainer } from '@/components/ui';
import { mainNavigation, type NavItem } from './navigation';

const route = useRoute();

const mobileOpen = ref(false);
const menuButton = ref<HTMLButtonElement | null>(null);

/** Tailwind `lg` breakpoint — the point where the desktop navigation appears. */
const desktopQuery = '(min-width: 64rem)';

const isActive = (item: NavItem): boolean => {
    // Dedicated pages: match by path (exact for Home, exact for /about etc.).
    if (item.path !== '/') {
        return route.path === item.path;
    }

    // Homepage and homepage-anchor items (e.g. Skills).
    if (route.path !== '/') {
        return false;
    }

    return item.hash ? route.hash === item.hash : route.hash === '';
};

/**
 * Active links get a soft surface and the darker brand ink; `aria-current`
 * mirrors the same state for assistive technology. Page/route matches use
 * `page`; a hash location on the homepage uses `location`.
 */
const isCurrentPage = (item: NavItem): 'page' | 'location' | undefined => {
    if (!isActive(item)) {
        return undefined;
    }

    if (item.hash) {
        return 'location';
    }

    return route.path === item.path ? 'page' : undefined;
};

const desktopLinkClasses = (item: NavItem): string[] => [
    'inline-flex items-center rounded-field px-3 py-2 text-small no-underline transition-colors duration-150',
    isActive(item)
        ? 'bg-surface-soft font-semibold text-primary-dark'
        : 'font-medium text-body hover:bg-surface-soft hover:text-heading',
];

const mobileLinkClasses = (item: NavItem): string[] => [
    'block rounded-field px-3 py-2.5 text-small no-underline transition-colors duration-150',
    isActive(item)
        ? 'bg-surface-soft font-semibold text-primary-dark'
        : 'font-medium text-body hover:bg-surface-soft hover:text-heading',
];

/**
 * Closes the panel. `returnFocus` is used for Escape so keyboard users are
 * returned to the control that opened the menu.
 */
const closeMenu = (returnFocus = false): void => {
    mobileOpen.value = false;

    if (returnFocus) {
        void nextTick(() => menuButton.value?.focus());
    }
};

const onKeydown = (event: KeyboardEvent): void => {
    if (event.key === 'Escape' && mobileOpen.value) {
        event.preventDefault();
        closeMenu(true);
    }
};

watch(mobileOpen, (open: boolean): void => {
    if (open) {
        document.addEventListener('keydown', onKeydown);
    } else {
        document.removeEventListener('keydown', onKeydown);
    }
});

// Selecting any destination (including browser back/forward) closes the panel.
watch(
    () => route.fullPath,
    (): void => {
        mobileOpen.value = false;
    },
);

let desktopMedia: MediaQueryList | null = null;

const onDesktopChange = (event: MediaQueryListEvent): void => {
    if (event.matches) {
        mobileOpen.value = false;
    }
};

onMounted((): void => {
    desktopMedia = window.matchMedia(desktopQuery);
    desktopMedia.addEventListener('change', onDesktopChange);
});

onBeforeUnmount((): void => {
    document.removeEventListener('keydown', onKeydown);
    desktopMedia?.removeEventListener('change', onDesktopChange);
});
</script>

<template>
    <header class="sticky top-0 z-40 border-b border-line bg-white/95 backdrop-blur">
        <BaseContainer class="flex h-16 items-center justify-between gap-4 lg:h-20">
            <!-- Brand -->
            <RouterLink
                to="/"
                class="flex items-center gap-2.5 rounded-field no-underline"
            >
                <!-- Decorative mark: the link name comes from the wordmark + hidden "home" suffix. -->
                <span
                    aria-hidden="true"
                    class="grid size-9 shrink-0 place-items-center rounded-field bg-primary-dark text-white"
                >
                    <svg class="size-5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path d="m4.5 10.5 3.5 3.5 7.5-8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>

                <span class="flex flex-col leading-tight">
                    <span class="font-display text-small font-bold text-heading">IT Assistance BD</span>
                    <span class="text-tiny font-medium text-muted">Portfolio</span>
                </span>

                <span class="sr-only">— home</span>
            </RouterLink>

            <!-- Desktop navigation -->
            <nav class="hidden lg:block" aria-label="Primary">
                <ul class="flex items-center gap-1">
                    <li v-for="item in mainNavigation" :key="item.label">
                        <RouterLink
                            :to="item.to"
                            :aria-current="isCurrentPage(item)"
                            :class="desktopLinkClasses(item)"
                        >
                            {{ item.label }}
                        </RouterLink>
                    </li>
                </ul>
            </nav>

            <!-- Mobile menu toggle: a real button with an explicit accessible name. -->
            <button
                ref="menuButton"
                type="button"
                class="inline-flex size-10 items-center justify-center rounded-field border border-line text-heading transition-colors duration-150 hover:bg-surface-soft lg:hidden"
                :aria-expanded="mobileOpen"
                aria-controls="mobile-navigation"
                :aria-label="mobileOpen ? 'Close main menu' : 'Open main menu'"
                @click="mobileOpen = !mobileOpen"
            >
                <svg
                    v-if="mobileOpen"
                    class="size-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.75"
                    aria-hidden="true"
                >
                    <path d="m5 5 10 10M15 5 5 15" stroke-linecap="round" />
                </svg>

                <svg
                    v-else
                    class="size-5"
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.75"
                    aria-hidden="true"
                >
                    <path d="M3 6h14M3 10h14M3 14h14" stroke-linecap="round" />
                </svg>
            </button>
        </BaseContainer>

        <!-- Mobile navigation panel -->
        <Transition
            enter-active-class="transition duration-150 ease-out motion-reduce:transition-none"
            enter-from-class="opacity-0 -translate-y-1"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-100 ease-in motion-reduce:transition-none"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-1"
        >
            <nav
                v-if="mobileOpen"
                id="mobile-navigation"
                class="border-t border-line bg-white lg:hidden"
                aria-label="Primary"
            >
                <BaseContainer class="py-3">
                    <ul class="flex flex-col gap-1">
                        <li v-for="item in mainNavigation" :key="item.label">
                            <RouterLink
                                :to="item.to"
                                :aria-current="isCurrentPage(item)"
                                :class="mobileLinkClasses(item)"
                                @click="closeMenu()"
                            >
                                {{ item.label }}
                            </RouterLink>
                        </li>
                    </ul>
                </BaseContainer>
            </nav>
        </Transition>
    </header>
</template>
