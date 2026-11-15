<script setup lang="ts">
/**
 * AboutPage — professional background and working approach.
 *
 * Content is factual and sourced from `resources/js/data/`: no invented
 * employment history, credentials, achievements, testimonials or metrics.
 * Reuses the same skill groups and about/focus points shown on the homepage.
 */
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import SkillItem from '@/components/portfolio/SkillItem.vue';
import { aboutPoints, focusAreas, site } from '@/data/site';
import { skillGroups } from '@/data/skills';
</script>

<template>
    <div>
        <!-- Page intro -->
        <section class="section bg-surface border-b border-line" aria-labelledby="about-page-title">
            <BaseContainer class="stack-lg">
                <p class="text-small font-semibold tracking-widest uppercase text-primary-dark">
                    {{ site.name }}
                </p>

                <SectionHeading
                    id="about-page-title"
                    as="h1"
                    title="About"
                    description="I work on web applications and the supporting design and marketing around them, with an emphasis on clear requirements, maintainable code and straightforward communication."
                    class="max-w-3xl"
                />

                <p class="text-body max-w-2xl text-muted">{{ site.availability }}</p>
            </BaseContainer>
        </section>

        <!-- Background and approach -->
        <section class="section" aria-labelledby="background-title">
            <BaseContainer class="grid gap-grid lg:grid-cols-12 lg:items-start">
                <div class="lg:col-span-5">
                    <SectionHeading
                        id="background-title"
                        as="h2"
                        eyebrow="Background"
                        title="Development, problem solving and management"
                        description="Hands-on application work combined with experience outside the editor — planning, coordination and running day-to-day operations."
                    />
                </div>

                <ul class="grid gap-grid sm:grid-cols-2 lg:col-span-7">
                    <BaseCard
                        v-for="point in aboutPoints"
                        :key="point.title"
                        as="li"
                        class="h-full"
                    >
                        <h3 class="text-h4">{{ point.title }}</h3>
                        <p class="mt-2 text-small text-body">{{ point.detail }}</p>
                    </BaseCard>
                </ul>
            </BaseContainer>
        </section>

        <!-- Areas of work -->
        <section class="section bg-surface" aria-labelledby="focus-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="focus-title"
                    as="h2"
                    eyebrow="Approach"
                    title="Where I focus my work"
                    description="The kinds of problems I take on most often, from application backends and interfaces to content platforms and supporting creative work."
                />

                <ul class="grid gap-grid sm:grid-cols-2">
                    <BaseCard v-for="area in focusAreas" :key="area.title" as="li" class="h-full">
                        <h3 class="text-h4">{{ area.title }}</h3>
                        <p class="mt-2 text-small text-body">{{ area.detail }}</p>
                    </BaseCard>
                </ul>
            </BaseContainer>
        </section>

        <!-- Relevant skills -->
        <section class="section" aria-labelledby="skills-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="skills-title"
                    as="h2"
                    eyebrow="Skills"
                    title="Tools I work with"
                    description="A straightforward list of the technologies and platforms used in my work, grouped by area."
                />

                <div class="grid gap-grid lg:grid-cols-3">
                    <BaseCard
                        v-for="group in skillGroups"
                        :key="group.title"
                        as="section"
                        :aria-labelledby="`about-skills-${group.title}`"
                    >
                        <h3 :id="`about-skills-${group.title}`" class="text-h4">{{ group.title }}</h3>
                        <p class="mt-2 text-small text-body">{{ group.description }}</p>

                        <ul class="mt-4 flex flex-wrap gap-2" :aria-label="group.title">
                            <SkillItem v-for="item in group.items" :key="item" :label="item" />
                        </ul>
                    </BaseCard>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <CtaLink to="/contact" variant="primary">Get in touch</CtaLink>
                    <CtaLink to="/projects" variant="secondary">View projects</CtaLink>
                </div>
            </BaseContainer>
        </section>
    </div>
</template>
