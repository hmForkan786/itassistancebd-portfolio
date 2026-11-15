# API Documentation — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Status

**No API endpoints are implemented.** The application is a static portfolio SPA served by Laravel. There are no backend controllers, routes, or data endpoints beyond Laravel framework routes (`/`, `/up`, signed storage routes) and the SPA catch-all.

## Frontend HTTP client (prepared, unused)

- `resources/js/services/http.ts` provides a reusable Axios client:
  - `baseURL: /api`
  - `withCredentials: true`
  - JSON headers (`Accept: application/json`, `Content-Type: application/json`)
  - 15s timeout
- No endpoints are defined or consumed. Do not invent endpoints.

## Laravel routes (current)

| Method | Path | Purpose |
|---|---|---|
| GET/HEAD | `/` | SPA mount view (`view('app')`) |
| GET/HEAD | `/sitemap.xml` | Dynamic sitemap (XML) |
| GET/HEAD | `/dev/{path?}` | Dev-only shell (local env only) |
| GET/HEAD | `/{any?}` | SPA catch-all (excludes `dev/*`) |
| GET/HEAD | `/up` | Framework health check |
| GET/HEAD | `storage/{path}` | Signed local storage (framework) |
| PUT | `storage/{path}` | Signed local storage upload (framework) |

## Future API work

Any API implementation requires an approved module. Follow `PROJECT_MASTER_RULES.md` and `AGENTS.md`: no backend feature expansion without explicit module approval; record endpoints, methods, auth, validation, and responses in this document.