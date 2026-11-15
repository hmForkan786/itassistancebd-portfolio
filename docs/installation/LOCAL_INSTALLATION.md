# Local Installation — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Prerequisites

- PHP ≥ 8.2 (verified locally 8.4.24), Composer 2.x (verified 2.11.2)
- Node.js LTS + npm (verified 24.19.0 / 11.17.0)
- Git 2.x (verified 2.55.0)
- XAMPP (Apache + MariaDB 10.4.32) or equivalent
- VS Code (optional)

See `docs/ENVIRONMENT_SETUP.md` and `docs/INSTALLATION_REPORT.md` for full verified environment details.

## Setup steps

1. Clone/copy the project into `C:\xampp\htdocs\Laravel\Portfolio` (or your web root).
2. Install PHP dependencies: `composer install`
3. Ensure `.env` exists (copy from `.env.example` if missing; never overwrite an existing `.env`). Set `APP_NAME`, `APP_KEY` (`php artisan key:generate` if missing), `APP_URL`.
4. Database: scaffold uses SQLite (`database/database.sqlite`). For MariaDB, set `DB_CONNECTION=mysql` and credentials (owner decision required; not configured by default).
5. Install Node dependencies: `npm install`
6. Build frontend: `npm run build` (or `npm run dev` for HMR).
7. Run migrations (if needed): `php artisan migrate`
8. Serve: `php artisan serve` (or use Apache/XAMPP vhost). Vite dev server on port 5173 when running `npm run dev`.

## Required commands

```bash
composer install
npm install
npm run type-check
npm run build
php artisan test
php artisan serve
```

## Notes

- `public/hot` must be absent for production-style behavior; remove if a killed dev server leaves it.
- `public/build/manifest.json` must exist before `php artisan test` in a fresh checkout.
- Dev-only routes `/dev/ui` and `/dev/layout` are available only in local/dev builds.
- No secrets are committed; `.env` is gitignored. Use `.env.example` as template.