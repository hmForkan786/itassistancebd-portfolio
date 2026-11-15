<template>
    <div>
        <div class="flex items-center justify-between">
            <h1 class="text-h2">{{ isNew ? 'New project' : 'Edit project' }}</h1>
            <router-link to="/admin/projects" class="text-small text-muted hover:text-heading">Back</router-link>
        </div>

        <div v-if="loading" class="mt-6 text-small text-muted">Loading...</div>
        <form v-else class="mt-6 grid gap-4 lg:grid-cols-2" @submit.prevent="save">
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Title *</label>
                <input v-model="form.title" required class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Slug</label>
                <input v-model="form.slug" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Category</label>
                <input v-model="form.category" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Status *</label>
                <select v-model="form.status" required class="rounded-field border border-line px-3 py-2">
                    <option value="completed">Completed</option>
                    <option value="in-progress">In progress</option>
                    <option value="prototype">Prototype</option>
                    <option value="planned">Planned</option>
                </select>
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Short description</label>
                <textarea v-model="form.short_description" rows="2" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Description</label>
                <textarea v-model="form.description" rows="4" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Purpose</label>
                <textarea v-model="form.purpose" rows="2" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Problem statement</label>
                <textarea v-model="form.problem_statement" rows="3" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Solution</label>
                <textarea v-model="form.solution" rows="3" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Implementation details</label>
                <textarea v-model="form.implementation_details" rows="3" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Results</label>
                <textarea v-model="form.results" rows="3" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="lg:col-span-2 flex flex-col gap-2">
                <label class="text-small font-medium">Limitations (one per line)</label>
                <textarea v-model="form.limitations" rows="3" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Client name</label>
                <input v-model="form.client_name" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex items-center gap-2">
                <input id="client_visibility" v-model="form.client_visibility" type="checkbox" />
                <label for="client_visibility" class="text-small">Show client name publicly</label>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Duration</label>
                <input v-model="form.duration" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Live URL</label>
                <input v-model="form.live_url" type="url" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">GitHub URL</label>
                <input v-model="form.github_url" type="url" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Sort order</label>
                <input v-model.number="form.sort_order" type="number" min="0" class="rounded-field border border-line px-3 py-2" />
            </div>
            <div class="flex items-center gap-2">
                <input id="featured" v-model="form.featured" type="checkbox" />
                <label for="featured" class="text-small">Featured</label>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-small font-medium">Published at</label>
                <input v-model="form.published_at" type="datetime-local" class="rounded-field border border-line px-3 py-2" />
            </div>

            <div class="lg:col-span-2">
                <label class="text-small font-medium">Technologies (comma-separated)</label>
                <input v-model="techInput" class="mt-1 w-full rounded-field border border-line px-3 py-2" placeholder="Laravel 12, Vue 3, TypeScript" />
            </div>

            <div class="lg:col-span-2 flex items-center gap-3">
                <button type="submit" :disabled="saving" class="rounded-field bg-brand px-4 py-2 text-small text-white">
                    {{ saving ? 'Saving...' : 'Save' }}
                </button>
                <p v-if="error" class="text-small text-red-600">{{ error }}</p>
                <p v-if="success" class="text-small text-green-600">Saved.</p>
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import http from '@/services/http';

const route = useRoute();
const router = useRouter();
const isNew = computed(() => route.name === 'admin.project.new');
const loading = ref(true);
const saving = ref(false);
const error = ref('');
const success = ref(false);

const form = ref<any>({
    title: '', slug: '', category: '', short_description: '', description: '', purpose: '', limitations: '',
    problem_statement: '', solution: '', implementation_details: '', results: '',
    client_name: '', client_visibility: false, status: 'planned', featured: false,
    sort_order: 0, duration: '', live_url: '', github_url: '', seo_title: '', seo_description: '',
    published_at: '',
});
const techInput = ref('');

onMounted(async () => {
    if (!isNew.value && route.params.id) {
        try {
            const res = await http.get(`/admin/projects/${route.params.id}`);
            const p = res.data;
            Object.assign(form.value, p);
            if (p.published_at) {
                form.value.published_at = String(p.published_at).slice(0, 16);
            }
            techInput.value = (p.technologies ?? []).map((t: any) => t.name).join(', ');
        } catch {
            error.value = 'Failed to load project.';
        }
    }
    loading.value = false;
});

function toPayload(): any {
    const payload: any = { ...form.value };
    if (payload.published_at) {
        // convert local datetime to ISO
        payload.published_at = new Date(payload.published_at).toISOString();
    } else {
        payload.published_at = null;
    }
    payload.technologies = techInput.value.split(',').map((s) => s.trim()).filter(Boolean);
    payload.client_visibility = !!payload.client_visibility;
    payload.featured = !!payload.featured;
    return payload;
}

async function save(): Promise<void> {
    saving.value = true;
    error.value = '';
    success.value = false;
    try {
        if (isNew.value) {
            const res = await http.post('/admin/projects', toPayload());
            router.replace(`/admin/projects/${res.data.id}/edit`);
        } else {
            await http.put(`/admin/projects/${route.params.id}`, toPayload());
        }
        success.value = true;
    } catch (e: any) {
        error.value = e?.response?.data?.message ?? 'Save failed.';
    } finally {
        saving.value = false;
    }
}
</script>