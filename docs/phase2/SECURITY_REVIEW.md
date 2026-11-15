# Security Review

## Measures
- Authentication: session-based, admin role required, no public registration.
- Authorization: `auth` middleware + `isAdmin()` check; unauthenticated → 401 JSON.
- Validation: all inputs validated; mass assignment via `$fillable`.
- CSRF: web middleware; axios sends X-XSRF-TOKEN.
- Rate limiting: login 5/min/IP; contact 5/5min/IP; analytics 60/min/IP.
- Spam protection: honeypot field on contact.
- File uploads: not implemented (images referenced by path/URL); no arbitrary upload endpoint.
- XSS: Vue template escaping; no v-html on user content.
- SQL injection: Eloquent/parameterized queries.
- Data separation: admin notes, unapproved testimonials, private messages, hidden projects, internal metrics not exposed via public API.
- Secrets: `.env` gitignored; admin password only in `.env`.

## Remaining
- Production hardening (HTTPS, secure cookies, APP_DEBUG=false) at deployment.
- Email delivery requires mail config.