<script setup lang="ts">
/**
 * ProjectDetail — reusable detail view for a single portfolio initiative.
 *
 * Renders only verified, data-driven information: status, overview, purpose,
 * technology stack (when confirmed), implemented work, planned scope and
 * limitations. Implemented and planned items are shown in separate sections so
 * they are never conflated.
 */
import { computed } from 'vue';
import { BaseBadge, BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import type { PortfolioProject, ProjectStatus } from '@/data/projects';

interface Props {
    /** Project entry to display. */
    project: PortfolioProject;
}

const props = defineProps<Props>();

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
const hasTechStack = computed<boolean>(() => props.project.techStack.length > 0);
</script>

<template>
    <article>
        <!-- Header -->
        <section class="section bg-surface border-b border-line" aria-labelledby="project-title">
            <BaseContainer class="stack-lg">
                <nav aria-label="Breadcrumb" class="text-small">
                    <RouterLink to="/projects" class="inline-flex items-center gap-1 text-primary-dark no-underline hover:underline">
                        <span aria-hidden="true">←</span>
                        <span>Back to projects</span>
                    </RouterLink>
                </nav>

                <div class="flex flex-wrap items-center gap-3">
                    <BaseBadge :variant="status.variant">{{ status.label }}</BaseBadge>
                    <p class="text-tiny font-semibold tracking-widest uppercase text-muted">
                        {{ project.focus }}
                    </p>
                </div>

                <SectionHeading
                    id="project-title"
                    as="h1"
                    :title="project.name"
                    :description="project.summary"
                    class="max-w-3xl"
                />

                <p class="text-small text-muted max-w-2xl">
                    Initiative — {{ status.label.toLowerCase() }}. Details below distinguish confirmed work from planned scope.
                </p>
            </BaseContainer>
        </section>

        <!-- Overview and purpose -->
        <section class="section" aria-labelledby="overview-title">
            <BaseContainer class="grid gap-grid lg:grid-cols-12">
                <BaseCard as="section" class="lg:col-span-7" aria-labelledby="overview-title">
                    <SectionHeading id="overview-title" as="h2" eyebrow="Overview" title="About this initiative" />
                    <p class="mt-4 text-body">{{ project.overview }}</p>
                </BaseCard>

                <BaseCard as="section" class="lg:col-span-5" aria-labelledby="purpose-title">
                    <SectionHeading id="purpose-title" as="h2" eyebrow="Purpose" title="What it aims to address" />
                    <p class="mt-4 text-body">{{ project.purpose }}</p>
                </BaseCard>
            </BaseContainer>
        </section>

        <!-- Technology stack -->
        <section class="section bg-surface" aria-labelledby="stack-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="stack-title"
                    as="h2"
                    eyebrow="Technology"
                    title="Technology stack"
                    :description="hasTechStack
                        ? 'Technologies verified for this initiative in the current project context.'
                        : 'A specific technology stack has not been confirmed for this initiative yet.'"
                />

                <ul v-if="hasTechStack" class="flex flex-wrap gap-2" aria-label="Technology stack">
                    <li v-for="tech in project.techStack" :key="tech">
                        <BaseBadge variant="neutral">{{ tech }}</BaseBadge>
                    </li>
                </ul>

                <p v-else class="text-small text-body max-w-2xl">
                    Stack details will be added here only when they are verified. No technologies are assumed for planned initiatives.
                </p>
            </BaseContainer>
        </section>

        <!-- Implemented work and planned scope -->
        <section class="section" aria-labelledby="work-title">
            <BaseContainer class="grid gap-grid lg:grid-cols-2">
                <BaseCard as="section" aria-labelledby="implemented-title" class="h-full">
                    <SectionHeading
                        id="implemented-title"
                        as="h2"
                        eyebrow="Implemented"
                        title="Confirmed work"
                        description="Work verified as done in this build or repository."
                    />

                    <ul v-if="project.implemented.length" class="mt-5 flex flex-col gap-4">
                        <li v-for="item in project.implemented" :key="item.title">
                            <h3 class="text-small font-semibold text-heading">{{ item.title }}</h3>
                            <p class="mt-1 text-small text-body">{{ item.detail }}</p>
                        </li>
                    </ul>

                    <p v-else class="mt-4 text-small text-body">
                        No implementation has been confirmed for this initiative yet. Its status remains
                        <strong class="font-semibold">{{ status.label.toLowerCase() }}</strong>.
                    </p>
                </BaseCard>

                <BaseCard as="section" aria-labelledby="planned-title" class="h-full">
                    <SectionHeading
                        id="planned-title"
                        as="h2"
                        eyebrow="Planned scope"
                        title="Intended direction"
                        description="Possible or intended areas of work — not claimed as implemented."
                    />

                    <ul v-if="project.plannedScope.length" class="mt-5 flex flex-col gap-4">
                        <li v-for="item in project.plannedScope" :key="item.title">
                            <h3 class="text-small font-semibold text-heading">{{ item.title }}</h3>
                            <p class="mt-1 text-small text-body">{{ item.detail }}</p>
                        </li>
                    </ul>

                    <p v-else class="mt-4 text-small text-body">
                        No additional planned scope is listed at this time.
                    </p>
                </BaseCard>
            </BaseContainer>
        </section>

        <!-- Limitations and actions -->
        <section class="section bg-surface" aria-labelledby="limitations-title">
            <BaseContainer class="grid gap-grid lg:grid-cols-12 lg:items-start">
                <BaseCard as="section" class="lg:col-span-7" aria-labelledby="limitations-title">
                    <SectionHeading
                        id="limitations-title"
                        as="h2"
                        eyebrow="Limitations"
                        title="Current limitations and notes"
                    />

                    <ul class="mt-5 flex flex-col gap-3">
                        <li v-for="note in project.limitations" :key="note" class="flex gap-2 text-small text-body">
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>{{ note }}</span>
                        </li>
                    </ul>
                </BaseCard>

                <BaseCard as="aside" class="lg:col-span-5" aria-labelledby="next-title">
                    <SectionHeading
                        id="next-title"
                        as="h2"
                        title="Discuss this initiative"
                        description="If you have a question about this initiative or related work, you can get in touch by email."
                    />

                    <div class="mt-6 flex flex-wrap gap-3">
                        <CtaLink to="/contact" variant="primary">Contact</CtaLink>
                        <CtaLink to="/projects" variant="secondary">Back to projects</CtaLink>
                    </div>
                </BaseCard>
            </BaseContainer>
        </section>
    </article>
</template>
