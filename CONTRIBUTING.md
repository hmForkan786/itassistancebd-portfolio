# Contributing — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

This project follows an incremental, owner-approved module workflow. Contributions must preserve existing functionality, design tokens, and factual content constraints.

## Development requirements

- PHP 8.2+ (verified locally 8.4.24), Composer 2.x
- Node.js LTS + npm (verified 24.19.0 / 11.17.0)
- Laravel 12, Vue 3, TypeScript, Vite, Tailwind CSS 4
- XAMPP (Apache + MariaDB) for local development (optional MariaDB; scaffold uses SQLite)

## Coding standards

- Preserve existing structure, naming, style, and patterns; prefer minimal, targeted changes.
- Vue: Composition API with `<script setup lang="ts">`; typed props/interfaces; avoid `any`.
- TypeScript: keep `npm run type-check` passing (strict mode).
- CSS: Tailwind 4 CSS-first conventions and project tokens/utilities; no hard-coded hex where tokens exist; no duplicate styling systems.
- Separate data/content from presentation where already established (`resources/js/data/*`).
- Reuse existing UI/layout/portfolio components before creating new ones.
- Do not add packages, frameworks, or build tools without Project Owner approval.

## Laravel conventions

- Follow Laravel 12 skeleton structure; no business logic expansion without an approved module.
- Keep `routes/web.php` SPA catch-all and local `/dev/*` guard intact.
- No controllers/models/migrations/APIs/auth/CMS/contact backend without explicit module approval.

## Vue conventions

- Components in `resources/js/components/`; pages in `resources/js/pages/`; layouts in `resources/js/layouts/`.
- Use `<script setup lang="ts">` and typed props.
- Reuse primitives from `@/components/ui`.

## TypeScript conventions

- Strict checking (`strict: true` + noUnusedLocals/Parameters).
- No `any`; use exported types from `types.ts`.
- Keep `npm run type-check` exit 0.

## Documentation standards

- Documentation is Markdown (`.md`), accurate, concise, cross-linked with relative links.
- `docs/IMPLEMENTATION_STATUS.md` is the single current-state source; `docs/MODULE_REGISTRY.md` is the module/register source.
- Update relevant docs when implementation/state changes; record decisions, limitations, owner actions.
- Distinguish approved/completed vs proposed/pending/deferred.
- Do not invent dates, statuses, approvals, or evidence.
- Preserve historical reports; do not overwrite detailed reports with summaries.

## Testing expectations

- For frontend/app changes: run `npm run type-check`, `npm run build`, `php artisan test`.
- Perform targeted browser verification for affected routes/flows.
- Record actual results only; never mark unverified checks as PASS.
- Fix only verified defects within approved scope; document defect, file, correction, re-test.

## Git workflow

- Branch strategy: `main` is the primary branch. Feature work should use feature branches when a Git workflow is approved (Git repo not yet initialized; pending owner approval).
- Commit message conventions: clear, concise, imperative mood (e.g., "Add ...", "Fix ...", "Update ..."). Reference module/issue where applicable.
- Do not commit secrets, `.env`, `vendor/`, `node_modules/`, `release/`, local DB files, or build artifacts (per `.gitignore`).
- Preserve existing README and historical reports.

## Owner approval workflow

- Module work begins only when the Project Owner approves/specifies it.
- Preserve approval gates between modules.
- At module completion: deliver evidence-based report, update required documentation, stop, and wait for Project Owner approval before starting the next module.
- Do not treat roadmap/proposed items as approved implementation tasks.

## Notes

- No Git repository is currently initialized (pending owner approval). Git initialization and first commit are deferred.
- All changes must stay within the project root. No destructive commands or broad cleanup.