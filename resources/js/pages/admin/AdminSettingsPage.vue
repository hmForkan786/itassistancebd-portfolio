<template>
    <div>
        <h1 class="text-h2">Site settings</h1>
        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr><th class="p-3 text-left">Key</th><th class="p-3 text-left">Value</th><th class="p-3 text-left">Type</th><th class="p-3 text-left">Public</th><th class="p-3 text-left">Actions</th></tr>
                </thead>
                <tbody>
                    <tr v-for="s in items" :key="s.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-mono text-caption">{{ s.key }}</td>
                        <td class="p-3 max-w-xs truncate">{{ s.value }}</td>
                        <td class="p-3">{{ s.type }}</td>
                        <td class="p-3">{{ s.is_public ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <button class="text-brand hover:underline" @click="edit(s)">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">{{ editing ? 'Edit setting' : 'New setting' }}</h2>
            <form class="mt-4 grid gap-3 sm:grid-cols-2" @submit.prevent="save">
                <input v-if="!editing" v-model="form.key" placeholder="key *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <select v-model="form.type" class="rounded-field border border-line px-3 py-2 text-small">
                    <option value="string">string</option>
                    <option value="text">text</option>
                    <option value="boolean">boolean</option>
                    <option value="number">number</option>
                    <option value="json">json</option>
                </select>
                <label class="text-small"><input v-model="form.is_public" type="checkbox" /> Public</label>
                <textarea v-model="form.value" rows="3" placeholder="Value" class="sm:col-span-2 rounded-field border border-line px-3 py-2 text-small" />
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
const form = ref<any>({ key: '', value: '', type: 'string', is_public: true });

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/settings', { params: { per_page: 100 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}
function edit(s: any): void { editing.value = s.id; form.value = { ...s }; }
function reset(): void { editing.value = null; form.value = { key: '', value: '', type: 'string', is_public: true }; }
async function save(): Promise<void> {
    saving.value = true; error.value = '';
    try {
        if (editing.value) await http.put(`/admin/settings/${editing.value}`, { value: form.value.value, type: form.value.type, is_public: form.value.is_public });
        else await http.post('/admin/settings', form.value);
        reset(); await load();
    } catch (e: any) { error.value = e?.response?.data?.message ?? 'Save failed.'; }
    finally { saving.value = false; }
}
onMounted(load);
</script>