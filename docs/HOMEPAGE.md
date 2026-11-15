# HOMEPAGE — IT Assistance BD Portfolio

**Module:** 07 — Portfolio Homepage Foundation
**Verified:** 2026-11-15
**Location:** `resources/js/pages/HomePage.vue`, `resources/js/data/`, `resources/js/components/portfolio/`

The public landing page for IT Assistance BD, rendered inside the approved `PortfolioLayout`. It presents a professional, factual profile: no invented metrics, clients, testimonials, ratings, employment statistics, pricing, guarantees, demo URLs, repositories or contact details beyond the verified email.

---

## 1. Section structure

The page is one component (`HomePage.vue`) composed from `BaseContainer`, `SectionHeading`, `BaseCard`, `BaseBadge` and small portfolio components. Sections appear in order:

| # | Section | `id` | Purpose |
|---|---|---|---|
| 1 | Hero | `home` | Name, role, introduction, capability chips, primary/secondary CTAs, focus card |
| 2 | About | `about` | Concise professional introduction across four practice points |
| 3 | Services | `services` | Seven service categories with short descriptions |
| 4 | Projects | `projects` | Five initiatives with explicit status labels and a status legend |
| 5 | Skills | `skills` | Nine verified tools grouped into three areas (no proficiency levels) |
| 6 | Contact | `contact` | Invitation and a verified email `mailto:` link (no backend form) |

The page renders a single `<h1>` in the hero (`Digital Solutions Developer & Creative Problem Solver`). Section headings are `<h2>` elements and card titles are `<h3>`, so the document outline never skips levels.

---

## 2. Content data organization

Presentation is separated from copy. All homepage content lives in typed, commented modules under `resources/js/data/`:

| File | Exports | Notes |
|---|---|---|
| `site.ts` | `site`, `focusAreas`, `aboutPoints` | Profile (name, role, intro, availability, verified `email`, capability chips) and the About/focus cards. The email is the project owner's Git identity recorded in `docs/INSTALLATION_REPORT.md` — the only verified address in the project. |
| `services.ts` | `services` (`Service[]`) | Seven categories: title + one-sentence description. No pricing, timelines or guarantees. |
| `projects.ts` | `ProjectStatus`, `PortfolioProject`, `projects` | Five initiatives with name, neutral summary, focus and an explicit status. No demo URLs, repositories, screenshots or client information. |
| `skills.ts` | `skillGroups` (`SkillGroup[]`) | The nine supplied skills grouped by area. No percentages or self-assigned levels. |

Editing copy means editing these data files; `HomePage.vue` and the card components do not contain business copy strings (aside from structural labels such as "Initiative" and the contact note).

---

## 3. Project status definitions

Every project card shows a text badge — colour is never the only signal.

| Status | Badge variant | Meaning |
|---|---|---|
| **Completed** | success (green) | Work finished and delivered/usable as stated |
| **In Progress** | primary (emerald) | Actively being worked on |
| **Prototype** | warning (amber) | An exploratory or proof-of-concept build |
| **Planned** | neutral (slate) | Intended/outlined, not yet built |

**Current entries (conservative, verifiable from this build):**

| Initiative | Status | Focus | Rationale |
|---|---|---|---|
| AI Kids Video Factory | Planned | Content automation | Initiative named in the brief; no confirmed build state |
| Scholarship Tracker | Planned | Education tools | Initiative named in the brief; no confirmed build state |
| IIUC Tower ERP | Planned | Enterprise systems | Initiative named in the brief; no confirmed build state |
| ApplyMate | Planned | Career tools | Initiative named in the brief; no confirmed build state |
| IT Assistance BD Portfolio | In Progress | Portfolio | This site is actively being built in the current installation sequence |

Statuses must be updated in `data/projects.ts` only when the Project Owner confirms a real change of state.

---

## 4. Component reuse

| Component | File | Reused from / role |
|---|---|---|
| `PortfolioLayout` | `layouts/PortfolioLayout.vue` | Shell (header, main, footer) — unchanged |
| `BaseContainer` | `components/ui` | Page/wide/narrow content shells |
| `SectionHeading` | `components/ui` | Eyebrow + `<h2>` + description blocks |
| `BaseCard` | `components/ui` | Surfaces for focus, about points, services, projects, skill groups, contact |
| `BaseBadge` | `components/ui` | Hero capability chips, project statuses, status legend |
| `BaseButton` | `components/ui` | Available in the barrel; navigation CTAs use `CtaLink` (links, not buttons) |
| `CtaLink` | `components/portfolio/CtaLink.vue` | Real `<RouterLink>`/`<a>` styled to match `BaseButton` for "View projects", "Contact", "Email" |
| `ServiceCard` | `components/portfolio/ServiceCard.vue` | One service entry (decorative index, title, description) |
| `ProjectCard` | `components/portfolio/ProjectCard.vue` | One initiative (status badge, focus, name, summary, honest note) |
| `SkillItem` | `components/portfolio/SkillItem.vue` | One skill chip (text label only) |

`CtaLink` exists because `BaseButton` renders a native `<button>` and must not be wrapped in an anchor; it keeps CTA semantics correct while matching the design system.

