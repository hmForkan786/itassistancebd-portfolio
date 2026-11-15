# SECONDARY PAGES — IT Assistance BD Portfolio

**Module:** 08 — Portfolio Secondary Pages Foundation
**Verified:** 2026-11-15
**Location:** `resources/js/pages/`, `resources/js/router/index.ts`, `resources/js/components/layout/`

Dedicated public pages for About, Services, Projects and Contact, rendered inside the existing `PortfolioLayout` and built from the approved design tokens, UI primitives and shared homepage data. No admin CMS, authentication, backend contact form, database-driven content or new business logic was added.

---

## 1. Page structure

| Route | Page component | `h1` | Key content |
|---|---|---|---|
| `/about` | `AboutPage.vue` | About | Intro and availability; background/approach points (`aboutPoints`, `focusAreas`) covering development, problem solving, business/management and remote collaboration; relevant skills (`skillGroups` via `SkillItem`); CTAs to Contact and Projects |
| `/services` | `ServicesPage.vue` | What I work on | Intro; all 7 service categories from `data/services.ts` via `ServiceCard`; CTAs to Contact. No pricing, guarantees or invented packages |
| `/projects` | `ProjectsPage.vue` | Initiatives in focus | Intro with honest caveat; status legend (Completed, In Progress, Prototype, Planned); all 5 initiatives from `data/projects.ts` via `ProjectCard`; CTA to Contact. No demo links or screenshots |
| `/contact` | `ContactPage.vue` | Get in touch | Invitation; verified email from `site` data with `mailto:` CTA and visible address; clear instructions/notes. No backend form, no phone, no social URLs, no delivery claim |

All pages use `BaseContainer`, `SectionHeading`, `BaseCard`/`BaseBadge` and portfolio components where appropriate, follow the existing section/container rhythm, and keep content factual.

---

## 2. Route configuration

**Frontend (`resources/js/router/index.ts`):** nested children of the `/` `PortfolioLayout` record:

| Path | Name | Meta title |
|---|---|---|
| `` (index) | `app.home` | IT Assistance BD — Digital Solutions Developer & Creative Problem Solver |
| `about` | `app.about` | About — IT Assistance BD |
| `services` | `app.services` | Services — IT Assistance BD |
| `projects` | `app.projects` | Projects — IT Assistance BD |
| `contact` | `app.contact` | Contact — IT Assistance BD |

- `scrollBehavior` restores saved position, scrolls to an existing hash target at `top: 80`, else scrolls to top.
- `router.afterEach` sets `document.title` from `route.meta.title` where provided.
- Development routes `/dev/ui` and `/dev/layout` remain registered only under `import.meta.env.DEV`.

**Backend (`routes/web.php`):** history-mode SPA support for direct loads/refresh. The local-only `/dev/{path?}` route is registered before a catch-all `/{any?}` (excluding `dev/*`) that returns `app.blade.php`, so `/`, `/about`, `/services`, `/projects`, `/contact` all resolve to the Vue shell.

---

## 3. Shared data usage

No content was duplicated into page markup; pages import existing typed data/components:

| Page | Shared source |
|---|---|
| About | `site`, `aboutPoints`, `focusAreas` (`data/site.ts`), `skillGroups` (`data/skills.ts`), `SkillItem`, `CtaLink` |
| Services | `services` (`data/services.ts`), `ServiceCard`, `CtaLink` |
| Projects | `projects` (`data/projects.ts`), `ProjectCard`, `BaseBadge`, `CtaLink` |
| Contact | `site` (`data/site.ts`, verified `email`), `CtaLink` |

---

## 4. Navigation behavior

**`components/layout/navigation.ts`** now defines page routes for the four secondary pages and keeps Skills as a homepage anchor:

| Label | `to` | `path` | `hash` |
|---|---|---|---|
| Home | `/` | `/` | — |
| About | `/about` | `/about` | — |
| Services | `/services` | `/services` | — |
| Projects | `/projects` | `/projects` | — |
| Skills | `/#skills` | `/` | `#skills` |
| Contact | `/contact` | `/contact` | — |

