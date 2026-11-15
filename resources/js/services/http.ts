import axios, { type AxiosInstance } from 'axios';

/**
 * Reusable HTTP client for future Laravel endpoints.
 *
 * - `baseURL` is the relative `/api` prefix (no production host or credentials).
 * - `withCredentials` keeps Laravel's session/CSRF cookies working for SPA calls.
 * - No endpoint, token or business request is defined here.
 */
const http: AxiosInstance = axios.create({
    baseURL: '/api',
    withCredentials: true,
    timeout: 15000,
    headers: {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
});

export default http;
