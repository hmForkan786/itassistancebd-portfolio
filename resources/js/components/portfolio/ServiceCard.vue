<script setup lang="ts">
/**
 * ServiceCard — one service category from `data/services.ts`.
 *
 * The number is decorative (the heading carries the meaning), so it is hidden
 * from assistive technology. No prices, guarantees or delivery times are shown
 * because the data model does not contain any.
 */
import { BaseCard } from '@/components/ui';
import type { Service } from '@/data/services';

interface Props {
    /** Service entry to render. */
    service: Service;
    /** Position in the list, rendered as a two-digit decorative index. */
    index: number;
    /** Rendered element. Use `li` inside lists, `article` when standalone. */
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    as: 'article',
});

const position: string = String(props.index + 1).padStart(2, '0');
</script>

<template>
    <BaseCard :as="as" hoverable class="flex h-full flex-col">
        <p aria-hidden="true" class="text-tiny font-semibold tracking-widest text-primary-dark">
            {{ position }}
        </p>

        <h3 class="mt-2 text-h4">{{ service.title }}</h3>

        <p class="mt-2 text-small text-body">{{ service.description }}</p>
    </BaseCard>
</template>
