<script setup lang="ts">
/**
 * CtaLink — a navigation call to action that is a real link.
 *
 * `BaseButton` renders a native `<button>` and must not be wrapped in an anchor,
 * so navigating CTAs use this component instead: it renders `<RouterLink>` for
 * internal destinations and `<a>` for `mailto:`/external URLs. Styling mirrors
 * `BaseButton` (same heights, radius, weight and brand variants) so the two can
 * sit side by side.
 */
import { computed } from 'vue';
import { RouterLink } from 'vue-router';

type CtaVariant = 'primary' | 'secondary' | 'inverse';
type CtaSize = 'md' | 'lg';

interface Props {
    /** Internal router destination, e.g. `/#projects`. */
    to?: string;
    /** External or non-router URL, e.g. `mailto:`. Takes precedence over `to`. */
    href?: string;
    /** Visual style. `inverse` is the white-on-emerald variant. */
    variant?: CtaVariant;
    /** Control height: 44px or 48px, matching BaseButton. */
    size?: CtaSize;
}

const props = withDefaults(defineProps<Props>(), {
    variant: 'primary',
    size: 'md',
});

const sizeClasses: Record<CtaSize, string> = {
    md: 'h-11 px-5 text-small gap-2',
    lg: 'h-12 px-6 text-body gap-2',
};

const variantClasses: Record<CtaVariant, string> = {
    // White on #047857 is ~5.5:1; hover states never fall back to the base link colour.
    primary: 'bg-primary-dark text-white hover:text-white hover:brightness-95 active:brightness-90',
    secondary: 'border border-line bg-white text-heading hover:border-primary hover:text-primary-dark',
    inverse: 'bg-white text-primary-dark hover:text-primary-dark hover:bg-surface',
};

const classes = computed<string[]>(() => [
    'inline-flex items-center justify-center rounded-field font-semibold no-underline whitespace-nowrap',
    'transition-colors duration-150',
    sizeClasses[props.size],
    variantClasses[props.variant],
]);
</script>

<template>
    <!-- Non-router targets keep normal anchor behaviour (mail client, new tab). -->
    <a v-if="href" :href="href" :class="classes">
        <slot />
    </a>

    <RouterLink v-else :to="to ?? '/'" :class="classes">
        <slot />
    </RouterLink>
</template>
