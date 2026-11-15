# ARCHITECTURE — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15 (verified through Installation 10)  
**Status:** Current verified architecture baseline

---

## 1. Overview

A Laravel 12 application serving a Vue 3 + TypeScript single-page application (SPA) through a Blade mount view. Frontend assets are built with Vite and styled with Tailwind CSS 4 (CSS-first tokens). Public content is currently static and data-driven from typed frontend modules.

## 2. Backend (Laravel)

- **Framework:** Laravel **12.72.0** (`laravel/framework`), skeleton `laravel/laravel` v12.x, PHP 8.4.x (verified 8.4.24), Composer 2.11.x.
- **Entry/view:** `resources/views/app.blade.php` provides HTML shell, metadata, and `@vite(['resources/css/app.css','resources/js/app.ts'])`; mounts Vue at `<div id="app"></div>`.
- **Web routes (`routes/web.php`):**
  - Local-only (when `app()->environment('local')`): `GET /dev/{path?}` → `view('app')` (registered before catch-all).
  - SEO: `GET /sitemap.xml` → dynamic XML response generated from verified public routes/project slugs using `config('app.url')` (registered before catch-all).
  - SPA catch-all: `GET /{any?}` → `view('app')` with constraint `^(?!dev(?:/|$)).*` so public/history-mode paths resolve to the SPA while `dev/*` is excluded from the public catch-all.
  - Framework routes remain separate (e.g. `/up`, signed storage routes).
- **Backend application logic:** Skeleton-level only (no custom business controllers/models/APIs/auth/CMS/contact backend implemented).
- **Configuration:** `.env` present with app key/name/local debug as documented; database currently scaffold SQLite unless later approved/changed. No secrets recorded in docs.

## 3. Frontend (Vue 3 + TypeScript)

- **Entry:** `resources/js/app.ts` creates Vue app, installs Pinia and Vue Router, mounts `#app`.
- **Root:** `resources/js/App.vue` renders `<RouterView />`.
- **TypeScript:** strict checking via `tsconfig.json` and `vue-tsc --noEmit` (`npm run type-check`).
- **Alias:** `@` → `resources/js` (Vite resolve alias).
- **State:** `resources/js/stores/index.ts` exports shared Pinia instance (no feature stores yet).
- **HTTP:** `resources/js/services/http.ts` provides reusable Axios client (`baseURL: /api`, credentials, JSON headers, 15s timeout); **no API endpoints defined/consumed**.
- **Types:** `resources/js/env.d.ts` for Vite client types.

## 4. Routing and layout structure

- **Router:** `resources/js/router/index.ts`, `createWebHistory()`.
- **Public layout route:** `/` uses `layouts/PortfolioLayout.vue` with nested children:
  - `''` (`app.home`) → `pages/HomePage.vue`
  - `about` (`app.about`) → `pages/AboutPage.vue`
  - `services` (`app.services`) → `pages/ServicesPage.vue`
  - `projects` (`app.projects`) → `pages/ProjectsPage.vue`
  - `projects/:slug` (`app.projects.detail`) → `pages/ProjectDetailPage.vue`
  - `contact` (`app.contact`) → `pages/ContactPage.vue`
- **Dev-only routes (registered only when `import.meta.env.DEV`):** `/dev/ui` (`ComponentShowcasePage.vue`) and `/dev/layout` (`PortfolioLayout.vue` → `LayoutShowcasePage.vue`).
- **Scroll behavior:** restores saved position on history nav; scrolls to hash target with `top: 80` offset when target exists; otherwise scrolls to top.
- **Titles:** `router.afterEach` syncs `document.title` from route meta; project detail titles resolved from project data/slug (`Project not found — IT Assistance BD` for unknown slug).
- **Layout shell:** `PortfolioLayout.vue` renders skip link, `AppHeader`, `<main id="main-content" tabindex="-1">` with `<RouterView />`, and `AppFooter` in a full-height flex column.
- **Navigation:** shared config in `components/layout/navigation.ts` used by header/footer; page routes for About/Services/Projects/Contact, homepage hash for Skills (`/#skills`). Active states reflect route path/hash semantics as implemented.

