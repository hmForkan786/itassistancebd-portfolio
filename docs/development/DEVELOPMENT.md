# Development — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Development workflow

1. Ensure environment (see `docs/ENVIRONMENT_SETUP.md`).
2. Install dependencies: `composer install`, `npm install`.
3. Serve: `php artisan serve` + `npm run dev` (Vite HMR).
4. Validate: `npm run type-check`, `npm run build`, `php artisan test`.
5. Browser verification for affected routes/flows.

## Commands

```bash
npm run dev          # Vite dev server (HMR)
npm run build        # production build
npm run type-check   # vue-tsc --noEmit
php artisan serve    # Laravel dev server
php artisan test     # Laravel tests
composer validate    # Composer config validity
```

## Notes

- `public/hot` must be absent for production-style behavior; remove if a killed dev server leaves it.
- Dev-only routes `/dev/ui`, `/dev/layout` available only in local/dev builds.
- No Git repository initialized (pending owner approval); see `docs/GITHUB_BACKUP_GUIDE.md`.
- See `CONTRIBUTING.md` for coding standards and `docs/QA_STRATEGY.md` for verification strategy.