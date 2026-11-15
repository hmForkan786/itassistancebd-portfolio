<script setup lang="ts">
/**
 * AchievementStats — verified statistics only.
 *
 * Renders nothing when there are no verified metrics, so unverified numbers are
 * never displayed. The "technologies used" metric is derived from the verified
 * skills data and is always shown when skills exist.
 */
import { computed } from 'vue';
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import { statMetrics, technologiesUsedCount } from '@/data/stats';

const hasMetrics = computed<boolean>(() => statMetrics.length > 0);
const hasTechCount = computed<boolean>(() => technologiesUsedCount > 0);
const showSection = computed<boolean>(() => hasMetrics.value || hasTechCount.value);
</script>

<template>
    <section v-if="showSection" id="achievements" class="section bg-surface" aria-labelledby="achievements-title">
        <BaseContainer class="stack-lg">
            <SectionHeading
                id="achievements-title"
                as="h2"
                eyebrow="Track record"
                title="Verified numbers"
                description="Only figures that can be verified are shown here. No estimates, ratings or client counts are invented."
                align="center"
            />

            <div class="grid gap-grid sm:grid-cols-2 lg:grid-cols-4">
                <BaseCard
                    v-for="metric in statMetrics"
                    :key="metric.label"
                    as="article"
                    class="text-center"
                >
                    <p class="text-display font-bold text-primary-dark">
                        {{ metric.value }}{{ metric.suffix ?? '' }}
                    </p>
                    <p class="mt-2 text-small font-semibold text-heading">{{ metric.label }}</p>
                    <p v-if="metric.note" class="mt-1 text-tiny text-muted">{{ metric.note }}</p>
                </BaseCard>

                <BaseCard v-if="hasTechCount" as="article" class="text-center">
                    <p class="text-display font-bold text-primary-dark">{{ technologiesUsedCount }}</p>
                    <p class="mt-2 text-small font-semibold text-heading">Technologies used</p>
                    <p class="mt-1 text-tiny text-muted">Verified tools across the stack</p>
                </BaseCard>
            </div>
        </BaseContainer>
    </section>
</template>