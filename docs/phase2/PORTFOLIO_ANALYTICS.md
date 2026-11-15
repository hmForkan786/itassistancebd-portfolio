# Portfolio Analytics

## Events recorded
page_view, project_view, contact_form_submit, project_cta_click, contact_cta_click.

## PortfolioEvent fields
event_name, page_path, project_id (nullable FK), session_hash (SHA-256 of session id, not raw IP), referrer_domain, device_type, occurred_at.

## Privacy
- No raw IP storage; no personal data beyond hashed session.
- Admin traffic excluded (checked via `isAdmin()`).
- Rate-limited (60/min/IP).
- Lightweight, first-party, no external dependency.

## Admin reporting
Total page views, project views, contact submissions, CTA clicks; top projects/pages; daily trend (30 days); referrer domains. Empty states when no data. Analytics events are recorded client-side on route changes.