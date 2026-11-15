<script setup lang="ts">
/**
 * BaseCard — the standard surface for content blocks.
 *
 * One border + one radius + one shadow, all from the design system. Hover is
 * opt-in and nothing animates unless `hoverable` is set.
 */
import { computed } from 'vue';

interface Props {
    /** Rendered element. Use `article` for standalone content, `li` inside lists. */
    as?: string;
    /** Applies standard card padding. */
    padded?: boolean;
    /** Adds a restrained elevation change on pointer hover / keyboard focus. */
    hoverable?: boolean;
    /** Uses the soft surface fill instead of white. */
    muted?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    as: 'div',
    padded: true,
    hoverable: false,
    muted: false,
});

const classes = computed<string[]>(() => [
    'rounded-card border border-line shadow-card',
    props.muted ? 'bg-surface' : 'bg-white',
    props.padded ? 'p-card' : '',
    props.hoverable
        ? 'transition-shadow duration-150 hover:border-line-strong hover:shadow-card-hover focus-within:border-line-strong'
        : '',
]);
</script>

<template>
    <component :is="as" :class="classes">
        <slot name="header" />

        <slot />

        <slot name="footer" />
    </component>
</template>
