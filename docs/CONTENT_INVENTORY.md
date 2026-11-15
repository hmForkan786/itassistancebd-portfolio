# CONTENT INVENTORY — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Primary sources:** `resources/js/data/site.ts`, `services.ts`, `projects.ts`, `skills.ts`, `resources/js/components/layout/navigation.ts`, `resources/js/router/index.ts`, `resources/views/app.blade.php`

---

## 1. Pages and routes

| Page | Route | Name | Title (as implemented) | Key content blocks | Confirmation status |
|---|---|---|---|---|---|
| Homepage | `/` | `app.home` | IT Assistance BD — Digital Solutions Developer & Creative Problem Solver | Hero (`home`), About (`about`), Services (`services`), Projects (`projects`), Skills (`skills`), Contact (`contact`) sections | Structure/layout implemented; copy/statuses/email require owner confirmation where noted |
| About | `/about` | `app.about` | About — IT Assistance BD | Intro/availability, background/approach/focus points, relevant skills, CTAs | Factual baseline; owner review recommended |
| Services | `/services` | `app.services` | Services — IT Assistance BD | Intro, 7 service categories, contact CTA | Categories/descriptions present; no pricing/guarantees (intentional) |
| Projects | `/projects` | `app.projects` | Projects — IT Assistance BD | Intro/caveat, status legend, 5 initiative cards linking to details | Statuses and summaries conservative; owner confirmation needed |
| Project detail (dynamic) | `/projects/:slug` | `app.projects.detail` | `<Project name> — IT Assistance BD` or Project not found — IT Assistance BD | Status, focus, overview, purpose, tech stack, confirmed work, planned scope, limitations, CTAs | Data-driven; owner confirmation needed for facts/statuses/stacks |
| Contact | `/contact` | `app.contact` | Contact — IT Assistance BD | Invitation, verified email/mailto CTA, instructions/notes (no backend form/phone/social) | Email source recorded in docs but owner confirmation/replacement pending |
| Unknown project slug | `/projects/<unknown>` (resolved by detail route) | — | Project not found — IT Assistance BD | In-page not-found message with navigation to Projects/Contact | Implemented behavior |
| Dev UI showcase (local/dev only) | `/dev/ui` | `dev.ui` (DEV) | Dev page title as rendered | UI component showcase | Internal tooling; not public content |
| Dev layout showcase (local/dev only) | `/dev/layout` | `dev.layout*` (DEV) | Dev page title as rendered | Layout verification inside shell | Internal tooling; not public content |

## 2. Navigation

| Location | Items (label → destination) | Notes |
|---|---|---|
| Header/Footer primary nav (`navigation.ts`) | Home → `/`; About → `/about`; Services → `/services`; Projects → `/projects`; Skills → `/#skills`; Contact → `/contact` | Shared source for header/footer. Page routes active by path; Skills is homepage hash/location on home. |
| Homepage in-page CTAs/anchors | Hero CTAs to `/#projects`, `/#contact`; section ids `home/about/services/projects/skills/contact`; mailto CTA in contact section | Hash-aware scrolling with sticky-header offset behavior implemented. |
| Project flows | Project cards link to `/projects/:slug`; detail pages include Back to Projects and Contact actions | Unknown slugs render in-page not-found. |

## 3. Services

| Service | Description (current) | Confirmation status |
|---|---|---|
| Web Application Development | Custom web applications tailored to business workflows and user needs. | Present in `services.ts`; owner review/confirmation recommended |
| Laravel Development | Backend development, APIs, and application features built with Laravel. | Present; owner review recommended |
| Vue.js Frontend Development | Interactive, component-based interfaces built with Vue.js and modern frontend tooling. | Present; owner review recommended |
| API Development & Integration | Design and integration of APIs to connect services, data, and applications. | Present; owner review recommended |
| WordPress Development | WordPress site setup, customization, and content-focused web solutions. | Present; owner review recommended |
| Digital Marketing | Practical digital marketing support to improve online visibility and reach. | Present; owner review recommended |
| Graphic Design | Visual design assets for web and digital communication needs. | Present; owner review recommended |

