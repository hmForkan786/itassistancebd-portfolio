# INSTALLATION REPORT — Module 01 (Development Environment Setup)

**Project:** IT Assistance BD Portfolio
**Module:** 01 — Development Environment Setup (installation only)
**Inspection date:** 2026-11-15
**Performed by:** Automated environment inspection (read-only + one temporary database connection test)
**Overall status:** **COMPLETE** (no software installation was required — all required tools were already present and verified)

> No software was uninstalled, replaced, or upgraded. No project files, `.env` files, databases, or unrelated projects were modified. No PATH or registry changes were made.

---

## 1. Operating System

| Item | Value |
|---|---|
| OS | Microsoft Windows 11 Pro |
| Version | 10.0.26300 |
| Build | 26300 |
| Architecture | 64-bit (AMD64) |
| CPU | Intel(R) Core(TM) i5-8500T @ 2.10GHz |
| PowerShell | 5.1.26100.9818 |
| Free disk space (C:) | ~93 GB free of ~171 GB used+free total |

---

## 2. Software Inventory (already installed)

| Software | Version | Executable path | Status |
|---|---|---|---|
| PHP (CLI) | 8.4.24 (ZTS, Visual C++ 2022 x64) | `C:\xampp\php\php.exe` | Verified |
| PHP configuration | `C:\xampp\php\php.ini` | — | Verified |
| Composer | 2.11.2 (2026-11-10) | `C:\composer\composer.bat` → `C:\composer\composer.phar` | Verified |
| Node.js | v24.19.0 (LTS) | `C:\Program Files\nodejs\node.exe` | Verified |
| npm | 11.17.0 | `C:\Program Files\nodejs\npm.cmd` | Verified |
| Git for Windows | 2.55.0.windows.3 | `C:\Program Files\Git\cmd\git.exe` | Verified |
| MariaDB (XAMPP) | 10.4.32-MariaDB for Win64 (AMD64) | `C:\xampp\mysql\bin\mysqld.exe`, `mysql.exe`, `mysqladmin.exe` | Verified (connection test passed) |
| Apache (XAMPP) | XAMPP 8.2.12 bundle | `C:\xampp\apache\bin\httpd.exe` | Config valid (`httpd -t` → Syntax OK) |
| Visual Studio Code | 1.146.0 (x64, user install) | `C:\Users\Admin\AppData\Local\Programs\Microsoft VS Code\Code.exe` (`code` on PATH) | Verified |
| XAMPP | 8.2.12-0 at `C:\xampp` (PHP component upgraded in place to 8.4.24) | `C:\xampp` | Preserved |

Nothing in the required stack was missing, therefore **no installer was run** in this module.

---

## 3. PHP Details

**Command output (`php -v`):**

```
PHP 8.4.24 (cli) (built: Jul 29 2026 06:00:56) (ZTS Visual C++ 2022 x64)
Zend Engine v4.4.24, Copyright (c) Zend Technologies
    with Zend OPcache v8.4.24, Copyright (c) Zend Technologies
```

**Loaded configuration (`php --ini`):**

```
Loaded Configuration File:         C:\xampp\php\php.ini
Scan for additional .ini files in: (none)
```

**Active PHP resolution:** `where php` → `C:\xampp\php\php.exe` (single match, no conflicting PHP on PATH).

`extension_dir = "C:\xampp\php\ext"` (php.ini line 764).

**Key runtime settings (read-only inspection, unchanged):**

| Setting | Value |
|---|---|
| `memory_limit` | 512M |
| `upload_max_filesize` | 2M |
| `post_max_size` | 8M |
| `date.timezone` (ini) | not set → PHP default (UTC) |
| Zend OPcache | Enabled (`zend_extension=php_opcache.dll`) |

### 3.1 Required PHP extensions

