# UI COMPONENTS — IT Assistance BD Portfolio

**Module:** 05 — Vue UI Component Foundation
**Verified:** 2026-11-15
**Location:** `resources/js/components/ui/`
**Stack:** Vue 3.5.45 (Composition API, `<script setup>`) · TypeScript 6.0.3 (strict) · Tailwind CSS 4.3.5 tokens

Nine accessible primitives, reusable across the public portfolio, projects, services, case studies, blog, contact and the future admin CMS. No business logic, no data fetching and no page sections live here.

---

## 1. Inventory

| Component | Responsibility |
|---|---|
| `BaseButton` | Native button with five variants, three sizes, loading/disabled states and an icon slot |
| `BaseContainer` | Centred content shell on the page/wide/narrow container tokens |
| `SectionHeading` | Eyebrow + title + description + actions block with a fixed heading level |
| `BaseCard` | Standard surface: border, radius, shadow, optional padding/hover, three slots |
| `BaseBadge` | Compact semantic status label (always carries text, never colour alone) |
| `BaseInput` | Labelled single-line text field with helper/error wiring |
| `BaseTextarea` | Labelled multi-line field sharing the same field styling |
| `BaseSelect` | Labelled native `<select>` with option list and placeholder |
| `BaseModal` | Teleported dialog: `role="dialog"`, focus trap, scroll lock, focus restore |

Supporting modules:

| File | Purpose |
|---|---|
| `types.ts` | Shared unions/interfaces (`ButtonVariant`, `ButtonSize`, `ComponentSize`, `FeedbackVariant`, `SelectOption`) |
| `field-styles.ts` | Shared field classes and `aria-describedby` helper — no duplicated control CSS |
| `index.ts` | Public barrel; consumers import from `@/components/ui` |

---

## 2. Conventions

1. **Naming:** primitives use the `Base*` prefix (`BaseButton`, `BaseCard`, …). Composed, layout-aware blocks may keep a descriptive name (`SectionHeading`). One component per file, PascalCase filename.
2. **Props:** camelCase in script, kebab-case in templates (`full-width`, `close-on-escape`). Every prop has an explicit type and a JSDoc line; defaults are declared with `withDefaults`.
3. **TypeScript:** no `any`. Union types are exported from `types.ts` when more than one component needs them. Unused imports/locals fail the build (`noUnusedLocals`).
4. **Styling:** only design tokens and Tailwind utilities — no hard-coded hex values, no `!important`, no arbitrary values. Repeated field styling lives in `field-styles.ts`.
5. **Semantics:** components render real HTML elements (`button`, `label`, `input`, `select`, `textarea`, `dialog` semantics). A wrapper never replaces native behaviour.
6. **Import:** always `import { BaseButton } from '@/components/ui';` — never deep-import a `.vue` file, so internals stay portable.
7. **Extending:** compose in a feature component or add a documented prop. Do not fork a primitive to change one colour.

---

## 3. Component reference

### BaseButton

| Prop | Type | Default | Notes |
|---|---|---|---|
| `variant` | `primary \| secondary \| outline \| ghost \| danger` | `primary` | Solid `primary` uses `primary-dark` for AA contrast |
| `size` | `sm \| md \| lg` | `md` | 36 / 44 / 48 px heights |
| `type` | `button \| submit \| reset` | `button` | Native attribute |
| `disabled` | `boolean` | `false` | Native `disabled` |
| `loading` | `boolean` | `false` | Shows a spinner, sets `aria-busy`, blocks clicks — it does **not** fake progress |
| `fullWidth` | `boolean` | `false` | `width: 100%` |

Slots: default (label), `icon` (decorative, hidden from AT).

```vue
<BaseButton variant="primary" size="md" @click="save">Save</BaseButton>
<BaseButton variant="outline" :loading="saving" type="submit">Send</BaseButton>
```

### BaseContainer

| Prop | Type | Default |
|---|---|---|
| `width` | `page \| wide \| narrow` | `page` |
| `as` | `string` | `div` |

Slots: default. Widths: 1280 / 1440 / 768 px with the shared fluid gutter.

```vue
<BaseContainer as="section" width="narrow" class="stack">…</BaseContainer>
```

### SectionHeading

