<script setup lang="ts">
/**
 * ProjectDetailPage — resolves a project slug and renders its detail view.
 *
 * Uses the shared, factual project data. Unknown slugs render an in-page
 * not-found state (so direct URLs load without a broken route) with a way back
 * to the projects list.
 */
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import ProjectDetail from '@/components/portfolio/ProjectDetail.vue';
import { getProjectBySlug } from '@/data/projects';

const route = useRoute();

const slug = computed<string>(() => {
    const param = route.params.slug;
    return typeof param === 'string' ? param : '';
});

const project = computed(() => getProjectBySlug(slug.value));
</script>

<template>
    <ProjectDetail v-if="project" :project="project" />

    <section v-else class="section" aria-labelledby="project-not-found-title">
        <BaseContainer>
            <BaseCard class="stack-lg">
                <SectionHeading
                    id="project-not-found-title"
                    as="h1"
                    eyebrow="Projects"
                    title="Project not found"
                    description="There is no project page for this address. It may be mistyped, or the project may not be listed here."
                />

                <div class="flex flex-wrap gap-3">
                    <CtaLink to="/projects" variant="primary">Back to projects</CtaLink>
                    <CtaLink to="/contact" variant="secondary">Contact</CtaLink>
                </div>
            </BaseCard>
        </BaseContainer>
    </section>
</template>
