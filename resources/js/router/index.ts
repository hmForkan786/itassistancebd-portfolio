import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';
import { getProjectBySlug } from '@/data/projects';

/**
 * Frontend routing foundation.
 *
 * Public pages are children of `PortfolioLayout`, so every page inherits the
 * header/footer shell automatically. The homepage and the secondary pages live
 * under the same layout; homepage section hashes (e.g. /#projects, /#skills)
 * continue to work because the sections still exist on the home route.
 */

/** SEO metadata shared by route records. Descriptions are factual and conservative. */
interface RouteSeoMeta {
    title: string;
    description: string;
}

const homeDescription =
    'Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills.';

const routes: RouteRecordRaw[] = [
    {
        path: '/admin/login',
        name: 'admin.login',
        component: () => import('@/pages/admin/AdminLoginPage.vue'),
        meta: { title: 'Admin login — IT Assistance BD', description: 'Admin sign in.' },
    },
    {
        path: '/admin',
        component: () => import('@/layouts/AdminLayout.vue'),
        meta: { requiresAdmin: true },
        children: [
            { path: '', name: 'admin.dashboard', component: () => import('@/pages/admin/AdminDashboardPage.vue') },
            { path: 'projects', name: 'admin.projects', component: () => import('@/pages/admin/AdminProjectsPage.vue') },
            { path: 'projects/:id/edit', name: 'admin.project.edit', component: () => import('@/pages/admin/AdminProjectEditPage.vue') },
            { path: 'projects/new', name: 'admin.project.new', component: () => import('@/pages/admin/AdminProjectEditPage.vue') },
            { path: 'testimonials', name: 'admin.testimonials', component: () => import('@/pages/admin/AdminTestimonialsPage.vue') },
            { path: 'metrics', name: 'admin.metrics', component: () => import('@/pages/admin/AdminMetricsPage.vue') },
            { path: 'services', name: 'admin.services', component: () => import('@/pages/admin/AdminServicesPage.vue') },
            { path: 'skills', name: 'admin.skills', component: () => import('@/pages/admin/AdminSkillsPage.vue') },
            { path: 'messages', name: 'admin.messages', component: () => import('@/pages/admin/AdminMessagesPage.vue') },
            { path: 'settings', name: 'admin.settings', component: () => import('@/pages/admin/AdminSettingsPage.vue') },
            { path: 'analytics', name: 'admin.analytics', component: () => import('@/pages/admin/AdminAnalyticsPage.vue') },
        ],
    },
    {
        path: '/',
        component: () => import('@/layouts/PortfolioLayout.vue'),
        children: [
            {
                path: '',
                name: 'app.home',
                component: () => import('@/pages/HomePage.vue'),
                meta: {
                    title: 'IT Assistance BD — Digital Solutions Developer & Creative Problem Solver',
                    description: homeDescription,
                } satisfies RouteSeoMeta,
            },
            {
                path: 'about',
                name: 'app.about',
                component: () => import('@/pages/AboutPage.vue'),
                meta: {
                    title: 'About — IT Assistance BD',
                    description:
                        'About IT Assistance BD: web application development with Laravel and Vue, problem solving, business and management experience, and remote collaboration.',
                } satisfies RouteSeoMeta,
            },
            {
                path: 'services',
                name: 'app.services',
                component: () => import('@/pages/ServicesPage.vue'),
                meta: {
                    title: 'Services — IT Assistance BD',
                    description:
                        'Services by IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design. Scope and timing discussed per project.',
                } satisfies RouteSeoMeta,
            },
            {
                path: 'projects',
                name: 'app.projects',
                component: () => import('@/pages/ProjectsPage.vue'),
                meta: {
                    title: 'Projects — IT Assistance BD',
                    description:
                        'Selected project initiatives by IT Assistance BD, each with an honest current status. No claimed demos, repositories, screenshots or client information.',
                } satisfies RouteSeoMeta,
            },
            {
                path: 'projects/:slug',
                name: 'app.projects.detail',
                component: () => import('@/pages/ProjectDetailPage.vue'),
                // Title/description resolved per slug in router.afterEach.
            },
            {
                path: 'contact',
                name: 'app.contact',
                component: () => import('@/pages/ContactPage.vue'),
                meta: {
                    title: 'Contact — IT Assistance BD',
                    description:
                        'Contact IT Assistance BD by email for projects, collaboration ideas or questions. Verified email contact; no on-site form or message storage.',
                } satisfies RouteSeoMeta,
            },
        ],
    },
];

/**
 * Internal development routes.
 *
 * Registered only in development builds, so they cannot be reached through a
 * production bundle. They sit outside the public layout so the shell itself can
 * be inspected without affecting the placeholder home page.
 */
if (import.meta.env.DEV) {
    routes.push(
        {
            path: '/dev/ui',
            name: 'dev.ui',
            component: () => import('@/pages/ComponentShowcasePage.vue'),
            meta: { title: 'Component showcase — IT Assistance BD', description: 'Internal development component showcase.' },
        },
        {
            path: '/dev/layout',
            name: 'dev.layout',
            component: () => import('@/layouts/PortfolioLayout.vue'),
            children: [
                {
                    path: '',
                    name: 'dev.layout.content',
                    component: () => import('@/pages/LayoutShowcasePage.vue'),
                    meta: { title: 'Layout showcase — IT Assistance BD', description: 'Internal development layout showcase.' },
                },
            ],
        },
    );
}

