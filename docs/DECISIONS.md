# DECISIONS — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Scope:** Verified and owner-approved decisions recorded from completed modules/documentation. Proposed ideas are not decisions.

| Decision ID | Date (known) | Decision | Reason / evidence | Status | Scope affected | Superseded by |
|---|---|---|---|---|---|---|
| D-001 | 2026-11-15 | Target stack: Laravel 12 + Vue 3 + TypeScript + Vite + Tailwind 4 for the portfolio foundation | Established across approved Installations 02–04 and subsequent modules; verified in build/config/docs | Approved (implemented) | Architecture, frontend/backend integration, tooling | — |
| D-002 | 2026-11-15 | Preserve Module 01 documentation and install Laravel in project root without overwriting existing docs (staged install/move approach) | Installation 02 evidence (`LARAVEL_INSTALLATION.md`) | Approved (implemented) | Project setup, repository structure | — |
| D-003 | 2026-11-15 | Keep `.env` local/development configuration as scaffolded/adjusted (APP_NAME set), with `APP_KEY` generated; do not document secrets | Installation 02/03 evidence; security rule | Approved (implemented) | Application configuration | — |
| D-004 | 2026-11-15 | Use SPA architecture: Blade mount (`app.blade.php`) + Vue Router history mode + Laravel catch-all for public paths; local `/dev/*` guarded | Modules 03, 06, 08, 09; `routes/web.php`, router config | Approved (implemented) | Routing, UX, deployment requirements | — |
| D-005 | 2026-11-15 | Tailwind 4 CSS-first design system with `@theme static` tokens (no `tailwind.config.js`), self-hosted fonts, and approved brand palette preserved | Module 04 (`DESIGN_SYSTEM.md`), master rules | Approved (implemented) | Styling, UI consistency | — |
| D-006 | 2026-11-15 | Build reusable accessible UI primitives/layout shell and reuse them across pages (no duplicate systems) | Modules 05–09 | Approved (implemented) | Components, maintainability | — |
| D-007 | 2026-11-15 | Primary navigation uses page routes for About/Services/Projects/Contact and homepage hash for Skills; homepage section hashes remain supported | Modules 06–08 (`navigation.ts`, router/header/footer behavior) | Approved (implemented) | Navigation, IA | Refines earlier hash-only primary nav behavior from Module 06 |
| D-008 | 2026-11-15 | Public contact method limited to verified email/mailto with clear context notes; no backend form, phone, or unverified social links | Modules 07–08, QA; `site.ts`, contact/home content | Approved (implemented) | Content, privacy/accuracy | — |
| D-009 | 2026-11-15 | Project initiatives presented with honest statuses and data-driven detail pages; planned items separated from confirmed/implemented work; unknown slug handled in-page | Modules 07, 09; `projects.ts`, `ProjectDetail*` | Approved (implemented) | Portfolio content model, trust/accuracy | — |
| D-010 | 2026-11-15 | Dev showcase routes (`/dev/ui`, `/dev/layout`) allowed in local/dev contexts but excluded from production bundle; retirement deferred to owner decision | Modules 05, 06, 10 | Approved (implemented) | Developer tooling, production hygiene | — |
| D-011 | 2026-11-15 | Database remains scaffold SQLite for now; MariaDB connection/use deferred pending owner approval/decisions | Modules 01–02, status docs | Approved (deferred decision) | Data persistence, future backend | — |
| D-012 | 2026-11-15 | Git repository initialization deferred pending owner approval | Status/registry open items | Approved (deferred decision) | Version control workflow | — |
| D-013 | 2026-11-15 | Incremental module workflow with evidence, documentation updates, and owner approval gate between modules; stop after each module | Master rules, all module reports, AGENTS workflow | Approved (process) | Delivery process | — |
| D-014 | 2026-11-15 | Documentation system established as centralized Markdown source-of-truth set with preserved historical reports and token-efficient agent reading order | Installation 11 outputs (`PROJECT_MASTER_RULES.md`, `AGENTS.md`, `docs/*`) | Completed, awaiting owner approval | Documentation, agent efficiency | — |
| D-015 | 2026-11-15 | SEO implementation uses environment-aware canonical/sitemap URLs (derived from `APP_URL`/runtime origin) rather than hard-coding an unconfirmed production domain; per-route metadata and JSON-LD use verified facts only; sitemap is a Laravel route; robots.txt and .htaccess updated for safety/performance without changing SPA fallback | Installation 12 audit/implementation (`app.blade.php`, router, `routes/web.php`, `public/robots.txt`, `public/.htaccess`) | Completed, awaiting owner approval | SEO, routing, deployment readiness | — |

## Notes
- Dates reflect the verified documentation date recorded in project docs (2026-11-15) where earlier per-decision dates are not separately recorded.
- Only verified/implemented or explicitly deferred owner-gated decisions are listed. Roadmap items remain proposed/pending unless separately approved.