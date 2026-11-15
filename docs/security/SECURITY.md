# Security — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

See root `SECURITY.md` for the full security policy. Summary:

- No authentication/authorization implemented in current scope.
- No backend contact form or message storage.
- Contact is mailto-only (verified email).
- No secrets in repository or frontend bundle (verified: scan 0).
- `.env` gitignored; production `.env` created on host (never committed).
- Dev-only routes (`/dev/ui`, `/dev/layout`) local-only and excluded from production bundle.
- Production security (HTTPS, permissions, error handling, file exposure) is NOT_VERIFIED (no hosting access). See `docs/CPANEL_DEPLOYMENT_AUDIT_REPORT.md` and `docs/DEPLOYMENT_PLANNING.md`.