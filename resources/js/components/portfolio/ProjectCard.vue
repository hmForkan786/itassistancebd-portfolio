<script setup lang="ts">
/**
 * ProjectCard — one portfolio initiative from `data/projects.ts`.
 *
 * Initiatives are not automatically completed products, so the status badge is
 * always visible and the copy never implies a live deployment, client, demo URL
 * or repository. The title links to the project's detail page for more
 * information while the card preserves its existing summary and status behavior.
 */
import { computed } from 'vue';
import { RouterLink } from 'vue-router';
import { BaseBadge, BaseCard } from '@/components/ui';
import type { PortfolioProject, ProjectStatus } from '@/data/projects';

interface Props {
    /** Project entry to render. */
    project: PortfolioProject;
    /** Rendered element. Use `li` inside lists. */
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    as: 'article',
});

interface StatusPresentation {
    label: string;
    variant: 'success' | 'primary' | 'warning' | 'neutral';
}

const statusPresentation: Record<ProjectStatus, StatusPresentation> = {
    completed: { label: 'Completed', variant: 'success' },
    'in-progress': { label: 'In Progress', variant: 'primary' },
    prototype: { label: 'Prototype', variant: 'warning' },
    planned: { label: 'Planned', variant: 'neutral' },
};

const status = computed<StatusPresentation>(() => statusPresentation[props.project.status]);
const detailTo = computed(() => ({ name: 'app.projects.detail', params: { slug: props.project.slug } }));
</script>

<template>
    <BaseCard :as="as" hoverable class="flex h-full flex-col">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <BaseBadge :variant="status.variant">{{ status.label }}</BaseBadge>

            <p class="text-tiny font-semibold tracking-widest uppercase text-muted">
                {{ project.focus }}
            </p>
        </div>

        <h3 class="mt-4 text-h4">
            <RouterLink :to="detailTo" class="text-heading no-underline hover:text-primary-dark">
                {{ project.name }}
            </RouterLink>
        </h3>

        <p class="mt-2 grow text-small text-body">{{ project.summary }}</p>

        <p class="mt-4 text-tiny text-muted">
            Initiative — {{ status.label.toLowerCase() }}. No public demo or source link listed.
        </p>
    </BaseCard>
</template>
