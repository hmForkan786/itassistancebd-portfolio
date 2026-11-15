# VUE INSTALLATION — Module 03

**Project:** IT Assistance BD Portfolio
**Module:** 03 — Vue 3 + TypeScript + Vite Integration
**Date:** 2026-11-15
**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`
**Status:** **COMPLETE — Vue 3 + TypeScript + Vite integrated with Laravel 12.72.0, build and type-check passing, verified in a real browser**

---

## 1. Installed Packages (actual versions)

### Runtime dependencies (`dependencies`)

| Package | Version |
|---|---|
| vue | **3.5.45** |
| vue-router | **4.6.5** |
| pinia | **4.1.0** |
| axios | **1.21.1** |

### Development dependencies (`devDependencies`)

| Package | Version | Note |
|---|---|---|
| vite | **6.4.6** | Laravel 12 skeleton declared `^6.0.11`; resolved to latest 6.x (not a major upgrade) |
| @vitejs/plugin-vue | **6.0.11** | New in this module |
| typescript | **6.0.3** | New in this module |
| vue-tsc | **3.3.14** | New in this module |
| laravel-vite-plugin | **1.3.0** | Pre-existing (declared `^1.2.0`) |
| tailwindcss | 4.3.5 | **Pre-declared by the Laravel 12 skeleton** — not added or configured by this module |
| @tailwindcss/vite | 4.3.5 | **Pre-declared by the Laravel 12 skeleton** — not added or configured by this module |
| concurrently | 9.2.5 | Pre-existing skeleton dependency |

Install commands used:

```powershell
npm install vue vue-router@4 pinia axios
npm install -D typescript vue-tsc @vitejs/plugin-vue
```

`npm audit`: **0 vulnerabilities** (140 packages audited).

**Tailwind note (important for Module 04):** the Laravel 12 skeleton already declares `tailwindcss` and `@tailwindcss/vite`, and its stock `resources/css/app.css` starts with `@import 'tailwindcss';`. This module **left that stock setup exactly as delivered** — it added no Tailwind configuration, no design tokens, no component classes and no design system. Because `node_modules` did not exist before this module, `npm install` did materialise those pre-declared packages; that is an unavoidable consequence of installing any dependency, not a Tailwind installation step. Design-system work starts in Module 04.

---

## 2. Frontend Architecture

```
resources/
├── css/
│   └── app.css                 (stock Laravel entry, unchanged)
├── js/
│   ├── app.ts                  Vue entry — mounts #app, registers Pinia + Router
│   ├── App.vue                 root component — <RouterView /> only
│   ├── env.d.ts                Vite client type reference
│   ├── router/
│   │   └── index.ts            createWebHistory + route table (1 route)
│   ├── stores/
│   │   └── index.ts            shared Pinia instance
│   ├── services/
│   │   └── http.ts             reusable Axios client (baseURL /api)
│   ├── pages/
│   │   └── PlaceholderPage.vue temporary mount-verification page
│   ├── components/             (.gitkeep — populated in later modules)
│   ├── layouts/                (.gitkeep — populated in later modules)
│   ├── app.js                  stock Laravel file, retained, not built
│   └── bootstrap.js            stock Laravel file, retained, not built
└── views/
    ├── app.blade.php           Vue mount point + @vite assets
    └── welcome.blade.php       stock Laravel welcome view, retained
