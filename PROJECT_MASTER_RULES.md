# PROJECT MASTER RULES — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15 (end of Installation 11 documentation)  
**Status:** Verified project rules baseline. Any change requires Project Owner approval and documentation update.

---

## 1. Project identity and scope

- **Project:** IT Assistance BD Portfolio
- **Type:** Public portfolio website/application for IT Assistance BD.
- **Current approved product scope:** Frontend portfolio foundation delivered through Installation 10 (environment, Laravel 12, Vue 3/TypeScript/Vite integration, Tailwind 4 design system, UI primitives, layout shell, homepage, secondary pages, project detail pages, integrated QA/content verification). Content is factual and static/file-based.
- **Out of current approved scope (unless explicitly approved later):** Admin CMS, database-driven portfolio/content management, authentication, backend contact form/message storage, blog, job automation, external API integrations, e-commerce, SEO implementation/Installation 12, deployment execution, and any feature/module not approved by the Project Owner.

## 2. Technology stack (verified baseline)

| Layer | Verified |
|---|---|
| Backend framework | Laravel **12.72.0** (PHP **8.4.24**, Composer **2.11.2**) |
| Frontend | Vue **3.5.45**, TypeScript **6.0.3**, Vite **6.4.6**, `@vitejs/plugin-vue` **6.0.11** |
| Routing/state/HTTP | Vue Router **4.6.5**, Pinia **4.1.0**, Axios **1.21.1** |
| Styling | Tailwind CSS **4.3.5** (CSS-first, `@theme static`, no `tailwind.config.js`) |
| Fonts | Inter Variable, Plus Jakarta Sans Variable, Noto Sans Bengali Variable (self-hosted) |
| Tooling/runtime (dev) | Node **24.19.0** LTS, npm **11.17.0**, XAMPP (Apache, MariaDB **10.4.32** available) |
| Database binding (current) | Laravel scaffold default **SQLite** (`database/database.sqlite`); MariaDB not yet connected/approved for app use |

See [docs/ENVIRONMENT_SETUP.md](docs/ENVIRONMENT_SETUP.md), [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md), and [docs/IMPLEMENTATION_STATUS.md](docs/IMPLEMENTATION_STATUS.md).

## 3. Design standards

- **Approved brand palette/tokens are fixed unless Project Owner approves changes.** Do not alter core brand colors/tokens in `resources/css/theme.css` without approval.
- Use design tokens and Tailwind utilities; avoid hard-coded hex values/arbitrary values where tokens/utilities exist.
- Maintain accessible, semantic, responsive UI consistent with existing primitives (`resources/js/components/ui/`) and layout patterns.
- Preserve contrast, focus visibility, semantic landmarks/headings, keyboard operability, and reduced-motion behavior.
- Content presentation must remain factual, neutral, and professional; no decorative claims or misleading visual signals.

## 4. Architecture constraints

- **SPA-in-Laravel shell:** `resources/views/app.blade.php` mounts Vue at `#app` with `@vite(['resources/css/app.css','resources/js/app.ts'])`.
- **Frontend source of truth:** `resources/js/` (`app.ts`, `App.vue`, `router/`, `layouts/`, `pages/`, `components/`, `data/`, `services/`, `stores/`).
- **Public pages render inside `PortfolioLayout`** (header/main/footer) except approved dev-only showcase routes.
- **Routing:** Vue Router history mode; Laravel catch-all returns SPA view for public paths; local-only `/dev/{path?}` handled before catch-all. Preserve SPA fallback behavior.
- **Content/data:** Static typed data in `resources/js/data/*` unless a future approved module changes architecture.
- **No backend feature expansion** (controllers/models/migrations/APIs/auth/CMS/contact backend) without explicit module approval.
- Keep `http.ts` Axios client reusable; do not invent endpoints.

## 5. Coding conventions

- Preserve existing structure, naming, style, and patterns; prefer minimal, targeted changes.
- Vue: Composition API with `<script setup lang="ts">` where consistent; typed props/interfaces; avoid `any`.
- TypeScript: keep strict checking passing (`npm run type-check`).
- CSS: Tailwind 4 CSS-first conventions and project token/utilities; no duplicate/conflicting styling systems.
- Separate data/content from presentation where already established.
- Reuse existing UI/layout/portfolio components before creating new ones.
- Do not add packages, frameworks, or build tools without Project Owner approval.

## 6. Safety rules

- Work only inside `C:\xampp\htdocs\Laravel\Portfolio`.
- No destructive commands or broad cleanup (no mass deletes, resets, rebases, forced overwrites, dependency purges) unless explicitly approved.
- Do not modify/delete unrelated files or overwrite historical installation/QA reports with summaries.
- No application source changes unless the approved module requires them.
- Do not expose or store secrets, credentials, API keys, passwords, or private tokens in docs or code.
- Treat unfamiliar files/changes as potential user work; investigate before editing.

## 7. Documentation requirements

- Documentation is Markdown (`.md`) and must be accurate, concise, cross-linked (relative links), and free of duplicate/conflicting sources of truth.
- `docs/IMPLEMENTATION_STATUS.md` is the single current-state source; `docs/MODULE_REGISTRY.md` is the module/register source; historical reports remain detailed evidence.
- Update relevant docs when implementation/state changes; record decisions, limitations, and owner actions.
- Distinguish **approved/completed**, **proposed**, **pending approval**, and **deferred** work clearly.
- Do not invent dates, statuses, approvals, or evidence.

## 8. Testing standards

- For frontend/app changes, run and report as applicable: `npm run type-check`, `npm run build`, `php artisan test`.
- Perform targeted browser verification for affected routes/flows (direct load, navigation, console, responsive, accessibility/content checks as relevant).
- Record actual results only; never mark unverified checks as PASS.
- Fix only verified defects within approved scope; document defect, file, correction, and re-test evidence.

## 9. Owner approval workflow

- Module work begins only when the Project Owner approves/specifies it.
- Preserve approval gates between modules/installations.
- At module completion: deliver evidence-based report, update required documentation, stop, and wait for Project Owner approval before starting the next module.
- Do not treat roadmap/proposed items as approved implementation tasks.

## 10. No-fabrication rules

- Do not fabricate contact details, social/profile URLs, phone numbers, project statuses, achievements, metrics, clients, testimonials, screenshots, demo links, repositories, credentials, or deployment claims.
- Mark unverified/owner-dependent information explicitly (e.g., pending confirmation, not supplied, not verified).
- Keep project status language honest (e.g., planned vs in progress vs confirmed implementation).

## 11. Module completion and reporting requirements

- Complete only the approved module scope; no feature expansion.
- Verify with appropriate checks and evidence.
- Update `docs/IMPLEMENTATION_STATUS.md`, `docs/MODULE_REGISTRY.md`, and module-specific docs/reports as required.
- Report: final status, files created/modified, verification results (with actual evidence), defects/fixes, limitations, owner actions, and acceptance checklist.
- **Stop condition:** after completion, do not start the next module until Project Owner approval.