| Prop | Type | Default | Notes |
|---|---|---|---|
| `title` | `string` | — (required) | Never renders an empty heading |
| `eyebrow` | `string` | — | Small uppercase label |
| `description` | `string` | — | Lead paragraph |
| `as` | `h1 \| h2 \| h3 \| h4` | `h2` | `h1` only for the page title |
| `align` | `left \| center` | `left` | Presentation only |
| `id` | `string` | — | For `aria-labelledby` |

Slots: `description` (rich copy), `actions` (buttons/links).

```vue
<SectionHeading
    as="h2"
    id="services-heading"
    eyebrow="Services"
    title="What we do"
    description="Support, development and consulting for growing teams."
/>
```

### BaseCard

| Prop | Type | Default |
|---|---|---|
| `as` | `string` | `div` (`article`, `li`, …) |
| `padded` | `boolean` | `true` |
| `hoverable` | `boolean` | `false` |
| `muted` | `boolean` | `false` |

Slots: default, `header`, `footer`.

```vue
<BaseCard as="article" hoverable>
    <template #header><BaseBadge variant="primary">New</BaseBadge></template>
    <h3 class="text-h4">Title</h3>
</BaseCard>
```

### BaseBadge

| Prop | Type | Default |
|---|---|---|
| `variant` | `primary \| neutral \| success \| warning \| danger` | `neutral` |
| `size` | `sm \| md` | `sm` |

Slots: default text (required for meaning).

### BaseInput

| Prop | Type | Default | Notes |
|---|---|---|---|
| `label` | `string` | — (required) | Rendered as `<label for>` |
| `type` | `text \| email \| password \| tel \| url \| search \| number` | `text` | |
| `id` | `string` | auto (`useId`) | Stable per instance |
| `name` | `string` | — | Form submission |
| `placeholder` | `string` | — | Never replaces the label |
| `helper` | `string` | — | Linked via `aria-describedby` |
| `error` | `string` | — | Sets `aria-invalid` + error styles |
| `required` / `disabled` | `boolean` | `false` | Native attributes |
| `autocomplete` | `string` | — | Passed through |
| `size` | `sm \| md` | `md` | |

`v-model` (string). Extra attributes (`maxlength`, `inputmode`, `@blur`, …) fall through to the `<input>`.

### BaseTextarea

Same labelling/wiring as `BaseInput`, plus `rows` (default `4`). `v-model` string; `resize-y` by default.

### BaseSelect

| Prop | Type | Default |
|---|---|---|
| `label` | `string` | — (required) |
| `options` | `readonly SelectOption[]` | — (required) |
| `placeholder` | `string` | — |
| `helper` / `error` | `string` | — |
| `required` / `disabled` | `boolean` | `false` |
| `size` | `sm \| md` | `md` |

`SelectOption`: `{ value: string; label: string; disabled?: boolean }`. `v-model` string; the placeholder option is disabled when the field is required.

### BaseModal

| Prop | Type | Default | Notes |
|---|---|---|---|
| `title` | `string` | — | Becomes the dialog's accessible name |
| `description` | `string` | — | Linked via `aria-describedby` |
| `ariaLabel` | `string` | `'Dialog'` | Used when no title is rendered |
| `size` | `sm \| md \| lg` | `md` | 448 / 512 / 672 px |
| `closeLabel` | `string` | `Close dialog` | Accessible name of the × button |
| `closeOnBackdrop` | `boolean` | `true` | |
| `closeOnEscape` | `boolean` | `true` | |

`v-model` boolean; emits `close`. Slots: default, `header`, `footer`.

```vue
<BaseModal v-model="open" title="Delete project" description="This cannot be undone.">
    <p class="text-small text-body">The project and its files will be removed.</p>
    <template #footer>
        <BaseButton variant="ghost" @click="open = false">Cancel</BaseButton>
        <BaseButton variant="danger" @click="remove">Delete</BaseButton>
    </template>
</BaseModal>
```

---

## 4. Accessibility rules

