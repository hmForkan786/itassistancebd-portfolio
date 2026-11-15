/**
 * Shared classes for form controls.
 *
 * BaseInput, BaseTextarea and BaseSelect must look identical, so their shared
 * field styling lives here instead of being duplicated in each component.
 */

/** Structural + typography styling common to every text-like control. */
export const fieldBaseClass =
    'w-full rounded-field border bg-white text-body text-heading shadow-none ' +
    'placeholder:text-muted transition-colors duration-150 ' +
    'disabled:cursor-not-allowed disabled:bg-surface-soft disabled:text-muted';

/** Border/focus colour driven by the validation state. */
export const fieldStateClass = (invalid: boolean): string =>
    invalid ? 'border-danger focus:border-danger' : 'border-line focus:border-primary';

/** Single-line input height. */
export const fieldControlClass = 'h-11 px-3.5';

/** Multi-line padding: matches the input horizontally, breathing room vertically. */
export const fieldTextareaClass = 'min-h-28 px-3.5 py-2.5';

/** Joins the ids used by `aria-describedby`, ignoring empty values. */
export const describedBy = (...ids: Array<string | undefined>): string | undefined => {
    const present = ids.filter((id): id is string => Boolean(id));

    return present.length > 0 ? present.join(' ') : undefined;
};
