# PRODUCTION UPLOAD CHECKLIST — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning only — no upload performed.

---

## Pre-upload

- [ ] Owner approval received for deployment execution.
- [ ] Hosting provider details confirmed.
- [ ] Production domain confirmed (`itassistancebd.com`).
- [ ] Document root strategy confirmed (prefer `public/`).
- [ ] Backup of current hosting state prepared (not executed).
- [ ] Rollback plan reviewed.

## Build verification

- [ ] `npm run type-check` passed (exit 0).
- [ ] `npm run build` passed (exit 0).
- [ ] `public/build/manifest.json` present.
- [ ] Hashed assets resolve (200).
- [ ] `public/hot` absent.
- [ ] No source maps in build.
- [ ] No secrets in production bundle.
- [ ] No dev-only showcase strings in production bundle.
- [ ] `php artisan test` passed (2 passed, 2 assertions).
- [ ] `composer validate` passed.

## Package contents (release/)

- [ ] `app/`, `bootstrap/`, `config/`, `database/` (migrations only, no local sqlite), `public/` (index.php, .htaccess, robots.txt, favicon.ico, build/), `resources/`, `routes/`, `storage/` (structure, cleaned), `vendor/`, `artisan`, `composer.json`, `composer.lock`.
- [ ] `release/.env.example` (production template, no secrets) present.
- [ ] `release/DEPLOYMENT_INSTRUCTIONS.md` present.
- [ ] No `.env`, `node_modules/`, `public/hot`, `docs/`, tests, Git credentials, API secrets, local databases, or dev logs included.

## Upload

- [ ] Upload release artifact to hosting account (owner-managed).
- [ ] Extract to approved application root.
- [ ] Place `public/` contents in document root (or approved layout).

## Post-upload configuration

- [ ] Create production `.env` on host from `release/.env.example` (no secrets committed).
- [ ] Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://itassistancebd.com`.
- [ ] Generate `APP_KEY` on host.
- [ ] Configure DB, session, cache, queue, logging per host.
- [ ] Set storage/bootstrap/cache permissions.
- [ ] Run Laravel cache commands after config stable.

## Verification

- [ ] Homepage loads (200, correct title/H1).
- [ ] All public routes load (including 5 detail slugs + unknown slug).
- [ ] SPA fallback works (direct load/refresh).
- [ ] Static assets load (200).
- [ ] No console errors.
- [ ] HTTPS active; no mixed content.
- [ ] Canonical URLs use production domain.
- [ ] Sitemap (`/sitemap.xml`) valid, 10 URLs.
- [ ] robots.txt served, safe rules.
- [ ] Navigation, back/forward, hash nav, mailto work.
- [ ] Responsive: no horizontal overflow at 360/768/1024/1280/1440.
- [ ] No private file exposure (`.env`, `vendor/`, `storage/`, etc.).
- [ ] No debug output / stack traces.
- [ ] Lighthouse (if run): a11y/bp/seo recorded.

## Rollback

- [ ] Previous release backup available.
- [ ] Rollback procedure reviewed (`docs/CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md` Section 17).
- [ ] Post-rollback smoke tests defined.

## Safety

- [ ] No hosting access performed by this module.
- [ ] No DNS/SSL changes performed.
- [ ] No database changes performed.
- [ ] No `.env` modified in project root.
- [ ] No source code changes.
- [ ] No destructive commands run.
- [ ] Original project remains intact.

**No upload performed in this module.** Execution requires an approved deployment execution module with owner authorization.