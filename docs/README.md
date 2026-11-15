# Documentation Index — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Last updated:** 2026-11-15 (GitHub backup preparation)  
**Purpose:** Central navigation for project documentation. Use this index to find the current state, rules, evidence, and focused reference docs without reading every historical report.

> **Reading order for coding agents:** see [../AGENTS.md](../AGENTS.md) and [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md). Do not read every historical installation report during ordinary implementation.

---

## Core project documents

| Document | Purpose |
|---|---|
| [../PROJECT_MASTER_RULES.md](../PROJECT_MASTER_RULES.md) | Permanent project rules (scope, stack, design, architecture, safety, testing, approval, no-fabrication, reporting) |
| [../AGENTS.md](../AGENTS.md) | Compact coding-agent instructions and documentation-first reading workflow |
| [PROJECT_CONTEXT.md](PROJECT_CONTEXT.md) | Project overview: purpose, audience, brand, goals, current scope, constraints, owner responsibilities |
| [ARCHITECTURE.md](ARCHITECTURE.md) | Current verified architecture (Laravel, Vue/TS/Vite/Tailwind, routing/layout/data/build/SPA fallback, limitations) |
| [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md) | **Single source of truth:** current state, completed/in-progress/pending/blocked work, limitations, owner actions, next approved module |
| [MODULE_REGISTRY.md](MODULE_REGISTRY.md) | Module register (01–10 complete, 11 documented), statuses/evidence links, dependencies, planned modules, approval state |
| [ROADMAP.md](ROADMAP.md) | Future work with priority/dependencies/scope/acceptance/owner decisions; separates approved/proposed/pending approval/deferred |
| [DECISIONS.md](DECISIONS.md) | Verified/owner-approved decision log (ID, date/status/reason/scope/supersession) |
| [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) | Pages, services, projects/details, navigation, verified statuses/stacks/contact, confirmation status, missing owner info |
| [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md) | Consolidated verified environment, setup, commands, local dev process, assumptions, safe operating instructions (no secrets) |
| [QA_STRATEGY.md](QA_STRATEGY.md) | Type-check/build/tests, browser/responsive/accessibility/content/bundle checks, defect handling, evidence requirements |
| [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | Installation 12 audit/implementation/verification report (metadata, sitemap, robots, JSON-LD, performance, production readiness) |
| [DEPLOYMENT.md](DEPLOYMENT.md) | cPanel/shared-hosting deployment plan (prerequisites, build, SPA routing, config checklist, rollback, owner decisions) — **not deployed** |
| [CHANGELOG.md](CHANGELOG.md) | Chronological summary of approved module changes |
| [OPEN_ISSUES.md](OPEN_ISSUES.md) | Outstanding issues, known limitations, owner actions, deferred/pending verification items with status/links |

---

## Categorized documentation (navigation)

### Project overview
- [PROJECT_CONTEXT.md](PROJECT_CONTEXT.md) — purpose, audience, brand, goals, scope, constraints, owner responsibilities
- [../PROJECT_MASTER_RULES.md](../PROJECT_MASTER_RULES.md) — permanent project rules
- [../AGENTS.md](../AGENTS.md) — coding-agent instructions

### Architecture
- [ARCHITECTURE.md](ARCHITECTURE.md) — current verified architecture (Laravel, Vue/TS/Vite/Tailwind, routing/layout/data/build/SPA fallback, limitations)
- [architecture/SYSTEM_ARCHITECTURE.md](architecture/SYSTEM_ARCHITECTURE.md) — system/backend/frontend/SPA/API/auth/data flow/build/runtime/boundaries

### Requirements
- [requirements/REQUIREMENTS.md](requirements/REQUIREMENTS.md) — functional, technical, non-functional requirements and out-of-scope

### Decisions
- [DECISIONS.md](DECISIONS.md) — verified/owner-approved decision log (D-001–D-015)
- [decisions/](decisions/) — decision register directory (see `OWNER_DECISION_APPROVAL_REGISTER.md`)

### Backend
- [backend/BACKEND_DOCUMENTATION.md](backend/BACKEND_DOCUMENTATION.md) — Laravel structure, controllers, models, services, middleware, providers, auth, validation, error handling, conventions

### Frontend
- [frontend/FRONTEND_DOCUMENTATION.md](frontend/FRONTEND_DOCUMENTATION.md) — Vue app structure, routing, components, layouts, state, Pinia, Axios, TypeScript, Tailwind, Vite

### API
- [api/API_DOCUMENTATION.md](api/API_DOCUMENTATION.md) — API status (none implemented), HTTP client, Laravel routes, future API work

### Database
- [database/DATABASE_DOCUMENTATION.md](database/DATABASE_DOCUMENTATION.md) — current SQLite scaffold, tables, migrations, production strategy

### Installation
- [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md) — verified environment, setup, commands, safe operating instructions
- [installation/LOCAL_INSTALLATION.md](installation/LOCAL_INSTALLATION.md) — local installation steps
- [INSTALLATION_REPORT.md](INSTALLATION_REPORT.md) — Module 01 environment report
- [LARAVEL_INSTALLATION.md](LARAVEL_INSTALLATION.md) — Module 02
- [VUE_INSTALLATION.md](VUE_INSTALLATION.md) — Module 03

### Development
- [development/DEVELOPMENT.md](development/DEVELOPMENT.md) — development workflow, commands, notes
- [CONTRIBUTING.md](../CONTRIBUTING.md) (root) — coding standards, Git workflow, testing expectations
- [SECURITY.md](../SECURITY.md) (root) — security policy

### Testing
- [testing/TESTING_GUIDE.md](testing/TESTING_GUIDE.md) — test framework, commands, environment, limitations
- [testing/QUALITY_STATUS.md](testing/QUALITY_STATUS.md) — actual quality results
- [QA_STRATEGY.md](QA_STRATEGY.md) — QA strategy and evidence requirements

### Security
- [security/SECURITY.md](security/SECURITY.md) — security summary and policy reference
- [../SECURITY.md](../SECURITY.md) (root) — full security policy

### Deployment
- [DEPLOYMENT.md](DEPLOYMENT.md) — cPanel/shared-hosting deployment plan
- [deployment/CPANEL_DEPLOYMENT.md](deployment/CPANEL_DEPLOYMENT.md) — cPanel deployment summary
- [deployment/DEPLOYMENT_STATUS.md](deployment/DEPLOYMENT_STATUS.md) — deployment status (not deployed)
- [CPANEL_DEPLOYMENT_AUDIT_REPORT.md](CPANEL_DEPLOYMENT_AUDIT_REPORT.md) — hosting compatibility audit
- [DEPLOYMENT_PLANNING.md](DEPLOYMENT_PLANNING.md) — deployment planning
- [CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md](CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md) — owner deployment guide
- [PRODUCTION_UPLOAD_CHECKLIST.md](PRODUCTION_UPLOAD_CHECKLIST.md) — upload checklist
- [PRODUCTION_RELEASE_EXECUTION_PLAN.md](PRODUCTION_RELEASE_EXECUTION_PLAN.md) — release execution plan
- [PRODUCTION_SMOKE_TEST_CHECKLIST.md](PRODUCTION_SMOKE_TEST_CHECKLIST.md) — smoke tests
- [OWNER_RELEASE_AUTHORIZATION.md](OWNER_RELEASE_AUTHORIZATION.md) — release authorization sheet

### Phases
- [phases/PHASE_INDEX.md](phases/PHASE_INDEX.md) — phase/module index (01–22)
- [reports/PROJECT_IMPLEMENTATION_STATUS.md](reports/PROJECT_IMPLEMENTATION_STATUS.md) — implementation status summary
- [MODULE_REGISTRY.md](MODULE_REGISTRY.md) — module register (01–22)

### Reports
- [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md) — single source of truth for current state
- [PORTFOLIO_QA_REPORT.md](PORTFOLIO_QA_REPORT.md) — Module 10 QA report
- [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) — Module 12 SEO/perf report
- [PERFORMANCE_AUDIT_REPORT.md](PERFORMANCE_AUDIT_REPORT.md) — Module 13 perf audit
- [RELEASE_READINESS_REPORT.md](RELEASE_READINESS_REPORT.md) — Module 17 release readiness
- [PRODUCTION_RELEASE_GO_NO_GO.md](PRODUCTION_RELEASE_GO_NO_GO.md) — Go/No-Go matrix
- [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) — owner content review
- [OWNER_DECISION_APPROVAL_REGISTER.md](OWNER_DECISION_APPROVAL_REGISTER.md) — owner decision approval register

### Roadmap
- [ROADMAP.md](ROADMAP.md) — future work (approved/proposed/pending/deferred)
- [roadmap/PROJECT_ROADMAP.md](roadmap/PROJECT_ROADMAP.md) — roadmap summary

### Troubleshooting
- [troubleshooting/TROUBLESHOOTING.md](troubleshooting/TROUBLESHOOTING.md) — common issues and fixes

### GitHub backup
- [github/GITHUB_PROJECT_INVENTORY.md](github/GITHUB_PROJECT_INVENTORY.md) — project inventory
- [github/GITHUB_BACKUP_FINAL_REPORT.md](github/GITHUB_BACKUP_FINAL_REPORT.md) — backup final report (created at push)
- [GITHUB_BACKUP_GUIDE.md](GITHUB_BACKUP_GUIDE.md) — GitHub backup guide

### Reference
- [reference/REFERENCE.md](reference/REFERENCE.md) — central reference links
- [requirements/REQUIREMENTS.md](requirements/REQUIREMENTS.md) — requirements
- [development/DEVELOPMENT.md](development/DEVELOPMENT.md) — development workflow
- [CONTENT_INVENTORY.md](CONTENT_INVENTORY.md) — content inventory

---

## Historical installation and module reports (preserved evidence)

Detailed reports are preserved as evidence. Use [MODULE_REGISTRY.md](MODULE_REGISTRY.md) for status and links; open historical reports only when task details, regression investigation, or Project Owner request requires them.

| Installation/Module | Report / evidence | Status |
|---|---|---|
| 01 — Development Environment Setup | [INSTALLATION_REPORT.md](INSTALLATION_REPORT.md), [ENVIRONMENT_SETUP.md](ENVIRONMENT_SETUP.md) | ✅ Complete |
| 02 — Laravel 12 Project Installation | [LARAVEL_INSTALLATION.md](LARAVEL_INSTALLATION.md) | ✅ Complete |
| 03 — Vue 3 + TypeScript + Vite Integration | [VUE_INSTALLATION.md](VUE_INSTALLATION.md) | ✅ Complete |
| 04 — Tailwind CSS + Design System Foundation | [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md) | ✅ Complete |
| 05 — Vue UI Component Foundation | [UI_COMPONENTS.md](UI_COMPONENTS.md) | ✅ Complete |
| 06 — Portfolio Layout Foundation | [PORTFOLIO_LAYOUT.md](PORTFOLIO_LAYOUT.md) | ✅ Complete |
| 07 — Portfolio Homepage Foundation | [HOMEPAGE.md](HOMEPAGE.md) | ✅ Complete |
| 08 — Portfolio Secondary Pages Foundation | [SECONDARY_PAGES.md](SECONDARY_PAGES.md) | ✅ Complete |
| 09 — Project Detail Pages Foundation | [PROJECT_DETAIL_PAGES.md](PROJECT_DETAIL_PAGES.md) | ✅ Complete |
| 10 — Portfolio QA & Content Verification | [PORTFOLIO_QA_REPORT.md](PORTFOLIO_QA_REPORT.md) | ✅ Complete |
| 12 — SEO, Performance & Production Readiness | [SEO_PERFORMANCE_REPORT.md](SEO_PERFORMANCE_REPORT.md) | ✅ Complete (awaiting owner approval) |
| 13 — Performance Audit & Optimization | [PERFORMANCE_AUDIT_REPORT.md](PERFORMANCE_AUDIT_REPORT.md) | ✅ Complete (awaiting owner approval) |
| 14 — Production Deployment Preparation & cPanel Compatibility Audit | [CPANEL_DEPLOYMENT_AUDIT_REPORT.md](CPANEL_DEPLOYMENT_AUDIT_REPORT.md) | ✅ Complete (awaiting owner approval) |
| 15 — Project Content Finalization & Owner Content Review | [INSTALLATION_15_REPORT.md](INSTALLATION_15_REPORT.md), [OWNER_CONTENT_REVIEW.md](OWNER_CONTENT_REVIEW.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 16 — Owner-Approved Content Implementation & Final Content Verification | [INSTALLATION_16_REPORT.md](INSTALLATION_16_REPORT.md) | ⚠️ BLOCKED_PENDING_OWNER_INPUT (REVIEW; awaiting owner approval) |
| 17 — Production Release Validation & Deployment Readiness Gate | [INSTALLATION_17_REPORT.md](INSTALLATION_17_REPORT.md), [RELEASE_READINESS_REPORT.md](RELEASE_READINESS_REPORT.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 18 — Deployment Planning & Owner Infrastructure Decision | [INSTALLATION_18_REPORT.md](INSTALLATION_18_REPORT.md), [DEPLOYMENT_PLANNING.md](DEPLOYMENT_PLANNING.md), [OWNER_INFRASTRUCTURE_DECISIONS.md](OWNER_INFRASTRUCTURE_DECISIONS.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 19 — Owner Infrastructure Configuration & Deployment Readiness Preparation | [INSTALLATION_19_REPORT.md](INSTALLATION_19_REPORT.md), [DEPLOYMENT_CONFIGURATION_READINESS.md](DEPLOYMENT_CONFIGURATION_READINESS.md), [OWNER_INFRASTRUCTURE_DECISIONS_STATUS.md](OWNER_INFRASTRUCTURE_DECISIONS_STATUS.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 20 — Deployment Execution Authorization & Production Release Preparation | [INSTALLATION_20_REPORT.md](INSTALLATION_20_REPORT.md), [PRODUCTION_RELEASE_EXECUTION_PLAN.md](PRODUCTION_RELEASE_EXECUTION_PLAN.md), [PRODUCTION_SMOKE_TEST_CHECKLIST.md](PRODUCTION_SMOKE_TEST_CHECKLIST.md), [OWNER_RELEASE_AUTHORIZATION.md](OWNER_RELEASE_AUTHORIZATION.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 21 — Owner Infrastructure Decision Intake & Production Release Go/No-Go | [INSTALLATION_21_REPORT.md](INSTALLATION_21_REPORT.md), [PRODUCTION_RELEASE_GO_NO_GO.md](PRODUCTION_RELEASE_GO_NO_GO.md), [OWNER_FINAL_RELEASE_DECISIONS.md](OWNER_FINAL_RELEASE_DECISIONS.md) | ✅ Complete (REVIEW; awaiting owner approval) |
| 21C - Owner Decision Approval & Documentation | [INSTALLATION_21C_REPORT.md](INSTALLATION_21C_REPORT.md), [OWNER_DECISION_APPROVAL_REGISTER.md](OWNER_DECISION_APPROVAL_REGISTER.md) |
| 22 - Production Upload Preparation | [INSTALLATION_22_REPORT.md](INSTALLATION_22_REPORT.md), [CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md](CPANEL_PRODUCTION_DEPLOYMENT_GUIDE.md), [PRODUCTION_UPLOAD_CHECKLIST.md](PRODUCTION_UPLOAD_CHECKLIST.md) | ✅ Complete (REVIEW; awaiting owner approval) |

---

## Notes

- **Source of truth:** [IMPLEMENTATION_STATUS.md](IMPLEMENTATION_STATUS.md) (current state) and [MODULE_REGISTRY.md](MODULE_REGISTRY.md) (modules/evidence). Historical reports provide detailed evidence and are not replaced by summaries.
- **No secrets:** Documentation must not contain passwords, API keys, tokens, or private credentials.
- **Approval gates:** Proposed/roadmap items are not approved implementation tasks unless explicitly approved by the Project Owner.
