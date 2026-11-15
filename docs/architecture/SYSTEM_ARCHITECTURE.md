# System Architecture — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Current verified architecture baseline (see `docs/ARCHITECTURE.md` for full details)

---

## Overview

A Laravel 12 application serving a Vue 3 + TypeScript single-page application (SPA) through a Blade mount view. Frontend assets are built with Vite and styled with Tailwind CSS 4 (CSS-first tokens). Public content is static and data-driven from typed frontend modules.

## Backend architecture

- **Framework:** Laravel 12.72.0 (PHP 8.4.x, Composer 2.11.x).
- **Entry/view:** `resources/views/app.blade.php` provides HTML shell, metadata, and `@vite(['resources/css/app.css','resources/js/app.ts'])`; mounts Vue at `<div id="app"></div>`.
- **Routes (`routes/web.php`):** local-only `/dev/{path?}` (before catch-all); `/sitemap.xml` dynamic route; SPA catch-all `/{any?}` → `view('app')` (excludes `dev/*`).
- **Application logic:** Skeleton-level only — no custom controllers/models/APIs/auth/CMS/contact backend.

## Frontend architecture

- **Entry:** `resources/js/app.ts` creates Vue app, installs Pinia + Vue Router, mounts `#app`.
- **Root:** `resources/js/App.vue` renders `<RouterView />`.
- **Routing:** `resources/js/router/index.ts` — `createWebHistory()`; public layout route `/` with nested children (home, about, services, projects, projects/:slug, contact); dev-only routes under `import.meta.env.DEV`.
- **State:** `resources/js/stores/index.ts` — shared Pinia instance (no feature stores yet).
- **HTTP:** `resources/js/services/http.ts` — reusable Axios client (`/api`, credentials, JSON, 15s timeout); no endpoints defined/consumed.
- **Layout shell:** `layouts/PortfolioLayout.vue` — skip link, header, main landmark, footer, full-height flex column.

## SPA interaction

- Vue Router history mode for clean URLs.
- Laravel catch-all returns SPA mount view for public paths (direct loads/refresh work).
- Unknown project slugs handled in-page by `ProjectDetailPage` (route resolves; not-found UI).
- Homepage hash anchors (`/#skills`) and hash-aware scrolling supported (80px offset).

## API communication

- No API endpoints defined or consumed. Axios client is prepared for future use (`/api` base URL, credentials, JSON headers, 15s timeout). Do not invent endpoints.

## Authentication / authorization

- Not implemented. Any future auth/admin/CMS feature requires an approved module and security review.

## Service layer

- No service layer beyond the reusable Axios client. Business logic is in components/data modules.

## Data flow

- Static typed data in `resources/js/data/*` (site, services, projects, skills).
- Pages and portfolio components consume data/components; copy separated from markup where established.
- No CMS/database-driven content, no backend content API.

## Build process

- Vite config: Laravel Vite plugin inputs `resources/css/app.css` + `resources/js/app.ts`; Tailwind plugin; Vue plugin; `@` alias.
- Scripts: `npm run dev`, `npm run build`, `npm run type-check`.
- Output: production assets/manifests in `public/build/` (hashed CSS/JS/font assets, `manifest.json`).
- Dev-only frontend routes excluded from production bundle (verified).
- Laravel/Vite integration: Blade `@vite` loads compiled assets in production or dev server assets when running with Vite dev.

## Runtime dependencies

- Backend: Laravel 12, PHP 8.2+, Composer 2.x.
- Frontend runtime: Vue 3, Vue Router, Pinia (Axios prepared but unused).
- Styling: Tailwind CSS 4 (CSS-first, `@theme static`).
- Fonts: self-hosted variable fonts (Inter, Plus Jakarta Sans, Noto Sans Bengali) with `font-display: swap`.

## Application boundaries

- Public pages render inside `PortfolioLayout` (header/main/footer) except approved dev-only showcase routes.
- Content is static/file-based; no CMS/database-driven content, auth, admin, backend contact handling, blog, or APIs.
- Dev showcase routes exist for local use; retirement is an owner decision.

See `docs/ARCHITECTURE.md` for the full verified architecture baseline.