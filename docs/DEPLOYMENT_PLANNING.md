# DEPLOYMENT PLANNING — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Status:** Planning only — **no deployment executed.** Any execution requires a separate approved module and owner authorization.

---

## 1. Hosting infrastructure audit

### Verified locally (evidence)

| Item | Verified value / state | Evidence |
|---|---|---|
| Laravel framework | 12.72.0 (`laravel/framework` ^12.0) | `composer.json`, `php artisan --version` |
| PHP requirement | `^8.2` (verified locally 8.4.24) | `composer.json`, `php -v` |
| Required PHP extensions (16) | bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip — all enabled locally | `php -m` (Module 01) |
| Optional extension | `gd` disabled (only needed for image manipulation) | Module 01 report |
| Composer dependencies | `laravel/framework`, `laravel/tinker` (prod); dev deps listed separately | `composer.json` |
| Composer validity | `./composer.json is valid` | `composer validate` |
| Node / Vite (build-time) | Node 24.19.0 / npm 11.17.0; Vite 6.4.6; build exit 0 (88 modules) | `npm run build` |
| Build artifacts | `public/build/manifest.json` present; hashed CSS/JS/fonts emitted | `public/build/` |
| Storage / cache dirs | `storage/` (app, framework, logs), `bootstrap/cache/` exist | filesystem |
| `.htaccess` | Laravel SPA fallback rewrite + guarded mod_deflate/mod_expires | `public/.htaccess` |
| SPA fallback (local) | Direct loads for public routes return 200 | browser/HTTP checks |
| Sitemap | `/sitemap.xml` is a Laravel route (dynamic, APP_URL-based) | `routes/web.php` |
| Robots | `robots.txt` static file in `public/` | `public/robots.txt` |
| Environment (local) | `APP_ENV=local`, `APP_DEBUG=true`, `APP_URL=http://localhost`, `DB_CONNECTION=sqlite` | `.env` (key names/values not reproduced as secrets) |
| Public/hot | Absent (verified) | filesystem |
| Dev routes | `/dev/ui`, `/dev/layout` local-only (Laravel) + frontend `import.meta.env.DEV` guard | `routes/web.php`, router |
| TypeScript / tests | `npm run type-check` exit 0; `php artisan test` 2 passed | verified |

### Documented but not verified on hosting
- cPanel/shared hosting PHP ≥ 8.2 with required extensions enabled.
- Ability to set document root to `public/` (or approved secure alternative).
- Composer availability on host (optional; `vendor/` can be uploaded).
- Writable `storage/` and `bootstrap/cache/` on host.
- Apache `mod_rewrite` (and optional `mod_deflate`/`mod_expires`).
- HTTPS/SSL availability and trusted proxy configuration.
- No Node.js runtime needed on host after build (build-time dependency only).

### Owner decision required
- Production domain name and canonical preference (www vs non-www).
- Hosting provider/plan, cPanel access, SSH/terminal availability.
- Document root configuration approach.
- Production database engine (SQLite file vs MariaDB) and credentials provisioning.
- Deployment method (manual upload, FTP/SFTP, Git deploy, CI/CD).
- Whether a staging domain is needed.
- `gd` extension and upload limit tuning (optional, before media features).
- Whether to add verified OG image and `ProfessionalService` schema.
- Whether to retire `/dev/ui` and `/dev/layout` and remove unused scaffold artifacts.

### Hosting-provider confirmation required
- PHP version selection and extension availability.
- Document root configurability.
- Composer availability.
- Writable directory support.
- HTTPS/SSL and proxy behavior.
- Any provider-specific restrictions (file count, size limits, process limits).

## 2. Production infrastructure decision checklist

### Domain
- [ ] Production domain name confirmed.
- [ ] Primary domain vs subdomain decided.
- [ ] WWW vs non-WWW canonical preference decided.
- [ ] HTTPS/SSL availability confirmed.
- [ ] Staging domain needed? (yes/no)

### Hosting
- [ ] Hosting provider and plan confirmed.
- [ ] cPanel access available.
- [ ] PHP version selection confirmed (≥ 8.2).
- [ ] Document root can be set to Laravel `public/` (or approved alternative).
- [ ] SSH/Terminal availability confirmed (if needed).
- [ ] Composer availability confirmed (or upload `vendor/`).
- [ ] File Manager/SFTP deployment option confirmed.

