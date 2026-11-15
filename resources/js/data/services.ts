/**
 * Service catalogue for the homepage.
 *
 * Each entry is a category, a one-sentence explanation and nothing else: no
 * prices, timelines, guarantees or "starting at" claims. Scope is discussed per
 * project, so the data model stays intentionally small.
 */

/** A single service category rendered by `ServiceCard`. */
export interface Service {
    /** Service name (also the card heading). */
    title: string;
    /** One-sentence description of what the service covers. */
    description: string;
}

export const services: readonly Service[] = [
    {
        title: 'Web Application Development',
        description:
            'Custom web applications built around a defined workflow, from database design through to the interface.',
    },
    {
        title: 'Laravel Development',
        description:
            'Laravel backends covering routing, authentication, database migrations, validation and background jobs.',
    },
    {
        title: 'Vue.js Frontend Development',
        description:
            'Vue 3 and TypeScript interfaces with reusable components, accessible markup and predictable state.',
    },
    {
        title: 'API Development & Integration',
        description:
            'REST APIs and integrations that move data between applications, including authentication and data mapping.',
    },
    {
        title: 'WordPress Development',
        description:
            'WordPress sites and theme-level customisation for content-driven pages that non-technical editors can manage.',
    },
    {
        title: 'Digital Marketing',
        description:
            'Search and social support: content planning, on-page fundamentals and campaign coordination.',
    },
    {
        title: 'Graphic Design',
        description:
            'Brand-consistent visuals for web, social media and print, prepared for the platform they will be used on.',
    },
];
