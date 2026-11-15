# ENVIRONMENT SETUP — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15 (consolidated in Installation 11; Module 01 verification preserved)  
**Status:** Verified local development environment reference. **No secrets, credentials, API keys, or passwords are recorded in this document.**

---

## 1. Verified software versions (baseline)

| Component | Verified version / value | Location / note |
|---|---|---|
| Operating system | Windows 11 Pro, 10.0.26300, 64-bit (AMD64) | Verified 2026-11-15 |
| PHP CLI | **8.4.24** (ZTS x64, VC++ 2022) | `C:\xampp\php\php.exe` |
| PHP ini | Loaded config | `C:\xampp\php\php.ini` |
| Composer | **2.11.2** | `C:\composer\composer.bat` |
| Node.js | **24.19.0** (LTS) | `C:\Program Files\nodejs\node.exe` |
| npm | **11.17.0** | `C:\Program Files\nodejs\npm.cmd` |
| Git | **2.55.0.windows.3** | `C:\Program Files\Git\cmd\git.exe` |
| Database server (available) | **MariaDB 10.4.32-MariaDB** (XAMPP) | `C:\xampp\mysql\bin\`, port **3306** |
| Web server (available) | Apache (XAMPP, PHP module aligned with active PHP) | `C:\xampp\apache\bin\httpd.exe` |
| Editor | **VS Code 1.146.0** (x64) | `C:\Users\Admin\AppData\Local\Programs\Microsoft VS Code\Code.exe` |
| Laravel framework | **12.72.0** | Installed in project (Module 02) |
| Frontend stack | Vue 3.5.45, TypeScript 6.0.3, Vite 6.4.6, Vue Router 4.6.5, Pinia 4.1.0, Axios 1.21.1, Tailwind 4.3.5 | See `package.json`/lock and module docs |

> PHP required extensions (including `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pcre`, `PDO`, `pdo_mysql`, `session`, `tokenizer`, `xml`, `zip`) were verified in Module 01. See [INSTALLATION_REPORT.md](INSTALLATION_REPORT.md) for full evidence.

## 2. Project setup (current)

- **Workspace/root:** `C:\xampp\htdocs\Laravel\Portfolio`
- **Backend:** Laravel 12 application with SPA mount view (`resources/views/app.blade.php`) and catch-all web route.
- **Frontend:** `resources/js/` (Vue 3 + TS), `resources/css/` (Tailwind 4 CSS-first), Vite config in `vite.config.js`.
- **Dependencies:** PHP dependencies in `vendor/` (Composer), Node dependencies in `node_modules/` (npm). `public/build/` contains production build artifacts when built.
- **Environment file:** `.env` exists locally (not documented with secrets). Use `.env.example` as template; never commit or document secret values.
- **Database (current app binding):** Scaffold **SQLite** file `database/database.sqlite` (Laravel default). MariaDB server is available locally but not connected/approved for app data use yet.
- **Version control:** No Git repository initialized (pending owner approval).

## 3. Required commands

Run from project root unless noted.

### Frontend
```bash
npm install          # install Node dependencies (if needed)
npm run dev          # Vite dev server
npm run build        # production build to public/build
npm run type-check   # vue-tsc --noEmit
```

### Backend / Laravel
```bash
composer install     # install PHP dependencies (if needed)
php artisan serve    # local dev server (default host/port) or: php artisan serve --host=127.0.0.1 --port=8000
php artisan test     # run Laravel test suite
php artisan route:list
php artisan about
```

### Combined dev workflow (as configured)
```bash
composer run dev     # runs serve/queue/logs/vite concurrently per composer script (use when appropriate)
```

## 4. Local development process

1. Ensure required runtimes/tools are available (PHP, Composer, Node/npm). Start MariaDB/Apache from XAMPP only if needed for specific tasks.
2. Install dependencies if missing: `composer install`, `npm install`.
3. Ensure `.env` exists and is configured locally (do not overwrite existing `.env`; keep secrets private). Run `php artisan key:generate` only if a key is missing and appropriate.
4. For frontend development with HMR, run Vite (`npm run dev`) and serve Laravel (`php artisan serve` or Apache/vhost as configured). Laravel `@vite` will use dev server when `public/hot` is present.
5. For production-like verification, run `npm run build` and load via Laravel server/Apache; remove stale `public/hot` if dev server was interrupted.
6. Validate changes with relevant checks: `npm run type-check`, `npm run build`, `php artisan test`, and targeted browser verification.

## 5. Environment assumptions

- Local Windows/XAMPP-based development environment as verified on 2026-11-15.
- PHP CLI used for artisan/composer is the XAMPP PHP installation (`C:\xampp\php\php.exe`) unless explicitly changed.
- Node/npm versions compatible with current `package.json` toolchain (verified with Node 24 LTS).
- SPA routing requires Laravel to serve the app shell for client routes (catch-all in `routes/web.php`); history-mode direct loads depend on this behavior.
- No production server, domain, or deployment pipeline is configured/verified.
- Existing databases/services on the machine may belong to other projects and must not be modified.

## 6. Safe operating instructions

- Work only inside the project root; do not run destructive or broad cleanup commands.
- Never modify, drop, or inspect credentials/data of unrelated databases/projects.
- Do not overwrite `.env` or commit/document secrets, passwords, API keys, or tokens.
- Back up configuration files (e.g. `php.ini`, `my.ini`) before any approved change; record changes in documentation when relevant.
- Prefer local project dependency installs (`npm install`, `composer install`) over global changes.
- Stop dev servers/processes cleanly and remove stale `public/hot` if left behind.
- Do not use legacy/backup binaries (e.g. `C:\xampp\php82_backup\php.exe`) for this project.
- Preserve approval gates: do not start unapproved modules or feature work.

## 7. Module 01 verification reference (preserved)

The following summarizes the original Module 01 verified evidence. Full details remain in [INSTALLATION_REPORT.md](INSTALLATION_REPORT.md).

| Requirement | Required | Available (verified) | Ready |
|---|---|---|---|
| PHP ≥ 8.2 | yes | 8.4.24 | ✅ |
| Required PHP extensions | yes | Verified complete set | ✅ |
| Composer 2.x | yes | 2.11.2 | ✅ |
| Node.js LTS + npm | yes | 24.19.0 / 11.17.0 | ✅ |
| Git | yes | 2.55.0 | ✅ |
| MySQL-compatible DB server | yes | MariaDB 10.4.32 (port 3306) | ✅ |
| Editor | preferred | VS Code 1.146.0 | ✅ |
| Writable workspace | yes | Project root | ✅ |

**Operational notes (Module 01):** MariaDB service not registered as Windows service (start via XAMPP Control Panel as needed); optional `gd` disabled; upload limits conservative; npm global folder may be absent until first global install; local root password and exposure hardening are environment responsibilities (do not record credentials). No software installation, PATH, php.ini, service, or database changes were made in Module 01.