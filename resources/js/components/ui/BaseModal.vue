<script setup lang="ts">
/**
 * BaseModal — accessible dialog built on the native platform primitives.
 *
 * Responsibilities: render a dialog in a body teleport, expose correct
 * `role="dialog"` semantics, lock background scrolling, move focus in on open,
 * restore it on close, trap Tab inside the panel and close on Escape/backdrop.
 * No external library is involved.
 */
import { computed, nextTick, onBeforeUnmount, ref, useId, watch } from 'vue';

type ModalSize = 'sm' | 'md' | 'lg';

interface Props {
    /** Dialog heading. When omitted, pass `ariaLabel` instead. */
    title?: string;
    /** Optional supporting text shown under the title. */
    description?: string;
    /** Accessible name used when no visible title is rendered. */
    ariaLabel?: string;
    /** Panel width. */
    size?: ModalSize;
    /** Accessible name for the close button. */
    closeLabel?: string;
    /** Clicking the backdrop closes the dialog. */
    closeOnBackdrop?: boolean;
    /** Escape closes the dialog. */
    closeOnEscape?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    size: 'md',
    closeLabel: 'Close dialog',
    closeOnBackdrop: true,
    closeOnEscape: true,
});

const emit = defineEmits<{ close: [] }>();

/** Visibility is controlled by the parent through `v-model`. */
const open = defineModel<boolean>({ default: false });

const uid = useId();
const titleId = `${uid}-title`;
const descriptionId = `${uid}-description`;

const panel = ref<HTMLElement | null>(null);
const hasTitle = computed<boolean>(() => Boolean(props.title));

const sizeClasses: Record<ModalSize, string> = {
    sm: 'max-w-md',
    md: 'max-w-lg',
    lg: 'max-w-2xl',
};

const close = (): void => {
    open.value = false;
    emit('close');
};

/** Elements that can receive focus inside the panel, in DOM order. */
const FOCUSABLE_SELECTOR =
    'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]):not([type="hidden"]), ' +
    'select:not([disabled]), [tabindex]:not([tabindex="-1"])';

const getFocusable = (): HTMLElement[] =>
    Array.from(panel.value?.querySelectorAll<HTMLElement>(FOCUSABLE_SELECTOR) ?? []);

const onKeydown = (event: KeyboardEvent): void => {
    if (event.key === 'Escape' && props.closeOnEscape) {
        event.preventDefault();
        close();

        return;
    }

    if (event.key !== 'Tab') {
        return;
    }

    // Keep Tab focus inside the dialog while it is open.
    const focusable = getFocusable();

    if (focusable.length === 0) {
        event.preventDefault();
        panel.value?.focus();

        return;
    }

    const first = focusable[0]!;
    const last = focusable[focusable.length - 1]!;
    const active = document.activeElement as HTMLElement | null;

    if (event.shiftKey && (active === first || !panel.value?.contains(active))) {
        event.preventDefault();
        last.focus();
    } else if (!event.shiftKey && active === last) {
        event.preventDefault();
        first.focus();
    }
};

const onBackdropClick = (): void => {
    if (props.closeOnBackdrop) {
        close();
    }
};

let previouslyFocused: HTMLElement | null = null;
let previousOverflow = '';

const restoreBodyScroll = (): void => {
    if (typeof document !== 'undefined') {
        document.body.style.overflow = previousOverflow;
    }
};

watch(
    open,
    async (isOpen: boolean): Promise<void> => {
        if (typeof document === 'undefined') {
            return;
        }

        if (isOpen) {
            previouslyFocused = document.activeElement as HTMLElement | null;
            previousOverflow = document.body.style.overflow;
            document.body.style.overflow = 'hidden';
            document.addEventListener('keydown', onKeydown);

            await nextTick();
            panel.value?.focus();

            return;
        }

        document.removeEventListener('keydown', onKeydown);
        restoreBodyScroll();

        // Return focus to the trigger if it is still in the document.
        if (previouslyFocused?.isConnected) {
            previouslyFocused.focus();
        }
        previouslyFocused = null;
    },
    { immediate: true },
);

onBeforeUnmount((): void => {
    if (typeof document !== 'undefined') {
        document.removeEventListener('keydown', onKeydown);
        document.body.style.overflow = previousOverflow;
    }
});
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition-opacity duration-150 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-100 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="open" class="fixed inset-0 z-50 overflow-y-auto bg-heading/60">
                <!-- The flex layer is the backdrop: clicks land here only outside the panel. -->
                <div
                    class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-6"
                    @click.self="onBackdropClick"
                >
                    <div
                        ref="panel"
                        role="dialog"
                        aria-modal="true"
                        :aria-labelledby="hasTitle ? titleId : undefined"
                        :aria-label="hasTitle ? undefined : (ariaLabel ?? 'Dialog')"
                        :aria-describedby="description ? descriptionId : undefined"
                        tabindex="-1"
                        :class="[
                            'relative w-full rounded-card border border-line bg-white shadow-elevated outline-none',
                            sizeClasses[size],
                        ]"
                    >
                        <header class="flex items-start justify-between gap-4 border-b border-line p-card">
                            <div class="flex flex-col gap-1">
                                <h2 v-if="title" :id="titleId" class="text-h4">
                                    {{ title }}
                                </h2>

                                <p v-if="description" :id="descriptionId" class="text-small text-body">
                                    {{ description }}
                                </p>

                                <slot name="header" />
                            </div>

                            <button
                                type="button"
                                :aria-label="closeLabel"
                                class="-mt-1 -mr-1 inline-flex size-9 shrink-0 items-center justify-center rounded-field text-muted transition-colors duration-150 hover:bg-surface-soft hover:text-heading"
                                @click="close"
                            >
                                <svg
                                    class="size-5"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.75"
                                    aria-hidden="true"
                                >
                                    <path d="m5 5 10 10M15 5 5 15" stroke-linecap="round" />
                                </svg>
                            </button>
                        </header>

                        <div class="p-card">
                            <slot />
                        </div>

                        <footer
                            v-if="$slots.footer"
                            class="flex flex-wrap justify-end gap-3 border-t border-line p-card"
                        >
                            <slot name="footer" />
                        </footer>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
