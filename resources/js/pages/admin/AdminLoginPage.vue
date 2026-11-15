<template>
    <div class="flex min-h-screen items-center justify-center bg-surface-soft p-6">
        <div class="w-full max-w-md rounded-card border border-line bg-white p-card shadow-soft">
            <h1 class="text-h3">Admin sign in</h1>
            <p class="mt-1 text-small text-muted">IT Assistance BD Portfolio CMS</p>

            <form class="mt-6 flex flex-col gap-4" @submit.prevent="onSubmit">
                <div>
                    <label class="text-small font-medium">Email</label>
                    <input v-model="email" type="email" required class="mt-1 w-full rounded-field border border-line px-3 py-2" />
                </div>
                <div>
                    <label class="text-small font-medium">Password</label>
                    <input v-model="password" type="password" required class="mt-1 w-full rounded-field border border-line px-3 py-2" />
                </div>
                <p v-if="auth.error" class="text-small text-red-600">{{ auth.error }}</p>
                <BaseButton type="submit" :disabled="auth.loading" class="w-full">
                    {{ auth.loading ? 'Signing in...' : 'Sign in' }}
                </BaseButton>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import BaseButton from '@/components/ui/BaseButton.vue';
import { useAdminAuthStore } from '@/stores/adminAuth';

const auth = useAdminAuthStore();
const router = useRouter();
const email = ref('');
const password = ref('');

async function onSubmit(): Promise<void> {
    const ok = await auth.login(email.value, password.value);
    if (ok) {
        router.push('/admin');
    }
}
</script>