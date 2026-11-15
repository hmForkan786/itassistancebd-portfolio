# Portfolio Design System — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15 (Premium Experience Upgrade)

## Overview

Cohesive premium design system built on Tailwind CSS 4 CSS-first tokens. Brand palette (emerald/green accent on slate neutrals) preserved. Typography: Inter (body), Plus Jakarta Sans (display), Noto Sans Bengali (Bengali script).

## Tokens

- **Colors:** `--color-primary` (#059669), `--color-primary-dark` (#047857), `--color-primary-light`, `--color-accent`, `--color-heading`, `--color-body`, `--color-muted`, `--color-surface`, `--color-surface-soft`, `--color-line`, `--color-line-strong`, `--color-footer`, `--color-footer-text`, `--color-footer-muted`. Semantic states: success, warning, danger, neutral (soft/line variants).
- **Typography:** Fluid clamp scale: display, h1–h4, lead, body, small, tiny, bn. Headings use Plus Jakarta Sans, weight 700, balanced wrapping.
- **Spacing:** 4px base grid + fluid tokens: gutter, section, section-sm, card, grid, stack, stack-lg.
- **Containers:** narrow (768px), page (1280px), wide (1440px).
- **Radius:** field (8px), card (12px), pill (9999px).
- **Shadows:** card, card-hover, elevated (ink-tone, soft).

## Components

- UI primitives: `BaseButton`, `BaseContainer`, `SectionHeading`, `BaseCard`, `BaseBadge`, `BaseInput`, `BaseTextarea`, `BaseSelect`, `BaseModal`.
- Portfolio components: `CtaLink`, `ServiceCard`, `ProjectCard`, `ProjectDetail`, `SkillItem`, `AchievementStats`, `Testimonials`, `WorkProcess`, `Faq`, `ContactForm`.
- Layout: `PortfolioLayout`, `AppHeader`, `AppFooter`, `navigation.ts`.

## Interactions

- Scroll reveal: `[data-reveal]` elements fade/slide in via IntersectionObserver (`useScrollReveal` composable); disabled under `prefers-reduced-motion: reduce`.
- Hover: restrained elevation on cards (`hoverable`), color transitions on links/buttons.
- Mobile disclosure: Escape closes, focus restores to toggle.
- Reduced-motion: all durations collapse to 0.01ms globally.

## Premium patterns

- Hero: strong headline, capability chips, primary/secondary/ghost CTAs, trust indicators, focus card.
- Cards: single border, radius, shadow; hover elevation opt-in.
- Sections: fluid vertical rhythm; alternating surface backgrounds.
- Achievements: data-driven, hidden when no verified metrics (shows derived "technologies used" count).
- Testimonials: data-driven, hidden when empty (no fabricated reviews).
- Work process: 6 factual engagement steps.
- FAQ: native `<details>` for accessibility and reduced-motion safety.
- Contact form: client-side validation, mailto fallback (no backend).

## Accessibility

- Semantic landmarks (header/main/footer), single h1 per page, ordered headings.
- Native controls; visible focus ring (2px primary, 2px offset); never removed.
- Contrast: body text ≥ 4.5:1; small brand text uses primary-dark.
- `lang="bn"` for Bengali; `aria-*` on interactive elements.
- Reduced-motion respected globally.