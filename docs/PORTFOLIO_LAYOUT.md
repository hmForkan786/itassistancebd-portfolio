# PORTFOLIO LAYOUT — IT Assistance BD Portfolio

**Module:** 06 — Portfolio Layout Foundation
**Verified:** 2026-11-15
**Location:** `resources/js/layouts/`, `resources/js/components/layout/`

The public application shell: sticky header with responsive navigation, flexible main region and dark footer. No homepage content, project cards, admin UI or business logic is part of this module.

---

## 1. Architecture

```
App.vue (RouterView)
└── PortfolioLayout.vue            route component for `/`
    ├── skip link → #main-content
    ├── AppHeader.vue              sticky header + navigation (desktop + mobile)
    ├── <main id="main-content">   flex-1, holds <RouterView />
    │   └── page component         (currently PlaceholderPage.vue)
    └── AppFooter.vue              dark footer + navigation + copyright
```

- `PortfolioLayout` is a **route component**, not a wrapper: it renders `<RouterView />` inside `<main>`, so future pages become children of the `/` route and inherit the shell automatically.
- The root column is `flex min-h-screen flex-col`; `<main>` is `flex-1` and the footer is `mt-auto`. Short pages therefore pin the footer to the viewport bottom, long pages push it after the content.
- Header, main and footer share the `container-page` utility (1280px cap, fluid gutters), so every edge aligns without nested containers.

---

## 2. Component responsibilities

| File | Responsibility |
|---|---|
| `layouts/PortfolioLayout.vue` | Shell: skip link, header, main landmark, footer, full-height column |
| `components/layout/AppHeader.vue` | Brand, desktop navigation, mobile disclosure, active state, Escape/focus handling |
| `components/layout/AppFooter.vue` | Brand, footer navigation, copyright row |
| `components/layout/navigation.ts` | Single source of truth for the six primary destinations |
| `pages/LayoutShowcasePage.vue` | Internal verification page rendered inside the real shell (dev only) |

The header and footer import the same `mainNavigation` array, so adding or renaming a destination is a one-line change and the two can never drift apart.

---

## 3. Router integration

```ts
{
    path: '/',
    component: () => import('@/layouts/PortfolioLayout.vue'),
    children: [{ path: '', name: 'app.home', component: () => import('@/pages/PlaceholderPage.vue') }],
}
```