| Extension | Status |
|---|---|
| bcmath | ENABLED |
| ctype | ENABLED |
| curl | ENABLED |
| dom | ENABLED |
| fileinfo | ENABLED |
| filter | ENABLED |
| hash | ENABLED |
| mbstring | ENABLED |
| openssl | ENABLED |
| pcre | ENABLED |
| PDO | ENABLED |
| pdo_mysql | ENABLED |
| session | ENABLED |
| tokenizer | ENABLED |
| xml | ENABLED |
| zip | ENABLED |

**16 / 16 required extensions enabled — no php.ini change needed.**

### 3.2 Additional extensions

| Extension | Status |
|---|---|
| intl | ENABLED |
| exif | ENABLED |
| pdo_sqlite / sqlite3 | ENABLED |
| mysqli | ENABLED |
| bz2, gettext, sodium, xsl, iconv, ftp, calendar, zlib, Phar, SimpleXML, xmlreader, xmlwriter | ENABLED |
| **gd** | **DISABLED** (optional — `C:\xampp\php\ext\php_gd.dll` exists but is not enabled in php.ini) |

`gd` is **not** required by Laravel 12. It is recommended only if image resizing/manipulation (e.g. `intervention/image`) is added later.

### 3.3 PHP installation notes

- The XAMPP bundle was originally 8.2.12; the PHP component now serves **8.4.24**. The previous tree is preserved at `C:\xampp\php82_backup`.
- `C:\xampp\php82_backup\php.exe` is **not usable directly**: it reads the shared `C:\xampp\php\php.ini` (`extension_dir=C:\xampp\php\ext`) and therefore tries to load PHP 8.4 DLLs, producing startup warnings and a fatal error. It is retained as a rollback copy only and must not be added to PATH. **Left untouched.**
- Apache loads `C:/xampp/php/php8apache2_4.dll` with `PHPINIDir "C:/xampp/php"` (httpd-xampp.conf lines 20, 41) — consistent with the active PHP 8.4 tree. `httpd -t` reports **Syntax OK**.

---

## 4. Composer

- Version: **2.11.2** (released 2026-11-10)
- Launcher: `C:\composer\composer.bat` (thin wrapper) → `C:\composer\composer.phar` (3,815,650 bytes)
- PHP binary used: `C:\xampp\php\php.exe` (PHP 8.4.24)
- PATH entry: `C:\composer` (pre-existing)
- Only one Composer installation found (`C:\ProgramData\ComposerSetup\bin` and `%APPDATA%\Composer\vendor\bin` are absent)

**`composer diagnose` result — all checks OK:**

```
Checking Composer version: OK            Composer version: 2.11.2
Checking platform settings: OK           PHP version: 8.4.24
Checking git settings: OK                OpenSSL 3.0.21 / curl 8.21.0
Checking http/https connectivity: OK
Checking github.com rate limit: OK
Checking disk free space: OK
zip: extension present, unzip not available, 7-Zip not available
```

Note: the PHP `zip` extension is present (used by Composer). A standalone `unzip`/7-Zip binary is absent; this is informational only and does not affect Composer operation.

---

## 5. Node.js and npm

- Node.js **v24.19.0** (Active LTS line — suitable for Vue 3 + Vite)
- npm **11.17.0**
- Path: `C:\Program Files\nodejs\`
- Registry: `https://registry.npmjs.org/`
- Global prefix configured as `C:\Users\Admin\AppData\Roaming\npm` — **this folder does not exist yet**, so `npm ls -g` reports `ENOENT`. This is cosmetic and self-heals on the first `npm install -g`; it does not affect local project installs.
- No Node.js "Current" line is installed and no version manager (nvm) is active for Node. (`C:\Users\Admin\.config\herd\bin\nvm` is on PATH as an empty Laravel Herd placeholder directory — no Node binary there.)

---

## 6. Git

- Version: **2.55.0.windows.3** at `C:\Program Files\Git\cmd\git.exe`
- Existing global configuration (inspected only, **not modified**):

