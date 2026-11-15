# AGENTS — IT Assistance BD Portfolio

**Project root:** `C:\xampp\htdocs\Laravel\Portfolio`  
**Purpose:** Compact instructions for coding agents working in this repository. Follow [PROJECT_MASTER_RULES.md](PROJECT_MASTER_RULES.md).

## 1. Mandatory first-read files (in order)

1. `AGENTS.md` (this file)
2. `docs/IMPLEMENTATION_STATUS.md` — **single source of truth** for current state, completed/pending/blocked work, limitations, owner actions, next approved module
3. `docs/MODULE_REGISTRY.md` — module statuses, evidence/report links, dependencies, planned modules and approval state
4. Current module specification/report (as provided by Project Owner or referenced in status/registry)
5. Only the relevant focused docs for the task:
   - Architecture/routing/build: `docs/ARCHITECTURE.md`, `docs/PROJECT_CONTEXT.md`
   - Decisions: `docs/DECISIONS.md`
   - Content/data/pages: `docs/CONTENT_INVENTORY.md`, relevant `docs/*` page/module docs
   - QA/testing/evidence: `docs/QA_STRATEGY.md`, `docs/PORTFOLIO_QA_REPORT.md` (if relevant)
   - Environment/setup: `docs/ENVIRONMENT_SETUP.md`
   - Deployment (planning only): `docs/DEPLOYMENT.md`
   - Issues/roadmap: `docs/OPEN_ISSUES.md`, `docs/ROADMAP.md`
6. Relevant source files only

**Do not read every historical installation report during ordinary implementation.** Read historical reports only when: (a) the current task depends on their details, (b) regression investigation requires them, or (c) the Project Owner explicitly asks. Use `docs/README.md` and module registry links to locate evidence.

## 2. How to determine current state and module

- Current baseline, completed installations, in-progress/pending/blocked work, known limitations, owner actions, and next approved module: `docs/IMPLEMENTATION_STATUS.md`.
- Module completion/approval/evidence: `docs/MODULE_REGISTRY.md`.
- Proposed vs approved future work: `docs/ROADMAP.md` and registry. **Never treat proposed roadmap items as approved implementation tasks.**
- If the active module is unclear, stop and confirm with the Project Owner before implementing.

## 3. Documentation-first workflow

- Inspect relevant existing docs and source before changing anything.
- Preserve historical reports/evidence; do not overwrite detailed reports with summaries.
- Use existing documentation as context; avoid repeating unchanged project details.
- When implementation/state changes: update affected docs, maintain concise current-state summary in `docs/IMPLEMENTATION_STATUS.md`, update `docs/MODULE_REGISTRY.md`/changelog/issues/decisions/content inventory as applicable, and link detailed evidence instead of copying it.
- Record new verified decisions and limitations; keep unknowns and owner decisions explicit.

## 4. Safe implementation rules

- Work only inside project root; no destructive commands/broad cleanup; no changes outside root.
- No application source changes unless the approved module requires them.
- Preserve approved modules, architecture, design tokens, and factual content constraints.
- No new packages/frameworks/tools without Project Owner approval.
- No fabricated facts, statuses, contacts, links, metrics, or claims. Do not store secrets/credentials in docs or code.
- Make minimal, evidence-based changes; fix only verified defects within scope.

## 5. Test/build requirements

- Run and report actual results for applicable checks: `npm run type-check`, `npm run build`, `php artisan test`.
- Perform targeted browser/route/responsive/accessibility/content verification relevant to the module.
- Do not mark unverified checks as PASS. For each defect fixed: identify defect, affected file, correction, and re-test.

## 6. Report format (completion)

Include: 1) Final status, 2) Files created, 3) Files modified, 4) Scope/verification results (actual evidence), 5) Defects and fixes (if any), 6) Documentation updates, 7) Owner actions/remaining gaps, 8) Acceptance checklist.

## 7. Approval/stop condition

- After completing an approved module: stop implementation, do not start the next module (including SEO/Installation 12 unless explicitly approved), deliver the completion report, and **wait for Project Owner approval**.
- Preserve owner approval gates at all times.
