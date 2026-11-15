/**
 * Portfolio project initiatives.
 *
 * Single source of truth for the projects listing and project detail pages.
 * Entries are initiatives, not automatically completed commercial products, so
 * every status is explicit and conservative. No demo URLs, repository links,
 * screenshots, client names, testimonials or outcome metrics are recorded
 * because none have been supplied or verified.
 *
 * Technology stacks and work items list only what is verified in this codebase
 * or explicitly confirmed; unverified details are stated as such.
 */

/** The four honest states a project initiative can show. */
export type ProjectStatus = 'completed' | 'in-progress' | 'prototype' | 'planned';

/** A short, verifiable note about work or scope. */
export interface ProjectPoint {
    /** Concise label. */
    title: string;
    /** Factual detail. */
    detail: string;
}

/** A single portfolio initiative used by cards and detail pages. */
export interface PortfolioProject {
    /** URL slug (stable route segment). */
    slug: string;
    /** Initiative name — the card/heading. */
    name: string;
    /** Neutral one-sentence description for listings. */
    summary: string;
    /** Longer overview for the detail page. */
    overview: string;
    /** Why the initiative exists / the problem area it addresses. */
    purpose: string;
    /** Current verified state (preserved). */
    status: ProjectStatus;
    /** Short domain focus, e.g. "Education tools". */
    focus: string;
    /** Verified technologies; empty/unspecified when not confirmed. */
    techStack: readonly string[];
    /** Work confirmed as done in this repository or verified build. */
    implemented: readonly ProjectPoint[];
    /** Intended or possible scope, clearly not claimed as implemented. */
    plannedScope: readonly ProjectPoint[];
    /** Known limits, gaps or caveats. */
    limitations: readonly string[];
}

export const projects: readonly PortfolioProject[] = [
    {
        slug: 'ai-kids-video-factory',
        name: 'AI Kids Video Factory',
        summary:
            'An initiative exploring a repeatable, template-based workflow for producing children\u2019s video content.',
        overview:
            'AI Kids Video Factory is a planned initiative focused on organising a repeatable workflow for producing children\u2019s video content from templates and structured inputs.',
        purpose:
            'To explore a more consistent, step-by-step process for preparing children\u2019s video content, reducing ad-hoc work where a template-driven flow may help.',
        status: 'planned',
        focus: 'Content automation',
        techStack: [],
        implemented: [],
        plannedScope: [
            {
                title: 'Template-based workflow',
                detail: 'Define reusable templates and a repeatable sequence for assembling video content (planned).',
            },
            {
                title: 'Content preparation steps',
                detail: 'Organise inputs and generation steps in a clearer, trackable flow (planned).',
            },
        ],
        limitations: [
            'Status is planned: no implementation, demo, repository or release has been verified for this site.',
            'Technology stack and feature set are not yet confirmed.',
        ],
    },
    {
        slug: 'scholarship-tracker',
        name: 'Scholarship Tracker',
        summary:
            'An initiative for keeping scholarship applications, requirements and deadlines in one place.',
        overview:
            'Scholarship Tracker is a planned initiative aimed at bringing scholarship opportunities, application requirements and key dates into a single, easier-to-follow view.',
        purpose:
            'To make it simpler to track which scholarships to consider, what each one requires and when actions or deadlines are due.',
        status: 'planned',
        focus: 'Education tools',
        techStack: [],
        implemented: [],
        plannedScope: [
            {
                title: 'Opportunity tracking',
                detail: 'Record scholarships with their requirements and important dates in one place (planned).',
            },
            {
                title: 'Deadline visibility',
                detail: 'Surface upcoming deadlines and application steps so they are easier to follow (planned).',
            },
        ],
        limitations: [
            'Status is planned: no implementation, demo, repository or release has been verified for this site.',
            'Technology stack and feature set are not yet confirmed.',
        ],
    },
    {
        slug: 'iiuc-tower-erp',
        name: 'IIUC Tower ERP',
        summary:
            'An enterprise resource planning initiative covering records and day-to-day operations for IIUC Tower.',
        overview:
            'IIUC Tower ERP is a planned initiative to organise operational records and routine processes for IIUC Tower in a single system.',
        purpose:
            'To support day-to-day administration by keeping relevant records and operational information structured and easier to manage.',
        status: 'planned',
        focus: 'Enterprise systems',
        techStack: [],
        implemented: [],
        plannedScope: [
            {
                title: 'Operational records',
                detail: 'Centralise selected records related to day-to-day tower operations (planned).',
            },
            {
                title: 'Process support',
                detail: 'Provide structured workflows for routine administrative tasks (planned).',
            },
        ],
        limitations: [
            'Status is planned: no implementation, demo, repository or release has been verified for this site.',
            'Technology stack, modules and scope are not yet confirmed.',
        ],
    },
    {
        slug: 'applymate',
        name: 'ApplyMate',
        summary:
            'An initiative to make repetitive application and job-search workflows easier to manage.',
        overview:
            'ApplyMate is a planned initiative to help organise repetitive steps in application and job-search workflows so progress is easier to track.',
        purpose:
            'To reduce manual repetition when managing applications by keeping tasks, statuses and follow-ups in a clearer structure.',
        status: 'planned',
        focus: 'Career tools',
        techStack: [],
        implemented: [],
        plannedScope: [
            {
                title: 'Application tracking',
                detail: 'Keep applications, their states and related notes organised in one place (planned).',
            },
            {
                title: 'Workflow support',
                detail: 'Simplify recurring steps in a job-search or application process (planned).',
            },
        ],
        limitations: [
            'Status is planned: no implementation, demo, repository or release has been verified for this site.',
            'Technology stack and feature set are not yet confirmed.',
        ],
    },
    {
        slug: 'it-assistance-bd-portfolio',
        name: 'IT Assistance BD Portfolio',
        summary:
            'This site: a Laravel and Vue portfolio presenting the services, skills and initiatives of IT Assistance BD.',
        overview:
            'This project is the public portfolio website for IT Assistance BD. It presents services, skills and project initiatives in a factual way and is being built incrementally through approved installation modules.',
        purpose:
            'To provide a clear, professional web presence that describes the work, capabilities and initiatives of IT Assistance BD without invented claims or metrics.',
        status: 'in-progress',
        focus: 'Portfolio',
        techStack: ['Laravel 12', 'Vue 3', 'TypeScript', 'Vite', 'Tailwind CSS 4', 'Vue Router', 'Pinia'],
        implemented: [
            {
                title: 'Application foundation',
                detail: 'Laravel 12 project with a Vue 3 + TypeScript + Vite single-page frontend, routing and state setup.',
            },
            {
                title: 'Design system & UI primitives',
                detail: 'Tailwind CSS 4 token-based styling and a set of reusable, accessible UI components.',
            },
            {
                title: 'Layout and public pages',
                detail: 'Responsive header/footer shell, homepage sections, and secondary About, Services, Projects and Contact pages.',
            },
            {
                title: 'Project detail pages',
                detail: 'Individual project pages sourced from the shared project data (this module).',
            },
        ],
        plannedScope: [
            {
                title: 'Further approved modules',
                detail: 'Additional features only as approved by the Project Owner in later modules (planned).',
            },
        ],
        limitations: [
            'Content is static and file-based (no CMS or database-driven portfolio management).',
            'No authentication, admin area, backend contact form or external API integrations.',
            'No public demo links, repositories, screenshots, testimonials or client information are listed.',
        ],
    },
];

/** Look up a project by its route slug. */
export const getProjectBySlug = (slug: string): PortfolioProject | undefined =>
    projects.find((project) => project.slug === slug);

