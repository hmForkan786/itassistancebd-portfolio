<script setup lang="ts">
/**
 * BaseTextarea — labelled multi-line text field.
 *
 * Shares the field styling and ARIA wiring with BaseInput so both controls look
 * and behave consistently inside a form.
 */
import { computed, useId } from 'vue';
import { describedBy, fieldBaseClass, fieldStateClass, fieldTextareaClass } from './field-styles';

interface Props {
    /** Visible label text. Required — controls must never be unlabelled. */
    label: string;
    /** Explicit id; auto-generated when omitted. */
    id?: string;
    /** Native name attribute, used by form submission. */
    name?: string;
    /** Placeholder — never a replacement for the label. */
    placeholder?: string;
    /** Initial visible rows. */
    rows?: number;
    /** Helper text rendered under the field. */
    helper?: string;
    /** Error message; also switches the field into its invalid style. */
    error?: string;
    /** Marks the field as required. */
    required?: boolean;
    /** Disables the field. */
    disabled?: boolean;
}

defineOptions({ inheritAttrs: false });

const props = withDefaults(defineProps<Props>(), {
    rows: 4,
    required: false,
    disabled: false,
});

const model = defineModel<string>({ default: '' });

const uid = useId();
const fieldId = computed<string>(() => props.id ?? `${uid}-textarea`);
const helperId = computed<string | undefined>(() => (props.helper ? `${uid}-helper` : undefined));
const errorId = computed<string | undefined>(() => (props.error ? `${uid}-error` : undefined));
const describedByIds = computed<string | undefined>(() => describedBy(helperId.value, errorId.value));

const controlClasses = computed<string[]>(() => [
    fieldBaseClass,
    fieldTextareaClass,
    'resize-y',
    fieldStateClass(Boolean(props.error)),
]);
</script>

<template>
    <div class="flex flex-col gap-1.5">
        <label :for="fieldId" class="text-small font-medium text-heading">
            {{ label }}
            <span v-if="required" aria-hidden="true" class="text-danger">*</span>
        </label>

        <textarea
            :id="fieldId"
            v-model="model"
            v-bind="$attrs"
            :name="name"
            :rows="rows"
            :placeholder="placeholder"
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
