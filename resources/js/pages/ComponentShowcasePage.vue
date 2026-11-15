<script setup lang="ts">
/**
 * Component showcase — internal development verification page.
 *
 * Exercises every UI primitive (buttons, badges, cards, fields, modal) against
 * the design tokens. It is reachable only through the development-only route,
 * and it is not a portfolio page: no business logic, no data fetching.
 */
import { ref } from 'vue';
import {
    BaseBadge,
    BaseButton,
    BaseCard,
    BaseContainer,
    BaseInput,
    BaseModal,
    BaseSelect,
    BaseTextarea,
    SectionHeading,
} from '@/components/ui';
import type { SelectOption } from '@/components/ui';

const clicks = ref(0);
const submitted = ref(false);
const modalOpen = ref(false);
const modalSaved = ref(false);

const fullName = ref('');
const email = ref('');
const message = ref('');
const topic = ref('');
const modalNote = ref('');

const topics: readonly SelectOption[] = [
    { value: 'web', label: 'Web development' },
    { value: 'maintenance', label: 'IT support & maintenance' },
    { value: 'consulting', label: 'Consulting' },
    { value: 'unavailable', label: 'Retired service', disabled: true },
];

const registerClick = (): void => {
    clicks.value += 1;
};

const handleSubmit = (): void => {
    submitted.value = true;
};

const openModal = (): void => {
    modalNote.value = '';
    modalSaved.value = false;
    modalOpen.value = true;
};

const saveModal = (): void => {
    modalSaved.value = true;
    modalOpen.value = false;
};
</script>

