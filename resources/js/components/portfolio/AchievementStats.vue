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
                    v-for="metric in metrics"
                    :key="metric.id ?? metric.metric_key"
                    as="article"
                    class="text-center"
                >
                    <p class="text-display font-bold text-primary-dark">
                        {{ metric.metric_value }}{{ metric.metric_unit ?? '' }}
                    </p>
                    <p class="mt-2 text-small font-semibold text-heading">{{ metric.metric_label }}</p>
                </BaseCard>
            </div>
        </BaseContainer>
    </section>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import http from '@/services/http';

interface ApiMetric {
    id: number;
    metric_key: string;
    metric_label: string;
    metric_value: number | string | null;
    metric_unit: string | null;
    enabled: boolean;
    verified: boolean;
}

const metrics = ref<ApiMetric[]>([]);

onMounted(async () => {
    try {
        const res = await http.get('/public/metrics');
        metrics.value = res.data ?? [];
    } catch {
        metrics.value = [];
    }
});

const showSection = computed<boolean>(() => metrics.value.length > 0);
</script>