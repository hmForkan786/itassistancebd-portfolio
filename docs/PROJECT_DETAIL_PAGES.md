# PROJECT DETAIL PAGES — IT Assistance BD Portfolio

**Module:** 09 — Project Detail Pages Foundation
**Verified:** 2026-11-15
**Location:** `resources/js/pages/`, `resources/js/components/portfolio/`, `resources/js/data/`

Individual, data-driven project detail pages for the five existing initiatives, rendered inside the approved `PortfolioLayout`. All content is factual and sourced from the shared project data: statuses are preserved, planned work is distinguished from confirmed work, and no demo links, screenshots, results, clients, testimonials or metrics are claimed.

---

## 1. Routes

**Frontend (`resources/js/router/index.ts`)** — nested children of the `PortfolioLayout`:

| Path | Name | Title | Component |
|---|---|---|---|
| `projects` | `app.projects` | Projects — IT Assistance BD | `ProjectsPage.vue` (unchanged) |
| `projects/:slug` | `app.projects.detail` | `<Project name> — IT Assistance BD` (or “Project not found — IT Assistance BD”) | `ProjectDetailPage.vue` |

- Detail titles are set in `router.afterEach` by resolving the slug via `getProjectBySlug`.
- `scrollBehavior` restores saved position, scrolls to an existing hash target at `top: 80`, else scrolls to top (detail navigations scroll to top).
- Direct URL loads work via the existing SPA catch-all in `routes/web.php`.
- Unknown slugs render an in-page not-found state (route resolves; page shows a clear message with navigation back to Projects and Contact).
- Existing routes remain functional: `/`, `/about`, `/services`, `/projects`, `/contact`, `/dev/ui`, `/dev/layout`.

**Detail slugs (5):**
- `/projects/ai-kids-video-factory`
- `/projects/scholarship-tracker`
- `/projects/iiuc-tower-erp`
- `/projects/applymate`
- `/projects/it-assistance-bd-portfolio`

---

## 2. Component structure

| Component | File | Responsibility |
|---|---|---|
| `ProjectDetailPage` | `pages/ProjectDetailPage.vue` | Reads `:slug`, looks up the project, renders `ProjectDetail` or an in-page not-found view |
| `ProjectDetail` | `components/portfolio/ProjectDetail.vue` | Reusable detail template: breadcrumb/back link, status + focus, title/summary, overview, purpose, technology stack, confirmed work, planned scope, limitations, Contact and Back-to-Projects CTAs |
| `ProjectCard` | `components/portfolio/ProjectCard.vue` | Listing card (behavior preserved) with the title now linking to `app.projects.detail` |
| `ProjectsPage` | `pages/ProjectsPage.vue` | Listing page unchanged in structure/content; cards link to detail pages |
| `CtaLink`, `BaseBadge`, `BaseCard`, `BaseContainer`, `SectionHeading` | `components/portfolio` & `components/ui` | Reused primitives/tokens (no palette or layout-style duplication) |

---

## 3. Project data source

**`resources/js/data/projects.ts`** (single source of truth, extended in this module):

- Preserved: `name`, `summary`, `status`, `focus`, and all five entries/statuses.
- Added: `slug`, `overview`, `purpose`, `techStack` (readonly string[]), `implemented` (ProjectPoint[]), `plannedScope` (ProjectPoint[]), `limitations` (string[]).
- Helper: `getProjectBySlug(slug)`.
- Types: `ProjectStatus`, `ProjectPoint`, `PortfolioProject`.

**Content rules applied:**
- **Statuses preserved:** AI Kids Video Factory — Planned; Scholarship Tracker — Planned; IIUC Tower ERP — Planned; ApplyMate — Planned; IT Assistance BD Portfolio — In Progress.
- **Technology stack:** listed only when verified. IT Assistance BD Portfolio lists the verified stack (Laravel 12, Vue 3, TypeScript, Vite, Tailwind CSS 4, Vue Router, Pinia). The four planned initiatives list no assumed stack.
- **Implemented vs planned:** shown in separate sections. Planned initiatives have no confirmed implementation; planned items are labelled as planned scope. IT Assistance BD Portfolio lists confirmed foundation/layout/page work (including this module) separately from further approved modules (planned).
- **Limitations:** each entry states relevant caveats (planned/unverified status, static/no-CMS content, no backend contact/integrations, no demos/repos/screenshots where applicable).
- No fabricated completion, features, screenshots, results, clients, testimonials or metrics.

