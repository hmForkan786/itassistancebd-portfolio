# PRODUCTION RELEASE EXECUTION PLAN — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning only — **no deployment executed.** Any execution requires explicit owner authorization and a separately approved module.

---

## 1. Purpose

Document a controlled, step-by-step production release procedure for future authorized execution. No step is executed in this document.

## 2. Pre-deployment authorization gate

Before any execution, confirm:
- Owner has approved deployment (A1).
- Owner has provided hosting details (provider, domain, SSL, document root).
- Owner has approved DB strategy and migration authorization (if applicable).
- Owner has approved backup execution (A2) and rollback dry-run (A3, if possible).
- Owner has confirmed content decisions (or explicitly accepted current conservative content).

If any gate is unmet, deployment is BLOCKED.

## 3. Pre-deployment backup

1. Back up current hosting files (full document root / application root).
2. Back up database (if applicable; none currently for app data beyond scaffold).
3. Back up upload/storage directories (if/when used).
4. Securely back up `.env` (never in repository/documentation).
5. Record release version identifier (date + module/version + build artifact hash/manifest).
6. Keep a copy of the previous `public/build/` and application code for quick restore.
7. Verify backup integrity (file count/size, archive test) before release.
8. Confirm restore procedure is understood (dry run if possible).

## 4. Application upload

1. Prepare release artifact locally:
   - Run `npm run type-check` (must pass).
   - Run `npm run build` (must pass; verify `public/build/manifest.json` and hashed assets).
   - Ensure `public/hot` is absent.
   - Run `composer install --no-dev --optimize-autoloader` (if Composer available; else prepare `vendor/`).
   - Verify no secrets in bundle (secret scan).
   - Verify no dev-only showcase content in bundle (dev-string scan).
2. Exclude from upload: `node_modules/`, `public/hot`, `.env` (local), dev-only artifacts, secrets, backup files.
3. Upload application files per approved method (manual upload / FTP/SFTP / Git deploy / CI/CD) to the approved application root.
4. Upload `public/` contents to the document root (or per approved layout).

## 5. Document root verification

- Confirm document root points to Laravel `public/` (or approved secure alternative).
- Confirm `.htaccess` is in place (SPA fallback + perf directives).
- Confirm `public/build/` assets are accessible.
- Confirm `/sitemap.xml` and `/robots.txt` resolve.

## 6. Production environment setup

On host only (never commit):
- Create production `.env` from `.env.example` with owner-approved values.
- Set `APP_NAME`, `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://<confirmed-domain>`.
- Generate `APP_KEY` securely on host (do not reuse/copy local key).
- Set `APP_LOCALE`, `APP_FALLBACK_LOCALE`, `APP_FAKER_LOCALE`.
- Set `LOG_CHANNEL`, `LOG_LEVEL` (production-appropriate).
- Set `SESSION_DRIVER`, `SESSION_LIFETIME`, `SESSION_SECURE_COOKIE`, `SESSION_DOMAIN`, `SESSION_PATH` per host/HTTPS.
- Set `CACHE_STORE`, `QUEUE_CONNECTION` per host capabilities.
- Set `FILESYSTEM_DISK`, `BROADCAST_CONNECTION`.
- Set `MAIL_*` only if mail features approved.
- Set `DB_CONNECTION` and credentials per approved DB strategy.
- Set `BCRYPT_ROUNDS`, `AWS_*` only if relevant features approved.
- Set `VITE_APP_NAME` consistent with `APP_NAME`.
- Set HTTPS/proxy considerations (`TRUSTED_PROXIES`/hosts) per host.
- Never record secrets in documentation or repository.

## 7. APP_KEY generation on host

- Run `php artisan key:generate` on host (or set via hosting panel) to create a fresh production key.
- Do not copy the local `APP_KEY`.
- Store securely in production `.env` only.

## 8. Database configuration

- Apply approved DB strategy (`DB_CONNECTION`, credentials) in production `.env`.
- If SQLite: ensure `database/database.sqlite` path/permissions are correct (only if approved).
- If MariaDB/MySQL: provision database and credentials securely; never document secrets.
- No database migration executed in this module.

## 9. Authorized migrations

- Run migrations only if DB strategy is approved and migration authorization is granted.
- Use `php artisan migrate --force` (production) only when authorized.
- Back up database before migration.
- Verify migration success and rollback plan.

## 10. Storage permissions

- Set writable permissions on `storage/` and `bootstrap/cache/` per host requirements.
- Ensure `storage/` and `bootstrap/cache/` are not web-accessible.
- Verify Laravel can write logs, cache, sessions.

## 11. Laravel cache commands

Only after configuration is stable:
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan optimize` (if appropriate)

Clear caches if configuration changes post-deploy.

## 12. Frontend asset verification

- Confirm `public/build/manifest.json` exists and entries resolve.
- Confirm hashed CSS/JS/font assets are served (200).
- Confirm no `public/hot` file.
- Confirm no dev-only showcase content in bundle (dev-string scan 0).
- Confirm no secrets in bundle (secret scan 0).

## 13. HTTPS verification

- Confirm SSL is active and certificate valid.
- Confirm `APP_URL` uses HTTPS.
- Confirm canonical URLs, sitemap, and OG metadata use HTTPS.
- Confirm session cookies secure (`SESSION_SECURE_COOKIE`) where appropriate.
- Confirm trusted proxies/hosts configured for host.

## 14. Application smoke tests

See `docs/PRODUCTION_SMOKE_TEST_CHECKLIST.md`. Summary:
- Homepage, About, Services, Projects, project details, Contact, unknown route.
- SPA fallback (direct load/refresh).
- Static assets, CSS/JS loading.
- HTTPS, canonical URL, sitemap, robots.txt.
- Browser console errors.
- Server errors / debug info exposure.
- Private file exposure.
- Navigation and responsive behavior.

## 15. Release evidence recording

- Record all commands executed, outputs, and results.
- Record build artifact hash/manifest reference.
- Record smoke-test results.
- Record any issues and resolutions.
- Document actual deployment and rollback outcomes only when performed.

## 16. Post-deployment verification

- Re-run smoke tests after cache warming.
- Monitor error logs (`storage/logs/`, hosting error logs).
- Verify SEO metadata and sitemap/robots.
- Verify performance (optional Lighthouse) in production.
- Confirm no console errors.

## 17. Rollback path

- Keep previous release artifact and `public/build` for quick restore.
- Keep database backup (if DB changes were made).
- Rollback procedure: restore previous files, restore DB if needed, clear caches, verify smoke tests, document reason/outcome.
- Escalate to Project Owner with evidence; do not modify live hosting without approval.

## 18. Safety

- No deployment executed in this document.
- No hosting access, DNS, SSL, or DB changes.
- No `.env` modification, no secrets.
- No destructive commands.
- No source code changes.
- Preserve all project files and historical documentation.