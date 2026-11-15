<template>
    <div>
        <h1 class="text-h2">Analytics</h1>
        <p class="mt-1 text-small text-muted">First-party, privacy-conscious events. Empty state when no data.</p>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div v-for="c in cards" :key="c.label" class="rounded-card border border-line bg-white p-4">
                    <div class="text-caption text-muted">{{ c.label }}</div>
                    <div class="mt-1 text-h3">{{ c.value }}</div>
                </div>
            </div>

            <section class="mt-8 rounded-card border border-line bg-white p-4">
                <h2 class="text-h4">Top projects</h2>
                <ul class="mt-3 divide-y divide-line">
                    <li v-for="p in analytics?.top_projects" :key="p.project_id" class="flex justify-between py-2 text-small">
                        <span>{{ p.title || 'Unknown' }}</span>
                        <span class="text-muted">{{ p.views }} views</span>
                    </li>
                    <li v-if="!analytics?.top_projects?.length" class="py-2 text-small text-muted">No project views recorded yet.</li>
                </ul>
            </section>

            <section class="mt-6 rounded-card border border-line bg-white p-4">
                <h2 class="text-h4">Top pages</h2>
                <ul class="mt-3 divide-y divide-line">
                    <li v-for="p in analytics?.top_pages" :key="p.page_path" class="flex justify-between py-2 text-small">
                        <span>{{ p.page_path }}</span>
                        <span class="text-muted">{{ p.views }} views</span>
                    </li>
                    <li v-if="!analytics?.top_pages?.length" class="py-2 text-small text-muted">No page views recorded yet.</li>
                </ul>
            </section>

            <section class="mt-6 rounded-card border border-line bg-white p-4">
                <h2 class="text-h4">Traffic sources</h2>
                <ul class="mt-3 divide-y divide-line">
                    <li v-for="r in analytics?.referrer_domains" :key="r.referrer_domain" class="flex justify-between py-2 text-small">
                        <span>{{ r.referrer_domain }}</span>
                        <span class="text-muted">{{ r.count }}</span>
                    </li>
                    <li v-if="!analytics?.referrer_domains?.length" class="py-2 text-small text-muted">No referrer data yet.</li>
                </ul>
            </section>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import http from '@/services/http';

const analytics = ref<any>(null);
const loading = ref(true);
const cards = ref<{ label: string; value: number }[]>([]);

onMounted(async () => {
    try {
        const res = await http.get('/admin/analytics');
        analytics.value = res.data;
        const t = res.data.totals;
        cards.value = [
            { label: 'Page views', value: t.page_views },
            { label: 'Project views', value: t.project_views },
            { label: 'Contact submissions', value: t.contact_submissions },
            { label: 'CTA clicks', value: t.cta_clicks },
        ];
    } finally {
        loading.value = false;
    }
});
</script>