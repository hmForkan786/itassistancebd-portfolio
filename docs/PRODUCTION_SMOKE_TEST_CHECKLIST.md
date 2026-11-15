# PRODUCTION SMOKE-TEST CHECKLIST — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning only — no tests executed against live hosting.  
**Use:** Post-deployment verification in an approved deployment execution module.

---

## 1. Homepage `/`

- **Expected:** HTTP 200; title "IT Assistance BD — Digital Solutions Developer & Creative Problem Solver"; single H1 "Digital Solutions Developer & Creative Problem Solver"; header/footer present; sections home/about/services/projects/skills/contact render; no console errors.
- **Failure conditions:** 404/500, missing title/H1, missing header/footer, console errors, broken layout.

## 2. About `/about`

- **Expected:** HTTP 200; title "About — IT Assistance BD"; H1 "About"; single main landmark; no horizontal overflow; no console errors.
- **Failure conditions:** 404/500, wrong title/H1, missing content, console errors.

## 3. Services `/services`

- **Expected:** HTTP 200; title "Services — IT Assistance BD"; H1 "What I work on"; 7 service cards render; contact CTA present; no console errors.
- **Failure conditions:** missing cards/CTA, console errors, overflow.

## 4. Projects `/projects`

- **Expected:** HTTP 200; title "Projects — IT Assistance BD"; H1 "Initiatives in focus"; 5 project cards with statuses (4 Planned, 1 In Progress); status legend; cards link to detail pages; no console errors.
- **Failure conditions:** missing cards/statuses/links, console errors.

## 5. Project detail pages (5 slugs)

- **Expected (each):** HTTP 200; title "<Project name> — IT Assistance BD"; correct H1; status badge; overview/purpose/stack/confirmed work/planned scope/limitations sections; Back to Projects and Contact CTAs; single main landmark; no console errors.
  - `/projects/ai-kids-video-factory`
  - `/projects/scholarship-tracker`
  - `/projects/iiuc-tower-erp`
  - `/projects/applymate`
  - `/projects/it-assistance-bd-portfolio`
- **Failure conditions:** 404/500, wrong title/H1/status, missing sections/CTAs, multiple main landmarks, console errors.

## 6. Contact `/contact`

- **Expected:** HTTP 200; title "Contact — IT Assistance BD"; H1 "Get in touch"; verified email `hmforkan99@gmail.com` displayed; mailto links (2) resolve to the email; no `<form>`; no console errors.
- **Failure conditions:** missing email/mailto, unexpected form, console errors.

## 7. Unknown project slug `/projects/<unknown>`

- **Expected:** HTTP 200 (SPA route resolves); title "Project not found — IT Assistance BD"; H1 "Project not found"; in-page not-found message with Back to Projects and Contact links; single main landmark; no console errors.
- **Failure conditions:** server 404 (if SPA fallback broken), missing message/links, console errors.

## 8. SPA fallback (direct load / refresh)

- **Expected:** Direct URL load and browser refresh on any public route (`/`, `/about`, `/services`, `/projects`, `/projects/:slug`, `/contact`) returns the SPA shell and renders the correct page; no 404 from server.
- **Failure conditions:** server 404 on refresh, blank page, wrong route rendered.

## 9. Static assets

- **Expected:** `public/build/manifest.json` present; CSS/JS/font assets return 200; no `public/hot` file; hashed asset URLs resolve.
- **Failure conditions:** 404 assets, missing manifest, `public/hot` present, broken styling/scripts.

## 10. CSS and JavaScript loading

- **Expected:** Styles applied (brand colors, typography, layout); no unstyled content; JS executes; navigation works; no console errors.
- **Failure conditions:** unstyled page, JS errors, broken navigation.

## 11. HTTPS

- **Expected:** Site served over HTTPS; no mixed-content warnings; `APP_URL` uses HTTPS; canonical/sitemap/OG URLs use HTTPS.
- **Failure conditions:** HTTP-only access, mixed content, certificate errors, wrong canonical host.

## 12. Canonical URL

- **Expected:** Each public route has a canonical link matching the production URL (origin + path, no hash/query); no duplicate/incorrect canonicals.
- **Failure conditions:** missing/wrong canonical, localhost in canonical.

## 13. Sitemap `/sitemap.xml`

- **Expected:** HTTP 200; well-formed XML; contains 10 public URLs (5 pages + 5 project slugs); no dev/unknown slugs; no invented lastmod; correct namespace.
- **Failure conditions:** 404, malformed XML, missing/extra URLs, localhost URLs.

## 14. Robots.txt `/robots.txt`

- **Expected:** HTTP 200; safe rules (allow public, disallow `/dev/` and `/up`); no public pages blocked.
- **Failure conditions:** 404, rules blocking public pages, exposing sensitive paths.

## 15. Browser console errors

- **Expected:** 0 console errors on all checked pages and flows.
- **Failure conditions:** any console error (especially asset load failures, hydration errors, unhandled promise rejections).

## 16. Server errors

- **Expected:** No 5xx responses; no Laravel error pages (Whoops) in production; logs reviewed.
- **Failure conditions:** 5xx, error pages, fatal errors in `storage/logs/`.

## 17. Debug information exposure

- **Expected:** `APP_DEBUG=false`; no stack traces, env values, or debug output in responses.
- **Failure conditions:** debug output, stack traces, `.env` exposure.

## 18. Private file exposure

- **Expected:** `.env`, `vendor/`, `storage/`, `app/`, `config/`, `routes/`, `database/`, `bootstrap/` not web-accessible; backups not in `public/`.
- **Failure conditions:** any private file accessible via URL.

## 19. Navigation and responsive behavior

- **Expected:** Header/footer nav works; mobile disclosure opens/closes/Escape/focus restore; no horizontal overflow at 360/768/1024/1280/1440; back/forward works.
- **Failure conditions:** broken nav, overflow, broken back/forward, focus not restored.

## 20. SEO metadata (post-deploy)

- **Expected:** Titles/descriptions/OG/Twitter/canonical/robots/JSON-LD present and correct per route; project detail metadata dynamic; unknown slug has not-found metadata.
- **Failure conditions:** missing/wrong metadata, localhost in canonical/OG, JSON-LD invalid.

## 21. Additional checks

- [ ] Contact mailto links resolve to the approved email.
- [ ] Project detail Back to Projects / Contact CTAs work.
- [ ] Homepage hash navigation (`/#skills`, etc.) scrolls correctly.
- [ ] Footer links resolve.
- [ ] No broken internal links.
- [ ] Favicon loads.
- [ ] Font files load (200) and display correctly.

---

## Failure response

If any smoke test fails:
1. Stop further verification.
2. Capture evidence (URL, status, console, screenshot if available).
3. Do not attempt ad-hoc fixes on live hosting.
4. Restore from backup if needed (per rollback plan).
5. Escalate to Project Owner with evidence.
6. Document outcome in a subsequent approved module.

**No smoke tests executed in this module (planning only).** Execution requires an approved deployment execution module with hosting access.