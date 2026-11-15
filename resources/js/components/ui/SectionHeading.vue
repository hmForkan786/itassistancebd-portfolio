<script setup lang="ts">
/**
 * SectionHeading — eyebrow, title, description and optional actions.
 *
 * The heading element is chosen through `as` (h2 by default) so the page keeps a
 * single h1 and never skips levels. Alignment only changes presentation.
 */
import { computed } from 'vue';

type HeadingLevel = 'h1' | 'h2' | 'h3' | 'h4';
type HeadingAlign = 'left' | 'center';

interface Props {
    /** Small label above the title. */
    eyebrow?: string;
    /** Heading text — required, the component never renders an empty heading. */
    title: string;
    /** Supporting sentence below the title. */
    description?: string;
    /** Heading element to render. Defaults to h2; use h1 only for the page title. */
    as?: HeadingLevel;
    /** Text alignment for the whole block. */
    align?: HeadingAlign;
    /** Optional id so the heading can be referenced via `aria-labelledby`. */
    id?: string;
}

const props = withDefaults(defineProps<Props>(), {
    as: 'h2',
    align: 'left',
});

const headingClasses: Record<HeadingLevel, string> = {
    h1: 'text-h1',
    h2: 'text-h2',
    h3: 'text-h3',
    h4: 'text-h4',
};

const wrapperClasses = computed<string[]>(() => [
    'flex flex-col gap-3',
    props.align === 'center' ? 'items-center text-center' : 'items-start text-left',
]);

const descriptionClasses = computed<string[]>(() => [
    'text-lead text-body max-w-2xl',
    props.align === 'center' ? 'mx-auto' : '',
]);
</script>

<template>
    <div :class="wrapperClasses">
        <p v-if="eyebrow" class="text-small font-semibold tracking-widest uppercase text-primary-dark">
            {{ eyebrow }}
        </p>

        <component :is="as" :id="id" :class="headingClasses[as]">
            {{ title }}
        </component>

        <p v-if="description" :class="descriptionClasses">
            {{ description }}
        </p>

        <slot name="description" />

        <div v-if="$slots.actions" class="mt-2 flex flex-wrap gap-3">
            <slot name="actions" />
        </div>
    </div>
</template>
