<template>
    <div>
        <h1 class="text-h2">Services</h1>
        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr><th class="p-3 text-left">Title</th><th class="p-3 text-left">Enabled</th><th class="p-3 text-left">Featured</th><th class="p-3 text-left">Actions</th></tr>
                </thead>
                <tbody>
                    <tr v-for="s in items" :key="s.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-medium">{{ s.title }}</td>
                        <td class="p-3">{{ s.enabled ? 'Yes' : 'No' }}</td>
                        <td class="p-3">{{ s.featured ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <button class="text-brand hover:underline" @click="edit(s)">Edit</button>
                                <button class="text-muted hover:text-heading" @click="toggle(s)">{{ s.enabled ? 'Disable' : 'Enable' }}</button>
                                <button class="text-red-600 hover:underline" @click="remove(s)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="items.length === 0"><td colspan="4" class="p-6 text-center text-muted">No services.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">{{ editing ? 'Edit service' : 'New service' }}</h2>
            <form class="mt-4 grid gap-3 sm:grid-cols-2" @submit.prevent="save">
                <input v-model="form.title" placeholder="Title *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.slug" placeholder="Slug" class="rounded-field border border-line px-3 py-2 text-small" />
                <textarea v-model="form.description" placeholder="Description" rows="3" class="sm:col-span-2 rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.icon" placeholder="Icon" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model.number="form.sort_order" type="number" min="0" placeholder="Sort order" class="rounded-field border border-line px-3 py-2 text-small" />
                <label class="text-small"><input v-model="form.featured" type="checkbox" /> Featured</label>
                <label class="text-small"><input v-model="form.enabled" type="checkbox" /> Enabled</label>
                <div class="sm:col-span-2 flex gap-3">
                    <button type="submit" :disabled="saving" class="rounded-field bg-brand px-4 py-2 text-small text-white">{{ saving ? 'Saving...' : 'Save' }}</button>
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
const editing = ref<number | null>(null);
const form = ref<any>({ title: '', slug: '', description: '', icon: '', featured: false, enabled: true, sort_order: 0 });

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/services', { params: { per_page: 50 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}
function edit(s: any): void { editing.value = s.id; form.value = { ...s }; }
function reset(): void { editing.value = null; form.value = { title: '', slug: '', description: '', icon: '', featured: false, enabled: true, sort_order: 0 }; }
async function save(): Promise<void> {
    saving.value = true; error.value = '';
    try {
        if (editing.value) await http.put(`/admin/services/${editing.value}`, form.value);
        else await http.post('/admin/services', form.value);
        reset(); await load();
    } catch (e: any) { error.value = e?.response?.data?.message ?? 'Save failed.'; }
    finally { saving.value = false; }
}
async function toggle(s: any): Promise<void> { await http.post(`/admin/services/${s.id}/toggle-enabled`); await load(); }
async function remove(s: any): Promise<void> {
    if (!confirm(`Delete service "${s.title}"?`)) return;
    await http.delete(`/admin/services/${s.id}`); await load();
}
onMounted(load);
</script>