- **Header/Footer** mark an item active when the current route path matches its page `path` (`aria-current="page"`), or on the homepage when its hash matches (`aria-current="location"` — used by Skills). Footer links mirror the same active state.
- **Secondary pages:** clicking a header/footer nav item navigates to the actual page and the correct item is active. Verified for `/about`, `/services`, `/projects`, `/contact`.
- **Homepage hash anchors:** `/#about`, `/#services`, `/#projects`, `/#skills`, `/#contact` continue to resolve on the home page and scroll to the target section with the 80px sticky-header offset. Because About/Services/Projects/Contact nav items now point to pages, those hashes do not highlight a page-based nav item while on the home hash; Skills remains a hash nav item and is highlighted at `/#skills`. Homepage in-page CTAs (e.g. hero View projects/Contact) remain functional.
- **Mobile menu:** disclosure panel closes on selection, on Escape (focus returns to the toggle), on route change and at the `lg` breakpoint (existing behaviour preserved).
- **History:** browser back/forward navigates between visited pages correctly.
- No duplicate or confusing navigation labels were introduced.

---

## 5. Component reuse

- Layout: `PortfolioLayout`, `AppHeader`, `AppFooter`, `BaseContainer`
- UI primitives: `SectionHeading`, `BaseCard`, `BaseBadge`
- Portfolio: `ServiceCard`, `ProjectCard`, `SkillItem`, `CtaLink`
- Data: `services.ts`, `projects.ts`, `site.ts`, `skills.ts`

No new UI primitives or packages were added; the approved palette and tokens are unchanged.

---

## 6. Content limitations

- All copy is factual and derived from existing verified data; no achievements, testimonials, clients, results, credentials, pricing, guarantees or invented packages.
- Projects remain initiatives with honest statuses (4 Planned, 1 In Progress) and no demo links/screenshots.
- Contact provides only the verified email (`hmforkan99@gmail.com`, as recorded in project docs) and mailto instructions; no phone, no social URLs, no on-site form, no message delivery.
- Skills shown on About are the existing verified tool list (no proficiency levels).
- Content is static/file-based, not CMS or database driven.

---

## 7. Verification results (2026-11-15)

| Check | Result |
|---|---|
| `npm run type-check` | Exit **0** |
| `npm run build` | Exit **0**, **84 modules**; CSS 38.69 kB (8.09 kB gzip); chunks `AboutPage` 3.54 kB, `ServicesPage` 1.90 kB, `ProjectsPage` 2.18 kB, `ContactPage` 3.02 kB, `HomePage` 6.59 kB |
| `php artisan test` | **2 passed** (2 assertions) |
| HTTP (direct) | `/`, `/about`, `/services`, `/projects`, `/contact`, `/dev/layout`, `/dev/ui` → **200** |
| Page content | Correct `h1`/title per route; About shows 3 skill groups + background/focus + contact/projects CTAs; Services shows 7 cards + contact CTA; Projects shows 5 cards + legend + contact CTA; Contact shows verified mailto/email, instructions, no form |
| Header/footer nav | Active states correct on `/`, `/about`, `/services`, `/projects`, `/contact` (header and footer) |
| Nav flow | Header clicks Home↔About↔Services↔Projects↔Contact navigate to actual pages with correct titles/active states |
| Back/forward | Browser history back/forward traversed visited pages correctly |
| Homepage hashes | `/#about`, `/#services`, `/#projects`, `/#skills`, `/#contact` scroll to targets at **80px** offset; `/#skills` marked active (`location`) |
| Mobile nav | 390px: toggle visible, panel opens/closes on selection (navigates and marks active), Escape closes panel and returns focus to toggle |
| Responsive | 360, 390, 768, 1024, 1440 × (`/`, `/about`, `/services`, `/projects`, `/contact`) — **no horizontal overflow** |
| Console | **0 errors** |
| Lighthouse (a11y / BP / SEO) | `/about` **1.00 / 1.00 / 1.00**; `/contact` **1.00 / 1.00 / 1.00** (0 failures) |
| Production bundle | Page chunks emitted (`AboutPage`, `ServicesPage`, `ProjectsPage`, `ContactPage`, `HomePage`); dev-only routes remain Vite-dev-guarded |
| Dev servers | Stopped (5173, 8129), tab closed, generated `public/hot` removed, `php artisan test` re-verified against build |

**Notes:** direct navigation to a page updates the document title via the router `afterEach` hook (verified in flow). Hash-on-home active highlighting is limited to the Skills item because other primary items are now page routes; scrolling/anchors remain functional.
