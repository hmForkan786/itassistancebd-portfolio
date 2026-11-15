# INSTALLATION 21D.1 — HOSTING COMPATIBILITY REVIEW

**Project:** IT Assistance BD Portfolio  
**Project Root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Module:** Installation 21D.1  
**Date:** 2026-11-15  
**Status:** COMPLETE (read-only audit; no deployment performed)

---

## 1. Owner-supplied context (recorded, not verified)

- **Production domain (provided by owner):** `itassistancebd.com`
- **Hosting panel:** Existing WHM panel (cPanel/WHM environment)
- **Note:** These values are recorded as owner-supplied. They have not been verified against live hosting, DNS, or SSL. No credentials or server details are recorded.

## 2. Hosting compatibility checklist

Status key: `PASS` = verified locally with evidence. `FAIL` = verified failure. `UNKNOWN` = not verified on actual hosting (no hosting access). No item is marked PASS for hosting without evidence.

| # | Requirement | Why required | How owner can verify safely | Expected evidence | Status |
|---|---|---|---|---|---|
| 1 | PHP version >= 8.2 | Laravel 12 requires PHP ^8.2; verified locally on 8.4.24 | Check cPanel "Select PHP Version" / MultiPHP Manager; confirm selected version ≥ 8.2 | Screenshot or text showing PHP version ≥ 8.2 | UNKNOWN (hosting not accessed) |
| 2 | Required PHP extensions (bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip) | Laravel 12 framework requirements; all 16 verified locally | Check cPanel "Select PHP Version" → extensions list or run `php -m` via Terminal | List showing all 16 extensions enabled | UNKNOWN (hosting not accessed) |
| 3 | Apache mod_rewrite | Required for `.htaccess` SPA fallback (history-mode routes) and trailing-slash redirect | Check cPanel "Apache Modules" or ask hosting provider; verify `.htaccess` rewrite works after upload | `mod_rewrite` listed/enabled; direct route loads return 200 | UNKNOWN (hosting not accessed) |
| 4 | Laravel public document root | Laravel must serve from `public/` so `.env`, `vendor/`, `storage/`, source remain private and SPA fallback works | Set document root to `<app>/public` in cPanel "Domains" / "Addon Domains"; verify `/` loads Laravel app | Document root path ends in `/public`; app loads correctly | UNKNOWN (hosting not accessed) |
| 5 | Writable `storage/` and `bootstrap/cache/` | Laravel needs writable cache/logs/sessions/framework directories | Check permissions via File Manager; set 755/775 as host requires | Directories writable; no permission errors in logs | UNKNOWN (hosting not accessed) |
| 6 | Composer availability | Needed for `composer install --no-dev --optimize-autoloader` if installing on host | Check cPanel "Terminal" for `composer --version`; if unavailable, upload `vendor/` | Composer version output or successful `vendor/` upload | UNKNOWN (hosting not accessed) |
| 7 | SQLite support | Current app uses scaffold SQLite (`DB_CONNECTION=sqlite`); requires pdo_sqlite/sqlite3 | Check PHP extensions list for `pdo_sqlite`/`sqlite3` | Extensions enabled; SQLite connection works | UNKNOWN (hosting not accessed) |
| 8 | MariaDB/MySQL version and availability | Required only if DB strategy changes to MariaDB/MySQL; Laravel 12 supports MySQL 5.7+/MariaDB 10.3+ | Check cPanel "MySQL Databases" / "MariaDB" version; confirm ability to create DB/user | DB creation works; version ≥ supported minimum | UNKNOWN (hosting not accessed) |
| 9 | HTTPS/SSL availability | Required for production canonical URLs, SEO, secure cookies, and `APP_URL` | Check cPanel "SSL/TLS" or "Let's Encrypt"; confirm certificate can be issued | Valid SSL certificate; HTTPS loads without warnings | UNKNOWN (hosting not accessed) |
| 10 | Backup and restore capability | Needed for safe release and rollback | Check cPanel "Backup" / "Backup Wizard"; confirm full account backup + restore | Backup creation/restore tested (dry run) | UNKNOWN (hosting not accessed) |
| 11 | Upload limits | Affects artifact upload (build assets ~2–3 MB total; `vendor/` larger if uploaded) | Check cPanel PHP settings / `php.ini` via "Select PHP Version" or `phpinfo()` | `upload_max_filesize` and `post_max_size` sufficient (≥ 10 MB recommended for `vendor/` upload) | UNKNOWN (hosting not accessed) |
| 12 | Error/log access | Needed for diagnosis post-deployment | Check cPanel "Errors" / "Metrics" / file access to `storage/logs/` | Error logs accessible; `storage/logs/laravel.log` writable | UNKNOWN (hosting not accessed) |
| 13 | Node.js requirement | Build-time only; NOT required on hosting after build (artifacts uploaded) | N/A — build locally with Node 24.19.0 / npm 11.17.0 | Local `npm run build` exit 0; `public/build/manifest.json` present | PASS (local) — Node not required on host |
| 14 | SPA fallback and Laravel routing support | Vue Router history mode requires Laravel catch-all to serve SPA shell for client routes | Verify `.htaccess` rewrite to `index.php` is active; direct load/refresh of `/about`, `/projects/:slug` returns 200 with SPA shell | Direct route loads return 200; no server 404 on refresh | UNKNOWN (hosting not accessed) |