### Database
- [ ] Production database engine decided (SQLite file vs MariaDB).
- [ ] Database name/credentials provisioned securely (never documented).
- [ ] Production database migration authorized (if MariaDB).
- [ ] Database backup method confirmed.
- [ ] Local SQLite/MariaDB vs production compatibility confirmed.

### Deployment method
Evaluate, without executing:
1. **Laravel project outside `public_html` with document root → `public/`** (recommended, preferred).
2. **Secure shared-hosting layout when document root cannot be changed** (less preferred; provider-specific).
3. **Build locally and upload production files via File Manager/SFTP.**
4. **Composer install on hosting, if supported.**
5. **Build locally and upload compiled frontend assets.**

**Recommendation:** Approach 1 (document root → `public/`) when the host supports it; otherwise Approach 2 with a secure, provider-approved layout. Build locally (Approaches 3/5) and upload `public/build` + application files; use Composer on host (Approach 4) only if available and approved. Conditions: host PHP ≥ 8.2 with required extensions; writable `storage/` and `bootstrap/cache/`; production `.env` created on host; `public/hot` absent; SPA fallback verified post-deploy.

## 3. Production environment plan (checklist only — no changes)

Production `.env` configuration checklist (values set on host only; never commit secrets):

- [ ] `APP_NAME` set to production name (e.g., IT Assistance BD Portfolio).
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` set to confirmed production URL (HTTPS).
- [ ] `APP_KEY` generated securely on host (do not reuse/copy local key).
- [ ] `APP_LOCALE` / fallback / faker set as appropriate.
- [ ] `LOG_CHANNEL`/`LOG_LEVEL` set for production (e.g., `stack`/`single`, level `error` or `warning`).
- [ ] `SESSION_DRIVER` chosen (database or file) and configured.
- [ ] `SESSION_ENCRYPT`/`SESSION_DOMAIN`/`SESSION_PATH` set per host/HTTPS.
- [ ] `CACHE_STORE` chosen and configured.
- [ ] `QUEUE_CONNECTION` chosen (sync or database) and workers configured if needed.
- [ ] `FILESYSTEM_DISK` configured.
- [ ] `BROADCAST_CONNECTION` configured.
- [ ] `MAIL_*` configured only if/when mail features are approved (mailto-only currently).
- [ ] `DB_CONNECTION` and credentials configured per approved DB strategy (SQLite or MariaDB).
- [ ] `BCRYPT_ROUNDS` appropriate for production.
- [ ] `AWS_*` configured only if storage features are approved.
- [ ] `VITE_APP_NAME` consistent with `APP_NAME`.
- [ ] HTTPS/proxy considerations (`TRUSTED_PROXIES`/hosts) set per host.
- [ ] No production secrets recorded in documentation or repository.

Use `.env.example` only as a reference template. Do not overwrite `.env`.

## 4. Deployment sequence design (documentation only — not executed)

1. Confirm owner decisions (domain, hosting, DB, deployment method, content approvals).
2. Confirm hosting compatibility (PHP version/extensions, document root, writability, Composer, HTTPS).
3. Approve deployment architecture.
4. Prepare production environment (`.env`, permissions, DB if approved).
5. Create verified backup of current hosting state and database (if applicable).
6. Prepare release artifact (run `npm run type-check`, `npm run build`; verify manifest/assets; ensure `public/hot` absent; `composer install --no-dev --optimize-autoloader` if applicable).
7. Upload application files per approved method (excluding `node_modules/`, `public/hot`, dev-only artifacts, secrets).
8. Configure environment on host.
9. Install production dependencies if applicable (Composer on host) or upload `vendor/`.
10. Run authorized database migration (only if DB strategy approved).
11. Set permissions and Laravel caches (`config:cache`, `route:cache`, `view:cache`) only after config is stable.
12. Verify public routes, assets, HTTPS, application behavior, SEO metadata, sitemap/robots, navigation, console.
13. Record release evidence (commands, outputs, smoke tests).
14. Keep rollback path available.

This is documentation only. Do not execute any step.

## 5. Backup & rollback plan

### What must be backed up
- Current hosting files (full document root / application root).
- Database (if applicable; none currently for app data beyond scaffold).
- Application source and release artifact (including `public/build`).
- `.env` (securely, never in repository/documentation).
- Upload/storage directories (if/when used).

### Backup handling
- Store backups securely; never expose backup files in public directories.
- Record release version identifier (date + module/version + build artifact hash/manifest).
- Keep a copy of the previous `public/build/` and application code for quick restore.

### Backup verification
- Verify backup integrity (file count/size, archive test) before release.
- Confirm restore procedure is understood (dry run if possible).

### Rollback conditions
- Any failed smoke test, broken route/asset, console error, SEO regression, or security issue post-deploy.
- Hosting incompatibility discovered during deployment.
- Owner decision to revert.

### Rollback sequence
1. Restore previous file backup (or previous release artifact) to application root/document root.
2. Restore previous database backup if DB changes were made.
3. Clear Laravel caches or remove cached files as appropriate.
4. Verify smoke tests (routes, assets, navigation, console, metadata, sitemap/robots).
5. Document rollback reason and outcome.

### Recovery verification
- Re-run local verification (`type-check`, `build`, `test`) before retrying.
- Escalate to Project Owner with evidence; do not modify live hosting without approval.

## 6. Security review

| Risk | Severity | Evidence / notes |
|---|---|---|
| `.env` exposure | High (if misconfigured) | `.env` must remain outside web root; never commit/upload secrets. |
| Laravel source exposure | High (if misconfigured) | App root must be outside document root or protected. |
| `storage/` and `bootstrap/cache/` permissions | Medium | Must be writable but not web-accessible. |
| Debug mode in production | High (if `APP_DEBUG=true`) | Checklist requires `APP_DEBUG=false`. |
| Secret handling | High | No secrets in repository/docs; production secrets set on host only. |
| HTTPS | Medium/High | SSL availability unconfirmed; canonical/SEO depend on HTTPS. |
| Directory listing | Low/Medium | `.htaccess` has `Options -Indexes` (guarded by mod_negotiation). |
| Backup files in public dirs | Medium | Backups must not be stored in `public/`. |
| Composer dev dependencies | Medium | Production install must use `--no-dev`. |
| Public error messages | Medium | Laravel production error handling must not expose stack traces. |
| Writable directories | Medium | Required for Laravel; must be secured. |
| File upload/security | Low (no upload feature yet) | No upload feature implemented; revisit if added. |

## 7. Documentation deliverables

Created:
- `docs/INSTALLATION_18_REPORT.md` (this module's report)
- `docs/DEPLOYMENT_PLANNING.md` (this document)
- `docs/OWNER_INFRASTRUCTURE_DECISIONS.md` (owner decision checklist)

Updated (as needed):
- `docs/IMPLEMENTATION_STATUS.md`
- `docs/MODULE_REGISTRY.md`
- `docs/ROADMAP.md`
- `docs/OPEN_ISSUES.md`
- `docs/CHANGELOG.md`
- `docs/README.md`
- `docs/DECISIONS.md` (only if an actual approved decision exists — none added in this planning module)

Historical reports preserved (not rewritten).

## 8. Validation

Non-destructive checks performed:
- Documentation link/path validation (relative Markdown links resolve).
- Deployment checklist completeness review (sections 2–6 cover decisions, env plan, sequence, backup/rollback, security).
- Production configuration consistency review (`.env.example` keys vs documented requirements).
- Project root and document-root path consistency review (recommended `public/` document root).
- `.env.example` review (no secrets; defaults documented).
- Existing build/typecheck/test checks: already verified in prior modules (`npm run type-check` exit 0, `npm run build` exit 0, `php artisan test` 2 passed). No source changes in this module; re-run not required for planning-only module, but baseline remains valid.

No application source files modified.

## 9. Known limitations

- No live hosting environment accessed or tested.
- Hosting compatibility is based on documented requirements and local verification only.
- Production domain, DB strategy, hosting provider, and deployment method are owner decisions.
- No deployment execution, DNS, SSL, or database migration performed.
- No numeric Lighthouse Performance score available (tooling limitation from Module 13).
- Mobile performance not measured (emulation unavailable).
- Owner content approval items remain unresolved (Modules 15–16).

## 10. Deployment readiness status

**NOT AUTHORIZED / BLOCKED (owner-dependent).** Planning complete; execution requires owner decisions, hosting details, and a separate approved deployment execution module. See `docs/OWNER_INFRASTRUCTURE_DECISIONS.md`.