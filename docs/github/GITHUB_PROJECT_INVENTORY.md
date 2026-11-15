# GitHub Project Inventory — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Repository:** https://github.com/hmForkan786/itassistancebd-portfolio  
**Branch:** `main`  
**Audit date:** 2026-11-15  
**Mode:** Read-only inventory (no files modified by this document)

---

## 1. Project directory structure (top-level)

```
Portfolio/
├── .git/                  (Git repository, created during backup)
├── .qodo/                 (local tooling)
├── app/                   (Laravel app: Http, Models, Providers)
├── bootstrap/             (Laravel bootstrap + cache)
├── config/                (Laravel configuration)
├── database/              (migrations, factories, seeders; scaffold sqlite ignored)
├── docs/                  (project documentation — see Section 2)
├── node_modules/          (npm dependencies; gitignored)
├── public/                (web root: index.php, .htaccess, robots.txt, favicon.ico, build/)
├── release/               (prepared upload package; gitignored)
├── resources/             (css, js, views)
├── routes/                (web.php, console.php)
├── storage/               (app, framework, logs; runtime data gitignored)
├── tests/                 (PHPUnit tests)
├── vendor/                (Composer dependencies; gitignored)
├── AGENTS.md
├── PROJECT_MASTER_RULES.md
├── README.md
├── .env                   (local; gitignored)
├── .env.example           (template; tracked)
├── .gitignore
├── artisan
├── composer.json / composer.lock
├── package.json / package-lock.json
├── phpunit.xml
├── tsconfig.json
└── vite.config.js
```

## 2. Documentation directory structure (docs/)

Existing docs (flat, meaningful names) plus new subdirectories created for navigation:

```
docs/
├── README.md                       (central documentation index)
├── ARCHITECTURE.md
├── CHANGELOG.md
├── CONTENT_INVENTORY.md
├── CPANEL_DEPLOYMENT_AUDIT_REPORT.md
├── CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md
├── DECISIONS.md
├── DEPLOYMENT.md
├── DEPLOYMENT_CONFIGURATION_READINESS.md
├── DEPLOYMENT_PLANNING.md
├── DESIGN_SYSTEM.md
├── ENVIRONMENT_SETUP.md
├── GITHUB_BACKUP_GUIDE.md
├── HOMEPAGE.md
├── IMPLEMENTATION_STATUS.md        (single source of truth for current state)
├── INSTALLATION_REPORT.md          (Module 01)
├── INSTALLATION_15_REPORT.md
├── INSTALLATION_16_REPORT.md
├── INSTALLATION_17_REPORT.md
├── INSTALLATION_18_REPORT.md
├── INSTALLATION_19_REPORT.md
├── INSTALLATION_20_REPORT.md
├── INSTALLATION_21_REPORT.md
├── INSTALLATION_21C_REPORT.md
├── INSTALLATION_21D1_HOSTING_COMPATIBILITY.md
├── INSTALLATION_22_REPORT.md
├── LARAVEL_INSTALLATION.md
├── MODULE_REGISTRY.md             (module/evidence register)
├── OPEN_ISSUES.md
├── OWNER_CONTENT_REVIEW.md
├── OWNER_DECISION_APPROVAL_REGISTER.md
├── OWNER_FINAL_RELEASE_DECISIONS.md
├── OWNER_INFRASTRUCTURE_DECISIONS.md
├── OWNER_INFRASTRUCTURE_DECISIONS_STATUS.md
├── OWNER_RELEASE_AUTHORIZATION.md
├── PERFORMANCE_AUDIT_REPORT.md
├── PORTFOLIO_LAYOUT.md
├── PORTFOLIO_QA_REPORT.md
├── PRODUCTION_RELEASE_EXECUTION_PLAN.md
├── PRODUCTION_RELEASE_GO_NO_GO.md
├── PRODUCTION_SMOKE_TEST_CHECKLIST.md
├── PRODUCTION_UPLOAD_CHECKLIST.md
├── PROJECT_CONTEXT.md
├── PROJECT_DETAIL_PAGES.md
├── QA_STRATEGY.md
├── ROADMAP.md
├── SECONDARY_PAGES.md
├── SEO_PERFORMANCE_REPORT.md
├── UI_COMPONENTS.md
├── VUE_INSTALLATION.md
├── architecture/                  (new navigation subdirectory)
├── backend/                       (new)
├── frontend/                      (new)
├── api/                           (new)
├── database/                      (new)
├── installation/                  (new)
├── development/                   (new)
├── testing/                       (new)
├── security/                      (new)
├── deployment/                    (new)
├── releases/                      (new)
├── reports/                       (new)
├── phases/                        (new)
├── roadmap/                       (new)
├── troubleshooting/               (new)
├── reference/                     (new)
├── requirements/                  (new)
└── github/                        (new)
    ├── GITHUB_PROJECT_INVENTORY.md
    └── GITHUB_BACKUP_FINAL_REPORT.md
```

