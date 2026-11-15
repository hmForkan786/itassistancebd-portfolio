# Security — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Security reporting process

- Report security concerns to the Project Owner. Do not open public issues with exploit details.
- Include: affected component, reproduction steps, impact, and suggested mitigation.
- Do not include credentials, tokens, or private keys in reports.

## Environment secrets policy

- Never commit `.env` or any secrets/credentials/API keys/tokens/passwords to the repository.
- `.env` is gitignored; `.env.example` contains only empty/null defaults (no secrets).
- Production `.env` must be created on the host; never copy local `.env` to production.
- Never record secrets in documentation.

## Authentication security

- No authentication system is implemented in the current scope.
- Any future auth feature requires an approved module and security review.

## Authorization

- No authorization/roles implemented in current scope.
- Any future admin/CMS/auth feature requires an approved module and security review.

## Data protection

- Contact is mailto-only; no message storage or backend contact form.
- No personal data collection beyond what visitors voluntarily email.
- No database-driven content or user data currently.

## Dependency security

- Run `composer audit` and `npm audit` when dependencies change.
- Keep Laravel, Vue, Vite, and Tailwind updated per approved modules.
- Do not add packages without Project Owner approval.

## Production security requirements

- `APP_ENV=production`, `APP_DEBUG=false`.
- `APP_KEY` generated securely on host (do not reuse local key).
- HTTPS enforced; trusted proxies/hosts configured.
- `.env`, `vendor/`, `storage/`, `app/`, `config/`, `routes/`, `database/`, `bootstrap/` not web-accessible (document root → `public/`).
- `storage/` and `bootstrap/cache/` writable but not web-accessible.
- No debug output or stack traces in production.
- No dev-only showcase routes functional in production bundle (verified).
- No secrets in frontend bundle (verified: scan 0).
- File permissions set per host requirements.
- Backups stored outside `public/`.
- Security checks run on actual host before launch (not yet performed).

## Notes

- Hosting security is NOT_VERIFIED (no hosting access). See `docs/CPANEL_DEPLOYMENT_AUDIT_REPORT.md` and `docs/DEPLOYMENT_PLANNING.md`.
- No deployment has been performed.