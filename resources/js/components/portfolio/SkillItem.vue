<script setup lang="ts">
/**
 * SkillItem — one tool or skill name rendered as a text chip.
 *
 * A plain list item: the text is the signal, so no percentage bars, gauges or
 * self-assigned proficiency levels are used.
 */
import type { ComponentSize } from '@/components/ui';

interface Props {
    /** Skill/tool label. */
    label: string;
    /** Chip size. `sm` suits dense grids, `md` suits standalone lists. */
    size?: ComponentSize;
    /** Rendered element. Keep `li` when the parent is a `<ul>`. */
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    size: 'sm',
    as: 'li',
});

const sizeClasses: Record<ComponentSize, string> = {
    sm: 'px-3 py-1.5 text-small',
    md: 'px-4 py-2 text-body',
    lg: 'px-4 py-2.5 text-body',
};
</script>

<template>
    <component
        :is="as"
        :class="[
            'inline-flex items-center rounded-field border border-line bg-white font-medium text-heading shadow-card',
            sizeClasses[props.size],
        ]"
    >
        {{ label }}
    </component>
</template>
