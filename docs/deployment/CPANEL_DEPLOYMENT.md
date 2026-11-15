# cPanel Deployment — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

Full deployment planning and audit details are in:
- `docs/DEPLOYMENT.md`
- `docs/DEPLOYMENT_PLANNING.md`
- `docs/CPANEL_DEPLOYMENT_AUDIT_REPORT.md`
- `docs/CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md`
- `docs/PRODUCTION_UPLOAD_CHECKLIST.md`
- `docs/PRODUCTION_RELEASE_EXECUTION_PLAN.md`
- `docs/PRODUCTION_SMOKE_TEST_CHECKLIST.md`

## Summary

- Recommended architecture: document root → Laravel `public/`; application root outside web root.
- Build locally (`npm run type-check`, `npm run build`); upload production artifacts; no Node on host.
- Composer optional on host (upload `vendor/` if unavailable).
- Production `.env` created on host (never committed); `APP_KEY` generated on host.
- Backup and rollback procedures documented.
- No deployment executed. Deployment requires owner authorization and hosting details.