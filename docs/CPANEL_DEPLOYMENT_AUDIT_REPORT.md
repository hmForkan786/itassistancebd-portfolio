# CPANEL / SHARED-HOSTING DEPLOYMENT AUDIT REPORT — IT Assistance BD Portfolio

**Module:** 14 — Production Deployment Preparation & cPanel Compatibility Audit  
**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Verified:** 2026-11-15  
**Status:** COMPLETE (audit/preparation only; no deployment performed)

---

## 1. Final status

- Hosting compatibility audit completed based on verified local environment and project configuration.
- Recommended deployment architecture documented (preferred: document root → `public/`).
- Production configuration checklist, artifact assessment, backup/rollback plan, security checklist, and smoke tests documented.
- **No live deployment, no DNS changes, no production upload, no database migration, no live hosting modification, no destructive commands.**
- Required validation passed: type-check exit 0, build exit 0, Laravel tests 2 passed.

## 2. Hosting compatibility findings

### Verified facts (from local inspection)
- **Laravel:** 12.72.0 (`laravel/framework` ^12.0), PHP requirement `^8.2` (verified on 8.4.24).
- **Composer deps:** `laravel/framework`, `laravel/tinker`; dev deps `fakerphp/faker`, `laravel/pail`, `laravel/pint`, `laravel/sail`, `mockery/mockery`, `nunomaduro/collision`, `phpunit/phpunit`. Production install should use `composer install --no-dev --optimize-autoloader`.
- **Required PHP extensions (16):** bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip — all enabled locally. `gd` not enabled (optional; only needed for image manipulation).
- **Runtime limits (local):** memory_limit 512M, upload_max_filesize 2M, post_max_size 8M, timezone UTC. Upload limits are low for media features (owner decision).
- **Node/Vite:** Node 24.19.0 / npm 11.17.0 locally. **Node is NOT required on hosting** after the production build is generated (build artifacts committed/uploaded).
- **Build artifacts:** `public/build/manifest.json` present; 88 modules transformed; hashed CSS/JS/font assets emitted.
- **Storage/cache:** `storage/` (app, framework, logs) and `bootstrap/cache/` exist and must be writable on host.
- **SPA fallback:** Laravel catch-all (`routes/web.php`) + standard `.htaccess` rewrite to `index.php` present and verified locally.
- **Sitemap/robots:** `/sitemap.xml` is a Laravel route (dynamic, APP_URL-based); `robots.txt` is a static file in `public/`.
- **Environment:** `.env` exists locally with `APP_ENV=local`, `APP_DEBUG=true`, `APP_URL=http://localhost`, `DB_CONNECTION=sqlite`. Production values must be set on host (never committed).

### Hosting assumptions (not verified — require owner/provider confirmation)
- cPanel/shared hosting PHP version ≥ 8.2 with required extensions enabled.
- Ability to set document root to `public/` (or use an approved secure alternative).
- Composer availability on host (optional; `vendor/` can be uploaded instead).
- Writable `storage/` and `bootstrap/cache/` (standard Laravel requirement).
- Apache with `mod_rewrite` (for `.htaccess`); `mod_deflate`/`mod_expires` optional (guarded).
- HTTPS/SSL availability and trusted proxy configuration.
- No Node.js runtime needed on host after build.

## 3. PHP and extension requirements

- **PHP:** ≥ 8.2 (verified locally 8.4.24; host must provide compatible version).
- **Required extensions (16):** bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip.
- **Optional:** gd (only if image manipulation is added later); intl/exif/etc. are enabled locally and may be useful.
- **Composer:** 2.x (verified 2.11.2). Production: `composer install --no-dev --optimize-autoloader` (if Composer is available on host) or upload `vendor/`.
- **Database:** currently scaffold SQLite (`DB_CONNECTION=sqlite`, `database/database.sqlite`). MariaDB is available locally but not connected for app data. Production DB strategy requires owner decision (SQLite file vs MariaDB). If MariaDB is chosen, a database module (migrations, credentials handling) is required and must be approved separately.
- **Node/npm:** only needed at build time (locally/CI). Not required on hosting after `public/build` is generated.