---

## 4. Status/content limitations

- Four initiatives remain **Planned** with conservative, high-level scope; their stacks, modules and timelines are unconfirmed.
- IT Assistance BD Portfolio is **In Progress**; content is static/file-based and managed in code, not via CMS/database.
- No public demo URLs, repositories, screenshots, client references, testimonials or outcome metrics are provided for any project.
- Detail copy is intentionally neutral and should be refined only when the Project Owner confirms verified facts.

---

## 5. Tests and verification results (2026-11-15)

| Check | Result |
|---|---|
| `npm run type-check` | Exit **0** (`vue-tsc --noEmit`) |
| `npm run build` | Exit **0**, **88 modules**; CSS 38.83 kB (8.11 kB gzip); `ProjectDetailPage` 6.97 kB (2.30 kB gzip); dev-route strings absent from production JS chunks |
| `php artisan test` | **2 passed** (2 assertions) |
| HTTP direct loads | 200: `/`, `/about`, `/services`, `/projects`, `/contact`, all 5 detail slugs, `/projects/unknown-slug-test`, `/dev/ui`, `/dev/layout` |
| `/projects` | Listing intact (5 initiatives, status legend, cards link to detail routes) |
| Detail pages (verified DOM) | **Scholarship Tracker** (Planned), **IIUC Tower ERP** (Planned), **ApplyMate** (Planned), **IT Assistance BD Portfolio** (In Progress, verified tech stack shown), **unknown slug** (not-found state) — correct titles, h1, status, sections (overview/purpose/stack/confirmed work/planned scope/limitations/actions), back-to-projects and contact CTAs, 1 main landmark |
| AI Kids Video Factory | Direct-load HTTP 200 confirmed; responsive checks passed (h1 present, no overflow). A final DOM snapshot was not captured because the dev server was stopped before that specific check completed (see Known issues). Data/template is equivalent to other planned entries. |
| Navigation | Card → detail (ApplyMate), detail → Projects, browser back/forward, detail → Contact CTA all verified with correct URLs/titles/h1s |
| Keyboard | Project card link focusable and activatable (navigated to detail) |
| Unknown slug | `/projects/unknown-slug-test` → “Project not found — IT Assistance BD”, clear message, Back to projects and Contact links |
| Responsive (360, 390, 768, 1024, 1440) | 35 checks across `/projects`, 5 detail paths, unknown slug — **0 overflow**, h1 present in all cases |
| Console | **0 errors** (checked during navigation) |
| Lighthouse | Detail (`/projects/it-assistance-bd-portfolio`): accessibility **1.00**, best practices **1.00**, SEO **1.00** (re-audit). Unknown slug: **1.00 / 1.00 / 1.00**. An earlier detail audit reported a transient `landmark-one-main` failure (0.93) not reproduced on re-audit (single `<main>` present). |
| Existing routes | `/`, `/about`, `/services`, `/contact`, `/dev/ui`, `/dev/layout` returned 200 after changes |

---

## 6. Known issues

- **AI Kids Video Factory DOM snapshot:** the final in-browser DOM content check for `/projects/ai-kids-video-factory` was interrupted when servers were stopped (a `browser.navigate` call was cancelled). Direct HTTP 200 and responsive rendering (h1 present, no overflow at all target widths) were confirmed; the page uses the same data-driven template and planned-entry structure as the other fully verified planned initiatives.
- **Verification tooling:** some long-running combined browser evaluate runs timed out or conflicted when executed in parallel against the same tab; checks were re-run in smaller, sequential batches. Results above reflect completed, observed checks only.
- Non-blocking environment notes unchanged: `php artisan serve` `PHP_CLI_SERVER_WORKERS` notice; npm `allow-scripts` esbuild warning.

---

## 7. Not done (by design)

- No Installation 10 work, no new project initiatives, no status changes, no fabricated content, no screenshots/demo/repo links, no CMS/database/auth/contact-backend, no palette or unrelated UI changes.
