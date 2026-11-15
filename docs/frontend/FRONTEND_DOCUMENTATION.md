# Frontend Documentation — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Vue application structure

- Entry: `resources/js/app.ts` — creates Vue app, installs Pinia + Vue Router, mounts `#app`.
- Root: `resources/js/App.vue` — renders `<RouterView />`.
- TypeScript: strict (`tsconfig.json`, `vue-tsc --noEmit`).
- Alias: `@` → `resources/js`.

## Routing

- `resources/js/router/index.ts` — `createWebHistory()`.
- Public layout route `/` uses `PortfolioLayout.vue` with nested children: home, about, services, projects, projects/:slug, contact.
- Dev-only routes (`/dev/ui`, `/dev/layout`) registered only under `import.meta.env.DEV`.
- Hash-aware `scrollBehavior` (80px offset when target exists, else top).
- `router.afterEach` syncs `document.title` and SEO metadata (title, description, canonical, OG, Twitter, robots) per route.

## Components

- `components/ui/` — 9 accessible primitives (`BaseButton`, `BaseContainer`, `SectionHeading`, `BaseCard`, `BaseBadge`, `BaseInput`, `BaseTextarea`, `BaseSelect`, `BaseModal`) + `types.ts`, `field-styles.ts`, `index.ts`.
- `components/layout/` — `AppHeader.vue`, `AppFooter.vue`, `navigation.ts`.
- `components/portfolio/` — `CtaLink`, `ServiceCard`, `ProjectCard`, `ProjectDetail`, `SkillItem`.

## Layouts

- `layouts/PortfolioLayout.vue` — skip link, header, `<main id="main-content" tabindex="-1">`, footer, full-height flex column.

## State management

- `stores/index.ts` — shared Pinia instance (no feature stores yet).

## Pinia

- Shared instance exported; no feature stores implemented.

## Axios / API communication

- `services/http.ts` — reusable Axios client (`/api`, credentials, JSON headers, 15s timeout). No endpoints defined or consumed.

## TypeScript

- Strict mode (`strict: true`, noUnusedLocals/Parameters, etc.). `npm run type-check` = `vue-tsc --noEmit`.

## Tailwind CSS

- Tailwind 4 CSS-first: `resources/css/app.css` (entry), `theme.css` (`@theme static` tokens), `base.css` (global styles), `utilities.css` (project utilities). No `tailwind.config.js`.

## Vite build process

- `vite.config.js`: Laravel Vite plugin (inputs `app.css` + `app.ts`), Tailwind plugin, Vue plugin, `@` alias.
- Scripts: `npm run dev`, `npm run build`, `npm run type-check`.
- Output: `public/build/` (hashed assets + `manifest.json`).
- Route-level code splitting via dynamic imports.

## Frontend conventions

- Preserve existing structure/naming/style; prefer minimal targeted changes.
- Composition API `<script setup lang="ts">`; typed props; avoid `any`.
- Reuse existing UI/layout/portfolio components.
- Separate data/content from presentation (`resources/js/data/*`).

See `docs/HOMEPAGE.md`, `docs/SECONDARY_PAGES.md`, `docs/PROJECT_DETAIL_PAGES.md`, `docs/UI_COMPONENTS.md`, `docs/PORTFOLIO_LAYOUT.md` for module details.