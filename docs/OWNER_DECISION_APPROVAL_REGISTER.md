# OWNER DECISION APPROVAL REGISTER — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15  
**Purpose:** Structured owner-decision approval register prepared from the existing audit findings.  
**Status:** **NO-GO — OWNER APPROVALS PENDING.** All approval fields are intentionally blank. No decision is marked APPROVED without explicit owner authorization.

> Recommendations below are labeled **NOT APPROVED** until the Project Owner explicitly approves them. They are not decisions and must not be treated as approvals.

---

## 1. Existing approved decisions (preserved, not rewritten)

The following decisions are already recorded in `docs/DECISIONS.md` and remain approved/implemented or approved-deferred. They are not reopened by this register:

| ID | Decision (summary) | Status |
|---|---|---|
| D-001 | Target stack: Laravel 12 + Vue 3 + TypeScript + Vite + Tailwind 4 | Approved (implemented) |
| D-002 | Preserve docs; install Laravel in project root via staged move | Approved (implemented) |
| D-003 | `.env` local/dev as scaffolded; APP_KEY generated; no secrets documented | Approved (implemented) |
| D-004 | SPA architecture: Blade mount + Vue Router history + Laravel catch-all; local `/dev/*` guarded | Approved (implemented) |
| D-005 | Tailwind 4 CSS-first design system with `@theme static` tokens; approved brand palette preserved | Approved (implemented) |
| D-006 | Reusable accessible UI primitives/layout shell; reuse across pages | Approved (implemented) |
| D-007 | Primary nav uses page routes for About/Services/Projects/Contact and homepage hash for Skills | Approved (implemented) |
| D-008 | Public contact limited to verified email/mailto with clear context notes; no backend form/phone/unverified socials | Approved (implemented) |
| D-009 | Project initiatives with honest statuses and data-driven detail pages; planned separated from confirmed; unknown slug in-page | Approved (implemented) |
| D-010 | Dev showcase routes local/dev only, excluded from production bundle; retirement deferred to owner decision | Approved (implemented) |
| D-011 | Database remains scaffold SQLite; MariaDB deferred pending owner approval/decisions | Approved (deferred decision) |
| D-012 | Git repository initialization deferred pending owner approval | Approved (deferred decision) |
| D-013 | Incremental module workflow with evidence, documentation updates, owner approval gate between modules | Approved (process) |
| D-014 | Documentation system established as centralized Markdown source-of-truth with preserved historical reports | Completed, awaiting owner approval |
| D-015 | SEO uses environment-aware canonical/sitemap URLs (derived from `APP_URL`/runtime origin); verified facts only | Completed, awaiting owner approval |

No existing approved decision was rewritten or removed.

## 2. Pending owner decision register

All approval fields are intentionally blank. Statuses are `PENDING` until the Project Owner explicitly approves/rejects.

| ID | Decision | Recommended Option (NOT APPROVED) | Owner Choice | Status | Notes |
|----|----------|----------------------------------|--------------|--------|-------|
| D1 | Production domain | Owner-supplied domain (e.g., `example.com`) | | PENDING_OWNER | Canonical URLs, sitemap, OG URLs, JSON-LD depend on it. No domain invented. |
| D3 | Canonical domain (www or non-www) | non-www (common) | | PENDING_OWNER | Must be consistent with SEO/canonical strategy. |
| D4 | SSL/HTTPS availability | HTTPS required | | PENDING_HOSTING_PROVIDER | Security and SEO dependency; confirm with hosting provider. |
| D5 | Staging domain needed? | No (unless pre-launch review desired) | | PENDING_OWNER | Adds complexity; optional. |
| H1 | Hosting provider/plan | cPanel shared hosting with PHP ≥ 8.2 | | PENDING_OWNER | Compatibility with Laravel 12. |
| H3 | Hosting PHP version | 8.3 or 8.4 if available (≥ 8.2) | | PENDING_HOSTING_PROVIDER | Verified locally 8.4.24; Laravel 12 supports 8.2+. |
| H4 | Document root (`public`) | Yes (preferred) | | PENDING_HOSTING_PROVIDER | Security and SPA fallback depend on it. |
| H6 | Composer availability on host | Use if available; otherwise upload `vendor/` | | PENDING_HOSTING_PROVIDER | Production dependency installation strategy. |
| DB1 | Production database strategy | SQLite for current static site; MariaDB if DB-driven features approved | | PENDING_OWNER | No app data models currently; owner must decide. |
| M2 | Deployment method | Local build + manual cPanel/SFTP upload | | PENDING_OWNER | Simplicity and control for shared hosting. |
| C10 | Development-only routes handling (`/dev/ui`, `/dev/layout`) | Retire after public launch confidence | | PENDING_OWNER | Currently guarded; not in production bundle. |
| C11 | Laravel scaffold cleanup (`app.js`, `bootstrap.js`, `PlaceholderPage.vue`, scaffold sqlite) | Defer until approved cleanup module | | PENDING_OWNER | Avoid unintended regressions. |
| S4 | Public contact email | Confirm or replace `hmforkan99@gmail.com` | | PENDING_OWNER | Sourced from Git identity; not owner-confirmed. |
| S5 | Project status approval | Confirm or adjust (4 Planned, 1 In Progress) | | PENDING_OWNER | Prevents inaccurate public claims. |
| S7 | Social profile URLs | Supply verified URLs or keep none | | PENDING_OWNER | No verified URLs currently; do not fabricate. |
| S8 | Bengali/English spelling and content approval | Owner/editorial standardization choice | | PENDING_OWNER | Minor consistency item. |
| A1 | Authorization for separate deployment implementation phase | Yes, after all decisions confirmed | | PENDING_OWNER | Deployment requires explicit authorization. |

