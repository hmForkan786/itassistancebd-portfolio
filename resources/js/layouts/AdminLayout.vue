<template>
    <div class="min-h-screen bg-surface-soft text-heading">
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 border-r border-line bg-white transition-transform lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-16 items-center gap-3 border-b border-line px-5">
                <div class="flex size-9 items-center justify-center rounded-card bg-brand text-white font-bold">IA</div>
                <div class="flex flex-col">
                    <span class="text-small font-semibold">IT Assistance BD</span>
                    <span class="text-caption text-muted">Admin CMS</span>
                </div>
            </div>
            <nav class="flex flex-col gap-1 p-3">
                <router-link v-for="item in nav" :key="item.to" :to="item.to" class="admin-nav-link" active-class="admin-nav-link-active">
                    <span>{{ item.label }}</span>
                </router-link>
            </nav>
            <div class="absolute bottom-0 left-0 right-0 border-t border-line p-3">
                <button type="button" class="w-full rounded-field border border-line px-3 py-2 text-small hover:bg-surface-soft" @click="onLogout">
                    Sign out
                </button>
            </div>
        </aside>

        <div class="lg:pl-64">
            <header class="flex h-16 items-center justify-between border-b border-line bg-white px-6">
                <button type="button" class="lg:hidden rounded-field border border-line px-3 py-1.5 text-small" @click="sidebarOpen = !sidebarOpen">
                    Menu
                </button>
                <div class="text-small text-muted">{{ auth.user?.email }}</div>
            </header>
            <main class="p-6">
                <router-view />
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminAuthStore } from '@/stores/adminAuth';

const auth = useAdminAuthStore();
const router = useRouter();
const sidebarOpen = ref(false);

const nav = [
    { to: '/admin', label: 'Dashboard' },
    { to: '/admin/projects', label: 'Projects' },
    { to: '/admin/testimonials', label: 'Testimonials' },
    { to: '/admin/metrics', label: 'Metrics' },
    { to: '/admin/services', label: 'Services' },
    { to: '/admin/skills', label: 'Skills' },
    { to: '/admin/messages', label: 'Messages' },
    { to: '/admin/settings', label: 'Settings' },
    { to: '/admin/analytics', label: 'Analytics' },
];

async function onLogout(): Promise<void> {
    await auth.logout();
    router.push('/admin/login');
}
</script>

<style scoped>
.admin-nav-link {
    display: block;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    color: #475569;
    transition: background-color 0.15s ease;
}
.admin-nav-link:hover {
    background-color: #f1f5f9;
}
.admin-nav-link-active {
    background-color: #eef2ff;
    color: #4338ca;
    font-weight: 600;
}
</style>