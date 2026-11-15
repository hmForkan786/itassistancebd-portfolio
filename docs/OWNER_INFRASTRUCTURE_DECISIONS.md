# OWNER INFRASTRUCTURE DECISIONS — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Purpose:** Consolidated owner decision checklist for production deployment planning.  
**Status:** All items pending owner decision. No deployment authorized.

---

## A. Domain decisions

| # | Decision | Options / notes | Owner decision |
|---|---|---|---|
| D1 | Production domain name | e.g. `example.com` / subdomain | Pending |
| D2 | Primary domain vs subdomain | Root domain or subdomain for the portfolio | Pending |
| D3 | WWW vs non-WWW canonical | Choose canonical host for SEO/canonical URLs | Pending |
| D4 | HTTPS/SSL availability | Confirm SSL can be enabled on host | Pending |
| D5 | Staging domain needed? | Yes/No; if yes, separate APP_URL/canonical strategy | Pending |

## B. Hosting decisions

| # | Decision | Options / notes | Owner decision |
|---|---|---|---|
| H1 | Hosting provider and plan | cPanel shared hosting (or alternative) | Pending |
| H2 | cPanel access availability | Confirm access to cPanel/File Manager/SSH | Pending |
| H3 | PHP version selection | Must be ≥ 8.2 (verified locally 8.4.24) | Pending |
| H4 | Document root configuration | Can document root point to Laravel `public/`? | Pending |
| H5 | SSH/Terminal availability | Needed for Composer/artisan if used | Pending |
| H6 | Composer availability on host | If unavailable, upload `vendor/` | Pending |
| H7 | File Manager/SFTP deployment | Manual upload via File Manager/SFTP if no Git deploy | Pending |

## C. Database decisions

| # | Decision | Options / notes | Owner decision |
|---|---|---|---|
| DB1 | Production database engine | SQLite file (scaffold) vs MariaDB | Pending |
| DB2 | Database name and credentials | Provision securely; never document secrets | Pending |
| DB3 | Production migration authorization | Authorize only if MariaDB is chosen | Pending |
| DB4 | Database backup method | Hosting backup / manual export | Pending |
| DB5 | Local vs production compatibility | Ensure chosen engine works with Laravel 12 | Pending |

## D. Deployment method decisions

| # | Decision | Options | Owner decision |
|---|---|---|---|
| M1 | Deployment architecture | (1) Document root → `public/` (recommended) or (2) secure alternative layout | Pending |
| M2 | Deployment method | Manual upload / FTP/SFTP / Git deploy / CI/CD | Pending |
| M3 | Build execution | Build locally and upload artifacts (recommended) | Pending |
| M4 | Composer execution | Run on host if available, else upload `vendor/` | Pending |
| M5 | Release artifact retention | Keep previous build for rollback | Pending |

## E. Production configuration decisions

| # | Decision | Options / notes | Owner decision |
|---|---|---|---|
| C1 | `APP_ENV` | Must be `production` | Pending (set at deploy) |
| C2 | `APP_DEBUG` | Must be `false` | Pending (set at deploy) |
| C3 | `APP_URL` | Confirmed production URL (HTTPS) | Pending |
| C4 | `APP_KEY` | Generate fresh on host | Pending (at deploy) |
| C5 | Session/cache/queue drivers | Choose per host capabilities | Pending |
| C6 | Logging level | Production-appropriate (e.g., `error`/`warning`) | Pending |
| C7 | Mail configuration | Only if mail features approved (mailto-only currently) | Pending |
| C8 | `gd` extension | Enable only if image manipulation needed | Pending |
| C9 | Upload limits | Raise if media features are added | Pending |
| C10 | Dev route retirement | When to retire `/dev/ui` and `/dev/layout` | Pending |
| C11 | Scaffold cleanup | Whether to remove unused `app.js`, `bootstrap.js`, `PlaceholderPage.vue`, scaffold sqlite | Pending |

## F. Content and SEO decisions (cross-reference)

| # | Decision | Related doc | Owner decision |
|---|---|---|---|
| S1 | Production domain and canonical URL | [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | Pending |
| S2 | Verified OG image (optional) | [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | Pending |
| S3 | `ProfessionalService` schema (verified business details) | [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | Pending |
| S4 | Contact email confirmation/replacement | [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | Pending |
| S5 | Project statuses/details confirmation | [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | Pending |
| S6 | Services/About content confirmation | [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | Pending |
| S7 | Verified social/profile URLs (if any) | [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | Pending |
| S8 | Spelling standardization | [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | Pending |

## G. Deployment authorization

| # | Decision | Owner decision |
|---|---|---|
| A1 | Authorize a separate deployment execution module | Pending |
| A2 | Authorize backup execution before release | Pending |
| A3 | Authorize rollback dry-run (if possible) | Pending |

**No deployment is authorized until these decisions are made and an approved deployment execution module is created.**  
Do not store secrets, passwords, API keys, or credentials in this document or the repository.