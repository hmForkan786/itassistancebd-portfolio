# CPANEL PRODUCTION DEPLOYMENT GUIDE — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning/guide only — **no deployment performed.** Any execution requires explicit owner authorization and a separately approved module.

---

## 1. Backup instructions

- Back up the current hosting account (full document root) and database (if applicable) before any change.
- Record a release version identifier (date + module/version + build artifact hash/manifest).
- Keep a copy of the previous `public/build/` and application code for quick restore.
- Verify backup integrity (file count/size, archive test) before release.
- Confirm restore procedure is understood (dry run if possible).

## 2. cPanel upload instructions

- Use cPanel File Manager or SFTP to upload the release artifact (prepared in `release/`) to the hosting account.
- Do not upload `.env`, Git credentials, API secrets, local databases, development logs, `node_modules/`, `public/hot`, `docs/`, or tests.
- Upload only the prepared release contents.

## 3. File extraction instructions

- Extract the uploaded archive into the approved application root.
- Ensure `public/` contents (including `public/build/`) land in the document root (or approved layout).

## 4. Document root configuration

- Preferred: set the domain's document root to `<app>/public`.
- If document root cannot be changed, use a provider-approved secure layout so only `public/` contents are web-accessible.
- Verify `/` loads the Laravel app after configuration.

## 5. Laravel application directory placement

- Place the Laravel application root outside the web root where hosting permits.
- Keep `.env`, `vendor/`, `storage/`, `app/`, `config/`, `database/`, `resources/`, `routes/`, `bootstrap/` private.
- Only `public/` contents should be web-accessible.

## 6. Environment configuration

- Create production `.env` on the host from the provided `.env.example` (in `release/`).
- Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://itassistancebd.com`.
- Set `APP_NAME`, locale, logging, session, cache, queue, filesystem, mail (if needed), and DB settings per host.
- Generate `APP_KEY` on the host (do not reuse/copy local key).
- Never commit or expose `.env` or secrets.

## 7. APP_KEY setup

- Run `php artisan key:generate` on the host (or set via hosting panel) to create a fresh production key.
- Do not copy the local `APP_KEY`.
- Store securely in production `.env` only.

## 8. Database configuration

- Current strategy: SQLite scaffold (`DB_CONNECTION=sqlite`). If MariaDB/MySQL is chosen, provision credentials securely and set `DB_*` in `.env`.
- No migrations executed by this guide.
- If MariaDB is chosen, run migrations only in an approved module with owner authorization.

## 9. Storage permissions

- Set `storage/` and `bootstrap/cache/` writable (755/775 as host requires).
- Ensure `storage/` and `bootstrap/cache/` are not web-accessible.
- Verify Laravel can write logs, cache, sessions.

## 10. Cache optimization

- After configuration is stable: `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`.
- Clear caches if configuration changes post-deploy.

## 11. SSL/HTTPS verification

- Enable SSL and confirm HTTPS loads without warnings.
- Verify canonical/sitemap/OG URLs use HTTPS.
- Set `SESSION_SECURE_COOKIE` and trusted proxies/hosts as needed.

## 12. Homepage verification

- Load `/` over HTTPS; confirm title, H1, header/footer, sections render; no console errors.

## 13. SPA route verification

- Direct load/refresh of `/about`, `/services`, `/projects`, `/projects/:slug`, `/contact`, unknown slug.
- Confirm 200 and correct render; no server 404.

## 14. Contact verification

- Verify email display and mailto links; confirm no form (as designed).

## 15. SEO verification

- Verify page titles/descriptions, canonical, OG, Twitter, JSON-LD, sitemap (`/sitemap.xml`), robots.txt.

## 16. Error troubleshooting

- Check `storage/logs/laravel.log` and hosting error logs.
- Confirm `APP_DEBUG=false` (no stack traces).
- Confirm `.env` not publicly accessible.

## 17. Rollback instructions

- Restore previous file backup and (if applicable) database backup.
- Clear Laravel caches.
- Verify smoke tests.
- Document reason/outcome.

---

## Required vs optional steps

**Required:** Backup, upload, extraction, document root, environment configuration, APP_KEY, storage permissions, SSL/HTTPS, homepage verification, SPA route verification, contact verification, SEO verification, error troubleshooting, rollback preparedness.

**Optional (owner decision):** Cache optimization commands, database migration (if MariaDB chosen), `gd` extension, upload limit adjustments, dev route retirement, scaffold cleanup, OG image, `ProfessionalService` schema.

---

## Safety

- No deployment performed by this guide.
- No hosting access, DNS, SSL, or database changes performed.
- No `.env` modification, no secrets.
- No destructive commands.
- No source code changes.

See `docs/PRODUCTION_UPLOAD_CHECKLIST.md` for the release checklist.