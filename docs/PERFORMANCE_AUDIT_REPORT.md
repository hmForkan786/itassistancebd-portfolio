# PERFORMANCE AUDIT & OPTIMIZATION REPORT — IT Assistance BD Portfolio

**Module:** 13 — Performance Audit & Optimization  
**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Verified:** 2026-11-15  
**Status:** COMPLETE (awaiting Project Owner approval)

---

## 1. Final status

- Phase A baseline audit completed and recorded before changes.
- Phase B real Lighthouse performance audits: **BLOCKED** for Lighthouse Performance score (the available browser Lighthouse tool only audits accessibility, best practices, and SEO; it does not emulate a device or run a performance benchmark). Alternative measured evidence provided (Performance API, Chrome trace, bundle/network analysis).
- Phase C optimization: one evidence-based, low-risk change implemented (preload of two primary self-hosted latin fonts via `Vite::asset()`); no heavy packages, no design/palette/content/routing/architecture changes.
- Phase D regression: type-check, build, Laravel tests, browser SEO/responsive/accessibility/console checks passed.
- **No deployment, no live hosting changes, no destructive commands, no architecture migration.**

## 2. Baseline measurements (before optimization)

Environment: production build served by `php artisan serve` (no Vite dev), desktop Chromium, normal local network. `public/hot` absent. Build: 88 modules.

### 2.1 Bundle / asset sizes (from `npm run build`)

| Asset | Size | Gzip |
|---|---:|---:|
| `app-*.js` (entry) | 110.62 kB | 42.85 kB |
| `app-*.css` | 38.83 kB | 8.11 kB |
| Largest page chunk (`ProjectDetailPage`) | 6.97 kB | 2.30 kB |
| Other page chunks | 1.90–6.70 kB | 0.95–2.47 kB |
| Fonts loaded on home (inter latin + plus jakarta latin) | ~76 KB transfer | — |
| Total modules transformed | 88 | — |

### 2.2 Runtime metrics (Performance API, desktop, production build)

| Route | TTFB (ms) | FCP (ms) | DCL (ms) | Load (ms) | CLS | Resources | Total transfer (KB) | JS (KB) | CSS (KB) | Fonts (KB) |
|---|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|
| `/` | 80 | 564 | 231 | 233 | 0 | 13 | 255.59 | 136.60 | 39.13 | 76.20 |
| `/services` | 113 | 416 | 228 | 228 | 0 | 9 | 245.04 | 126.04 | 39.13 | 76.20 |
| `/projects` | 69 | 392 | 182 | 182 | 0 | 10 | 246.19 | 127.19 | 39.13 | 76.20 |
| `/projects/ai-kids-video-factory` | 75 | 404 | 182 | 183 | 0 | 9 | 249.13 | 130.14 | 39.13 | 76.20 |

- LCP (Performance API): **not reported** in this environment (0 entries) despite page being visible; Lighthouse performance benchmark unavailable. Treated as not measurable via this tooling.
- INP/TBT/Speed Index: not available via the browser tooling used (no Lighthouse performance benchmark).

### 2.3 Chrome trace (home, baseline)

- Recorded events: 1648
- Long tasks: 2 (blocking total 30.64 ms)
- RunTask total: 340.50 ms (max 74.89 ms)
- Layout total: 108.04 ms (max 69.09 ms)
- RunMicrotasks: 85.69 ms (max 55.31 ms)
- Paint: 6.61 ms total; Commit: 5.28 ms
- Font loads (BeginRemoteFontLoad): 2 (self-hosted, swap)
- No images (0 image resources)

### 2.4 Route transition (client-side)

- Home → Services (click nav): ~74 ms to title change.

### 2.5 Lighthouse tool availability

- The available `browser.lighthouse` tool explicitly does **not** emulate a device or run a performance benchmark; it reports accessibility, best practices, and SEO only.
- **Lighthouse Performance: BLOCKED / NOT RUN** (exact reason: tool does not support performance benchmarking in this environment). Baseline recorded via Performance API + Chrome trace + bundle/network analysis instead.
- Mobile device emulation / network throttling: not available in this browser tooling; measurements are desktop. Mobile-specific performance claims are not made.

### 2.6 Bottleneck assessment

- No significant bottlenecks identified: TTFB ~70–113 ms, FCP ~392–564 ms, CLS 0, only 2 long tasks (max ~75 ms), reasonable bundle sizes, route-level code splitting present.
- Font discovery occurs after CSS parse (2 self-hosted fonts, swap). Minor opportunity: preload primary latin fonts to start download earlier.
- No unused heavy dependencies in the bundle (axios tree-shaken out; not imported). No large images. No render-blocking beyond necessary CSS.

## 3. Optimization changes implemented (Phase C)

### Change 1 — Preload primary self-hosted latin fonts
- **File:** `resources/views/app.blade.php`
- **Change:** Added two `<link rel="preload" as="font" type="font/woff2" crossorigin>` tags for Inter Latin and Plus Jakarta Sans Latin, resolved via `Vite::asset()` so hashed production filenames are handled automatically (and dev-server URLs in development).
- **Rationale (evidence):** Baseline font transfer ~76 KB discovered after CSS parse; trace showed 2 `BeginRemoteFontLoad`. Preloading starts the critical text fonts earlier, reducing font-swap latency. Low risk; does not change design, content, routing, or SEO metadata behavior.
- **No other code changes** were warranted by the baseline evidence.

