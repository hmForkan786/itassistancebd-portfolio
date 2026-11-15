<template>
    <div>
        <h1 class="text-h2">Dashboard</h1>
        <p class="mt-1 text-small text-muted">Live statistics from database records.</p>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div v-for="card in cards" :key="card.label" class="rounded-card border border-line bg-white p-4">
                <div class="text-caption text-muted">{{ card.label }}</div>
                <div class="mt-1 text-h3">{{ card.value ?? '—' }}</div>
            </div>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <section class="rounded-card border border-line bg-white p-4">
                <h2 class="text-h4">Recent projects</h2>
                <ul class="mt-3 divide-y divide-line">
                    <li v-for="p in dashboard?.recent.projects" :key="p.id" class="py-2 text-small">
                        <span class="font-medium">{{ p.title }}</span>
                        <span class="ml-2 text-muted">{{ p.status }}</span>
                    </li>
                    <li v-if="!dashboard?.recent.projects?.length" class="py-2 text-small text-muted">No projects yet.</li>
                </ul>
            </section>
            <section class="rounded-card border border-line bg-white p-4">
                <h2 class="text-h4">Recent messages</h2>
                <ul class="mt-3 divide-y divide-line">
                    <li v-for="m in dashboard?.recent.messages" :key="m.id" class="py-2 text-small">
                        <span class="font-medium">{{ m.name }}</span>
                        <span class="ml-2 text-muted">{{ m.subject || 'No subject' }}</span>
                    </li>
                    <li v-if="!dashboard?.recent.messages?.length" class="py-2 text-small text-muted">No messages yet.</li>
                </ul>
            </section>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import http from '@/services/http';

interface DashboardData {
    stats: Record<string, any>;
    recent: { projects: any[]; testimonials: any[]; messages: any[] };
}

const dashboard = ref<DashboardData | null>(null);
const loading = ref(true);

const cards = ref<{ label: string; value: any }[]>([]);

function buildCards(s: Record<string, any>): void {
    cards.value = [
        { label: 'Total projects', value: s.projects },
        { label: 'Published projects', value: s.published_projects },
        { label: 'Draft projects', value: s.draft_projects },
        { label: 'Completed projects', value: s.completed_projects },
        { label: 'Total testimonials', value: s.testimonials },
        { label: 'Approved testimonials', value: s.approved_testimonials },
        { label: 'Average rating', value: s.average_rating },
        { label: 'Happy clients (metric)', value: s.happy_clients },
        { label: 'Success rate (metric)', value: s.success_rate },
        { label: 'Contact messages', value: s.contact_messages },
        { label: 'Unread messages', value: s.unread_messages },
    ];
}

onMounted(async () => {
    try {
        const res = await http.get('/admin/dashboard');
        dashboard.value = res.data;
        buildCards(res.data.stats);
    } catch {
        // ignore
    } finally {
        loading.value = false;
    }
});
</script>