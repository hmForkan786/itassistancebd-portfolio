/**
 * Primary site navigation.
 *
 * Shared by the header and the footer so both always list the same
 * destinations. About, Services, Projects and Contact are dedicated pages;
 * Skills links to the homepage section because no separate Skills page exists in
 * this module. Homepage section anchors (e.g. /#projects) remain valid targets.
 */
export interface NavItem {
    /** Visible link text. */
    label: string;
    /** Router destination (path, or path + hash for homepage anchors). */
    to: string;
    /**
     * Page path used for active-state matching.
     * - Page routes: '/about'
     * - Homepage-only anchor: '/' (active follows the hash instead)
     */
    path: string;
    /** Hash fragment for homepage-anchor items such as Skills. */
    hash?: string;
}

export const mainNavigation: readonly NavItem[] = [
    { label: 'Home', to: '/', path: '/' },
    { label: 'About', to: '/about', path: '/about' },
    { label: 'Services', to: '/services', path: '/services' },
    { label: 'Projects', to: '/projects', path: '/projects' },
    { label: 'Skills', to: '/#skills', path: '/', hash: '#skills' },
    { label: 'Contact', to: '/contact', path: '/contact' },
];