- Public pages are added as further children of this record; they render inside the shell with no extra wiring.
- Existing development routes are untouched: `/dev/ui` (component showcase) and `/dev/layout` (this module's showcase) are top-level records inside `if (import.meta.env.DEV)`.
- `scrollBehavior` restores `savedPosition` on back/forward, scrolls to a hash target with a `top: 80` offset (sticky header) **only when that target exists**, and otherwise scrolls to the top. Missing section targets therefore do not throw or log warnings before Module 07 adds them.

### Adding a page

```ts
{
    path: 'contact',
    name: 'contact',
    component: () => import('@/pages/ContactPage.vue'),
}
```

The page component starts at `<section>` level (the layout already provides `<main>`).

### Adding a navigation item

```ts
// components/layout/navigation.ts
{ label: 'Blog', to: '/#blog', hash: '#blog' },
```

Header and footer pick it up automatically; active state follows the hash.

---

## 4. Navigation behaviour

**Destinations:** Home `/`, About `/#about`, Services `/#services`, Projects `/#projects`, Skills `/#skills`, Contact `/#contact`.

Section links are hash links on the homepage because the module forbids creating About/Services/… pages. When Module 07 adds sections with those ids, the links scroll to them with no further changes; until then they resolve to the homepage without dead routes.

**Active state**

- Home is active when the path is `/` and there is no hash (`aria-current="page"`).
- Section links are active when the current hash matches (`aria-current="location"`).
- Active styling is a soft surface fill plus `--color-primary-dark` text; no colour-only signal because `aria-current` is exposed simultaneously.
- On non-home routes (e.g. `/dev/layout`) no primary link is marked active.

**Desktop:** horizontal list, 4px gaps, 8/12px link padding, 14px label, visible from the `lg` breakpoint (1024px).

**Mobile:** a real `<button>` with `aria-expanded`, `aria-controls="mobile-navigation"` and a dynamic label ("Open main menu" / "Close main menu"). The panel is a disclosure below the header: 42px-tall full-width links, a 150ms fade/slide transition (disabled under reduced motion). It closes when:

1. a destination is selected (mouse or keyboard),
2. Escape is pressed — focus returns to the toggle,
3. the route changes (including browser back/forward),
4. the viewport crosses to the desktop breakpoint.

Focus is never moved automatically on open, so the toggle keeps a predictable position; Tab moves straight into the first link because the panel follows the button in DOM order.

---

## 5. Responsive behaviour

| Viewport | Header height | Navigation | Footer |
|---|---|---|---|
| 360 / 390 px | 65px (64 + border) | hamburger + panel | stacked brand → navigation |
| 768 px | 65px | hamburger + panel | brand and navigation side by side (`sm:flex-row`) |
| 1024 / 1440 px | 81px (80 + border) | full desktop nav | side by side, contained at 1280px |

- Container gutters: 16.6px at 360px, 22.7px at 768px, 32.8px at 1440px (fluid `--spacing-gutter`).
- Footer navigation is a two-column list on phones and a single column from `sm` upward.
- No horizontal scrollbar at any target width (verified in real 1440/1024/768/390/360px rendering contexts).

---

## 6. Accessibility

1. **Landmarks:** one `<header>`, one `<main id="main-content">`, one `<footer>`, and labelled `<nav aria-label="Primary">` regions. The footer navigation is labelled by its "Navigate" heading.
2. **Skip link:** first focusable element; becomes a visible emerald button on focus and moves focus to `main` (which carries `tabindex="-1"`).
3. **Real controls:** navigation is `<a>`/`<RouterLink>` lists; the toggle is a `<button>`. No clickable divs, no custom key handlers standing in for native activation.
4. **Names:** brand links contain their visible wordmark plus a visually hidden "— home" suffix, so the accessible name includes the visible label (avoids the `label-content-name-mismatch` failure). The logo mark is decorative (`aria-hidden`) and contains no text.
5. **State:** `aria-expanded` + `aria-controls` on the toggle, `aria-current` on the active destination.
6. **Keyboard:** Tab order is skip link → brand → desktop links (or toggle) → main. Escape closes the menu and restores focus. Focus rings use the global 2px `#059669` outline with 2px offset and are never removed.
7. **Motion:** transitions collapse to 0.01ms under `prefers-reduced-motion: reduce` (global rule) and are also marked `motion-reduce:transition-none`.
8. **Contrast:** footer text `#F9FAFB` on `#111827` = 15.4:1; footer muted `#9CA3AF` = 6.4:1; active nav `#047857` on `#F1F5F9` ≈ 5.3:1.

---

## 7. Usage

```vue
<!-- Layout is applied by the router; pages only render their content. -->
<section class="section bg-surface" aria-labelledby="page-title">
    <BaseContainer class="stack-lg">
        <SectionHeading id="page-title" as="h1" title="Page title" />
    </BaseContainer>
</section>
```

```vue
<!-- Reusing the header/footer outside the layout is possible but not required. -->
<AppHeader />
<AppFooter />
```

---

## 8. Verification record (2026-11-15)

| Check | Result |
|---|---|
| `npm run type-check` | Exit **0**, no output |
| `npm run build` | Exit **0**, 64 modules, CSS **37.49 kB** (7.90 kB gzip), app JS 101.21 kB, `PortfolioLayout` chunk 7.08 kB |
| `php artisan test` | **2 passed** (2 assertions) |
| HTTP | `/`, `/dev/layout`, `/dev/ui` all **200** with Vite client during development; `/dev/layout` also 200 through the `local`-only shell route |
| Landmarks | 1 header, 1 main (`id="main-content"`, `tabindex="-1"`), 1 footer, 2 navs |
| Header | `position: sticky`, 65px at 800px, 81px at 1024/1440px, white 95% + blur, `#E2E8F0` bottom border |
| Footer | `rgb(17, 24, 39)` background, `rgb(249, 250, 251)` text, stacked at 360/390, row at 768+ |
| Footer positioning | On a 1200px-tall viewport with the short home page: document height 1200px and footer bottom exactly **1200px** (pinned) |
| Mobile panel | Opens below the header, 375px wide at 390px viewport, six 42px-tall links, no horizontal overflow, content pushed down |
| Keyboard | Tab: skip link → brand → toggle; Enter opens; Tab reaches first link; Escape closes and returns focus to the toggle; skip link Enter focuses `main` |
| Desktop keyboard | At 1440px: Tab brand → Home → About → Services; focus ring `2px solid rgb(5,150,105)` offset 2px; Enter on Services → `/#services` with `aria-current="location"` |
| Mouse selection | Contact clicked in the panel → `/#contact`, panel closed, Contact marked current |
| Home active state | At `/`: Home has `aria-current="page"`, no other link active |
| Horizontal overflow | None at 360 / 390 / 768 / 1024 / 1440 px |
| Console | **0 errors** across load, navigation, menu open/close and route changes |
| Lighthouse (a11y) | **1.00** · best practices **1.00** · SEO **0.80** |
| Production bundle | 0 occurrences of `/dev/layout`, `/dev/ui`, `LayoutShowcase` or `ComponentShowcase` in every emitted JS chunk |
| Dev routes | `/dev/ui` still renders the component showcase (h1 present, 15 buttons) without the portfolio header |

---

## 9. Known limitations

- The six destinations point at homepage section hashes; those sections arrive in Module 07, so the links currently resolve to the top of the homepage. The router checks for the target before scrolling, which keeps this clean and warning-free.
- `/` still renders the temporary `PlaceholderPage`; the real homepage is out of scope for this module.
- No social links exist because no verified profile URLs have been supplied — inventing them would mislead visitors.
- The footer has no contact details or statistics for the same reason (unapproved business claims).
- `app.blade.php` has no meta description yet; this is the remaining Lighthouse SEO item and belongs to the homepage module.
- The mobile menu is a disclosure panel, not a full-screen drawer: background scrolling stays available by design, and focus is not trapped (unlike `BaseModal`).
