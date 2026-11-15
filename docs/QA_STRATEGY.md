# QA STRATEGY — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Scope:** Verification strategy for approved modules (frontend SPA + Laravel shell). Record actual results only.

---

## 1. Quality gates by change type

| Change type | Minimum checks |
|---|---|
| Frontend/UI/routing/content/data changes | `npm run type-check`, `npm run build`, relevant browser/route checks, responsive checks for affected views, console/accessibility/content checks as applicable |
| Backend/Laravel integration affecting app behavior | `php artisan test`, `npm run build` (if views/assets affected), relevant HTTP/route/browser checks |
| Documentation-only (no app source changes) | Verify file existence, internal Markdown links, consistency with status/registry/reports, and that historical evidence is preserved; no false claims. App build/tests not required unless module specifies |
| Production/release readiness review | Build output, bundle review, SPA fallback/direct-load checks, env/config checklist (no secrets), documented limitations |

## 2. Type-check

- **Command:** `npm run type-check`
- **Tool:** `vue-tsc --noEmit` (strict TS project settings)
- **Pass criteria:** Exit 0 with no blocking type errors.
- **Evidence to record:** command, exit code/result, notable fixes (if any).

## 3. Production build

- **Command:** `npm run build`
- **Tool:** Vite production build (`laravel-vite-plugin`, Vue, Tailwind)
- **Pass criteria:** Exit 0, manifest/assets emitted to `public/build/`.
- **Evidence to record:** exit code, module count, key asset sizes/chunks if relevant, manifest presence.
- **Notes:** Ensure `public/hot` is absent for production-style behavior; rebuild before `php artisan test` when manifest is required.

## 4. Laravel tests

- **Command:** `php artisan test`
- **Pass criteria:** Expected test suite passes (currently stock example tests: 2 passed, 2 assertions).
- **Evidence to record:** pass/fail counts, assertions, duration/failures.
- **Notes:** Feature tests may depend on built assets/manifest in fresh checkout states.

## 5. Browser verification

- Verify in a real browser/dev session for affected routes/flows.
- **Route/page checks:** direct URL load, SPA navigation, back/forward history, correct title and primary heading, expected landmarks/content, 404/unknown-slug behavior where applicable.
- **Interaction checks:** header/footer nav, mobile disclosure behavior (open/close/Escape/focus as implemented), CTAs/links, hash navigation/scroll offset, project card/detail flows.
- **Console:** record errors/warnings relevant to defects; 0 console errors is required for "no console errors" claims.
- **Evidence:** route list, observed titles/h1/URL states, screenshots/DOM evidence when needed, console results.

## 6. Responsive testing

- **Target widths (baseline):** 360, 390, 768, 1024, 1440 px (and other relevant breakpoints as needed).
- **Checks:** no horizontal overflow/clipping, readable text, usable controls/navigation, layout integrity for key pages/components.
- **Evidence:** widths/routes tested, pass/fail counts, specific issues if found.

## 7. Accessibility

- **Checks:** semantic landmarks/headings, labels/names for controls, keyboard navigation/focus visibility/order, visible focus states, link/button semantics, `aria-*` correctness, contrast and non-color-only meaning as applicable.
- **Tooling:** Lighthouse accessibility audits where available/useful; manual keyboard checks.
- **Pass criteria:** no verified blocking accessibility defects in scope; report actual scores/failures.
- **Evidence:** Lighthouse scores/failures (sampled pages), keyboard/ARIA observations.

## 8. Performance and production audit

- Measure baseline before optimizing: bundle sizes, chunk loading, CSS/fonts/images, render-blocking, layout shifts, main thread, initial render, route transitions, network transfer.
- Use available tooling (Performance API, Chrome trace, network/bundle analysis). If Lighthouse Performance is unavailable, report BLOCKED/NOT RUN with exact reason and alternative evidence.
- Optimize only verified problems; document changes, before/after comparison, and regressions.
- **Evidence:** measured metrics, trace summaries, bundle/network outputs, optimization diffs.

## 9. SEO and metadata integrity

- Verify per-route titles/descriptions, canonical URL behavior, Open Graph/Twitter metadata, robots meta, and structured data (JSON-LD) use verified facts only.
- Validate `sitemap.xml` well-formedness and that it contains valid public routes only (no dev/unknown slugs).
- Validate `robots.txt` safety (no accidental blocking of public pages; no unnecessary exposure).
- Record Lighthouse SEO score/evidence (do not claim 100% unless obtained).
- **Evidence:** route checks, browser DOM/meta inspection, XML validation, Lighthouse reports.

## 9. Content integrity

- Verify factual accuracy against approved/data sources (`resources/js/data/*`, verified docs).
- **Checks:** correct project statuses, no fabricated claims (metrics, clients, testimonials, screenshots, demo/repo links, achievements), no placeholder/broken/misleading links, contact details/notes match verified state (email confirmation note where applicable), no unintended copy/status changes.
- **Evidence:** sampled findings, data/source references, explicit "no changes made" when applicable.

## 9. Production bundle checks

- Confirm `public/build/manifest.json` and built assets exist for production verification.
- Review bundle for unintended dev-only leakage (e.g. dev route/showcase strings absent in production JS where applicable).
- Verify SPA fallback/direct-load behavior in target environment configuration when relevant.
- **Evidence:** manifest presence, search/check results, asset observations.

## 10. Defect handling

- **Only fix verified defects within approved module scope.**
- For each fix record: defect description, affected file(s), correction made, and re-test/evidence.
- Do not refactor unrelated code or expand scope while fixing.
- If a defect cannot be fixed within scope/approval, document it in report/open issues with impact and owner action if needed.

## 11. Evidence and reporting requirements

- Report **actual results only** (commands run, exit codes, counts, routes/pages checked, observed behavior).
- Link or reference detailed evidence (e.g. `docs/PORTFOLIO_QA_REPORT.md`, module reports) instead of duplicating large logs.
- Update `docs/IMPLEMENTATION_STATUS.md`, `docs/MODULE_REGISTRY.md`, and relevant module docs when state/verification baseline changes.
- Preserve historical reports; do not replace detailed evidence with summaries.