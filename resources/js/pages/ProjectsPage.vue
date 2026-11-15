<script setup lang="ts">
/**
 * ProjectsPage — portfolio initiatives and their current status.
 *
 * Reuses `ProjectCard` and the canonical `projects` data. Every entry is an
 * initiative with an explicit, honest status badge — not an assumed completed
 * commercial product. No demo URLs, repositories, screenshots or client details
 * are invented.
 */
import { BaseBadge, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import ProjectCard from '@/components/portfolio/ProjectCard.vue';
import { projects } from '@/data/projects';

/** Legend labels — always shown as text alongside badge colour. */
const projectStatuses: readonly string[] = ['Completed', 'In Progress', 'Prototype', 'Planned'];
</script>

<template>
    <div>
        <!-- Page intro -->
        <section class="section bg-surface border-b border-line" aria-labelledby="projects-page-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="projects-page-title"
                    as="h1"
                    eyebrow="Projects"
                    title="Initiatives in focus"
                    description="Selected initiatives and what each one is about. Every card states its current stage — these are not automatically completed commercial products, and no public demo, repository, screenshot or client information is claimed."
                    class="max-w-3xl"
                />

                <div class="flex flex-wrap items-center gap-3">
                    <p class="text-small font-medium text-heading">Status labels:</p>
                    <ul class="flex flex-wrap gap-2" aria-label="Project status legend">
                        <li v-for="label in projectStatuses" :key="label">
                            <BaseBadge variant="neutral" size="sm">{{ label }}</BaseBadge>
                        </li>
                    </ul>
                </div>
            </BaseContainer>
        </section>

        <!-- Project initiatives -->
        <section class="section" aria-labelledby="project-list-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="project-list-title"
                    as="h2"
                    title="Project initiatives"
                    description="Each entry includes a short summary, its focus area and its current, honestly stated status."
                />

                <ul class="grid gap-grid sm:grid-cols-2 lg:grid-cols-3" aria-label="Project initiatives">
                    <ProjectCard
                        v-for="project in projects"
                        :key="project.name"
                        :project="project"
                        as="li"
                    />
                </ul>

                <p class="text-small text-muted max-w-2xl">
                    Statuses are kept conservative and updated only when confirmed. If you would like to discuss any of
                    these initiatives, you can reach me by email.
                </p>

                <div>
                    <CtaLink to="/contact" variant="primary">Contact</CtaLink>
                </div>
            </BaseContainer>
        </section>
    </div>
</template>