## 3. Markdown file count

- Markdown files in project (excluding `node_modules/`, `vendor/`, `release/`): **54** (as of audit).
- Plus new files created in this module (subdirectory navigation docs).

## 4. Source file counts (approximate)

- Frontend (`resources/js/`): ~45 files (`.vue`, `.ts`, `.js`).
- Backend (`app/`, `config/`, `routes/`, `database/`): ~25 files.
- Tests: 3 PHP files (`tests/Unit/ExampleTest.php`, `tests/Feature/ExampleTest.php`, `tests/TestCase.php`).
- CSS: 4 files (`app.css`, `base.css`, `theme.css`, `utilities.css`).

## 5. Important configuration files

- `composer.json` / `composer.lock` — PHP dependencies.
- `package.json` / `package-lock.json` — Node dependencies.
- `vite.config.js` — Vite build config (Laravel plugin, Tailwind, Vue, `@` alias).
- `tsconfig.json` — TypeScript strict config.
- `phpunit.xml` — PHPUnit config.
- `.env` (local, gitignored) / `.env.example` (tracked, no secrets).
- `routes/web.php` — SPA catch-all + dev routes + sitemap route.
- `resources/views/app.blade.php` — SPA mount view + metadata + JSON-LD.
- `public/.htaccess` — SPA fallback + perf directives.
- `public/robots.txt` — robots rules.

## 6. Existing reports (preserved)

Installation/module reports: `INSTALLATION_REPORT.md` (01), `LARAVEL_INSTALLATION.md` (02), `VUE_INSTALLATION.md` (03), `DESIGN_SYSTEM.md` (04), `UI_COMPONENTS.md` (05), `PORTFOLIO_LAYOUT.md` (06), `HOMEPAGE.md` (07), `SECONDARY_PAGES.md` (08), `PROJECT_DETAIL_PAGES.md` (09), `PORTFOLIO_QA_REPORT.md` (10), plus reports for modules 11–22 and hosting/content/performance/deployment/readiness reports.

## 7. Missing documentation (gaps identified)

- No dedicated backend API documentation (no API endpoints exist yet — `services/http.ts` has no consumed endpoints). `docs/api/API_DOCUMENTATION.md` documents this.
- No database documentation beyond scaffold migrations (no app models/migrations). `docs/database/DATABASE_DOCUMENTATION.md` documents this.
- No `LICENSE` file at root (owner decision required; do not invent).
- No `CONTRIBUTING.md` or root `SECURITY.md` (created in this module).
- No troubleshooting guide (created `docs/troubleshooting/` placeholder index).
- No dedicated requirements document (created `docs/requirements/` placeholder index).

## 8. Documentation requiring updates

- Root `README.md` (Laravel stock) enhanced with project-specific info (this module).
- `docs/README.md` already serves as central index; verified/updated.
- Historical reports preserved (not rewritten).

## 9. Files excluded from GitHub and reasons

Excluded (via `.gitignore`): `.env` and variants, `vendor/`, `node_modules/`, `release/`, `public/hot`, `public/build`, `storage/*.key`, `storage/pail`, logs, cache, sessions, views, local DB files (`*.sqlite`), IDE files (`.idea`, `.vscode`, etc.), OS files (`Thumbs.db`, `.DS_Store`, `desktop.ini`), `auth.json`, `Homestead.*`, `npm-debug.log`, `yarn-error.log`, `.phpunit.result.cache`, `.phpunit.cache`.

Reasons: secrets/credentials, generated dependencies, build artifacts, local databases/logs, environment-specific files, OS/IDE files.

## 10. Notes

- Existing documentation is extensive and meaningful; paths preserved. New subdirectory docs act as navigation/summary and link to existing detailed reports to avoid duplication.
- No application source code modified during this inventory.