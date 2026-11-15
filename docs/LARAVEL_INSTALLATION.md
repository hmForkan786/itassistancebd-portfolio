# LARAVEL INSTALLATION — Module 02

**Project:** IT Assistance BD Portfolio
**Module:** 02 — Laravel 12 Project Installation
**Date:** 2026-11-15
**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`
**Status:** **COMPLETE — Laravel 12.72.0 installed and verified**

---

## 1. Laravel Version

| Item | Value |
|---|---|
| Framework | **Laravel Framework 12.72.0** (`laravel/framework` v12.72.0) |
| Skeleton package | `laravel/laravel` **v12.0.0** |
| PHP | 8.4.24 (CLI, ZTS x64) |
| Composer | 2.11.2 |
| Environment | `local` (debug enabled) |

`php artisan --version` → `Laravel Framework 12.72.0`

---

## 2. Installation Method

**Official Composer mechanism only** — no ZIP download, no global Laravel installer (none is installed; `where laravel` → not found).

The project root already contained the Module 01 documentation (`docs/`), so the skeleton was installed into a temporary staging folder **inside the project root** and then moved up, guaranteeing that no existing file was overwritten:

```powershell
cd C:\xampp\htdocs\Laravel\Portfolio
composer create-project laravel/laravel:^12.0 _laravel_staging --no-interaction --prefer-dist
# then every entry (incl. dotfiles) moved to the project root; nothing existed to overwrite
# empty _laravel_staging folder removed afterwards
```

`composer create-project` performed the standard official post-install scripts:

- `post-create-project-cmd`: copy `.env.example` → `.env`, `php artisan key:generate`, create `database/database.sqlite`, `php artisan migrate --graceful`
- `post-autoload-dump`: `php artisan package:discover` (laravel/pail, laravel/sail, laravel/tinker, nesbot/carbon, nunomaduro/collision, nunomaduro/termwind discovered successfully)
- `post-update-cmd`: `php artisan vendor:publish --tag=laravel-assets` (no publishable resources)

No nested `Portfolio\Portfolio` directory exists. Nothing outside the project directory was touched.

---

## 3. Project Directory

```
C:\xampp\htdocs\Laravel\Portfolio
├── app\            (Http\Controllers, Http, Models, Providers)
├── bootstrap\
├── config\
├── database\       (factories, migrations, seeders, database.sqlite)
├── docs\           (Module 01 + Module 02 documentation — preserved)
├── public\
├── resources\
├── routes\
├── storage\
├── tests\
├── vendor\
├── .editorconfig
├── .env
├── .env.example
├── .gitattributes
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── README.md
└── vite.config.js
```

All standard Laravel 12 directories are present. `docs/` is the only project-specific folder (documentation only). No custom architecture folders were created.

---

## 4. Composer Verification

| Command | Result |
|---|---|
| `composer validate` | `./composer.json is valid` |
| `composer check-platform-reqs` | **all `success`** (php 8.4.24, composer-runtime-api 2.2.2, ext-dom, ext-fileinfo, ext-filter, ext-hash, ext-iconv, ext-json, ext-libxml, ext-openssl, ext-pcre, ext-phar, ext-session, ext-tokenizer, ext-xml, ext-xmlwriter; ext-ctype/mbstring satisfied by Symfony polyfills) |
| `composer show laravel/framework` | `versions : * v12.72.0` |

Installed packages: **112 total** (production + dev), lock file written (`composer.lock`). `No security vulnerability advisories found` during installation.

Useful dev tooling installed by the skeleton: `laravel/pint` 1.32.3, `laravel/pail` 1.3.0, `laravel/tinker` 2.11.1, `laravel/sail` 1.70.0, `phpunit/phpunit` 11.5.58, `nunomaduro/collision` 8.9.6.

---

## 5. Artisan Verification

| Command | Result |
|---|---|
| `php artisan --version` | `Laravel Framework 12.72.0` |
| `php artisan about` | bootstraps fully — Application Name `IT Assistance BD Portfolio`, PHP 8.4.24, Composer 2.11.2, env `local`, Debug `ENABLED`, Timezone UTC, Locale en, Config/Routes/Events `NOT CACHED` |
| `php artisan route:list` | **4 routes** — `GET|HEAD /` (`routes/web.php:5`), `GET|HEAD up` (health), `GET|HEAD storage/{path}` and `PUT storage/{path}` (signed local-storage routes) |
| `php artisan test` | **2 passed** (2 assertions) — `Tests\Unit\ExampleTest`, `Tests\Feature\ExampleTest` ("the application returns a successful response") |

No bootstrap, autoload, or package-discovery errors occurred. `storage/logs/` contains no error log (only `.gitignore`).

---

## 6. Application Configuration (`.env`)

Created by the official skeleton, then one value adjusted. **No secrets are reproduced in this document** (`APP_KEY` masked).

| Key | Value | Note |
|---|---|---|
| `APP_NAME` | `IT Assistance BD Portfolio` | Adjusted from skeleton default `Laravel` |
| `APP_ENV` | `local` | Development |
| `APP_DEBUG` | `true` | Kept enabled for local development |
| `APP_URL` | `http://localhost` | Skeleton default; will be aligned with the dev server in a later module |
| `APP_KEY` | base64 key, **set** | Generated once by the skeleton; masked here |
| `APP_LOCALE` / fallback / faker | `en` / `en` / `en_US` | Defaults |
| `LOG_CHANNEL` / `LOG_STACK` / `LOG_LEVEL` | `stack` / `single` / `debug` | Default local logging |
| `SESSION_DRIVER` | `database` | Default Laravel 12 |
| `CACHE_STORE` | `database` | Default |
| `QUEUE_CONNECTION` | `database` | Default |
| `BROADCAST_CONNECTION` | `log` | Default |
| `FILESYSTEM_DISK` | `local` | Default |
| `MAIL_MAILER` | `log` | Default (no mail credentials configured) |
| `DB_CONNECTION` | `sqlite` | **Skeleton default — MariaDB switch belongs to the database module** |

