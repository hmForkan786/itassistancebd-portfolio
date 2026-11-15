# DESIGN SYSTEM — IT Assistance BD Portfolio

**Module:** 04 — Tailwind CSS & Design System Foundation
**Verified:** 2026-11-15
**Tailwind CSS:** **4.3.5** (`tailwindcss` + `@tailwindcss/vite`)
**Configuration approach:** **CSS-first** (`@theme` in CSS) — there is **no `tailwind.config.js`** and no PostCSS config file.

This document is the single reference for colours, type, spacing, layout, utilities and accessibility.
It defines the foundation only — no page sections, navigation, cards or admin UI exist yet.

---

## 1. Architecture

| File | Purpose |
|---|---|
| `resources/css/app.css` | Entry point: imports Tailwind, the three self-hosted fonts, and the layers below; declares the scanned content sources |
| `resources/css/theme.css` | All design tokens inside a single `@theme static` block |
| `resources/css/base.css` | Element-level defaults (`@layer base`) |
| `resources/css/utilities.css` | Project utilities (`@utility`) |
| `resources/js/pages/PlaceholderPage.vue` | Temporary screen that proves the tokens render (removed when the homepage arrives) |

Load order: `theme` → `base` → `components` → `utilities` (Tailwind's layer order). Utilities always beat base styles, so explicit classes override global defaults as expected.

**Source scanning:** automatic content detection is disabled (`@import 'tailwindcss' source(none)`) and sources are listed explicitly — `resources/views/**/*.blade.php` (excluding the archived `welcome.blade.php`), `resources/js/**/*.{js,ts,vue}` and Laravel's pagination views. This keeps the bundle free of the Laravel demo palette (bundle shrank from 49.6 kB to ~21.6 kB once the demo stylesheet was excluded).

---

## 2. Brand colours

All values are approved — **do not change without Project Owner approval**.

| Token | Hex | Tailwind utilities | Use for |
|---|---|---|---|
| `--color-primary` | `#059669` | `bg-primary` `text-primary` `border-primary` | Primary actions, links, brand marks |
| `--color-primary-dark` | `#047857` | `bg-primary-dark` `text-primary-dark` | Hover/active state of primary |
| `--color-primary-light` | `#10B981` | `bg-primary-light` | Tints, icon backgrounds, gradients |
| `--color-accent` | `#34D399` | `bg-accent` `text-accent` | Highlights, badges, decorative accents |
| `--color-heading` | `#0F172A` | `text-heading` | Headings, high-emphasis text |
| `--color-body` | `#475569` | `text-body` | Default body copy |
| `--color-muted` | `#64748B` | `text-muted` | Secondary/meta text, captions |
| `--color-surface` | `#F8FAFC` | `bg-surface` | Alternating section background |
| `--color-surface-soft` | `#F1F5F9` | `bg-surface-soft` | Subtle panels, hover fills |
| `--color-line` | `#E2E8F0` | `border-line` | Default borders/dividers |
| `--color-line-strong` | `#CBD5E1` | `border-line-strong` | Emphasised borders, inputs |
| `--color-footer` | `#111827` | `bg-footer` | Footer background |
| `--color-footer-text` | `#F9FAFB` | `text-footer-text` | Footer headings/links |
| `--color-footer-muted` | `#9CA3AF` | `text-footer-muted` | Footer secondary text |
| `--color-white` | `#FFFFFF` | `bg-white` / `text-white` | Page and card background |

Rules:

- Never hard-code these hex values in components or inline styles — always use the token utility.
- Tailwind's default palette remains available for neutral/gray scale needs and for gradients.
- Contrast: `#475569` on white ≈ 7.5:1 and `#64748B` on white ≈ 4.8:1 (AA for normal text); `#F9FAFB`/`#9CA3AF` on `#111827` are 15.4:1 and 6.4:1. Primary `#059669` on white is ~3.1:1 — acceptable for large text, icons and UI borders, **not** for small body copy; use `--color-primary-dark` for small text on light backgrounds.

### Semantic state colours (added in Module 05)

These extend — never replace — the approved brand palette. They exist only for status and validation, and every one is paired with text so colour is never the only signal.

| Token | Hex | Utilities | Use |
|---|---|---|---|
| `--color-success` | `#047857` | `text-success` | Success text/icons |
| `--color-success-soft` | `#ECFDF5` | `bg-success-soft` | Success badge fill |
| `--color-success-line` | `#A7F3D0` | `border-success-line` | Success border |
| `--color-warning` | `#B45309` | `text-warning` | Warning text/icons |
| `--color-warning-soft` | `#FFFBEB` | `bg-warning-soft` | Warning badge fill |
| `--color-warning-line` | `#FDE68A` | `border-warning-line` | Warning border |
| `--color-danger` | `#B91C1C` | `bg-danger` `text-danger` | Destructive action, error text |
| `--color-danger-dark` | `#991B1B` | `bg-danger-dark` | Destructive hover |
| `--color-danger-soft` | `#FEF2F2` | `bg-danger-soft` | Error/danger fill |
| `--color-danger-line` | `#FECACA` | `border-danger-line` | Error/danger border |
| `--color-neutral` | `#475569` | `text-neutral` | Neutral badge text |
| `--color-neutral-soft` | `#F1F5F9` | `bg-neutral-soft` | Neutral badge fill |
| `--color-neutral-line` | `#E2E8F0` | `border-neutral-line` | Neutral badge border |

**Solid brand fills:** white text on `#059669` is 3.76:1 and fails AA for normal text. Primary buttons and other solid brand surfaces therefore use `--color-primary-dark` (`#047857`, ≈5.5:1). Small brand-coloured text (eyebrows, links) uses `text-primary-dark` for the same reason. Large text (≥24px, or ≥18.66px bold) may still use `--color-primary`.

---

## 3. Typography

### Font families

| Token | Stack | Loaded |
|---|---|---|
| `font-sans` (default) | `Inter Variable` → `Inter` → `Noto Sans Bengali Variable` → `Nirmala UI` → system UI → `Segoe UI` → sans-serif | Self-hosted via `@fontsource-variable/inter` |
| `font-display` | `Plus Jakarta Sans Variable` → `Inter Variable` → `Noto Sans Bengali Variable` → system UI | Self-hosted via `@fontsource-variable/plus-jakarta-sans` |
| `font-bengali` | `Noto Sans Bengali Variable` → `Noto Sans Bengali` → `Nirmala UI` → `Vrinda` → `Bangla Sangam MN` → sans-serif | Self-hosted via `@fontsource-variable/noto-sans-bengali` |

- Fonts are **variable woff2, bundled by Vite** and emitted with content hashes into `public/build/assets/`. No Google Fonts/CDN request, no paid service, no render-blocking third-party connection.
- `@font-face` declarations use `font-display: swap` (14 declarations verified in the build), so text paints immediately with the fallback stack.
- Subsets are declared with `unicode-range`, so a page only downloads the coverage it needs (latin ≈ 48 kB Inter, bengali ≈ 108 kB Noto Sans Bengali).
- Bengali text automatically uses `font-bengali` via `:lang(bn)` / `[lang="bn"]` with `line-height: 1.85`; use `lang="bn"` (and optionally `text-bn`) on Bengali blocks.

### Fluid type scale

All sizes use `clamp()` so headings scale between mobile and large desktop without breakpoints.

| Utility | Token | Size range | Line height | Tracking |
|---|---|---|---|---|
| `text-display` | `--text-display` | 40px → 64px | 1.06 | −0.025em |
| `text-h1` | `--text-h1` | 32px → 48px | 1.10 | −0.02em |
| `text-h2` | `--text-h2` | 26px → 36px | 1.15 | −0.015em |
| `text-h3` | `--text-h3` | 22px → 28px | 1.25 | −0.01em |
| `text-h4` | `--text-h4` | 18.4px → 22px | 1.35 | — |
| `text-lead` | `--text-lead` | 17px → 19px | 1.65 | — |
| `text-body` | `--text-body` | 16px | 1.70 | — |
| `text-small` | `--text-small` | 14px | 1.60 | — |
| `text-tiny` | `--text-tiny` | 12px | 1.50 | — |
| `text-bn` | `--text-bn` | 15px | 1.85 | — |

Body copy uses `Inter` at 16px / 1.7. Headings (`h1`–`h6`) default to `font-display`, `#0F172A`, weight 700, `line-height: 1.15`, and `text-wrap: balance`.

---

## 4. Spacing

Base grid is **4px** (`--spacing: 0.25rem`, Tailwind default) — every numeric utility (`p-1` … `p-96`) stays on that scale.

Semantic, fluid spacing tokens (so layouts never repeat arbitrary values):

| Token | Utility examples | Value |
|---|---|---|
| `--spacing-gutter` | `px-gutter` `gap-gutter` | `clamp(1rem, 0.7rem + 1.5vw, 2.5rem)` (16→40px) |
| `--spacing-section` | `py-section` | `clamp(3rem, 2.25rem + 3vw, 6rem)` (48→96px) |
| `--spacing-section-sm` | `py-section-sm` | `clamp(2rem, 1.5rem + 2vw, 3.5rem)` (32→56px) |
| `--spacing-card` | `p-card` | `clamp(1.25rem, 1rem + 0.75vw, 1.75rem)` (20→28px) |
| `--spacing-grid` | `gap-grid` | `clamp(1rem, 0.8rem + 0.9vw, 1.75rem)` (16→28px) |
| `--spacing-stack` | `gap-stack` | `1rem` (16px) |
| `--spacing-stack-lg` | `gap-stack-lg` | `1.5rem` (24px) |

Conventions: **sections** use `.section` / `py-section`; **cards** use `p-card`; **grids** use `gap-grid`; **rhythm inside a block** uses `.stack` / `.stack-lg`.

---

## 5. Responsive breakpoints

Mobile-first: base styles target phones, then Tailwind's default breakpoints apply.

| Name | Width | Tailwind prefix | Typical use |
|---|---|---|---|
| Mobile | < 640px | *(base)* | Single column, stacked navigation |
| Mobile L | ≥ 640px | `sm:` | Two-up small grids |
| **Tablet** | ≥ 768px | `md:` | Two/three columns, side-by-side blocks |
| **Desktop** | ≥ 1024px | `lg:` | Persistent navigation, 3-column grids |
| **Large desktop** | ≥ 1280px | `xl:` | Wider grids, larger gutters |
| Extra wide | ≥ 1536px | `2xl:` | Content stays inside the container cap |

Target widths for QA: **360px, 390px, 768px, 1024px, 1440px**. No custom breakpoints were added — the default scale already covers those widths, which keeps one consistent language across the project.

---

## 6. Container system

| Utility | Max width | Padding | Use |
|---|---|---|---|
| `.container-page` | 1280px (`--container-page`) | `--spacing-gutter` inline | Default content shell |
| `.container-wide` | 1440px (`--container-wide`) | `--spacing-gutter` inline | Full-width feature bands |
| `.container-narrow` | 768px (`--container-narrow`) | `--spacing-gutter` inline | Long-form reading (blog, legal) |

All three are centred (`margin-inline: auto`), full-width below the cap, and use the same fluid gutters, so every section aligns on the same grid.

**Responsive column grid convention**

```html
<div class="container-page">
  <div class="grid grid-cols-1 gap-grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <!-- items -->
  </div>
</div>
```

For card lists of unknown count, `.grid-auto` produces an auto-fitting grid with a 288px minimum column and no media queries:

```html
<ul class="grid-auto">
  <li class="rounded-card border border-line bg-white p-card shadow-card">…</li>
</ul>
```

---

## 7. Border radius

| Token | Utility | Value | Use |
|---|---|---|---|
| `--radius-field` | `rounded-field` | 8px | Inputs, buttons, small chips |
| `--radius-card` | `rounded-card` | 12px | Cards, panels, media tiles |
| `--radius-pill` | `rounded-pill` | 9999px | Pills, badges, avatars |

Tailwind's default radius scale remains available for one-off shapes.

---

## 8. Shadows

| Token | Utility | Value | Use |
|---|---|---|---|
| `--shadow-card` | `shadow-card` | `0 1px 2px rgb(15 23 42 / .06), 0 8px 24px -12px rgb(15 23 42 / .18)` | Resting cards |
| `--shadow-card-hover` | `shadow-card-hover` | `0 2px 4px …, 0 16px 32px -16px …` | Hover/focus elevation |
| `--shadow-elevated` | `shadow-elevated` | `0 24px 48px -24px rgb(15 23 42 / .3)` | Menus, dialogs, floating panels |

Shadows use the heading ink tone (never pure black) for a soft, professional look. Do not stack multiple Tailwind shadow utilities on one element.

---

## 9. Global CSS behaviour

| Area | Behaviour |
|---|---|
| Reset | Tailwind Preflight (box-sizing, margins, media defaults) — no custom reset added |
| Body | `#FFFFFF` background, `--color-body` text, `font-sans`, 16px / 1.7, antialiased |
| Headings | `font-display`, `--color-heading`, weight 700, balanced wrapping |
| Links | `--color-primary`, hover `--color-primary-dark`; links inside `p`/`li`/`dd`/`blockquote` are underlined with a 45% tinted decoration |
| Selection | `--color-primary` background with white text |
| Focus | `:focus-visible` → 2px `--color-primary` outline with 2px offset (never removed) |
| Smooth scroll | Enabled only inside `@media (prefers-reduced-motion: no-preference)`; `scroll-padding-top: 5rem` for anchor targets |
| Reduced motion | All animation/transition durations collapse to 0.01ms under `prefers-reduced-motion: reduce` |
| Bengali | `:lang(bn)` → `font-bengali`, line-height 1.85; `text-bn` (15px/1.85) for Bengali body copy |
| Images/media | Preflight defaults (`max-width: 100%`, `height: auto`) |

---

## 10. Utility conventions

Use tokens and these utilities instead of ad-hoc values:

- **Layout:** `.container-page`, `.container-wide`, `.container-narrow`, `.section`, `.section-sm`
- **Grid/flex:** `.grid-auto`, `.stack`, `.stack-lg`, or built-in `grid`/`flex` + `gap-grid`
- **Type:** `text-display|h1|h2|h3|h4|lead|body|small|tiny|bn`
- **Colour:** `text-heading|body|muted|primary`, `bg-surface|surface-soft|white|footer`, `border-line|line-strong`
- **Shape:** `rounded-field|card|pill`, `shadow-card|card-hover|elevated`
- **Focus:** rely on the global `:focus-visible` ring; add `focus:shadow-card-hover` only when extra emphasis is needed.

Rule of thumb: if a value is needed more than twice, it must become a token — not an arbitrary value such as `text-[17px]` or `p-[23px]`.

---

## 11. Accessibility rules

1. **Contrast:** body text ≥ 4.5:1; large text/icons ≥ 3:1. Use `--color-primary-dark` for small text on light surfaces.
2. **Focus visible:** never remove outlines; the global 2px ring covers every interactive element.
3. **Motion:** smooth scrolling and animations respect `prefers-reduced-motion`.
4. **Language:** mark Bengali content with `lang="bn"` so screen readers use the correct voice and the font stack applies.
5. **Semantics:** one `<h1>` per page, headings in order; use real `<button>`/`<a>`/`<ul>` elements.
6. **Text scaling:** rem-based type and fluid clamps keep layouts usable at 200% zoom and at 360px width.
7. **No colour-only meaning:** pair colour with text, icon or pattern.

---

## 12. Verification record (2026-11-15)

| Check | Result |
|---|---|
| Tailwind version | 4.3.5 (`tailwindcss` 4.3.5, `@tailwindcss/vite` 4.3.5) |
| Duplicate configuration | None — no `tailwind.config.*`, no `postcss.config.*` |
| `npm run build` | Exit **0**, 37 modules, CSS **21.57 kB** (5.36 kB gzip), fonts hashed into `public/build/assets/` |
| `npm run type-check` | Exit **0** |
| Tokens in compiled CSS | `--color-primary:#059669`, `--color-primary-dark:#047857`, `--color-primary-light:#10b981`, `--color-accent:#34d399`, `--color-heading:#0f172a`, `--color-body:#475569`, `--color-muted:#64748b`, `--color-surface:#f8fafc`, `--color-surface-soft:#f1f5f9`, `--color-line:#e2e8f0`, `--color-line-strong:#cbd5e1`, `--color-footer:#111827`, `--color-footer-text:#f9fafb`, `--color-footer-muted:#9ca3af` |
| Utilities in compiled CSS | `.container-page`, `.section`, `.grid-auto`, `.stack-lg`, `.text-h1`, `.text-bn`, `.shadow-card`, `.rounded-card`, `.rounded-field`, … |
| `@font-face` | 14 declarations, all `font-display: swap` |
| Demo-palette leakage | 0 (archived welcome view excluded from scanning) |
| Runtime measurement (800px viewport, Chromium) | body `rgb(255,255,255)` / `rgb(71,85,105)`, Inter 16px/27.2px; `main` `rgb(248,250,252)`, 60px section padding; container max-width **1280px**; `h1` Plus Jakarta Sans 40px, −0.8px tracking, `rgb(15,23,42)`; card border `rgb(226,232,240)`, radius 8px, shadow applied; Bengali 15px/27.75px (1.85) in Noto Sans Bengali Variable; all three fonts loaded; 2-column auto grid at 800px |
| Console errors | 0 |
| Laravel regression | `php artisan test` → 2 passed |
| Screenshot | Captured in-browser at 800px; tokens, typography, grid, radius and shadow render as specified |

Widths 360/390/768/1024/1440 were validated analytically from the clamp tokens and the mobile-first grid rules; no page layouts exist yet to screenshot at those widths, so full multi-width layout QA moves to the component module.
