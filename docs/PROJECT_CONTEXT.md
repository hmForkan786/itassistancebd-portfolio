# PROJECT CONTEXT — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Verified context baseline (Installations 01–10 complete; Installation 11 documentation completed, awaiting owner approval)

---

## 1. Purpose

Build and maintain a professional, factual public portfolio for **IT Assistance BD** that presents services, skills, and selected project initiatives with honest status, clear navigation, responsive/accessible UI, and maintainable code/documentation. The project follows an incremental, owner-approved module workflow.

## 2. Audience

- **Primary:** Prospective clients, collaborators, and visitors evaluating IT Assistance BD’s capabilities and initiatives.
- **Secondary:** Project Owner (content/approval decisions) and future coding agents/contributors who must understand current state quickly and safely.

## 3. Brand

- **Name:** IT Assistance BD
- **Positioning (as implemented):** Digital Solutions Developer & Creative Problem Solver (portfolio of web development, API integration, WordPress, digital marketing, and graphic design capabilities, with selected initiatives and skills).
- **Visual identity:** Approved Tailwind 4 design tokens (emerald/green brand palette, slate/neutral surfaces, Inter/Plus Jakarta Sans/Noto Sans Bengali typography, consistent spacing/radius/shadows). Brand tokens/palette must not change without Project Owner approval.
- **Tone:** Professional, clear, factual, and conservative (no hype, no fabricated claims).

## 4. Business goals

- Present IT Assistance BD credibly and clearly.
- Showcase verified skills/services and initiative portfolio with honest status distinctions.
- Provide a simple, verified contact path (email) without implying unverified channels or backend capabilities.
- Establish a maintainable, documented foundation for future approved enhancements (e.g., content refinement, SEO, deployment, database/CMS/auth/features) under owner approval.

## 5. Current product scope (approved and implemented)

- Laravel 12 application shell with Vue 3 + TypeScript + Vite SPA frontend.
- Tailwind 4 CSS-first design system and reusable accessible UI primitives/layout.
- Public pages/routes: `/` (homepage with hero/about/services/projects/skills/contact sections), `/about`, `/services`, `/projects`, `/projects/:slug` (5 initiatives + in-page unknown-slug handling), `/contact`.
- Data-driven static content in `resources/js/data/*` (site, services, projects, skills).
- Local/dev-only showcase routes (`/dev/ui`, `/dev/layout`) guarded from production bundle.
- Integrated QA/content verification completed (Module 10) with documented evidence.

See [ARCHITECTURE.md](ARCHITECTURE.md), [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md), [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md), and [PORTFOLIO_QA_REPORT.md](PORTFOLIO_QA_REPORT.md).

## 6. Approved constraints

- Work only within project root; no destructive/broad cleanup; no changes outside root.
- Preserve historical reports and approved modules; no application source changes for documentation-only modules unless explicitly required.
- No new packages/features/scope expansion without Project Owner approval.
- No fabrication of contact details, social URLs, statuses, achievements, metrics, clients, testimonials, screenshots, demo/repo links, or deployment claims.
- Documentation-first, evidence-based workflow with owner approval gates and stop-after-completion behavior.

## 7. Owner responsibilities

- Approve modules/specifications and the next installation/module to start.
- Review and confirm public copy, project statuses, verified tech stacks, and initiative details.
- Confirm or replace the public contact email and supply verified social/profile URLs (if desired).
- Decide/approve infrastructure and product decisions: MariaDB connection details and database module, Git initialization, deployment targets/configuration, cleanup/retirement of unused/dev artifacts, and any future features (CMS, auth, contact backend, SEO, etc.).
- Validate that no unverified claims are published.