`.env` was **not** overwritten (it did not exist before this module). `.env.example` is untouched. No production credentials were configured.

### Database note

Laravel 12's official skeleton defaults to SQLite and, during installation, creates `database/database.sqlite` and runs its three default migrations (`create_users_table`, `create_cache_table`, `create_jobs_table`).

- This is the **framework's own scaffold database**, not the portfolio database.
- **No MariaDB database was created or modified.** The existing XAMPP databases remain untouched.
- Switching `DB_CONNECTION` to MariaDB and creating the `portfolio` schema is explicitly deferred to the database module, pending owner approval.
- The SQLite file was **not deleted** (no deletion without approval); it can be removed or repurposed later if the owner prefers.

---

## 7. Local Application Verification

**Method:** `php artisan serve --host=127.0.0.1 --port=8123` (dedicated port, no Apache configuration changed, no existing service started/stopped).

Actual HTTP results:

| Request | Result |
|---|---|
| `GET http://127.0.0.1:8123/` | **200 OK**, `text/html; charset=utf-8`, 80,650 bytes, `<title>Laravel</title>` (stock welcome page) |
| `GET http://127.0.0.1:8123/up` | **200** (framework health route) |
| `GET http://127.0.0.1:8123/missing-page-404` | **404** (error handling works) |

Server log (excerpt):

```
2026-11-15 13:20:09 / ............................ ~ 1s
2026-11-15 13:20:11 /up .......................... ~ 502.71ms
2026-11-15 13:20:11 /missing-page-404 ............ ~ 0.16ms
```

The development server was stopped immediately after the test; port 8123 is free again and no background process is left running. **No browser session was used — the check above is an HTTP-level verification, not a visual browser test.**

---

## 8. Installation Warnings / Limitations

| Item | Detail | Impact |
|---|---|---|
| Staged install | Skeleton installed in `_laravel_staging` then moved to root because `docs/` already existed | None — all paths are relative; artisan, routing and HTTP verified after the move |
| `PHP_CLI_SERVER_WORKERS=4` | `artisan serve` warns it cannot honour the variable without `--no-reload` and starts a single worker | Cosmetic, local dev only |
| SQLite default DB | `database/database.sqlite` + 3 default migrations created by the skeleton | Expected; MariaDB switch pending later module |
| Views compiled | `php artisan about` shows `Views ... CACHED` | Normal after serving requests; harmless |
| No Git repository | `.git` not initialised by `create-project` | Version control setup awaits owner approval |
| `npm install` not run | `package.json` exists (stock skeleton: vite 6, tailwind 4, axios, laravel-vite-plugin) but **no `node_modules`, no Vue, no TypeScript** | Frontend integration is Module 03 |
| Disk-space/security | `composer audit` reported no advisories | None |

No unresolved errors. No files were deleted, and no existing file was overwritten.

---

## 9. Verification Checklist

- [x] Laravel 12 installed (12.72.0)
- [x] Correct project directory
- [x] No nested `Portfolio/Portfolio`
- [x] Composer dependencies installed (112 packages, lock file)
- [x] Artisan works
- [x] Application boots (200 OK, 2 tests passing)
- [x] Routes verified (4 routes)
- [x] Application configuration verified (`APP_KEY` set, debug on, local env)
- [x] Module 01 documentation preserved
