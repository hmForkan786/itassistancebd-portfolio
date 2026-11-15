# Requirements — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`

## Functional requirements (current)

- Public portfolio website presenting services, skills, and project initiatives.
- Pages: Home, About, Services, Projects, Project Detail (5 slugs + unknown-slug handling), Contact.
- Honest project statuses (Planned/In Progress/Prototype/Completed).
- Verified-email-only contact (mailto); no backend form, phone, or unverified social links.
- Responsive, accessible UI with shared design tokens.

## Technical requirements

- PHP ≥ 8.2 (verified 8.4.24), Composer 2.x.
- Node.js LTS + npm (verified 24.19.0 / 11.17.0).
- Laravel 12, Vue 3, TypeScript (strict), Vite, Tailwind CSS 4.
- Required PHP extensions (16): bcmath, ctype, curl, dom, fileinfo, filter, hash, mbstring, openssl, pcre, PDO, pdo_mysql, session, tokenizer, xml, zip.
- MariaDB/MySQL optional (SQLite scaffold default).

## Non-functional requirements

- No fabricated content, statuses, metrics, clients, testimonials, screenshots, demo/repo links.
- No secrets in repository or frontend bundle.
- Dev-only routes excluded from production bundle.
- SPA fallback for direct URL loads/refresh.
- Accessibility (Lighthouse a11y 1.00 sampled), responsive (360–1440).
- SEO metadata, sitemap, robots.txt, structured data (verified facts only).

## Out of current scope

- Admin CMS, database-driven content, auth, contact backend, blog, APIs, social links (unless approved).