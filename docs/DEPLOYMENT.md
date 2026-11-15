# DEPLOYMENT — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning/reference only — **deployment has not been performed or verified**. Any deployment execution requires Project Owner approval and a dedicated approved module/task.

---

## 1. Production architecture (target concept)

- **Backend:** Laravel 12 (PHP 8.2+; verified locally on 8.4.x) serving the SPA mount view and framework routes.
- **Frontend:** Built Vue 3/TypeScript/Vite assets served from `public/build/` via Laravel `@vite` manifest.
- **Routing:** SPA history-mode routes must fall back to Laravel (`public/index.php`) so direct loads/refresh on client routes work.
- **Data/content:** Currently static frontend data (`resources/js/data/*`) with scaffold SQLite locally; production database/content strategy depends on owner decisions.

## 2. Build process

Run in a build-capable environment with matching Node/npm tooling:

```bash
npm ci            # or npm install (prefer reproducible install in CI/build env)
npm run type-check
npm run build
```

- Produces hashed assets and `public/build/manifest.json`.
- `public/hot` must **not** be present in production.
- PHP dependencies: `composer install --no-dev --optimize-autoloader` in production environments (when appropriate/approved).

## 3. Deployment prerequisites

- Hosting with supported PHP version/extensions for Laravel 12 and required Node/build step (locally or in CI) to generate `public/build`.
- Web server configured to serve Laravel from the `public/` document root.
- Writable `storage/` and `bootstrap/cache/` directories for Laravel.
- Correct environment configuration (`.env`) created on server (never committed with secrets).
- Database/service credentials and mail settings only if/when approved features require them.
- **Owner-provided:** hosting access, domain/subdomain, SSL, database credentials (if used), and deployment approval.

## 4. Public directory considerations (cPanel/shared hosting)

- Preferred: set domain/subdomain document root to `<project>/public`.
- If document root cannot be changed (common on shared hosting), use an approved, secure hosting-specific approach (e.g. symlink or controlled document-root mapping). Do not expose `.env`, `vendor/`, `storage/`, or application source outside intended public paths.
- Ensure `public/build/` assets are uploaded and accessible.

## 5. Laravel configuration (production checklist)

- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` set to production URL.
- `APP_KEY` generated/set securely on server.
- Correct `APP_LOCALE`/timezone/logging/session/cache/queue/mail/filesystem settings as required.
- Run approved optimization/caching commands when appropriate (e.g. `php artisan config:cache`, `route:cache`, `view:cache`) only after config is stable.
- File/folder permissions per host requirements.

*Do not record actual secrets, passwords, or tokens in documentation.*

## 6. SPA routing requirements

- All non-file, non-existing public client routes must rewrite to `public/index.php` (Laravel front controller) so Vue Router history-mode paths load correctly.
- `/sitemap.xml` and `/robots.txt` should resolve correctly in production (sitemap is a Laravel route; robots.txt is a static file in `public/`). Ensure rewrite rules do not block these paths.
- Preserve/align with existing Laravel route behavior (`/up`, storage routes, local dev `/dev/*` handling is environment-dependent).
- Verify direct loads for `/`, `/about`, `/services`, `/projects`, `/projects/:slug`, `/contact`, and unknown project slug handling after deployment.

## 7. Environment configuration

- Create production `.env` from `.env.example` with owner-approved values.
- Keep database/mail/third-party credentials private and out of git/docs.
- If SQLite remains used in any environment, ensure file path/permissions are correct (only if approved); MariaDB setup requires owner decisions and migration plan.
- Confirm HTTPS, trusted proxies/hosts, and cookie/session settings as needed for host.

## 8. Deployment checklist (planning)

- [ ] Owner approval and deployment target details confirmed
- [ ] Build completed (`type-check`, `build`) and `public/build/manifest.json` present
- [ ] `public/hot` absent
- [ ] Server PHP/extensions/composer dependencies ready
- [ ] Document root points to `public/` (or approved equivalent)
- [ ] `.env` configured securely (`APP_ENV`, `APP_DEBUG`, `APP_URL`, `APP_KEY`, etc.)
- [ ] Storage/cache permissions set
- [ ] SPA fallback/rewrite rules verified
- [ ] Database/migration plan executed only if approved
- [ ] Smoke test: key routes, assets, navigation, console, contact mailto, project detail/unknown slug
- [ ] Rollback plan prepared

## 9. Rollback considerations

- Keep previous release artifact/build and (if applicable) database backup/rollback plan before changes.
- Be able to restore prior `public/build` assets and code revision quickly.
- Database rollbacks depend on migration/data-change strategy and must be planned/approved separately.
- Document actual deployment/rollback steps and outcomes only when performed.

## 10. Owner decisions still required

- Hosting provider/account, domain/subdomain, SSL, and document-root configuration.
- Deployment method (manual upload, FTP/SFTP, Git deploy, CI/CD) and approval to execute.
- Production environment values and secret management process.
- Database choice/configuration (continue scaffold behavior, SQLite file, or MariaDB) and migration/data strategy.
- Mail/contact handling in production (mailto-only remains current; backend form requires separate approved module).
- Whether/when to expose or retire dev-only routes in non-local environments (production bundle already excludes dev frontend routes).
- Content/status/contact confirmation before public launch.