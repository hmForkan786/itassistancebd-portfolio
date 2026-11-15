# Database Documentation — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Current state

- **Application database binding:** Laravel scaffold default **SQLite** (`database/database.sqlite`), created by the skeleton installer.
- **Migrations:** 3 default Laravel scaffold migrations:
  - `0001_01_01_000000_create_users_table.php`
  - `0001_01_01_000001_create_cache_table.php`
  - `0001_01_01_000002_create_jobs_table.php`
- **Models:** Only skeleton `app/Models/User.php`. No business models.
- **Seeders/Factories:** `database/seeders/DatabaseSeeder.php`, `database/factories/UserFactory.php` (scaffold).
- **MariaDB:** 10.4.32 available locally (XAMPP, port 3306) but **not connected** for app data. No app-specific migrations. MariaDB switch is deferred pending owner approval (D-011).

## Configuration

- `config/database.php` defines connections: sqlite, mysql, mariadb, pgsql, sqlsrv. All credentials from env (`DB_*`). Charset/collation defaults: `utf8mb4` / `utf8mb4_unicode_ci`.
- `.env`: `DB_CONNECTION=sqlite` (local). Production DB strategy is an owner decision.

## Tables (scaffold only)

| Table | Purpose | Source |
|---|---|---|
| users | Default users table (scaffold) | migration 0001_01_01_000000 |
| cache | Cache store (scaffold) | migration 0001_01_01_000001 |
| jobs | Queue jobs (scaffold) | migration 0001_01_01_000002 |
| migrations | Migration tracking | framework |

No application-specific tables exist. Content is static/file-based (`resources/js/data/*`).

## Relationships / constraints

- None defined beyond scaffold defaults. No foreign keys or indexes beyond scaffold.

## Production database strategy

- **Owner decision required:** SQLite file vs MariaDB/MySQL.
- If MariaDB is chosen: a separate approved database module is needed (migrations, credentials handling, backup/rollback). No migrations executed in any completed module.
- Credentials must be provisioned securely and never documented.

See `docs/CPANEL_DEPLOYMENT_AUDIT_REPORT.md`, `docs/DEPLOYMENT_PLANNING.md`, and `docs/OWNER_INFRASTRUCTURE_DECISIONS.md` for deployment/database decisions.