### Additional pending owner decisions (from `docs/OWNER_INFRASTRUCTURE_DECISIONS.md`)

| ID | Decision | Recommended Option (NOT APPROVED) | Owner Choice | Status | Notes |
|----|----------|----------------------------------|--------------|--------|-------|
| D2 | Primary domain vs subdomain | Owner-supplied preference | | PENDING_OWNER | Affects canonical/SEO. |
| D5 | Staging domain needed? | No (unless pre-launch review desired) | | PENDING_OWNER | Optional; adds complexity. |
| H1 | Hosting provider and plan | cPanel shared hosting with PHP ≥ 8.2 | | PENDING_OWNER | Compatibility with Laravel 12. |
| H2 | cPanel access availability | Confirm access | | PENDING_HOSTING_PROVIDER | Required for File Manager/SFTP. |
| H3 | Hosting PHP version | 8.3 or 8.4 if available (≥ 8.2) | | PENDING_HOSTING_PROVIDER | Verified locally 8.4.24. |
| H4 | Document root (`public`) | Yes (preferred) | | PENDING_HOSTING_PROVIDER | Required for security and SPA fallback. |
| H5 | SSH/Terminal availability | Confirm if needed | | PENDING_HOSTING_PROVIDER | Needed for Composer/artisan if used. |
| H6 | Composer availability on host | Use if available; else upload `vendor/` | | PENDING_HOSTING_PROVIDER | Production dependency installation. |
| H7 | File Manager/SFTP deployment option | Confirm availability | | PENDING_HOSTING_PROVIDER | Manual upload option. |
| DB2 | Database name and credentials | Provision securely; never document | | PENDING_OWNER | Must not be recorded in docs. |
| DB3 | Production migration authorization | Authorize only if MariaDB/MySQL chosen | | PENDING_OWNER | No migrations currently. |
| DB4 | Database backup method | Hosting backup or manual export | | PENDING_HOSTING_PROVIDER | Depends on hosting capability. |
| DB5 | Local vs production compatibility | Confirm chosen engine works | | PENDING_OWNER | Requires engine confirmation. |
| M1 | Deployment architecture | (1) Document root → `public/` (recommended) | | PENDING_OWNER | Preferred when host supports it. |
| M2 | Deployment method | Manual upload / FTP/SFTP / Git deploy / CI/CD | | PENDING_OWNER | Owner choice. |
| M3 | Build execution | Build locally (recommended) | | PENDING_OWNER | Node not needed on host. |
| M4 | Composer execution | On host if available, else upload `vendor/` | | PENDING_HOSTING_PROVIDER | Depends on host. |
| M5 | Release artifact retention | Keep previous build for rollback | | PENDING_OWNER | Rollback safety. |
| C1 | `APP_ENV` | `production` | | PENDING (at deploy) | Standard production value. |
| C2 | `APP_DEBUG` | `false` | | PENDING (at deploy) | Security requirement. |
| C3 | `APP_URL` | Confirmed production URL (HTTPS) | | PENDING_OWNER | Affects canonical/sitemap/OG. |
| C4 | `APP_KEY` | Generate fresh on host | | PENDING (at deploy) | Do not reuse local key. |
| C5 | Session/cache/queue drivers | Choose per host capabilities | | PENDING_HOSTING_PROVIDER | Database vs file vs redis. |
| C6 | Logging level | Production-appropriate (e.g., `error`/`warning`) | | PENDING_OWNER | Owner preference. |
| C7 | Mail configuration | Not applicable (mailto-only currently) | | NOT_APPLICABLE (currently) | Only if mail features approved. |
| C8 | `gd` extension | Enable only if image manipulation needed | | PENDING_OWNER | Optional. |
| C9 | Upload limits | Raise if media features added | | PENDING_OWNER / PENDING_HOSTING_PROVIDER | Host-dependent. |
| C10 | Dev route retirement (`/dev/ui`, `/dev/layout`) | After public launch confidence | | PENDING_OWNER | Currently guarded; not in production bundle. |
| C11 | Scaffold cleanup (unused artifacts) | Defer until approved cleanup module | | PENDING_OWNER | Avoid regressions. |
| S1 | Production domain and canonical URL | Owner-supplied domain | | PENDING_OWNER | `APP_URL` currently `http://localhost`. |
| S2 | Verified OG image (optional) | Supply verified image or keep none | | PENDING_OWNER | No image currently. |
| S3 | `ProfessionalService` schema (verified business details) | Supply verified address/phone/hours or omit | | PENDING_OWNER | Currently omitted by design. |
| S4 | Contact email confirmation/replacement | Confirm or replace `hmforkan99@gmail.com` | | PENDING_OWNER | Sourced from Git identity; not owner-confirmed. |
| S5 | Project status approval | Confirm or adjust (4 Planned, 1 In Progress) | | PENDING_OWNER | Prevents inaccurate public claims. |
| S6 | Services/About content confirmation | Confirm accuracy | | PENDING_OWNER | Owner review recommended. |
| S7 | Verified social/profile URLs (if any) | Supply verified URLs or keep none | | PENDING_OWNER | No verified URLs currently; do not fabricate. |
| S8 | Spelling standardization (British/American) | Owner/editorial choice | | PENDING_OWNER | Minor consistency item. |
| A1 | Authorization for separate deployment implementation phase | Yes, after all decisions confirmed | | PENDING_OWNER | Deployment requires explicit authorization. |
| A2 | Authorization for backup execution before release | Yes, before release | | PENDING_OWNER | Backup procedure documented. |
| A3 | Authorization for rollback dry-run (if possible) | Yes, if possible | | PENDING_OWNER | Rollback procedure documented. |