*No pricing, timelines, guarantees, or package claims are included.*

## 4. Projects and project detail pages

### 4.1 Summary inventory

| Project | Slug | Status (verified in data/UI) | Focus | Verified tech stack shown | Implemented work shown | Planned scope shown | Confirmation status |
|---|---|---|---|---|---|---|---|
| AI Kids Video Factory | `ai-kids-video-factory` | **Planned** | Content automation | None confirmed (explicitly stated) | None confirmed | Yes (template-based workflow; content preparation steps) | Status/scope conservative; owner confirmation required |
| Scholarship Tracker | `scholarship-tracker` | **Planned** | Education tools | None confirmed | None confirmed | Yes (as defined in `projects.ts`) | Owner confirmation required |
| IIUC Tower ERP | `iiuc-tower-erp` | **Planned** | Enterprise systems | None confirmed | None confirmed | Yes (as defined in `projects.ts`) | Owner confirmation required |
| ApplyMate | `applymate` | **Planned** | Career tools | None confirmed | None confirmed | Yes (as defined in `projects.ts`) | Owner confirmation required |
| IT Assistance BD Portfolio | `it-assistance-bd-portfolio` | **In Progress** | Portfolio | Laravel 12, Vue 3, TypeScript, Vite, Tailwind CSS 4, Vue Router, Pinia (verified) | Yes (confirmed foundation/layout/pages/detail/QA work as recorded) | Yes (further approved modules/work as recorded) | Factual to implemented baseline; future scope/status owner-gated |

> Exact overview/purpose/implemented/planned/limitation text is maintained in `resources/js/data/projects.ts` (single source of truth). No demo URLs, repositories, screenshots, client references, testimonials, or outcome metrics are recorded.

### 4.2 Detail page behavior
- Dynamic route `/projects/:slug` renders project detail when slug matches; otherwise renders in-page not-found state with links to Projects and Contact.
- Detail pages distinguish confirmed work from planned scope and state limitations/caveats.

## 5. Skills and profile content

| Group / area | Items (current) | Source | Confirmation status |
|---|---|---|---|
| Profile/capabilities | IT Assistance BD; role/intro/availability; capability chips (as in `site.ts`) | `site.ts` | Owner review recommended |
| Focus/about points | Development, problem solving, business/management, remote collaboration (as in data) | `site.ts`, pages | Owner review recommended |
| Skills/tools groups | 9 verified tools grouped into 3 areas (no proficiency/percentage bars) | `skills.ts` | Owner confirmation recommended |

## 6. Contact information

| Item | Current value/state | Source | Confirmation status |
|---|---|---|---|
| Public email | `hmforkan99@gmail.com` | `site.ts` (sourced from Git identity recorded in docs) | **Pending owner confirmation/replacement** |
| Mailto CTA | `mailto:hmforkan99@gmail.com` (including subject-encoded variant in UI) | Home/Contact page components | Functional pattern implemented; address confirmation pending |
| Phone | None shown | — | Not verified/supplied |
| Social/profile URLs | None shown | — | Not verified/supplied |
| Backend contact form / message storage | None | — | Not implemented (intentional) |
| Contact notes | States no verified phone/social for site and that email action opens mail app / no message sent or stored by website | Contact/Home UI text | Implemented; keep aligned with verified facts |

## 7. Missing owner-supplied information

- Confirmation/replacement of public contact email and any verified social/profile URLs.
- Confirmation of project statuses, descriptions, verified technology stacks, and any approved detail updates in `projects.ts`.
- Any verified demo URLs, repositories, screenshots, case-study assets, client references, testimonials, or outcome metrics (none should be added without verification).
- Finalized public copy approval for all pages/sections.
- Deployment/domain/environment decisions and any future feature requirements (CMS, auth, contact backend, SEO scope) if/when approved.