<template>
    <div>
        <h1 class="text-h2">Skills</h1>
        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr><th class="p-3 text-left">Name</th><th class="p-3 text-left">Category</th><th class="p-3 text-left">Proficiency</th><th class="p-3 text-left">Enabled</th><th class="p-3 text-left">Actions</th></tr>
                </thead>
                <tbody>
                    <tr v-for="s in items" :key="s.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-medium">{{ s.name }}</td>
                        <td class="p-3">{{ s.category }}</td>
                        <td class="p-3">{{ s.proficiency_label ?? '' }}</td>
                        <td class="p-3">{{ s.enabled ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <button class="text-brand hover:underline" @click="edit(s)">Edit</button>
                                <button class="text-muted hover:text-heading" @click="toggle(s)">{{ s.enabled ? 'Disable' : 'Enable' }}</button>
                                <button class="text-red-600 hover:underline" @click="remove(s)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="items.length === 0"><td colspan="5" class="p-6 text-center text-muted">No skills.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">{{ editing ? 'Edit skill' : 'New skill' }}</h2>
            <form class="mt-4 grid gap-3 sm:grid-cols-3" @submit.prevent="save">
                <input v-model="form.name" placeholder="Name *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.category" placeholder="Category *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.proficiency_label" placeholder="Proficiency label" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.icon" placeholder="Icon" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model.number="form.sort_order" type="number" min="0" placeholder="Sort order" class="rounded-field border border-line px-3 py-2 text-small" />
                <label class="text-small"><input v-model="form.enabled" type="checkbox" /> Enabled</label>
                <div class="sm:col-span-3 flex gap-3">
                    <button type="submit" :disabled="saving" class="rounded-field bg-brand px-4 py-2 text-small text-white">{{ saving ? 'Saving...' : 'Save' }}</button>
                    <button type="button" class="rounded-field border border-line px-4 py-2 text-small" @click="reset">Cancel</button>
                </div>
                <p v-if="error" class="sm:col-span-3 text-small text-red-600">{{ error }}</p>
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
const form = ref<any>({ name: '', category: '', proficiency_label: '', icon: '', sort_order: 0, enabled: true });

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/skills', { params: { per_page: 50 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}
function edit(s: any): void { editing.value = s.id; form.value = { ...s }; }
function reset(): void { editing.value = null; form.value = { name: '', category: '', proficiency_label: '', icon: '', sort_order: 0, enabled: true }; }
async function save(): Promise<void> {
    saving.value = true; error.value = '';
    try {
        if (editing.value) await http.put(`/admin/skills/${editing.value}`, form.value);
        else await http.post('/admin/skills', form.value);
        reset(); await load();
    } catch (e: any) { error.value = e?.response?.data?.message ?? 'Save failed.'; }
    finally { saving.value = false; }
}
async function toggle(s: any): Promise<void> { await http.post(`/admin/skills/${s.id}/toggle-enabled`); await load(); }
async function remove(s: any): Promise<void> {
    if (!confirm(`Delete skill "${s.name}"?`)) return;
    await http.delete(`/admin/skills/${s.id}`); await load();
}
onMounted(load);
</script>