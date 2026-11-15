<script setup lang="ts">
/**
 * BaseButton — native button with the design-system variants.
 *
 * Stays a real `<button>` so keyboard activation, form submission and screen
 * reader semantics keep working. `loading` only reflects state supplied by the
 * parent; the component never fakes progress.
 */
import { computed } from 'vue';
import type { ButtonSize, ButtonVariant } from './types';

interface Props {
    /** Visual style. */
    variant?: ButtonVariant;
    /** Control height / padding. */
    size?: ButtonSize;
    /** Native button type. */
    type?: 'button' | 'submit' | 'reset';
    /** Disables the button. */
    disabled?: boolean;
    /** Shows a spinner and blocks interaction. */
    loading?: boolean;
    /** Stretches the button to its container width. */
    fullWidth?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    variant: 'primary',
    size: 'md',
    type: 'button',
    disabled: false,
    loading: false,
    fullWidth: false,
});

const sizeClasses: Record<ButtonSize, string> = {
    sm: 'h-9 px-3 text-small gap-1.5',
    md: 'h-11 px-5 text-small gap-2',
    lg: 'h-12 px-6 text-body gap-2',
};

const variantClasses: Record<ButtonVariant, string> = {
    // Solid fills use the darker brand shade: white on #059669 is only 3.76:1,
    // while #047857 reaches ~5.5:1 and still reads as the brand green.
    primary: 'bg-primary-dark text-white hover:brightness-95 active:brightness-90',
    secondary: 'border border-line bg-surface-soft text-heading hover:bg-line',
    outline: 'border border-line-strong bg-white text-heading hover:border-primary hover:text-primary',
    ghost: 'bg-transparent text-body hover:bg-surface-soft hover:text-heading',
    danger: 'bg-danger text-white hover:bg-danger-dark active:bg-danger-dark',
};

const isInactive = computed<boolean>(() => props.disabled || props.loading);

const classes = computed<string[]>(() => [
    'inline-flex items-center justify-center rounded-field font-semibold whitespace-nowrap',
    'transition-colors duration-150',
    'disabled:cursor-not-allowed disabled:opacity-60',
    sizeClasses[props.size],
    variantClasses[props.variant],
    props.fullWidth ? 'w-full' : '',
]);
</script>

<template>
    <button
        :type="type"
        :disabled="isInactive"
        :aria-busy="loading || undefined"
        :aria-disabled="isInactive || undefined"
        :class="classes"
    >
        <!-- Spinner replaces the icon while loading; announced through aria-busy. -->
        <svg
            v-if="loading"
            class="size-4 shrink-0 animate-spin"
            viewBox="0 0 24 24"
            fill="none"
            aria-hidden="true"
        >
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-opacity="0.25" stroke-width="3" />
            <path d="M22 12a10 10 0 0 0-10-10" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
        </svg>

        <span v-else-if="$slots.icon" class="shrink-0" aria-hidden="true">
            <slot name="icon" />
        </span>

        <slot />
    </button>
</template>
