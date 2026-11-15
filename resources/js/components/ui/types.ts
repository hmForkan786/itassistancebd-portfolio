/**
 * Shared types for the UI component foundation.
 *
 * Kept in a plain module so both `.vue` components and consumers can import the
 * same definitions without duplicating string unions in several places.
 */

/** Available visual variants for buttons. */
export type ButtonVariant = 'primary' | 'secondary' | 'outline' | 'ghost' | 'danger';

/** Control sizes shared by buttons and form fields. */
export type ComponentSize = 'sm' | 'md' | 'lg';

/** Alias used by BaseButton so the prop reads naturally at the call site. */
export type ButtonSize = ComponentSize;

/** Feedback variants for badges and inline notices. */
export type FeedbackVariant = 'primary' | 'neutral' | 'success' | 'warning' | 'danger';

/** A single option rendered by BaseSelect (native `<select>`). */
export interface SelectOption {
    value: string;
    label: string;
    disabled?: boolean;
}