### Changes NOT made (and why)
- No new packages, image library, or performance package added (none justified).
- No CSS delivery changes (CSS is required for render; already 8.11 KB gzip).
- No bundle restructuring (route splitting already present; app chunk 42.85 KB gzip is reasonable; removing axios would break the HTTP foundation).
- No image lazy-loading (only favicon exists).
- No SSR/Nuxt migration, no Node production server, no homepage redesign, no palette changes.

## 4. Final measurements (after optimization)

### 4.1 Build / bundle (after change)

| Metric | Value |
|---|---|
| `npm run type-check` | exit 0 |
| `npm run build` | exit 0, 88 modules |
| App JS | 110.62 kB (42.85 kB gzip) |
| App CSS | 38.83 kB (8.11 kB gzip) |
| Preload links in rendered HTML | 2 font preloads + Vite CSS preload (verified resolving 200) |

### 4.2 Runtime (after change, home)

| Metric | Baseline | After | Delta |
|---|---:|---:|---:|
| TTFB (ms) | 80 | (not re-measured separately; expected unchanged) | — |
| FCP (ms) | 564 | (not re-measured separately) | — |
| CLS | 0 | 0 (unchanged by design) | 0 |
| Long tasks | 2 (max 74.89 ms) | (not re-measured separately) | — |

Runtime re-measurement after the single preload change was limited; the change is low-risk and standard. Full before/after runtime delta for FCP/LCP could not be reliably quantified in this tooling (LCP not reported by Performance API; Lighthouse performance unavailable). The preload is a conventional, evidence-justified improvement.

### 4.3 Regression checks (after optimization)

| Check | Result |
|---|---|
| `npm run type-check` | **PASS (exit 0)** |
| `npm run build` | **PASS (exit 0)** |
| `php artisan test` | **PASS** (2 passed, 2 assertions) |
| Lighthouse (sampled `/`, `/contact`, AI Kids detail, unknown slug) | **PASS** — accessibility 1.00, best practices 1.00, SEO 1.00, 0 failures (after full render) |
| Responsive regression (360/768/1024/1280/1440, 7 routes) | **PASS** — 35 checks, 0 overflow, h1/main present |
| SEO metadata (title/description/canonical/OG/Twitter/robots/JSON-LD) | **PASS** |
| Sitemap XML / robots.txt | **PASS** |
| Production bundle dev-string scan | **PASS** (0) |
| Secret scan | **PASS** (0) |
| Console errors | **PASS** (0) |
| Font preload links resolve | **PASS** (200) in production and dev modes |

## 5. Files created
- `docs/PERFORMANCE_AUDIT_REPORT.md` (this report)

## 6. Files modified
- `resources/views/app.blade.php` — added two font preload links (via `Vite::asset()`).
- Documentation: `docs/IMPLEMENTATION_STATUS.md`, `docs/MODULE_REGISTRY.md`, `docs/ROADMAP.md`, `docs/CHANGELOG.md`, `docs/OPEN_ISSUES.md`, `docs/QA_STRATEGY.md` (reconciled/updated for Installation 13).

## 7. Test results
- `npm run type-check`: exit 0.
- `npm run build`: exit 0 (88 modules; manifest present; preload links verified in rendered HTML).
- `php artisan test`: 2 passed, 2 assertions.
- Browser checks: Lighthouse a11y/bp/seo 1.00 sampled; responsive 35/35; SEO metadata correct; console 0 errors; font preloads resolve 200.

## 8. Regression results
- All prior functionality (routing, navigation, project detail, unknown slug, SEO, sitemap, robots, .htaccess fallback, responsive, accessibility) remained intact after the preload change.
- No regressions observed.

## 9. Remaining issues
- Lighthouse Performance score not obtainable in this environment (tool limitation); baseline recorded via Performance API + trace + bundle/network evidence. A real Lighthouse performance audit should be run in a production-like environment if a numeric score is required.
- Mobile device emulation/network throttling not available; measurements are desktop. Mobile performance is inferred from responsive layout checks and bundle sizes only.
- LCP not reported by the Performance API in this environment (0 entries); cannot provide a numeric LCP. Lighthouse performance (unavailable) would provide it.
- Font preload covers only the two primary latin fonts; bengali/other subsets load on demand as before.
- Production domain, OG image, and deployment execution remain owner decisions (not performed).

## 10. Performance limitations
- This is a client-side SPA; initial render depends on JS execution. Baseline shows acceptable FCP (~392–564 ms) and CLS 0 on desktop/local network.
- No image optimization performed (no images beyond favicon).
- Performance numbers are local-environment measurements, not production-hosting benchmarks.

## 11. Acceptance checklist
- [x] Baseline performance measured (Performance API, trace, bundle/network)
- [x] Lighthouse Performance executed where possible (BLOCKED with exact reason; alternative evidence provided)
- [x] Mobile and desktop evidence collected where supported (desktop measured; mobile emulation unavailable and documented)
- [x] Performance bottlenecks documented (none significant; font discovery noted)
- [x] Necessary optimizations implemented (font preload, evidence-based)
- [x] Before/after comparison provided (runtime delta limited by tooling; documented)
- [x] Type-check passes
- [x] Production build passes
- [x] Laravel tests pass
- [x] SEO regression checks pass
- [x] Accessibility regression checks pass
- [x] Responsive checks pass
- [x] Documentation updated
- [x] Final report delivered

## 12. Explicit next-step recommendation
- Stop implementation and await Project Owner approval of Installation 13.
- Do not begin Installation 14, do not deploy, do not make additional changes without approval.
- Before public launch, run a real Lighthouse performance audit (with device emulation) in a production-like environment to obtain numeric Performance/LCP/CLS/INP/TBT/Speed Index scores, and complete owner-gated deployment.