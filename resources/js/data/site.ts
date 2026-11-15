/**
 * Site-level content for the public portfolio.
 *
 * All homepage copy lives in `resources/js/data/` so text can be reviewed and
 * edited without touching component markup. Nothing in this file asserts a
 * metric, client, testimonial, employer or delivery guarantee — only statements
 * supplied or verifiable in the project brief.
 */

/** Short profile details reused by the hero and contact sections. */
export interface SiteProfile {
    /** Trading name shown in the header, footer and hero. */
    name: string;
    /** Professional positioning line used as the page heading. */
    role: string;
    /** Two-sentence introduction for the hero. */
    intro: string;
    /** Statement about working preferences (brief: remote collaboration). */
    availability: string;
    /**
     * Public contact address.
     *
     * Source: the project owner's pre-configured Git identity, recorded in
     * `docs/INSTALLATION_REPORT.md`. It is the only verified address in the
     * project — replace this one value if a dedicated business mailbox is
     * created before deployment.
     */
    email: string;
    /** Capability phrases shown as chips under the hero introduction. */
    capabilities: readonly string[];
}

export const site: SiteProfile = {
    name: 'IT Assistance BD',
    role: 'Digital Solutions Developer & Creative Problem Solver',
    intro: 'I build web applications with Laravel and Vue, connect them to the services they depend on, and support the surrounding brand work: digital marketing and graphic design.',
    availability: 'Open to remote collaboration and client projects.',
    email: 'hmforkan99@gmail.com',
    capabilities: [
        'Laravel & Vue development',
        'Digital marketing',
        'Graphic design',
        'Problem solving & management',
    ],
};

/** A capability line inside the hero summary card. */
export interface FocusArea {
    title: string;
    detail: string;
}

export const focusAreas: readonly FocusArea[] = [
    {
        title: 'Web applications',
        detail: 'Laravel backends and Vue interfaces built around a real workflow.',
    },
    {
        title: 'APIs & integrations',
        detail: 'REST endpoints and connections between the services an app relies on.',
    },
    {
        title: 'WordPress sites',
        detail: 'Content-driven pages and theme-level customisation.',
    },
    {
        title: 'Marketing & design',
        detail: 'Digital marketing and graphic design support around the product.',
    },
];

/** A short "what this means in practice" point in the About section. */
export interface AboutPoint {
    title: string;
    detail: string;
}

export const aboutPoints: readonly AboutPoint[] = [
    {
        title: 'Development',
        detail: 'Hands-on web application work with Laravel, Vue and TypeScript, from the data model to the interface.',
    },
    {
        title: 'Problem solving',
        detail: 'A structured approach: reproduce the issue, isolate the cause, fix it and document the change.',
    },
    {
        title: 'Business & management',
        detail: 'Experience outside the editor, including business operations, planning and coordination.',
    },
    {
        title: 'Remote collaboration',
        detail: 'Open to remote client projects and clear, written communication across time zones.',
    },
];