### Recommendation section (NOT APPROVED)

The following are recommendations only. They are **NOT APPROVED** and must not be treated as decisions until the Project Owner explicitly approves them:

- cPanel shared hosting (recommended, not approved).
- PHP 8.2+ (prefer compatible latest host-supported version) — recommendation only.
- Local production build and manual cPanel/SFTP upload — recommendation only.
- Full backup before deployment — recommendation only.
- SQLite for current static portfolio, subject to hosting support — recommendation only.
- No staging domain unless needed — recommendation only.
- Keep deployment separate from current installation work — recommendation only.

### Owner approval workflow

For each pending decision, the owner should provide:

- **Decision ID:** (as listed above)
- **What it means:** (described in the Notes column and related docs)
- **Available options:** (as listed)
- **Recommended option:** (labeled NOT APPROVED above)
- **Risks or implications:** (documented in `docs/CPANEL_DEPLOYMENT_AUDIT_REPORT.md`, `docs/DEPLOYMENT_PLANNING.md`, `docs/OPEN_ISSUES.md`)
- **Owner approval field:** (blank — to be filled by owner)
- **Approval date field:** (blank — to be filled by owner)
- **Status:** `PENDING` (change to `APPROVED` or `REJECTED` only after explicit owner action)

All approval fields are intentionally left blank. No decision is marked `APPROVED`.

---

## 3. Release gate

Production status remains: **NO-GO — OWNER APPROVALS PENDING.**

See `docs/PRODUCTION_RELEASE_GO_NO_GO.md` (updated with a reference to this register).

No deployment is authorized. No live hosting changes. No source code changes.

---

## 4. Validation

- Existing D-001 through D-015 approvals preserved (listed in Section 1; none rewritten or removed).
- No pending decision marked approved (all statuses remain `PENDING_OWNER` / `PENDING_HOSTING_PROVIDER` / `NOT_APPLICABLE`).
- No production configuration changed.
- No source code changed.
- No credentials accessed or exposed.
- Release gate remains NO-GO.
- Documentation references are consistent (relative links validated).

---

## 5. Inconsistencies found

- None identified. The register consolidates decisions from `docs/OWNER_INFRASTRUCTURE_DECISIONS.md`, `docs/OWNER_FINAL_RELEASE_DECISIONS.md`, `docs/OWNER_CONTENT_REVIEW.md`, and related reports without conflicting records. Duplicate ID numbering (e.g., multiple `OA-003`/`OA-004` in `docs/OPEN_ISSUES.md`) is a pre-existing cosmetic issue noted for cleanup if the owner approves; no changes made.

---

## 6. Exact next owner action

1. Review this register and the related docs (`docs/OWNER_INFRASTRUCTURE_DECISIONS.md`, `docs/OWNER_FINAL_RELEASE_DECISIONS.md`, `docs/OWNER_CONTENT_REVIEW.md`).
2. Supply explicit decisions/approvals (fill the Owner Choice and approval/date fields) for the items above.
3. Provide hosting provider details and confirm compatibility (Section 15 questions in `docs/INSTALLATION_21B` report).
4. Once all decisions and hosting details are confirmed, re-evaluate the Go/No-Go matrix in `docs/PRODUCTION_RELEASE_GO_NO_GO.md`.
5. If GO, authorize a separate deployment execution module.
6. Do not deploy until explicit authorization is granted.

**STOP:** Installation 21C documentation complete. Do not begin Installation 22. Do not deploy. Waiting for Project Owner review.