1. **Labels are mandatory** on `BaseInput`, `BaseTextarea` and `BaseSelect` (typed as required props). The `<label for>` always resolves to the control id.
2. **Descriptions are announced:** helper and error text are referenced by `aria-describedby`; ids only appear when the text exists.
3. **Errors:** `error` sets `aria-invalid="true"` and renders a red message — colour is paired with text, never used alone.
4. **Focus:** the global `:focus-visible` ring (2px `--color-primary`, 2px offset) is never removed. Buttons/inputs keep native keyboard activation.
5. **Contrast:** solid primary buttons use `--color-primary-dark` and small brand text uses `text-primary-dark` — white on `#059669` is 3.76:1 and fails AA for normal text. Colour plus text carries badge meaning (Lighthouse accessibility 1.00).
6. **Headings:** `SectionHeading` renders `h2` by default; `as="h1"` is reserved for the single page title; never skip a level.
7. **Dialog:** `role="dialog"`, `aria-modal="true"`, `aria-labelledby`/`aria-label`, focus moved into the panel on open, Tab/Shift+Tab trapped, body scroll locked, focus restored to the trigger on close, Escape supported.
8. **Motion:** only 150 ms colour/shadow transitions; `base.css` collapses durations under `prefers-reduced-motion: reduce`.
9. **Bengali:** add `lang="bn"` to Bengali content so the correct font stack and reading rules apply.

---

## 5. Form composition pattern

```vue
<form class="grid gap-grid md:grid-cols-2" @submit.prevent="submit">
    <BaseInput v-model="form.name" label="Full name" name="name" autocomplete="name" required />
    <BaseInput v-model="form.email" label="Email" name="email" type="email" :error="errors.email" required />
    <BaseSelect v-model="form.service" label="Service" name="service" :options="options" required />
    <BaseTextarea v-model="form.message" label="Requirements" name="message" :rows="5" />
</form>
```

Validation stays in the form/feature layer: components only display the `error` string supplied to them.

---

## 6. Showcase page (development only)

- Page: `resources/js/pages/ComponentShowcasePage.vue`
- Route: `/dev/ui`, pushed into the router only when `import.meta.env.DEV` is true
- Server shell: `routes/web.php` serves the mount view for `/dev/*` **only when `app()->environment('local')`**
- The production bundle contains no `/dev/ui` string and no showcase chunk (verified: 0 occurrences)

Run `npm run dev` and `php artisan serve`, then open <http://127.0.0.1:8000/dev/ui>. The showcase is for review only; it is not a portfolio page and can be deleted once real sections exist.

---

## 7. Verification record (2026-11-15)

| Check | Result |
|---|---|
| `npm run type-check` | Exit **0**, no output, `strict` + `noUnusedLocals` on |
| `npm run build` | Exit **0**, 37 modules, CSS **32.64 kB** (7.18 kB gzip), app JS 93.33 kB. The primitives are consumed by the dev-only showcase, so the production entry stays at its Module 04 size while Tailwind still emits their classes |
| `php artisan test` | **2 passed** (2 assertions) |
| Rendering | 9 components on `/dev/ui`: shared h1, 9 section headings, buttons, badges, 3 cards, 6 fields, dialog |
| Buttons | Click counter incremented 1 per click; `disabled` ignored clicks; loading sets `aria-busy="true"` and blocks activation; heights 36/44/48 px |
| Fields | All labels resolve to a control id; `aria-describedby` ids resolve; error field reports `aria-invalid="true"`; typing and selecting update the model |
| Select | Placeholder `Choose a service` disabled when required; all four options rendered; disabled option not selectable |
| Modal | `role="dialog"`, `aria-modal="true"`, labelled + described; `tabindex="-1"`; body `overflow: hidden`; focus starts inside; Tab from last wraps to first; Shift+Tab from first wraps to last; Escape closes, scroll restored, focus returns to the trigger |
| Responsive (iframe viewports) | 360/390 px: 1 card column, 1 form column, 16.6 px gutter; 768 px: 2 columns; 1024/1440 px: 3 card columns, container capped at 1280 px; no horizontal overflow at any width; h1 32 → 48 px |
| Focus ring | `2px solid rgb(5,150,105)` with `2px` offset on keyboard focus |
| Lighthouse (a11y) | **1.00** with 0 contrast failures (was 0.96 before the button/eyebrow fix) |
| Console | **0 errors** during load, clicks, typing, select changes, modal open/close |
| Prod bundle | No `/dev/ui` route or showcase chunk |

Known non-blocking note: the Lighthouse SEO score is 0.8 because `resources/views/app.blade.php` has no meta description — page metadata belongs to the homepage module.
