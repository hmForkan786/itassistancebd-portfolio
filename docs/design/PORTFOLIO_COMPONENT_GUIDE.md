# Portfolio Component Guide — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## UI primitives (`components/ui/`)

`BaseButton`, `BaseContainer`, `SectionHeading`, `BaseCard`, `BaseBadge`, `BaseInput`, `BaseTextarea`, `BaseSelect`, `BaseModal` — plus `types.ts`, `field-styles.ts`, `index.ts`. Import from `@/components/ui`.

## Layout (`components/layout/`)

`AppHeader.vue`, `AppFooter.vue`, `navigation.ts` (shared nav config).

## Portfolio (`components/portfolio/`)

- `CtaLink.vue` — real `<RouterLink>`/`<a>` styled like `BaseButton`.
- `ServiceCard.vue` — one service entry.
- `ProjectCard.vue` — one initiative card with status badge and detail link.
- `ProjectDetail.vue` — reusable detail view (status, overview, purpose, stack, confirmed work, planned scope, limitations, CTAs).
- `SkillItem.vue` — one skill chip.
- `AchievementStats.vue` — verified metrics only; hidden when empty (shows derived technologies count).
- `Testimonials.vue` — approved testimonials only; hidden when empty.
- `WorkProcess.vue` — 6 factual engagement steps.
- `Faq.vue` — factual Q&A using native `<details>`.
- `ContactForm.vue` — client-side form with mailto fallback (no backend).

## Composables (`composables/`)

- `useScrollReveal.ts` — IntersectionObserver-based scroll reveal; respects reduced-motion.

## Data (`data/`)

- `site.ts` — profile, capabilities, focus/about points, verified email.
- `services.ts` — 7 service categories.
- `projects.ts` — 5 initiatives with status, overview, purpose, stack, implemented/planned, limitations.
- `skills.ts` — 3 skill groups / 9 tools.
- `stats.ts` — verified metrics (empty) + derived technologies count.
- `testimonials.ts` — approved testimonials (empty).

## Pages (`pages/`)

`HomePage.vue`, `AboutPage.vue`, `ServicesPage.vue`, `ProjectsPage.vue`, `ProjectDetailPage.vue`, `ContactPage.vue`, `PlaceholderPage.vue` (retained, not routed), `ComponentShowcasePage.vue`, `LayoutShowcasePage.vue` (dev-only).

## Layouts

`PortfolioLayout.vue` — public shell (skip link, header, main, footer).

## Conventions

- Primitives use `Base*` prefix; compose in feature components.
- Props camelCase in script, kebab-case in templates; typed with JSDoc.
- Styling via design tokens only; no hard-coded hex; no arbitrary values.
- One component per file, PascalCase filename.
- Import primitives from `@/components/ui`; never deep-import `.vue`.
- Add `data-reveal` attribute to elements for scroll-reveal animation.