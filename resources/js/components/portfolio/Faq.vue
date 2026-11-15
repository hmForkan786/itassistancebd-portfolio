<script setup lang="ts">
/**
 * Faq — factual, concise answers to common questions.
 *
 * Answers avoid fabricated claims (no pricing, timelines, guarantees, client
 * counts, or success rates). Uses native <details> for accessibility and
 * reduced-motion safety.
 */
import { BaseContainer, SectionHeading } from '@/components/ui';

const items = [
    {
        q: 'What kind of work do you take on?',
        a: 'Web application development with Laravel and Vue, API development and integration, WordPress sites, digital marketing, and graphic design. Scope and timing are discussed per project.',
    },
    {
        q: 'Do you work remotely?',
        a: 'Yes. I am open to remote collaboration and client projects across time zones.',
    },
    {
        q: 'Do you provide pricing upfront?',
        a: 'No fixed price list is published. Scope and timing are discussed per project so the estimate matches the actual work.',
    },
    {
        q: 'Can you take over an existing project?',
        a: 'Yes, where the codebase and requirements can be reviewed first. I follow a reproduce-isolate-fix-document approach.',
    },
    {
        q: 'How do I get in touch?',
        a: 'Email is the simplest way: hmforkan99@gmail.com. The contact button opens your email application with the address pre-filled.',
    },
    {
        q: 'Do you have live demos or repositories to share?',
        a: 'No public demo links, repositories, screenshots, or client information are listed, because none have been verified for publication.',
    },
];
</script>

<template>
    <section id="faq" class="section" aria-labelledby="faq-title">
        <BaseContainer class="stack-lg max-w-3xl">
            <SectionHeading
                id="faq-title"
                as="h2"
                eyebrow="FAQ"
                title="Frequently asked questions"
                description="Straightforward answers. If your question is not here, email is the best way to reach me."
                align="center"
            />

            <div class="mt-2 divide-y divide-line border-y border-line">
                <details v-for="item in items" :key="item.q" class="group py-4">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-small font-semibold text-heading">
                        <span>{{ item.q }}</span>
                        <span class="text-primary-dark transition-transform group-open:rotate-45" aria-hidden="true">+</span>
                    </summary>
                    <p class="mt-3 text-small text-body">{{ item.a }}</p>
                </details>
            </div>
        </BaseContainer>
    </section>
</template>