| Key | Value |
|---|---|
| `user.name` | hmForkan786 |
| `user.email` | hmforkan99@gmail.com |
| `init.defaultbranch` | main |
| `core.autocrlf` | true |

No credentials, tokens, or remote repository configuration were inspected, exported, or changed.

---

## 7. Database Environment

| Item | Value |
|---|---|
| Engine | MariaDB 10.4.32-MariaDB (XAMPP binary distribution) |
| Server binary | `C:\xampp\mysql\bin\mysqld.exe` |
| Client binary | `C:\xampp\mysql\bin\mysql.exe` (Ver 15.1 Distrib 10.4.32-MariaDB) |
| Config file | `C:\xampp\mysql\bin\my.ini` |
| Host / Port | `127.0.0.1` / **3306** |
| Socket | `C:/xampp/mysql/mysql.sock` |
| Data directory | `C:/xampp/mysql/data` |
| Windows service | **None registered** (no `mysql`/`mariadb`/`apache` service present) |
| State at inspection start | Not running (no listener on 3306) |

**Connectivity verification (temporary, non-destructive):**

The MariaDB server was **not running** at inspection. It was started from its own `my.ini`/data directory solely to verify connectivity, then shut down again with `mysqladmin shutdown`. The machine was returned to its original state (server stopped, no service installed, no configuration changed, no data written).

Actual results:

```
server_version   port   datadir
10.4.32-MariaDB  3306   C:\\xampp\\mysql\\data\\

PDO mysql OK, server=10.4.32-MariaDB
```

- `pdo_mysql` works end-to-end from the CLI PHP binary → Laravel can use this database.
- Laravel 12 supports MariaDB 10.3+, so **10.4.32 is supported**.
- Missing (optional) utility: no `unzip`/7-Zip binary.

**Existing databases found in the data directory (preserved, untouched, not opened for modification):**

```
applymate
ccms_055r_health
ccms_app
ccms_perf_final_hardening_20260822
ccms_test_final_hardening_20260821
iuaip
iu_aip
mysql
performance_schema
phpmyadmin
startup
temail
test
```

No database was created, altered, dropped, exported, or backed up in this module. No portfolio database was created.

**Security note (no credential value recorded):** XAMPP's phpMyAdmin uses `auth_type = 'config'` with the local `root` account and an empty password. This is the XAMPP default and is acceptable for a local-only development machine, but a password should be set before the database is ever exposed beyond localhost.

---

## 8. Existing Environment / Duplicate Detected (preserved)

| Component | Finding | Action |
|---|---|---|
| XAMPP | Full install at `C:\xampp` (Apache, PHP 8.4.24, MariaDB 10.4.32, phpMyAdmin, FileZilla, Mercury, Tomcat) | Preserved, in use |
| `C:\xampp\php82_backup` | Old PHP 8.2 tree kept as rollback copy; not functional standalone (see 3.3) | Preserved, not used |
| Laravel Herd | `C:\Users\Admin\.config\herd` with PHP 8.2–8.6, nginx, its own `composer.bat` and `laravel.bat` | Preserved, **not active** for this project (only `herd\bin\nvm` is on PATH) |
| Herd PHP 8.4 binary | Loads its own redis/mongodb DLL paths that do not exist → startup warnings | Not touched (unrelated to this project) |
| Chocolatey | Present (`C:\ProgramData\chocolatey`) with Python/dotnet/vcredist packages | Preserved |
| PATH duplicates | `C:\Program Files\nodejs` appears twice; `...\Microsoft VS Code\bin` appears twice (plus `copilot-shim`) | **Left unchanged** (harmless; no PATH edits made) |

---

## 9. PATH Changes

**None.** No PATH entry was added, removed, reordered, or edited (user or machine scope).

Currently relevant existing entries: `C:\composer`, `C:\xampp\php`, `C:\Program Files\nodejs`, `C:\Program Files\Git\cmd`, `C:\Users\Admin\AppData\Local\Programs\Microsoft VS Code\bin`, `C:\Users\Admin\AppData\Roaming\npm`.

