<script setup lang="ts">
/**
 * BaseSelect — labelled dropdown built on the native `<select>`.
 *
 * Native behaviour is kept on purpose: the platform menu, type-ahead and touch
 * pickers work without JavaScript. Only the visual chrome is replaced with a
 * design-system chevron.
 */
import { computed, useId } from 'vue';
import { describedBy, fieldBaseClass, fieldStateClass } from './field-styles';
import type { SelectOption } from './types';

interface Props {
    /** Visible label text. Required — controls must never be unlabelled. */
    label: string;
    /** Options rendered inside the select. */
    options: readonly SelectOption[];
    /** Explicit id; auto-generated when omitted. */
    id?: string;
    /** Native name attribute, used by form submission. */
    name?: string;
    /** Empty-state option shown first. */
    placeholder?: string;
    /** Helper text rendered under the field. */
    helper?: string;
    /** Error message; also switches the field into its invalid style. */
    error?: string;
    /** Marks the field as required. */
    required?: boolean;
    /** Disables the field. */
    disabled?: boolean;
    /** Visual density. */
    size?: 'sm' | 'md';
}

defineOptions({ inheritAttrs: false });

const props = withDefaults(defineProps<Props>(), {
    required: false,
    disabled: false,
    size: 'md',
});

const model = defineModel<string>({ default: '' });

const uid = useId();
const fieldId = computed<string>(() => props.id ?? `${uid}-select`);
const helperId = computed<string | undefined>(() => (props.helper ? `${uid}-helper` : undefined));
const errorId = computed<string | undefined>(() => (props.error ? `${uid}-error` : undefined));
const describedByIds = computed<string | undefined>(() => describedBy(helperId.value, errorId.value));

const sizeClasses: Record<'sm' | 'md', string> = {
    sm: 'h-10 pl-3 pr-9 text-small',
    md: 'h-11 pl-3.5 pr-9',
};

const controlClasses = computed<string[]>(() => [
    fieldBaseClass,
    'appearance-none',
    sizeClasses[props.size],
    fieldStateClass(Boolean(props.error)),
]);
</script>

<template>
    <div class="flex flex-col gap-1.5">
        <label :for="fieldId" class="text-small font-medium text-heading">
            {{ label }}
            <span v-if="required" aria-hidden="true" class="text-danger">*</span>
        </label>

        <div class="relative">
            <select
                :id="fieldId"
                v-model="model"
                v-bind="$attrs"
                :name="name"
                :required="required || undefined"
                :disabled="disabled || undefined"
                :aria-invalid="error ? 'true' : undefined"
                :aria-describedby="describedByIds"
                :class="controlClasses"
            >
                <option v-if="placeholder" value="" :disabled="required">
                    {{ placeholder }}
                </option>

                <option
                    v-for="option in options"
                    :key="option.value"
                    :value="option.value"
                    :disabled="option.disabled || undefined"
                >
                    {{ option.label }}
                </option>
            </select>

            <!-- Decorative chevron: the native control keeps its own semantics. -->
            <svg
                class="pointer-events-none absolute top-1/2 right-3.5 size-4 -translate-y-1/2 text-muted"
                viewBox="0 0 20 20"
                fill="none"
                stroke="currentColor"
                stroke-width="1.75"
                aria-hidden="true"
            >
                <path d="m6 8 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

        <p v-if="helper" :id="helperId" class="text-tiny text-muted">
            {{ helper }}
        </p>

        <p v-if="error" :id="errorId" class="text-tiny font-medium text-danger">
            {{ error }}
        </p>
    </div>
</template>
