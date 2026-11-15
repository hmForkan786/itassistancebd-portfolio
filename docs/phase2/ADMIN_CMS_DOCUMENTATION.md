# Admin CMS Documentation

## Access
- URL: `/admin/login` (not publicly linked; no registration).
- Credentials provisioned via `.env`: `ADMIN_EMAIL`, `ADMIN_NAME`, `ADMIN_PASSWORD`, then `php artisan db:seed --class=AdminUserSeeder`.
- Session-based auth with CSRF protection; rate-limited login (5 attempts/min/IP).

## Modules
- Dashboard: live counts (projects by status, testimonials, rating, metrics, messages), recent lists.
- Projects: CRUD, publish/unpublish, feature, search, filter by status, pagination, technologies, implemented/planned items, limitations, SEO metadata.
- Testimonials: CRUD, approve/reject, publish/unpublish, feature, rating 1-5 validation, project association.
- Metrics: CRUD, enable/disable, verify/unverify, source type manual/derived.
- Services: CRUD, enable/disable, featured, sort order.
- Skills: CRUD, enable/disable, category grouping.
- Messages: list/search/filter, view, mark read/replied/archived, notes, delete.
- Settings: CRUD, public/private flag, typed values.
- Analytics: totals, top projects/pages, daily trend, referrer domains.

## Security
- All `/api/admin/*` except login require `auth` middleware + admin role.
- Mass assignment protected via `$fillable`; validation on all inputs.
- CSRF via Laravel web middleware; axios auto-sends X-XSRF-TOKEN.
- Rate limiting on login, contact submission, analytics.