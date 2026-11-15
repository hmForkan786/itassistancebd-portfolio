<template>
    <div>
        <h1 class="text-h2">Testimonials</h1>
        <p class="mt-1 text-small text-muted">Manage client reviews. Only approved + published + verified appear publicly.</p>

        <div class="mt-4 flex gap-3">
            <input v-model="search" @input="debouncedLoad" placeholder="Search..." class="rounded-field border border-line px-3 py-2 text-small" />
        </div>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr>
                        <th class="p-3 text-left">Client</th>
                        <th class="p-3 text-left">Rating</th>
                        <th class="p-3 text-left">Approved</th>
                        <th class="p-3 text-left">Published</th>
                        <th class="p-3 text-left">Verified</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="t in items" :key="t.id" class="border-b border-line last:border-0">
                        <td class="p-3">
                            <div class="font-medium">{{ t.client_name }}</div>
                            <div class="text-caption text-muted">{{ t.company_name }}</div>
                        </td>
                        <td class="p-3">{{ t.rating }} / 5</td>
                        <td class="p-3">{{ t.approved ? 'Yes' : 'No' }}</td>
                        <td class="p-3">{{ t.published ? 'Yes' : 'No' }}</td>
                        <td class="p-3">{{ t.verified ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <div class="flex flex-wrap gap-2">
                                <button class="text-brand hover:underline" @click="edit(t)">Edit</button>
                                <button class="text-muted hover:text-heading" @click="doAction(t, 'approve')">Approve</button>
                                <button class="text-muted hover:text-heading" @click="doAction(t, 'reject')">Reject</button>
                                <button class="text-muted hover:text-heading" @click="doAction(t, t.published ? 'unpublish' : 'publish')">{{ t.published ? 'Unpublish' : 'Publish' }}</button>
                                <button class="text-red-600 hover:underline" @click="remove(t)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="items.length === 0">
                        <td colspan="6" class="p-6 text-center text-muted">No testimonials.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Simple inline create form -->
        <div class="mt-8 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">{{ editing ? 'Edit testimonial' : 'New testimonial' }}</h2>
            <form class="mt-4 grid gap-3 sm:grid-cols-2" @submit.prevent="save">
                <input v-model="form.client_name" placeholder="Client name *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.client_role" placeholder="Role" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.company_name" placeholder="Company" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model.number="form.rating" type="number" min="1" max="5" placeholder="Rating 1-5 *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <textarea v-model="form.review_text" placeholder="Review text *" required rows="3" class="sm:col-span-2 rounded-field border border-line px-3 py-2 text-small" />
                <div class="flex items-center gap-4 text-small">
                    <label><input v-model="form.verified" type="checkbox" /> Verified</label>
                    <label><input v-model="form.approved" type="checkbox" /> Approved</label>
                    <label><input v-model="form.published" type="checkbox" /> Published</label>
                    <label><input v-model="form.featured" type="checkbox" /> Featured</label>
                </div>
                <div class="sm:col-span-2 flex gap-3">
                    <button type="submit" :disabled="saving" class="rounded-field bg-brand px-4 py-2 text-small text-white">
                        {{ saving ? 'Saving...' : 'Save' }}
                    </button>
                    <button type="button" class="rounded-field border border-line px-4 py-2 text-small" @click="reset">Cancel</button>
                </div>
                <p v-if="error" class="sm:col-span-2 text-small text-red-600">{{ error }}</p>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import http from '@/services/http';

const items = ref<any[]>([]);
const loading = ref(true);
const saving = ref(false);
const error = ref('');
const search = ref('');
const editing = ref<number | null>(null);

const form = ref<any>({ client_name: '', client_role: '', company_name: '', review_text: '', rating: 5, verified: false, approved: false, published: false, featured: false });

let searchTimer: number | undefined;
function debouncedLoad(): void {
    if (searchTimer) window.clearTimeout(searchTimer);
    searchTimer = window.setTimeout(() => load(), 300);
}

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/testimonials', { params: { search: search.value || undefined, per_page: 50 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}

function edit(t: any): void {
    editing.value = t.id;
    form.value = { ...t };
}

function reset(): void {
    editing.value = null;
    form.value = { client_name: '', client_role: '', company_name: '', review_text: '', rating: 5, verified: false, approved: false, published: false, featured: false };
}

async function save(): Promise<void> {
    saving.value = true;
    error.value = '';
    try {
        if (editing.value) {
            await http.put(`/admin/testimonials/${editing.value}`, form.value);
        } else {
            await http.post('/admin/testimonials', form.value);
        }
        reset();
        await load();
    } catch (e: any) {
        error.value = e?.response?.data?.message ?? 'Save failed.';
    } finally {
        saving.value = false;
    }
}

async function doAction(t: any, action: string): Promise<void> {
    await http.post(`/admin/testimonials/${t.id}/${action}`);
    await load();
}

async function remove(t: any): Promise<void> {
    if (!confirm(`Delete testimonial from ${t.client_name}?`)) return;
    await http.delete(`/admin/testimonials/${t.id}`);
    await load();
}

onMounted(load);
</script>