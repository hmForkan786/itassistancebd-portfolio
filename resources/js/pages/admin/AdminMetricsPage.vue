<template>
    <div>
        <h1 class="text-h2">Portfolio metrics</h1>
        <p class="mt-1 text-small text-muted">Verified metrics only are shown publicly. No fabricated values.</p>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <div v-else class="mt-6 overflow-x-auto rounded-card border border-line bg-white">
            <table class="w-full text-small">
                <thead class="border-b border-line bg-surface-soft">
                    <tr>
                        <th class="p-3 text-left">Key</th>
                        <th class="p-3 text-left">Label</th>
                        <th class="p-3 text-left">Value</th>
                        <th class="p-3 text-left">Unit</th>
                        <th class="p-3 text-left">Verified</th>
                        <th class="p-3 text-left">Enabled</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="m in items" :key="m.id" class="border-b border-line last:border-0">
                        <td class="p-3 font-mono text-caption">{{ m.metric_key }}</td>
                        <td class="p-3">{{ m.metric_label }}</td>
                        <td class="p-3">{{ m.metric_value ?? '—' }}</td>
                        <td class="p-3">{{ m.metric_unit ?? '' }}</td>
                        <td class="p-3">{{ m.verified ? 'Yes' : 'No' }}</td>
                        <td class="p-3">{{ m.enabled ? 'Yes' : 'No' }}</td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <button class="text-brand hover:underline" @click="edit(m)">Edit</button>
                                <button class="text-muted hover:text-heading" @click="toggle(m, 'verified')">{{ m.verified ? 'Unverify' : 'Verify' }}</button>
                                <button class="text-muted hover:text-heading" @click="toggle(m, 'enabled')">{{ m.enabled ? 'Disable' : 'Enable' }}</button>
                                <button class="text-red-600 hover:underline" @click="remove(m)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 rounded-card border border-line bg-white p-4">
            <h2 class="text-h4">{{ editing ? 'Edit metric' : 'New metric' }}</h2>
            <form class="mt-4 grid gap-3 sm:grid-cols-3" @submit.prevent="save">
                <input v-model="form.metric_key" placeholder="metric_key *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.metric_label" placeholder="Label *" required class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model.number="form.metric_value" type="number" step="0.01" placeholder="Value" class="rounded-field border border-line px-3 py-2 text-small" />
                <input v-model="form.metric_unit" placeholder="Unit (%, yrs)" class="rounded-field border border-line px-3 py-2 text-small" />
                <select v-model="form.source_type" class="rounded-field border border-line px-3 py-2 text-small">
                    <option value="manual">Manual</option>
                    <option value="derived">Derived</option>
                </select>
                <input v-model="form.source_reference" placeholder="Source reference" class="rounded-field border border-line px-3 py-2 text-small" />
                <label class="text-small"><input v-model="form.verified" type="checkbox" /> Verified</label>
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
const form = ref<any>({ metric_key: '', metric_label: '', metric_value: null, metric_unit: '', source_type: 'manual', source_reference: '', verified: false, enabled: false });

async function load(): Promise<void> {
    loading.value = true;
    try {
        const res = await http.get('/admin/metrics', { params: { per_page: 50 } });
        items.value = res.data.data;
    } finally {
        loading.value = false;
    }
}

function edit(m: any): void {
    editing.value = m.id;
    form.value = { ...m };
}

function reset(): void {
    editing.value = null;
    form.value = { metric_key: '', metric_label: '', metric_value: null, metric_unit: '', source_type: 'manual', source_reference: '', verified: false, enabled: false };
}

async function save(): Promise<void> {
    saving.value = true;
    error.value = '';
    try {
        if (editing.value) {
            await http.put(`/admin/metrics/${editing.value}`, form.value);
        } else {
            await http.post('/admin/metrics', form.value);
        }
        reset();
        await load();
    } catch (e: any) {
        error.value = e?.response?.data?.message ?? 'Save failed.';
    } finally {
        saving.value = false;
    }
}

async function toggle(m: any, field: string): Promise<void> {
    if (field === 'verified') await http.post(`/admin/metrics/${m.id}/toggle-verified`);
    else await http.post(`/admin/metrics/${m.id}/toggle-enabled`);
    await load();
}

async function remove(m: any): Promise<void> {
    if (!confirm(`Delete metric ${m.metric_key}?`)) return;
    await http.delete(`/admin/metrics/${m.id}`);
    await load();
}

onMounted(load);
</script>