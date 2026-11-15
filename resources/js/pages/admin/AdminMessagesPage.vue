<template>
    <div>
        <h1 class="text-h2">Contact messages</h1>
        <div class="mt-4 flex gap-3">
            <input v-model="search" @input="debouncedLoad" placeholder="Search..." class="rounded-field border border-line px-3 py-2 text-small" />
            <select v-model="statusFilter" @change="load" class="rounded-field border border-line px-3 py-2 text-small">
                <option value="">All</option>
                <option value="unread">Unread</option>
                <option value="read">Read</option>
                <option value="replied">Replied</option>
                <option value="archived">Archived</option>
            </select>
        </div>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr><th class="p-3 text-left">Name</th><th class="p-3 text-left">Email</th><th class="p-3 text-left">Subject</th><th class="p-3 text-left">Status</th><th class="p-3 text-left">Submitted</th><th class="p-3 text-left">Actions</th></tr>
                </thead>
                <tbody>
                    <tr v-for="m in items" :key="m.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-medium">{{ m.name }}</td>
                        <td class="p-3">{{ m.email }}</td>
                        <td class="p-3">{{ m.subject || '—' }}</td>
                        <td class="p-3">{{ m.status }}</td>
                        <td class="p-3">{{ m.submitted_at || m.created_at }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <button class="text-brand hover:underline" @click="view(m)">View</button>
                                <button class="text-muted hover:text-heading" @click="act(m, 'read')">Read</button>
                                <button class="text-muted hover:text-heading" @click="act(m, 'replied')">Replied</button>
                                <button class="text-muted hover:text-heading" @click="act(m, 'archive')">Archive</button>
                                <button class="text-red-600 hover:underline" @click="remove(m)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="items.length === 0"><td colspan="6" class="p-6 text-center text-muted">No messages.</td></tr>
                </tbody>
            </table>
        </div>

        <div v-if="selected" class="mt-6 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">Message from {{ selected.name }}</h2>
            <p class="mt-1 text-caption text-muted">{{ selected.email }} · {{ selected.phone || 'no phone' }}</p>
            <p class="mt-3 whitespace-pre-wrap text-small">{{ selected.message }}</p>
            <div class="mt-3">
                <label class="text-small font-medium">Admin notes</label>
                <textarea v-model="notes" rows="3" class="mt-1 w-full rounded-field border border-line px-3 py-2 text-small" />
                <button class="mt-2 rounded-field bg-brand px-4 py-2 text-small text-white" @click="saveNotes">Save notes</button>
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
const selected = ref<any>(null);
const notes = ref('');

let searchTimer: number | undefined;
function debouncedLoad(): void {
    if (searchTimer) window.clearTimeout(searchTimer);
    searchTimer = window.setTimeout(() => load(), 300);
}

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/messages', { params: { search: search.value || undefined, status: statusFilter.value || undefined, per_page: 50 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}

async function view(m: any): Promise<void> {
    const res = await http.get(`/admin/messages/${m.id}`);
    selected.value = res.data;
    notes.value = res.data.admin_notes ?? '';
}

async function act(m: any, action: string): Promise<void> {
    await http.post(`/admin/messages/${m.id}/${action === 'archive' ? 'archive' : action === 'read' ? 'read' : 'replied'}`);
    await load();
}

async function saveNotes(): Promise<void> {
    if (!selected.value) return;
    await http.patch(`/admin/messages/${selected.value.id}/notes`, { admin_notes: notes.value });
    await view(selected.value);
}

async function remove(m: any): Promise<void> {
    if (!confirm(`Delete message from ${m.name}?`)) return;
    await http.delete(`/admin/messages/${m.id}`);
    if (selected.value?.id === m.id) selected.value = null;
    await load();
}

onMounted(load);
</script>