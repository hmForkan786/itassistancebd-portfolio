/**
 * Skills grouped by area.
 *
 * The list contains exactly the skills supplied for this module. Deliberately no
 * percentage bars or "expert/advanced" labels: self-assigned levels are not
 * verifiable, so the UI presents tools and the groups they belong to instead.
 */

/** A labelled group of related tools. */
export interface SkillGroup {
    /** Group heading, e.g. "Languages & frameworks". */
    title: string;
    /** Why the group exists / what it covers. */
    description: string;
    /** Tool names shown as chips. */
    items: readonly string[];
}

export const skillGroups: readonly SkillGroup[] = [
    {
        title: 'Languages & frameworks',
        description: 'The stack used for application work, from backend to interface.',
        items: ['Laravel', 'PHP', 'Vue.js', 'TypeScript', 'JavaScript'],
    },
    {
        title: 'Data & APIs',
        description: 'Storing application data and exposing it to other systems.',
        items: ['MySQL', 'REST API'],
    },
    {
        title: 'Web & content',
        description: 'Content-managed sites and the markup they are built on.',
        items: ['WordPress', 'HTML/CSS'],
    },
];
