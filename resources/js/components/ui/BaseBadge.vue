<script setup lang="ts">
/**
 * BaseBadge — compact status label.
 *
 * Colour is never the only signal: the badge always contains text, so the
 * meaning survives greyscale and screen readers.
 */
import { computed } from 'vue';
import type { FeedbackVariant } from './types';

type BadgeSize = 'sm' | 'md';

interface Props {
    /** Semantic meaning of the badge. */
    variant?: FeedbackVariant;
    /** Compact (12px) or default (14px) label. */
    size?: BadgeSize;
}

const props = withDefaults(defineProps<Props>(), {
    variant: 'neutral',
    size: 'sm',
});

const variantClasses: Record<FeedbackVariant, string> = {
    primary: 'border-primary/20 bg-primary/10 text-primary-dark',
    neutral: 'border-neutral-line bg-neutral-soft text-neutral',
    success: 'border-success-line bg-success-soft text-success',
    warning: 'border-warning-line bg-warning-soft text-warning',
    danger: 'border-danger-line bg-danger-soft text-danger',
};

const sizeClasses: Record<BadgeSize, string> = {
    sm: 'px-2.5 py-0.5 text-tiny',
    md: 'px-3 py-1 text-small',
};

const classes = computed<string[]>(() => [
    'inline-flex items-center gap-1.5 rounded-pill border font-semibold whitespace-nowrap',
    variantClasses[props.variant],
    sizeClasses[props.size],
]);
</script>

<template>
    <span :class="classes">
        <slot />
    </span>
</template>
