# Backend Documentation — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Laravel application structure

- Framework: Laravel 12.72.0 (`laravel/framework` ^12.0), PHP ^8.2 (verified 8.4.24), Composer 2.11.2.
- Skeleton structure: `app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `storage/`, `tests/`, `vendor/`.
- App namespace: `App\` (PSR-4).

## Controllers

- Only the skeleton `app/Http/Controllers/Controller.php` (base). No custom controllers implemented.

## Models

- Only the skeleton `app/Models/User.php`. No business models implemented.

## Services

- No backend service layer implemented. `resources/js/services/http.ts` is a frontend Axios client (no endpoints defined/consumed).

## Middleware

- Default Laravel middleware stack (no custom middleware).

## Providers

- Default `AppServiceProvider`. No custom providers.

## Authentication

- Not implemented. Laravel's auth scaffolding is available but not configured for this project. Any future auth feature requires an approved module.

## Validation

- No backend validation rules implemented (no forms/endpoints). Frontend form primitives (`BaseInput`, etc.) are ready for future use.

## Error handling

- Default Laravel error handling. `APP_DEBUG` must be `false` in production (checklist). No custom error pages.

## Business logic

- None implemented. The application is a static portfolio SPA. Business features (CMS, contact backend, blog, APIs) are out of current approved scope.

## Backend conventions

- Preserve Laravel 12 skeleton structure; no backend feature expansion without explicit module approval.
- Keep `routes/web.php` SPA catch-all and local `/dev/*` guard intact.
- Do not invent endpoints or models.

See `docs/ARCHITECTURE.md` and `docs/LARAVEL_INSTALLATION.md` for full details.