---

## 5. Navigation and section IDs

The header/footer navigation (shared `mainNavigation`) already targets:

| Label | Destination | Section id |
|---|---|---|
| Home | `/` | `home` (hero) |
| About | `/#about` | `about` |
| Services | `/#services` | `services` |
| Projects | `/#projects` | `projects` |
| Skills | `/#skills` | `skills` |
| Contact | `/#contact` | `contact` |

- `resources/js/router/index.ts` now renders `HomePage` as the `/` child of `PortfolioLayout`.
- `scrollBehavior` restores saved position, scrolls to an existing hash target with `top: 80` (sticky header offset), else scrolls to top.
- `resources/css/base.css` sets `scroll-padding-top: 5rem`, keeping anchor targets clear of the sticky header on non-router navigation as well.
- CTAs: "View projects" → `/#projects`, "Contact" → `/#contact`, "Email IT Assistance BD" → `mailto:hmforkan99@gmail.com?subject=Portfolio%20enquiry%20%E2%80%94%20IT%20Assistance%20BD`.

No separate About/Services/Projects/Skills/Contact routes were created.

---

## 6. SEO and metadata

Updated in `resources/views/app.blade.php` (Vite integration preserved, `lang` unchanged):

- **Title:** `IT Assistance BD — Digital Solutions Developer & Creative Problem Solver`
- **Meta description:** `Portfolio of IT Assistance BD: Laravel and Vue web development, API integration, WordPress, digital marketing and graphic design, with selected project initiatives and skills.`

Both are factual and make no claims about clients, ratings or outcomes. No sitemap, structured data or advanced SEO infrastructure was added.

---

## 7. Responsive behaviour

- Fluid type, spacing and container tokens from the design system; grids use `sm:grid-cols-2` / `lg:grid-cols-3` (and `lg:grid-cols-12` splits for hero/about/contact) so layouts reflow without bespoke breakpoints.
- Hero stacks on mobile and becomes a 7/5 column split at `lg`; service/project cards flow 1→2→3 columns; skill groups stack then form three columns.
- Measured at **360, 390, 768, 1024, 1440 px**: all six sections present, 7 service cards, 5 project cards, 3 skill groups, **no horizontal overflow** at any target width.

---

## 8. Verification evidence (2026-11-15)

| Check | Result |
|---|---|
| `npm run type-check` | Exit **0** (after fixing an unused `headingId` binding in `ServiceCard.vue`) |
| `npm run build` | Exit **0**, **76 modules**, CSS **38.64 kB** (8.08 kB gzip), `HomePage` chunk **14.93 kB** (5.11 kB gzip), app JS 101.48 kB |
| `php artisan test` | **2 passed** (2 assertions) |
| HTTP / metadata | `/` 200; `<title>` and `<meta name="description">` present and correct |
| Sections | `home`, `about`, `services`, `projects`, `skills`, `contact` all present |
| Navigation hashes | Direct navigation to `/`, `/#about`, `/#services`, `/#projects`, `/#skills`, `/#contact` settled with target section top **80px** and correct `aria-current` (`page` / `location`) |
| CTAs | "View projects" → `/#projects` (top 80px); "Contact" → `/#contact` (top 80px); email link `mailto:hmforkan99@gmail.com?subject=Portfolio%20enquiry%20%E2%80%94%20IT%20Assistance%20BD` |
| Content accuracy | 5 projects (4× Planned, 1× In Progress) with honest notes; 7 services; 3 skill groups / 9 skills; 4 about points; no `%` proficiency text; no backend form in contact |
| Responsive | 360/390/768/1024/1440: 6 sections, 7/5/3 cards, **no horizontal overflow** |
| Console | **0 errors** |
| Lighthouse | Accessibility **1.00**, Best Practices **1.00**, SEO **1.00** |

**Fix during verification:** the contact email link inherited `#059669` (3.76:1 on white at 14px); changed to `text-primary-dark` (#047857) to meet contrast. Re-audit passed 1.00.

---

## 9. Known limitations

- No phone number, social links or contact form backend: none verified / out of scope. The contact CTA opens the visitor's mail client only.
- Project statuses and summaries are conservative placeholders derived from initiative names; they must be confirmed and refined by the Project Owner.
- No screenshots, demo URLs, repository links, case-study pages or testimonials are shown because none were supplied.
- Homepage content is static (data files), not database/CMS driven.
- The temporary `PlaceholderPage.vue` remains in the repo but is no longer routed as the home page.
- `php artisan serve` `PHP_CLI_SERVER_WORKERS` notice is unchanged and non-blocking.

---

## 10. Updating content

1. **Copy/profile/email:** edit `resources/js/data/site.ts`.
2. **Services:** edit the `services` array in `resources/js/data/services.ts`.
3. **Projects/statuses:** edit `resources/js/data/projects.ts` (keep statuses honest; remove "no public demo…" note in `ProjectCard.vue` only when a verified link is intentionally added to the data model).
4. **Skills:** edit `resources/js/data/skills.ts` (do not add percentage/proficiency fields).
5. Re-run `npm run type-check && npm run build` and spot-check the affected section.