<template>
    <main class="section bg-surface">
        <BaseContainer class="stack-lg">
            <SectionHeading
                as="h1"
                eyebrow="Internal verification"
                title="UI component foundation"
                description="Every primitive below uses the approved design tokens. This page exists only in development builds."
            >
                <template #actions>
                    <BaseBadge variant="primary">Module 05</BaseBadge>
                    <BaseBadge variant="neutral">Dev only</BaseBadge>
                </template>
            </SectionHeading>

            <!-- Buttons -->
            <BaseCard as="section" aria-labelledby="showcase-buttons">
                <SectionHeading id="showcase-buttons" as="h2" title="Buttons" description="Five variants, three sizes and every interaction state." />

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <BaseButton @click="registerClick">Primary</BaseButton>
                    <BaseButton variant="secondary" @click="registerClick">Secondary</BaseButton>
                    <BaseButton variant="outline" @click="registerClick">Outline</BaseButton>
                    <BaseButton variant="ghost" @click="registerClick">Ghost</BaseButton>
                    <BaseButton variant="danger" @click="registerClick">Danger</BaseButton>
                </div>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <BaseButton size="sm">Small</BaseButton>
                    <BaseButton size="md">Medium</BaseButton>
                    <BaseButton size="lg">Large</BaseButton>
                    <BaseButton disabled>Disabled</BaseButton>
                    <BaseButton loading>Loading</BaseButton>
                </div>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <BaseButton variant="outline">
                        <template #icon>
                            <svg class="size-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                <path d="M10 4v12M4 10h12" stroke-linecap="round" />
                            </svg>
                        </template>
                        Add item
                    </BaseButton>

                    <BaseButton variant="primary" type="submit">Submit type</BaseButton>
                </div>

                <div class="mt-4 max-w-sm">
                    <BaseButton full-width variant="secondary">Full width</BaseButton>
                </div>

                <p class="mt-4 text-small text-muted" aria-live="polite">
                    Primary/secondary/outline/ghost/danger clicks registered: <strong class="text-heading">{{ clicks }}</strong>
                </p>
            </BaseCard>

            <!-- Badges -->
            <BaseCard as="section" aria-labelledby="showcase-badges">
                <SectionHeading id="showcase-badges" as="h2" title="Badges" description="Semantic states always pair colour with text." />

                <div class="mt-6 flex flex-wrap items-center gap-2">
                    <BaseBadge variant="primary">Primary</BaseBadge>
                    <BaseBadge variant="neutral">Neutral</BaseBadge>
                    <BaseBadge variant="success">Success</BaseBadge>
                    <BaseBadge variant="warning">Warning</BaseBadge>
                    <BaseBadge variant="danger">Danger</BaseBadge>
                    <BaseBadge variant="success" size="md">Medium size</BaseBadge>
                </div>
            </BaseCard>

            <!-- Cards -->
            <section aria-labelledby="showcase-cards">
                <SectionHeading id="showcase-cards" as="h2" title="Cards" description="One border, one radius, one shadow — hover is opt-in." />

                <ul class="mt-6 grid-auto">
                    <li>
                        <BaseCard hoverable class="h-full">
                            <template #header>
                                <BaseBadge variant="primary">Static</BaseBadge>
                            </template>

                            <h3 class="mt-3 text-h4">Default card</h3>
                            <p class="mt-2 text-small text-body">
                                White surface with the standard border, radius and shadow tokens.
                            </p>
                        </BaseCard>
                    </li>

                    <li>
                        <BaseCard hoverable muted class="h-full">
                            <template #header>
                                <BaseBadge variant="neutral">Muted</BaseBadge>
                            </template>

                            <h3 class="mt-3 text-h4">Soft surface</h3>
                            <p class="mt-2 text-small text-body">
                                Uses the soft surface token for secondary panels and callouts.
                            </p>
                        </BaseCard>
                    </li>

                    <li>
                        <BaseCard as="article" hoverable class="h-full">
                            <template #header>
                                <BaseBadge variant="success">Padded</BaseBadge>
                            </template>

                            <h3 class="mt-3 text-h4">With footer slot</h3>
                            <p class="mt-2 text-small text-body">Cards expose header, default and footer slots.</p>

                            <template #footer>
                                <p class="mt-4 border-t border-line pt-3 text-tiny text-muted">Footer slot content</p>
                            </template>
                        </BaseCard>
                    </li>
                </ul>
            </section>

            <!-- Form controls -->
            <BaseCard as="section" aria-labelledby="showcase-fields">
                <SectionHeading
                    id="showcase-fields"
                    as="h2"
                    title="Form controls"
                    description="Labels, helpers and errors are wired with for/id and aria-describedby."
                />

                <form class="mt-6 grid gap-grid md:grid-cols-2" @submit.prevent="handleSubmit">
                    <BaseInput
                        v-model="fullName"
                        label="Full name"
                        name="fullName"
                        placeholder="Rahim Uddin"
                        helper="As it should appear on the enquiry."
                        autocomplete="name"
                        required
                    />

                    <BaseInput
                        v-model="email"
                        label="Email address"
                        name="email"
                        type="email"
                        placeholder="you@example.com"
                        autocomplete="email"
                        helper="We reply within one business day."
                        required
                    />

                    <BaseInput
                        label="Phone (disabled example)"
                        name="phone"
                        type="tel"
                        placeholder="+880 1XXX XXXXXX"
                        disabled
                    />

                    <BaseInput
                        label="Project budget"
                        name="budget"
                        type="text"
                        model-value="1200"
                        error="Enter an amount between 500 and 100000."
                    />

                    <BaseSelect
                        v-model="topic"
                        label="Service"
                        name="service"
                        placeholder="Choose a service"
                        :options="topics"
                        helper="Disabled options cannot be selected."
                        required
                    />

                    <BaseTextarea
                        v-model="message"
                        label="Requirements"
                        name="message"
                        placeholder="Describe the project or the problem to solve."
                        :rows="4"
                        helper="Markdown is not supported."
                    />
                </form>

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <BaseButton type="button" @click="handleSubmit">Validate demo</BaseButton>
                    <BaseBadge v-if="submitted" variant="success">Form submit handler fired</BaseBadge>
                    <span v-else class="text-small text-muted">No submission yet.</span>
                </div>
            </BaseCard>

            <!-- Modal -->
            <BaseCard as="section" aria-labelledby="showcase-modal">
                <SectionHeading
                    id="showcase-modal"
                    as="h2"
                    title="Dialog"
                    description="Escape, backdrop click, Tab trapping, scroll lock and focus restore."
                />

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <BaseButton @click="openModal">Open dialog</BaseButton>
                    <BaseBadge v-if="modalSaved" variant="success">Saved via dialog</BaseBadge>
                </div>
            </BaseCard>
        </BaseContainer>

        <BaseModal
            v-model="modalOpen"
            title="Dialog example"
            description="Focus moves into the panel, Tab stays inside, Escape closes."
            @close="modalSaved = false"
        >
            <div class="stack">
                <BaseInput
                    v-model="modalNote"
                    label="Note"
                    name="modalNote"
                    placeholder="Optional note"
                    helper="This field lives inside the dialog."
                />

                <p class="text-small text-muted">
                    Current note: <span class="text-heading">{{ modalNote || '—' }}</span>
                </p>
            </div>

            <template #footer>
                <BaseButton variant="ghost" @click="modalOpen = false">Cancel</BaseButton>
                <BaseButton @click="saveModal">Save note</BaseButton>
            </template>
        </BaseModal>
    </main>
</template>
