<script setup lang="ts">
/**
 * BaseInput — labelled single-line text field.
 *
 * The label, helper text and error message are wired to the control through
 * `for`/`id` and `aria-describedby`, and invalid state is exposed with
 * `aria-invalid`. Validation itself belongs to the form layer, not here.
 */
import { computed, useId } from 'vue';
import { describedBy, fieldBaseClass, fieldControlClass, fieldStateClass } from './field-styles';

type FieldType = 'text' | 'email' | 'password' | 'tel' | 'url' | 'search' | 'number';

interface Props {
    /** Visible label text. Required — controls must never be unlabelled. */
    label: string;
    /** Explicit id; auto-generated when omitted. */
    id?: string;
    /** Input type. */
    type?: FieldType;
    /** Native name attribute, used by form submission. */
    name?: string;
    /** Placeholder — never a replacement for the label. */
    placeholder?: string;
    /** Helper text rendered under the field. */
    helper?: string;
    /** Error message; also switches the field into its invalid style. */
    error?: string;
    /** Marks the field as required. */
    required?: boolean;
    /** Disables the field. */
    disabled?: boolean;
    /** Browser autofill hint. */
    autocomplete?: string;
    /** Visual density. */
    size?: 'sm' | 'md';
}

defineOptions({ inheritAttrs: false });

const props = withDefaults(defineProps<Props>(), {
    type: 'text',
    required: false,
    disabled: false,
    size: 'md',
});

const model = defineModel<string>({ default: '' });

const uid = useId();
const fieldId = computed<string>(() => props.id ?? `${uid}-input`);
const helperId = computed<string | undefined>(() => (props.helper ? `${uid}-helper` : undefined));
const errorId = computed<string | undefined>(() => (props.error ? `${uid}-error` : undefined));
const describedByIds = computed<string | undefined>(() => describedBy(helperId.value, errorId.value));

const sizeClasses: Record<'sm' | 'md', string> = {
    sm: 'h-10 px-3 text-small',
    md: fieldControlClass,
};

const controlClasses = computed<string[]>(() => [
    fieldBaseClass,
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

        <input
            :id="fieldId"
            v-model="model"
            v-bind="$attrs"
            :type="type"
            :name="name"
            :placeholder="placeholder"
            :autocomplete="autocomplete"
            :required="required || undefined"
            :disabled="disabled || undefined"
            :aria-invalid="error ? 'true' : undefined"
            :aria-describedby="describedByIds"
            :class="controlClasses"
        />

        <p v-if="helper" :id="helperId" class="text-tiny text-muted">
            {{ helper }}
        </p>

        <p v-if="error" :id="errorId" class="text-tiny font-medium text-danger">
            {{ error }}
        </p>
    </div>
</template>
