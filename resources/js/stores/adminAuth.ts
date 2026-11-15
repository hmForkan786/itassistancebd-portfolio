import { defineStore } from 'pinia';
import { ref } from 'vue';
import http from '@/services/http';

interface AdminUser {
    id: number;
    name: string;
    email: string;
}

export const useAdminAuthStore = defineStore('adminAuth', () => {
    const user = ref<AdminUser | null>(null);
    const loading = ref(false);
    const error = ref<string | null>(null);

    const isAuthenticated = () => user.value !== null;

    async function fetchMe(): Promise<boolean> {
        try {
            const res = await http.get('/admin/me');
            user.value = res.data.user;
            return !!user.value;
        } catch {
            user.value = null;
            return false;
        }
    }

    async function login(email: string, password: string): Promise<boolean> {
        loading.value = true;
        error.value = null;
        try {
            const res = await http.post('/admin/login', { email, password });
            user.value = res.data.user;
            return true;
        } catch (e: any) {
            error.value = e?.response?.data?.errors?.email?.[0] ?? e?.response?.data?.message ?? 'Login failed.';
            return false;
        } finally {
            loading.value = false;
        }
    }

    async function logout(): Promise<void> {
        try {
            await http.post('/admin/logout');
        } catch {
            // ignore
        }
        user.value = null;
    }

    return { user, loading, error, isAuthenticated, fetchMe, login, logout };
});