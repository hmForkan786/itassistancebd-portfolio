<script setup lang="ts">
/**
 * BaseContainer — centres content on the design-system container widths.
 *
 * Thin wrapper around the `.container-page|wide|narrow` utilities so pages never
 * re-implement gutters or maximum widths. Renders a `div` unless `as` is given.
 */
import { computed } from 'vue';

type ContainerWidth = 'page' | 'wide' | 'narrow';

interface Props {
    /** Content shell: default page (1280px), wide (1440px) or narrow (768px). */
    width?: ContainerWidth;
    /** Rendered element, e.g. `'main'`, `'section'` or `'header'`. */
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    width: 'page',
    as: 'div',
});

const widthClasses: Record<ContainerWidth, string> = {
    page: 'container-page',
    wide: 'container-wide',
    narrow: 'container-narrow',
};

const classes = computed<string>(() => widthClasses[props.width]);
</script>

<template>
    <component :is="as" :class="classes">
        <slot />
    </component>
</template>