```

**Request flow:** Laravel route `GET /` → `app.blade.php` → `@vite` injects `app.css` + `app.ts` → `app.ts` creates the app, installs Pinia and Vue Router → `App.vue` renders the matched route → `PlaceholderPage.vue` (lazy-loaded chunk).

**No business logic, page content, admin CMS or design system exists yet.** The single page is explicitly a verification placeholder with no styling.

---

## 3. Configuration Changes

### `vite.config.js` (modified)

```js
laravel({ input: ['resources/css/app.css', 'resources/js/app.ts'], refresh: true })
tailwindcss()          // stock Laravel plugin, untouched
vue({ template: { transformAssetUrls: { base: null, includeAbsolute: false } } })
resolve.alias['@'] → resources/js
```

Changes: input `app.js` → `app.ts`; added `@vitejs/plugin-vue`; added the `@` alias. Laravel's Vite plugin, refresh and the stock Tailwind plugin were preserved.

### `tsconfig.json` (new)

- `strict: true` plus `noUnusedLocals`, `noUnusedParameters`, `noFallthroughCasesInSwitch`, `noImplicitOverride`, `noUncheckedIndexedAccess`
- `module`/`moduleResolution`: `ESNext` / `Bundler` (Vite-compatible)
- `noEmit: true`, `isolatedModules: true`, `verbatimModuleSyntax: true`, `skipLibCheck: true`
- `types: ["vite/client"]`, `jsx: "preserve"` with `jsxImportSource: "vue"`
- Alias mapping `@/* → ./resources/js/*`
- Includes `resources/js/**/*.{ts,d.ts,vue}`
- TypeScript 6 deprecates `baseUrl`, so it is intentionally omitted and the `paths` entry is written relative (`./resources/js/*`).

### `package.json` (modified)

Added script:

```json
"type-check": "vue-tsc --noEmit"
```

`build` and `dev` kept as the stock Vite commands.

### `routes/web.php` (modified)

`GET /` now returns `view('app')` instead of `view('welcome')`. Route count unchanged (1 web route + framework routes).

### `resources/views/welcome.blade.php` (one-line modification)

Its `@vite([...])` entry reference was updated from `resources/js/app.js` to `resources/js/app.ts` so the retained stock view cannot reference a missing manifest entry. No other part of that file was touched.

### Untouched

`resources/css/app.css`, `resources/js/app.js`, `resources/js/bootstrap.js`, all Laravel `app/`, `config/`, `database/`, `public/` (except generated `public/build/`), `.env`, `composer.json`, PHP configuration, and all databases.

---

## 4. Build Verification (actual output)

```powershell
PS> npm run build
vite v6.4.6 building for production...
✓ 37 modules transformed.
public/build/manifest.json                      0.62 kB │ gzip:  0.23 kB
public/build/assets/app-CYdspVfZ.css           39.77 kB │ gzip:  9.52 kB
public/build/assets/PlaceholderPage-lOsINrXX.js  0.49 kB │ gzip:  0.36 kB
public/build/assets/app-CZI2szRS.js            93.33 kB │ gzip: 36.45 kB
✓ built in 2.14s
```

Exit code **0**. The manifest proves both entries and the lazy SFC chunk:

```json
"resources/js/app.ts": { "isEntry": true, "dynamicImports": ["resources/js/pages/PlaceholderPage.vue"] }
"resources/js/pages/PlaceholderPage.vue": { "isDynamicEntry": true, "imports": ["resources/js/app.ts"] }
```

## 5. TypeScript Verification (actual output)

```powershell
PS> npm run type-check
> vue-tsc --noEmit
(no output)
EXIT: 0
```

Strict checking passes across `app.ts`, `router/index.ts`, `stores/index.ts`, `services/http.ts`, `App.vue` and `PlaceholderPage.vue`. No strictness flags were relaxed to obtain a pass.

Two errors were hit and fixed during configuration (recorded for transparency):

1. `TS5101` — `baseUrl` is deprecated in TypeScript 6 → removed `baseUrl`.
2. `TS5090` — non-relative `paths` without `baseUrl` → changed mapping to `./resources/js/*`.

## 6. Laravel Integration Verification

| Check | Result |
|---|---|
| `php artisan serve` on `127.0.0.1:8124` → `GET /` | **200 OK**, 664 bytes, `<title>IT Assistance BD Portfolio</title>`, `<div id="app">` present |
| Emitted asset tags | `/build/assets/app-CZI2szRS.js`, `/build/assets/app-CYdspVfZ.css` |
| `GET /build/assets/app-CZI2szRS.js` | **200**, 93,333 bytes, `application/javascript` |
| `GET /build/assets/app-CYdspVfZ.css` | **200**, 39,772 bytes, `text/css` |
| `GET /build/assets/PlaceholderPage-lOsINrXX.js` | **200**, 488 bytes (lazy chunk reachable) |

**Browser verification (performed):** the page was loaded in the in-app Chromium browser. Result — Vue mounted (`#app` filled with 253 characters of rendered markup), `<h1>` text `IT Assistance BD Portfolio`, all seven stack items rendered, **no console errors**, correct title and stylesheet. The tab was closed and the dev server stopped afterwards; nothing is left running.

---

## 7. Errors and Warnings

| Item | Detail | Status |
|---|---|---|
| `npm warn allow-scripts` | npm 11.17 reports `esbuild@0.25.12` postinstall not covered by allowScripts | **Harmless** — esbuild's platform binary resolved from `@esbuild/win32-x64` and the Vite build succeeded; no approval was granted or needed |
| TS5101 / TS5090 | Config errors while adopting TypeScript 6 (see §5) | Fixed |
| `PHP_CLI_SERVER_WORKERS` | `artisan serve` warns it needs `--no-reload`; single worker used | Cosmetic |
| Unused stock files | `resources/js/app.js` and `resources/js/bootstrap.js` remain on disk but are no longer built | Intentional (no deletions without approval); can be removed in a later module |
| Legacy welcome view | `welcome.blade.php` kept, unreachable from routing, manifest reference updated | Intentional |
| No Tailwind configuration | Stock Tailwind 4 packages/CSS remain as delivered | Deferred to Module 04 |

No unresolved errors.

---

## 8. Verification Checklist

- [x] Vue 3 installed (3.5.45)
- [x] TypeScript installed (6.0.3) + `vue-tsc` (3.3.14)
- [x] Vite Vue plugin configured (`@vitejs/plugin-vue` 6.0.11)
- [x] Vue Router installed (4.6.5) with history-mode router foundation
- [x] Pinia installed (4.1.0) with shared instance
- [x] Axios installed (1.21.1) with reusable `services/http.ts` client
- [x] Vue application entry point prepared (`resources/js/app.ts`)
- [x] Laravel Vite integration working (HTTP 200 + manifest assets served)
- [x] TypeScript configuration verified (`vue-tsc --noEmit` exit 0)
- [x] `npm run build` successful (exit 0, 37 modules)
- [x] Documentation updated
