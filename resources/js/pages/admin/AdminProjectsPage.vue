<template>
    <div>
        <div class="flex items-center justify-between">
            <h1 class="text-h2">Projects</h1>
            <router-link to="/admin/projects/new" class="rounded-field bg-brand px-4 py-2 text-small text-white">New project</router-link>
        </div>

        <div class="mt-4 flex flex-wrap gap-3">
            <input v-model="search" @input="debouncedLoad" placeholder="Search..." class="rounded-field border border-line px-3 py-2 text-small" />
            <select v-model="statusFilter" @change="load" class="rounded-field border border-line px-3 py-2 text-small">
                <option value="">All statuses</option>
                <option value="completed">Completed</option>
                <option value="in-progress">In progress</option>
                <option value="prototype">Prototype</option>
                <option value="planned">Planned</option>
            </select>
        </div>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Published</th>
                        <th class="p-3 text-left">Featured</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in items" :key="p.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-medium">{{ p.title }}</td>
                        <td class="p-3">{{ p.status }}</td>
                        <td class="p-3">{{ p.published_at ? 'Yes' : 'Draft' }}</td>
                        <td class="p-3">{{ p.featured ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <router-link :to="`/admin/projects/${p.id}/edit`" class="text-brand hover:underline">Edit</router-link>
                                <button class="text-muted hover:text-heading" @click="togglePublish(p)">{{ p.published_at ? 'Unpublish' : 'Publish' }}</button>
                                <button class="text-red-600 hover:underline" @click="remove(p)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="items.length === 0">
                        <td colspan="5" class="p-6 text-center text-muted">No projects found.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between text-small">
            <span class="text-muted">Page {{ page }} of {{ lastPage }}</span>
            <div class="flex gap-2">
                <button :disabled="page <= 1" class="rounded-field border border-line px-3 py-1 disabled:opacity-50" @click="page--; load()">Prev</button>
                <button :disabled="page >= lastPage" class="rounded-field border border-line px-3 py-1 disabled:opacity-50" @click="page++; load()">Next</button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import http from '@/services/http';

const items = ref<any[]>([]);
const loading = ref(true);
const search = ref('');
const statusFilter = ref('');
const page = ref(1);
const lastPage = ref(1);

let searchTimer: number | undefined;

function debouncedLoad(): void {
    if (searchTimer) window.clearTimeout(searchTimer);
    searchTimer = window.setTimeout(() => { page.value = 1; load(); }, 300);
}

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/projects', {
            params: { search: search.value || undefined, status: statusFilter.value || undefined, page: page.value, per_page: 15 },
        });
        items.value = res.data.data;
        lastPage.value = res.data.last_page ?? 1;
    } finally {
        loading.value = false;
    }
}

async function togglePublish(p: any): Promise<void> {
    if (p.published_at) {
        await http.post(`/admin/projects/${p.id}/unpublish`);
    } else {
        await http.post(`/admin/projects/${p.id}/publish`);
    }
    await load();
}

async function remove(p: any): Promise<void> {
    if (!confirm(`Delete "${p.title}"?`)) return;
    await http.delete(`/admin/projects/${p.id}`);
    await load();
}

onMounted(load);
</script>