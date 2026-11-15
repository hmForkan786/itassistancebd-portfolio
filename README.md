# IT Assistance BD Portfolio

A Laravel 12 + Vue 3 + TypeScript + Vite + Tailwind CSS 4 portfolio website for IT Assistance BD.

## Overview

This project is a factual, static, file-based portfolio presenting services, skills, and project initiatives of IT Assistance BD. It is built incrementally through owner-approved modules. Content is conservative and honest (no fabricated metrics, clients, testimonials, screenshots, demo links, or repositories).

## Technology stack

- **Backend:** Laravel 12.72.0 (PHP 8.4.x, Composer 2.11.x)
- **Frontend:** Vue 3.5.45, TypeScript 6.0.3, Vite 6.4.6, Vue Router 4.6.5, Pinia 4.1.0, Axios 1.21.1
- **Styling:** Tailwind CSS 4.3.5 (CSS-first, `@theme static`, no config file)
- **Fonts:** Inter Variable, Plus Jakarta Sans Variable, Noto Sans Bengali Variable (self-hosted)

## Requirements

- PHP ≥ 8.2 (verified 8.4.24), Composer 2.x
- Node.js LTS + npm (verified 24.19.0 / 11.17.0)
- XAMPP (Apache + MariaDB) optional for local dev
- Required PHP extensions: bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip

## Installation

See `docs/installation/LOCAL_INSTALLATION.md` and `docs/ENVIRONMENT_SETUP.md`.

Quick start:

```bash
composer install
npm install
cp .env.example .env   # then set APP_NAME, APP_KEY (php artisan key:generate), APP_URL
php artisan key:generate
npm run build
php artisan serve
```

## Local development

```bash
npm run dev          # Vite dev server (HMR)
npm run build        # production build
npm run type-check   # vue-tsc --noEmit
php artisan serve    # Laravel dev server
php artisan test     # Laravel tests
```

## Environment configuration

- `.env` is local-only (gitignored). Use `.env.example` as template. Never commit secrets.
- Current app binding uses scaffold SQLite. MariaDB switch is pending owner approval.
- Production domain is unconfirmed (`APP_URL=http://localhost` locally).

## Database setup

- Scaffold SQLite (`database/database.sqlite`, 3 default migrations). No app-specific models/migrations.
- MariaDB available locally but not connected for app data (owner decision pending).

## Frontend setup

- Vite inputs: `resources/css/app.css`, `resources/js/app.ts`.
- Tailwind 4 CSS-first tokens in `resources/css/theme.css`.
- Self-hosted fonts via `@fontsource-variable/*`.

## Backend setup

- Laravel 12 skeleton + SPA mount view (`resources/views/app.blade.php`) + catch-all route.
- No custom controllers/models/APIs/auth/CMS.

## Testing

See `docs/testing/TESTING_GUIDE.md` and `docs/testing/QUALITY_STATUS.md`.

```bash
npm run type-check
npm run build
php artisan test
composer validate
```

## Build instructions

```bash
npm run build   # outputs to public/build/ (manifest + hashed assets)
```

Ensure `public/hot` is absent for production-style behavior.

## Deployment overview

Deployment is planning-only (no deployment executed). See `docs/DEPLOYMENT.md`, `docs/DEPLOYMENT_PLANNING.md`, `docs/CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md`, and `docs/PRODUCTION_UPLOAD_CHECKLIST.md`. Release package in `release/` (46.15 MB). Go/No-Go: NO-GO (owner/hosting decisions pending).

## Documentation index

See `docs/README.md` for the central documentation navigation.

## Project status

- Installations 01–22 completed/review-blocked, awaiting Project Owner approval.
- No deployment executed. No live hosting changes.
- Content is conservative and pending owner confirmation.

## Repository structure

See `docs/github/GITHUB_PROJECT_INVENTORY.md` for the full inventory.

## Security notes

- No secrets in repository or frontend bundle (verified).
- `.env` gitignored; production `.env` created on host.
- Dev-only routes excluded from production bundle.
- HTTPS, permissions, and hosting security NOT_VERIFIED (no hosting access).
- See `SECURITY.md` and `docs/security/SECURITY.md`.

## License

No LICENSE file is present. License selection is an owner decision (not applied without approval).

## About Laravel

This project is built on the Laravel framework. Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). See `docs/LARAVEL_INSTALLATION.md` for installation details.

## Contributing

See `CONTRIBUTING.md`.