## 5. Data sources and content organization

- **Static typed data (`resources/js/data/`):**
  - `site.ts` — profile, capabilities, focus/about points, verified public email and availability text.
  - `services.ts` — service categories/descriptions.
  - `projects.ts` — initiative records (slug, status, focus, summary, overview, purpose, tech stack, implemented/planned/limitations) and lookup.
  - `skills.ts` — grouped skill/tool lists.
- **Presentation:** pages and portfolio components consume data/components; copy is largely separated from markup where established.
- **No CMS/database-driven content, no backend content API.**

## 6. Component organization

- `components/ui/` — reusable accessible primitives (`BaseButton`, `BaseContainer`, `SectionHeading`, `BaseCard`, `BaseBadge`, form fields, `BaseModal`) plus shared types/styles/index.
- `components/layout/` — `AppHeader.vue`, `AppFooter.vue`, `navigation.ts`.
- `components/portfolio/` — `CtaLink`, `ServiceCard`, `ProjectCard`, `ProjectDetail`, `SkillItem`.
- `pages/` — public pages, detail page, `PlaceholderPage` (retained, not routed), dev showcase pages.
- `layouts/` — `PortfolioLayout.vue`.

## 7. Styling and design system

- **Tailwind 4 CSS-first:** `resources/css/app.css` imports Tailwind, fonts, and layers; `theme.css` defines tokens in `@theme static`; `base.css` global element/accessibility defaults; `utilities.css` project utilities.
- **Build integration:** `@tailwindcss/vite` plugin in `vite.config.js`; no `tailwind.config.js`/PostCSS config required by current setup.
- **Tokens:** approved brand palette, semantic UI states, typography, spacing, containers, radius, shadows, utilities as documented in [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md).

## 8. Build and production behavior

- **Vite config (`vite.config.js`):** Laravel Vite plugin inputs `resources/css/app.css` and `resources/js/app.ts`, Tailwind plugin, Vue plugin, `@` alias.
- **Scripts:** `npm run dev` (Vite), `npm run build` (production build), `npm run type-check` (`vue-tsc --noEmit`).
- **Output:** production assets/manifests emitted to `public/build/` (e.g. hashed CSS/JS/font assets, `manifest.json`).
- **Dev-only frontend routes:** wrapped in `import.meta.env.DEV`, excluded from production bundle (verified in Module 10 bundle checks). Local backend `/dev/*` shell route is environment-guarded (`local`).
- **Laravel/Vite integration:** Blade `@vite` loads compiled assets in production or dev server assets when running with Vite dev.

## 9. SPA routing/fallback

- Vue Router uses HTML5 history mode for clean URLs.
- Laravel catch-all returns the SPA mount view for public paths so direct loads/refresh of client routes work.
- Unknown project slugs are handled in-page by `ProjectDetailPage` (route resolves; not-found UI rendered) rather than server 404.
- Homepage hash anchors (e.g. `/#skills`) and hash-aware scrolling are supported as implemented.

## 10. Current limitations

- Static/file-based content; no CMS/database-driven content, auth, admin, backend contact handling, blog, or APIs.
- Project statuses/details are conservative and owner-confirmation dependent.
- Contact limited to verified email/mailto; no verified phone/social links, no backend form.
- Dev showcase routes exist for local use; retirement is an owner decision.
- Skeleton SQLite and stock example tests remain; MariaDB binding/migrations for app data and broader test coverage are pending/approved-work dependent.
- Local dev verified via Vite + `php artisan serve`; production hosting/deployment not executed or validated in this module.
- Non-blocking known notes: possible `PHP_CLI_SERVER_WORKERS` notice on `artisan serve`, stale `public/hot` risk after interrupted dev server, npm esbuild allow-scripts warning.

See [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md) and [OPEN_ISSUES.md](OPEN_ISSUES.md) for current tracked items.