---

## 10. Configuration Changes

**None.** No `php.ini`, `my.ini`, `httpd.conf`, npm, Composer, or Git configuration was modified.

## 11. Backup Locations

**No backups were created, because no configuration file was changed.** Existing vendor-provided copies remain in place:

- `C:\xampp\php\php.ini-development`
- `C:\xampp\php\php.ini-production`
- `C:\xampp\php82_backup\` (entire previous PHP 8.2 tree)

## 12. Installation Failures

**None.** No installer was executed, so no installation failure occurred. No download was performed from any third-party source.

---

## 13. Verification Results (actual command output)

| Command | Result |
|---|---|
| `php -v` | `PHP 8.4.24 (cli) ... (ZTS Visual C++ 2022 x64)` |
| `php --ini` | `Loaded Configuration File: C:\xampp\php\php.ini` |
| `php -m` | All 16 required extensions present; `gd` absent |
| `composer --version` | `Composer version 2.11.2` / `PHP version 8.4.24 (C:\xampp\php\php.exe)` |
| `composer diagnose` | All checks OK |
| `node --version` | `v24.19.0` |
| `npm --version` | `11.17.0` |
| `git --version` | `git version 2.55.0.windows.3` |
| `mysqld --version` | `Ver 10.4.32-MariaDB for Win64 on AMD64` |
| `mysql -e "SELECT VERSION(), @@port"` | `10.4.32-MariaDB`, port `3306` |
| PHP PDO MySQL test | `PDO mysql OK, server=10.4.32-MariaDB` |
| `httpd -t` | `Syntax OK` |
| `code --version` | `1.146.0` (x64) |

---

## 14. Remaining Manual Actions (all optional, none blocking)

1. **Optional — enable `gd`:** add `extension=gd` to `C:\xampp\php\php.ini` (after `extension=exif`, line ~929) **only if** image manipulation is planned. Take a copy of `php.ini` first. Not required by Laravel 12.
2. **Optional — upload limits:** `upload_max_filesize = 2M` and `post_max_size = 8M` will be low for portfolio media uploads. Raise them in `php.ini` (with a backup) when the media-upload feature is built.
3. **Optional — npm global folder:** create `C:\Users\Admin\AppData\Roaming\npm` to silence `npm ls -g` `ENOENT`.
4. **Recommended — MariaDB root password:** set one for the local `root` account before the database is exposed beyond localhost.
5. **Operational — start MariaDB:** no Windows service is registered; start MySQL from the XAMPP Control Panel (or `C:\xampp\mysql\bin\mysqld.exe`) when development begins.
6. **Do not use** `C:\xampp\php82_backup\php.exe` as a CLI — it is a broken-standalone rollback copy.

---

## 15. Readiness for Module 02 (Laravel 12 installation)

| Requirement | Required | Available | Ready |
|---|---|---|---|
| PHP ≥ 8.2 | yes | 8.4.24 | ✅ |
| Required PHP extensions (16) | yes | 16/16 | ✅ |
| Composer 2.x | yes | 2.11.2 | ✅ |
| Node.js LTS + npm | yes | 24.19.0 / 11.17.0 | ✅ |
| Git | yes | 2.55.0 | ✅ |
| MySQL-compatible DB | yes | MariaDB 10.4.32 (port 3306) | ✅ |
| Editor | preferred | VS Code 1.146.0 | ✅ |
| Writable workspace | yes | `C:\xampp\htdocs\Laravel\Portfolio` (empty, writable) | ✅ |

**Verdict: READY.** The environment fully satisfies Laravel 12 requirements. No blocker remains for Module 02.

**Stop condition respected:** no Laravel project was created, no Vue/TypeScript/Vite/Tailwind installed, no database created, no application code written, no website feature implemented.
