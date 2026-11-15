/**
 * UI component foundation — public barrel.
 *
 * Consumers import from `@/components/ui` so internal file names can change
 * without touching feature code.
 */
export { default as BaseButton } from './BaseButton.vue';
export { default as BaseContainer } from './BaseContainer.vue';
export { default as SectionHeading } from './SectionHeading.vue';
export { default as BaseCard } from './BaseCard.vue';
export { default as BaseBadge } from './BaseBadge.vue';
export { default as BaseInput } from './BaseInput.vue';
export { default as BaseTextarea } from './BaseTextarea.vue';
export { default as BaseSelect } from './BaseSelect.vue';
export { default as BaseModal } from './BaseModal.vue';

export type { ButtonSize, ButtonVariant, ComponentSize, FeedbackVariant, SelectOption } from './types';