## 4. Deployment architecture (recommended)

**Recommended approach: Document root → Laravel `public/` directory.**

- Application root (all files except `public/` contents) resides outside the web root where hosting permits.
- Web server document root points to `<project>/public`.
- Laravel front controller (`public/index.php`) handles SPA fallback via `.htaccess` rewrite.
- `.env`, `vendor/`, `storage/`, `app/`, `config/`, `database/`, `resources/`, `routes/` remain private.
- `public/build/` (Vite assets + manifest) and `public/robots.txt` are served directly; `/sitemap.xml` is served by Laravel.

**Alternative (if document root cannot be changed):** Use a hosting-specific secure layout (e.g., symlink or controlled mapping) so that only `public/` contents are web-accessible. Do not expose `.env`, `vendor/`, `storage/`, or source. This requires provider-specific setup and owner approval; it is less preferred. Never place the application root inside a publicly browsable directory without protection.

**Requirements/limitations:**
- Requires host support for setting document root (or approved alternative).
- Requires writable `storage/` and `bootstrap/cache/`.
- Requires production `.env` created on host (never committed).
- `public/hot` must be absent in production.
- Dev-only frontend routes are already excluded from the production bundle; Laravel `/dev/*` is local-only.

## 5. Required deployment files (artifact assessment)

### Must deploy (private app + public assets)
- Application code: `app/`, `bootstrap/`, `config/`, `database/` (if used), `resources/`, `routes/`, `storage/` (structure), `vendor/` (if not running Composer on host), `artisan`, `composer.json`/`composer.lock`.
- Public web root contents: `public/index.php`, `public/.htaccess`, `public/robots.txt`, `public/favicon.ico`, `public/build/` (manifest + assets).
- Environment: production `.env` created on host (not from local; never commit secrets).

### Must remain private (never publicly exposed)
- `.env` (secrets/credentials)
- `vendor/`
- `storage/` (logs, cache, sessions, uploads)
- `database/` (including SQLite file if used)
- `app/`, `config/`, `routes/`, `resources/`, `bootstrap/`
- Any backup files, keys, or credentials

### Must include
- `public/build/manifest.json` and hashed assets (required for `@vite`).
- `public/.htaccess` (SPA fallback + performance directives).

### Must NOT include in production
- `public/hot`
- `node_modules/` (not needed after build)
- Dev-only source not in build (Vite excludes dev routes already)
- Any secrets, `.env` from local, or credentials

### Composer / Node on hosting
- **Node:** not required on host after build (build artifacts uploaded).
- **Composer:** optional; if unavailable, upload `vendor/` produced by `composer install --no-dev --optimize-autoloader`.

## 6. Security checklist

- [ ] `APP_ENV=production`, `APP_DEBUG=false`
- [ ] `APP_KEY` generated securely on host (never reuse/copy local key? Use a fresh production key)
- [ ] `APP_URL` set to confirmed production URL (HTTPS)
- [ ] HTTPS enforced (SSL configured; trusted proxies/hosts set as needed)
- [ ] `.env` not publicly accessible
- [ ] `storage/` and `bootstrap/cache/` writable but not web-accessible
- [ ] `vendor/`, `app/`, `config/`, `routes/`, `database/` not web-accessible
- [ ] No secrets in frontend bundle (verified: scan 0)
- [ ] No dev-only showcase routes in production bundle (verified: scan 0)
- [ ] Laravel `/dev/*` local-only (production returns 404/SPA fallback as appropriate)
- [ ] Error handling/logging configured (no debug output)
- [ ] File permissions set per host requirements
- [ ] Backup of current hosting state before release
- [ ] Rollback procedure prepared and tested (dry run if possible)

## 7. Backup & rollback plan

### Pre-release backup (documented procedure; not executed)
1. Back up current hosting files (full site/document root) and database (if applicable) before any change.
2. Record release version identifier (date + module/version + build artifact hash/manifest).
3. Keep a copy of the previous `public/build/` and application code for quick restore.

