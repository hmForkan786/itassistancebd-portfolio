<script setup lang="ts">
/**
 * WorkProcess — factual, high-level engagement steps.
 *
 * Describes how work typically runs. No pricing, timelines, guarantees, or
 * fabricated process claims. Steps are generic and professional.
 */
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';

const steps = [
    {
        title: 'Discovery',
        detail: 'Understand the goal, constraints, users, and the workflow the solution must support.',
    },
    {
        title: 'Planning',
        detail: 'Define scope, data model, and a clear sequence of deliverables before writing code.',
    },
    {
        title: 'Build',
        detail: 'Implement in small, reviewable increments with maintainable, typed, accessible code.',
    },
    {
        title: 'Review',
        detail: 'Test, refine, and verify against requirements; fix only verified defects.',
    },
    {
        title: 'Launch',
        detail: 'Deploy with a checklist, keep a rollback path, and document the release.',
    },
    {
        title: 'Support',
        detail: 'Iterate based on real usage and feedback; scope further work per approval.',
    },
];
</script>

<template>
    <section id="process" class="section bg-surface" aria-labelledby="process-title">
        <BaseContainer class="stack-lg">
            <SectionHeading
                id="process-title"
                as="h2"
                eyebrow="Process"
                title="How I work"
                description="A straightforward, structured approach to delivering web applications and supporting work."
                align="center"
            />

            <div class="grid gap-grid sm:grid-cols-2 lg:grid-cols-3">
                <BaseCard v-for="(step, index) in steps" :key="step.title" as="article" class="h-full">
                    <p class="text-tiny font-semibold tracking-widest uppercase text-primary-dark">
                        Step {{ index + 1 }}
                    </p>
                    <h3 class="mt-2 text-h4">{{ step.title }}</h3>
                    <p class="mt-2 text-small text-body">{{ step.detail }}</p>
                </BaseCard>
            </div>
        </BaseContainer>
    </section>
</template>