## 3. Locally verified (PASS) — not hosting-dependent

| Item | Verified value | Evidence |
|---|---|---|
| Laravel framework | 12.72.0 | `php artisan --version` |
| PHP (local) | 8.4.24 (ZTS x64) | `php -v` |
| Composer | 2.11.2; `composer validate` valid | `composer --version`, `composer validate` |
| Node.js / npm (build-time) | 24.19.0 / 11.17.0 | `node --version`, `npm --version` |
| Vite build | 6.4.6; exit 0; 88 modules | `npm run build` |
| TypeScript check | exit 0 | `npm run type-check` |
| Laravel tests | 2 passed, 2 assertions | `php artisan test` |
| Required PHP extensions (16) | All present locally | `php -m` |
| Build artifacts | `public/build/manifest.json` present; 15 JS + 1 CSS asset | filesystem |
| `public/hot` | Absent | filesystem |
| `.htaccess` | SPA fallback + guarded perf directives | `public/.htaccess` |
| SPA fallback (local) | Direct loads for public routes return 200 | HTTP checks |
| Sitemap | `/sitemap.xml` route; 10 URLs; well-formed XML | `routes/web.php`, browser check |
| Robots.txt | Static file in `public/`; safe rules | `public/robots.txt` |
| Dev routes | `/dev/ui`, `/dev/layout` local-only (Laravel) + frontend `import.meta.env.DEV` guard | `routes/web.php`, router |
| Storage/cache dirs | `storage/` (app, framework, logs), `bootstrap/cache/` exist | filesystem |
| Hardcoded localhost in resources | 0 (excluding `.env`) | grep scan |
| Secrets in production bundle | 0 | bundle scan |
| Dev strings in production bundle | 0 | bundle scan |
| Source maps in production build | 0 | filesystem scan |

## 4. Compatibility summary

- **Local technical baseline:** PASS (all verified items above).
- **Hosting compatibility:** UNKNOWN for all hosting-dependent items (no hosting access). No claim of cPanel capability is made without evidence.
- **Critical blockers for deployment:** hosting access/confirmation, document root configurability, PHP version/extensions, HTTPS/SSL, production domain, database strategy, deployment authorization.
- **No deployment performed.** No hosting, DNS, SSL, database, or `.env` changes made.

## 5. Owner verification actions (safe, no credentials)

The owner should verify the 14 items in Section 2 against the actual hosting account and record results (PASS/FAIL) without sharing credentials. Items 13 is already PASS (local). Items 1–12 and 14 require hosting evidence.

## 6. Safety confirmation

- No source files modified.
- No documentation files modified.
- No `.env` files modified.
- No database changes.
- No hosting access.
- No DNS or SSL changes.
- No deployment performed.
- No credentials exposed.
- No Installation 22 started.
- No production authorization granted.

**STOP CONDITION:** Installation 21D.1 audit complete. Report delivered. Wait for Project Owner instructions. Do not proceed automatically. No files created or modified. (Note: this report is returned as terminal output per the module's read-only mode.)