# OPEN ISSUES — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Purpose:** Consolidated outstanding issues, known limitations, owner actions, deferred tasks, and pending verification items.

## Status labels
- **Open** — active issue/limitation requiring attention
- **Pending owner** — blocked or awaiting Project Owner decision/action
- **Pending verification** — needs confirmation/testing/evidence
- **Deferred** — intentionally postponed
- **Resolved** — addressed (keep briefly for traceability if useful)

---

## 1. Outstanding issues

| ID | Item | Type | Related module/doc | Resolution status | Notes |
|---|---|---|---|---|---|
| OI-001 | No verified application defects currently open from Installation 10 QA | Issue tracking | [PORTFOLIO_QA_REPORT.md](PORTFOLIO_QA_REPORT.md), [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md) | **Resolved/None open** | Future issues must be recorded with evidence, scope, and fix status. |

## 2. Known limitations

| ID | Limitation | Related module/doc | Resolution status | Notes |
|---|---|---|---|---|
| KL-001 | Content is static/file-based (`resources/js/data/*`), not CMS/database-driven | 07–10, [ARCHITECTURE.md](ARCHITECTURE.md), [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) | **Open** | Owner-confirmed content changes require code/data edits until an approved content system exists. |
| KL-002 | Project statuses/details are conservative placeholders pending owner confirmation (4 Planned, 1 In Progress) | 07,09,10 | **Pending owner** | Update only with verified/approved facts. |
| KL-003 | Contact limited to mailto email; no verified phone/social links and no backend contact form/message storage | 07,08,10 | **Open (by design)** | Email currently `hmforkan99@gmail.com` pending confirmation; no unverified channels may be added. |
| KL-004 | No demo URLs, repositories, screenshots, testimonials, client references, or outcome metrics available | 07,09,10 | **Pending owner** | Add only when verified assets/links are supplied and approved. |
| KL-005 | Database is scaffold SQLite; MariaDB not connected for app data; Git repo not initialized | 01,02,10 | **Deferred/Pending owner** | Requires owner decisions and approved modules. |
| KL-006 | Dev showcase routes (`/dev/ui`, `/dev/layout`) exist for local/dev use (guarded from prod bundle) | 05,06,10 | **Deferred** | Retirement timing is an owner decision. |
| KL-007 | Unused scaffold artifacts retained (`resources/js/app.js`, `bootstrap.js`, `PlaceholderPage.vue`, scaffold sqlite, etc.) | 03,07,10 | **Deferred** | Remove only with explicit approval and verification. |
| KL-008 | Local dev/verification via Vite + `artisan serve`; no production hosting/deployment executed or validated | 10, [DEPLOYMENT.md](DEPLOYMENT.md) | **Open** | Deployment planning documented; execution requires approval. |
| KL-009 | QA baseline is evidence-based but not exhaustive cross-browser/device lab or production hosting validation | 10, [QA_STRATEGY.md](QA_STRATEGY.md) | **Open** | Extend checks as needed for future approved releases. |
| KL-010 | Non-blocking environment/tooling notes: `PHP_CLI_SERVER_WORKERS` notice on `artisan serve`, stale `public/hot` risk after interrupted dev server, npm esbuild allow-scripts warning | 01–10 | **Open (non-blocking)** | Operational awareness; not verified as app defects. |
| KL-011 | SEO canonical/sitemap URLs are derived from `APP_URL` (currently `http://localhost`); production domain must be configured before public launch | 12, [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | **Pending owner** | Environment-aware implementation avoids inventing a domain; update `APP_URL` in production. |
| KL-012 | No verified OG image supplied; Twitter card uses `summary` (no image) and OG image omitted | 12 | **Pending owner** | Add only a verified image asset and update metadata if approved. |
| KL-013 | `ProfessionalService` schema omitted because verified business address/phone/hours are not available | 12 | **Open (by design)** | Can be added later with verified business details. |
| KL-014 | Lighthouse Performance score not obtainable in this environment (tool limitation); no numeric LCP/INP/TBT/Speed Index recorded | 13, [PERFORMANCE_AUDIT_REPORT.md](PERFORMANCE_AUDIT_REPORT.md) | **Open (tooling limitation)** | Run real Lighthouse performance audit in production-like environment if required. |
| KL-015 | Mobile device emulation/network throttling not available; performance measurements are desktop only | 13, [PERFORMANCE_AUDIT_REPORT.md](PERFORMANCE_AUDIT_REPORT.md) | **Open (tooling limitation)** | Mobile performance inferred from responsive/bundle evidence only. |

## 3. Owner actions

| ID | Action required | Related module/doc | Resolution status | Priority |
|---|---|---|---|---|
| OA-001 | Approve Installation 11 documentation baseline (or request revisions) | [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md), [MODULE_REGISTRY.md](MODULE_REGISTRY.md), [README.md](README.md) | **Pending owner** | High |
| OA-002 | Approve Installation 12 SEO/performance/production-readiness baseline (or request revisions) | [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | **Pending owner** | High |
| OA-003 | Approve Installation 13 performance audit baseline (or request revisions) | [PERFORMANCE_AUDIT_REPORT.md](PERFORMANCE_AUDIT_REPORT.md) | **Pending owner** | High |
| OA-004 | Confirm production domain and update `APP_URL`/canonical/sitemap references before public launch | [DEPLOYMENT.md](DEPLOYMENT.md), [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | **Pending owner** | High |
| OA-003 | Review/confirm public copy, project statuses, and verified technology stacks/details (`resources/js/data/*`) | [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) | **Pending owner** | High |
| OA-004 | Confirm or replace public contact email and supply verified social/profile URLs (if any) | [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md), `resources/js/data/site.ts` | **Pending owner** | High |
| OA-005 | Decide MariaDB database name/user/config strategy and approve database module | [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md), [ROADMAP.md](ROADMAP.md) | **Pending owner** | Medium |
| OA-006 | Approve Git repository initialization and conventions | [ROADMAP.md](ROADMAP.md) | **Pending owner** | Medium |
| OA-007 | Decide deployment target/method and approve deployment execution module (if desired) | [DEPLOYMENT.md](DEPLOYMENT.md) | **Pending owner** | Medium |
| OA-008 | Decide when to retire `/dev/ui` and `/dev/layout` and whether to remove unused scaffold artifacts | [ARCHITECTURE.md](ARCHITECTURE.md), [ROADMAP.md](ROADMAP.md) | **Pending owner** | Low |
| OA-009 | Optional: approve PHP/runtime tuning for future media features (`gd`, upload limits) with backups | [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md) | **Pending owner** | Low |

## 4. Deferred tasks

| ID | Task | Related module/doc | Resolution status | Dependency/decision |
|---|---|---|---|---|
| DT-001 | MariaDB connection/switch and app database schema work | 01,02, [ROADMAP.md](ROADMAP.md) | **Deferred** | Owner DB decisions + approved module |
| DT-002 | Git initialization and first commit | [ROADMAP.md](ROADMAP.md) | **Deferred** | Owner approval |
| DT-003 | Deployment to cPanel/shared hosting (execution) | [DEPLOYMENT.md](DEPLOYMENT.md) | **Deferred** | Owner hosting/config approval + approved module |
| DT-004 | Dev showcase route/artifact cleanup | 05,06,10 | **Deferred** | Owner approval and safe timing |
| DT-005 | Future feature modules (SEO implementation, CMS/auth, contact backend, etc.) | [ROADMAP.md](ROADMAP.md) | **Deferred** | Explicit owner approval/spec per module |

## 5. Pending verification

| ID | Item | Related module/doc | Resolution status | Notes |
|---|---|---|---|---|
| PV-001 | Public contact email correctness/ownership for production use | [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) | **Pending verification (owner)** | Currently recorded as sourced from Git identity in docs; must be owner-confirmed. |
| PV-002 | Accuracy of all project descriptions/statuses/tech stacks for public publishing | [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md), `data/projects.ts` | **Pending verification (owner)** | Conservative placeholders until confirmed. |
| PV-003 | Any future social/profile URLs, assets, or external links before publication | [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) | **Pending verification (owner)** | None currently verified/supplied. |
| PV-004 | Production hosting behavior (SPA fallback, HTTPS, permissions, performance) when deployment is performed | [DEPLOYMENT.md](DEPLOYMENT.md), [QA_STRATEGY.md](QA_STRATEGY.md) | **Pending verification** | Not yet deployed/tested in production. |