const router = createRouter({
    history: createWebHistory(),
    routes,
    /**
     * Restores history position on back/forward, scrolls to a section when the
     * link has a hash (offset below the sticky header) and to the top otherwise.
     * The hash target is checked first so homepage anchors resolve only when the
     * target section exists on the current page.
     */
    scrollBehavior: (to, _from, savedPosition) => {
        if (savedPosition) {
            return savedPosition;
        }

        if (to.hash && document.querySelector(to.hash)) {
            return { el: to.hash, top: 80 };
        }

        return { top: 0 };
    },
});

/**
 * Update a <meta> or <link> element's content/attribute, creating it if missing.
 * Keeps SEO metadata in sync with the active SPA route without a head-management
 * dependency.
 */
const setMeta = (selector: string, attr: 'content' | 'href', value: string): void => {
    let element = document.querySelector(selector) as HTMLElement | null;
    if (!element) {
        element = document.createElement(selector.startsWith('link') ? 'link' : 'meta');
        // Parse selector minimally: supports meta[name="x"], meta[property="x"], link[rel="x"].
        const match = selector.match(/^(meta|link)\[([a-z-]+)="([^"]+)"\]$/);
        if (match && match[2] && match[3]) {
            element.setAttribute(match[2], match[3]);
        }
        document.head.appendChild(element);
    }
    element.setAttribute(attr, value);
};

const setMetaName = (name: string, content: string): void => {
    setMeta(`meta[name="${name}"]`, 'content', content);
};

const setMetaProperty = (property: string, content: string): void => {
    setMeta(`meta[property="${property}"]`, 'content', content);
};

const siteName = 'IT Assistance BD';
const fallbackDescription = homeDescription;

/** Keep the browser tab title and SEO metadata in sync with the active route. */
router.afterEach((to) => {
    let title: string;
    let description: string;

    if (to.name === 'app.projects.detail') {
        const slug = typeof to.params.slug === 'string' ? to.params.slug : '';
        const project = getProjectBySlug(slug);
        if (project) {
            title = `${project.name} — IT Assistance BD`;
            description = `${project.summary} Status: ${project.status.replace('-', ' ')}.`;
        } else {
            title = 'Project not found — IT Assistance BD';
            description =
                'The requested project page could not be found. Browse the project initiatives or contact IT Assistance BD.';
        }
    } else {
        title = typeof to.meta.title === 'string' ? to.meta.title : 'IT Assistance BD Portfolio';
        description =
            typeof to.meta.description === 'string' ? to.meta.description : fallbackDescription;
    }

    document.title = title;

    // Canonical URL uses origin + path (no hash/query) for stable, environment-aware URLs.
    const canonicalUrl = `${window.location.origin}${to.path === '/' ? '/' : to.path}`;
    setMeta('link[rel="canonical"]', 'href', canonicalUrl);

    setMetaName('description', description);
    setMetaName('robots', 'index, follow');

    setMetaProperty('og:title', title);
    setMetaProperty('og:description', description);
    setMetaProperty('og:url', canonicalUrl);
    setMetaProperty('og:type', 'website');
    setMetaProperty('og:site_name', siteName);
    setMetaProperty('og:locale', 'en_US');

    setMetaName('twitter:card', 'summary');
    setMetaName('twitter:title', title);
    setMetaName('twitter:description', description);

    // Lightweight first-party analytics (fire-and-forget; never block navigation).
    if (!to.path.startsWith('/admin')) {
        const eventName = to.name === 'app.projects.detail' ? 'project_view' : 'page_view';
        const payload: Record<string, unknown> = {
            event_name: eventName,
            page_path: to.path,
            device_type: /Mobi|Android/i.test(navigator.userAgent) ? 'mobile' : 'desktop',
        };
        if (to.name === 'app.projects.detail' && typeof to.params.slug === 'string') {
            // Resolve project id not available client-side; send slug via page_path only.
        }
        try {
            fetch('/api/public/analytics/event', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify(payload),
                keepalive: true,
            }).catch(() => {});
        } catch {
            // ignore
        }
    }
});

// Admin route guard.
router.beforeEach(async (to) => {
    if (to.meta.requiresAdmin) {
        // Lazy import to avoid circular deps.
        const { useAdminAuthStore } = await import('@/stores/adminAuth');
        const auth = useAdminAuthStore();
        if (!auth.user) {
            const ok = await auth.fetchMe();
            if (!ok) {
                return { name: 'admin.login', query: { redirect: to.fullPath } };
            }
        }
    }
    if (to.name === 'admin.login') {
        const { useAdminAuthStore } = await import('@/stores/adminAuth');
        const auth = useAdminAuthStore();
        if (!auth.user) {
            await auth.fetchMe();
        }
        if (auth.user) {
            return { name: 'admin.dashboard' };
        }
    }
    return true;
});

export default router;