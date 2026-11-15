/**
 * Client testimonials and ratings.
 *
 * Only approved, verified testimonials may be displayed publicly. This array is
 * intentionally empty: no client reviews, ratings, or identities have been
 * supplied or verified. Do not fabricate testimonials, ratings, client names,
 * roles, companies, or review dates.
 *
 * Admin management (create/edit/approve/publish/feature) requires a
 * backend/admin module that is not yet implemented; until then this file is the
 * single source of truth and the public section stays hidden when empty.
 */
export interface Testimonial {
    /** Client name (approved for public display). */
    name: string;
    /** Client role/company (approved for public display). */
    role?: string;
    /** Review text. */
    text: string;
    /** Rating value (1-5). */
    rating: number;
    /** Review date (ISO string). */
    date: string;
    /** Associated project slug, if any. */
    projectSlug?: string;
    /** Featured testimonial. */
    featured?: boolean;
}

export const testimonials: readonly Testimonial[] = [];