### Rollback procedure
1. Restore previous file backup (or previous release artifact) to the application root/document root.
2. Restore previous database backup if DB changes were made (none in this module).
3. Clear Laravel caches (`config:cache`, `route:cache`, `view:cache`) or remove cached files as appropriate.
4. Verify smoke tests (routes, assets, navigation, console, metadata, sitemap/robots).
5. Document the rollback reason and outcome.

### Failure response
- If deployment fails, do not continue partial changes; restore from backup.
- Capture error logs (`storage/logs/`) and hosting error logs for diagnosis.
- Re-run local verification (`type-check`, `build`, `test`) before retrying.
- Escalate to Project Owner with evidence; do not modify live hosting without approval.

## 8. Test evidence (current local verification)

| Check | Result | Evidence |
|---|---|---|
| PHP version/extensions | PASS | PHP 8.4.24; 16 required extensions enabled |
| Composer validity | PASS | `composer validate` valid |
| `npm run type-check` | PASS (exit 0) | `vue-tsc --noEmit` |
| `npm run build` | PASS (exit 0) | 88 modules; `public/build/manifest.json` present |
| `php artisan test` | PASS | 2 passed, 2 assertions |
| SPA fallback (local) | PASS | direct loads for public routes return 200 |
| Sitemap XML (local) | PASS | well-formed, 10 URLs |
| robots.txt (local) | PASS | served; safe rules |
| Production bundle dev-string scan | PASS | 0 |
| Secret scan (prod JS) | PASS | 0 |
| Console errors (checked pages) | PASS | 0 |
| Lighthouse a11y/bp/seo (sampled) | PASS | 1.00/1.00/1.00, 0 failures |
| Responsive regression | PASS | 35 checks, 0 overflow |
| Lighthouse Performance | BLOCKED | Tool does not run performance benchmark |
| Deployment execution | NOT RUN | No live hosting access/changes |

## 9. Hosting limitations

- No live hosting environment was accessed or tested; compatibility is based on documented requirements and local verification only.
- Document root configuration and provider-specific constraints are unknown until owner provides hosting details.
- MariaDB/SQLite production strategy not decided; no database migration executed.
- Upload limits (2M/8M local) may be insufficient for media features; owner decision needed.
- `gd` extension not enabled locally (optional; needed only for image manipulation).
- Production domain unconfirmed (`APP_URL=http://localhost`); canonical/sitemap/robots absolute references depend on it.
- No CI/CD or automated deployment pipeline configured (manual process documented).
- `.htaccess` performance directives depend on optional Apache modules (`mod_deflate`, `mod_expires`); they are guarded and non-fatal if absent.

## 10. Owner decisions required
1. Approve Installation 14 audit/preparation baseline (or request revisions).
2. Provide hosting provider/account details, domain/subdomain, SSL, and document-root configuration.
3. Choose deployment method (manual upload, FTP/SFTP, Git deploy, CI/CD) and approve execution module.
4. Decide production database strategy (SQLite file vs MariaDB) and credentials handling (never document secrets).
5. Decide whether to enable `gd` and adjust upload limits before media features.
6. Confirm content/status/contact details before public launch.
7. Decide whether to add verified OG image and `ProfessionalService` schema.
8. Decide when to retire `/dev/ui` and `/dev/layout` and remove unused scaffold artifacts.

## 11. Acceptance checklist
- [x] Project architecture inspected
- [x] Laravel hosting requirements documented
- [x] cPanel compatibility assumptions identified (verified facts vs assumptions distinguished)
- [x] Deployment architecture recommended
- [x] Public/private file separation documented
- [x] Production configuration checklist prepared
- [x] Backup and rollback plan documented
- [x] Deployment files assessed
- [x] Existing application build remains successful
- [x] TypeScript checks pass
- [x] Laravel tests pass
- [x] Documentation updated
- [x] Final audit report delivered
- [x] No live deployment performed
- [x] No destructive actions performed

## 12. Next-step recommendation
- Stop implementation and await Project Owner approval of Installation 14.
- Do not begin Installation 15, do not deploy, and do not make additional changes without approval.
- When ready to deploy, create a separate approved deployment execution module with hosting details, run the checklist, perform backup, deploy, and run smoke tests (SPA fallback, assets, navigation, console, metadata, sitemap/robots). Document actual deployment and rollback outcomes only when performed.