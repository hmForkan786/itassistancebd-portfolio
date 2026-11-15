<script setup lang="ts">
/**
 * ContactPage — a simple, factual way to get in touch.
 *
 * Uses the verified email address from `site` data. There is no backend contact
 * form, no phone number and no social/profile links because none have been
 * verified for this site. The mailto CTA opens the visitor's email application
 * — it does not send or store a message.
 */
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import { site } from '@/data/site';

/** Pre-encoded mailto target for the primary call to action. */
const mailtoHref: string = `mailto:${site.email}?subject=${encodeURIComponent('Portfolio enquiry — IT Assistance BD')}`;
</script>

<template>
    <div>
        <!-- Page intro -->
        <section class="section bg-surface border-b border-line" aria-labelledby="contact-page-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="contact-page-title"
                    as="h1"
                    eyebrow="Contact"
                    title="Get in touch"
                    :description="`If you have a project, a collaboration idea or a question about the work shown on this site, email is the simplest way to reach ${site.name}.`"
                    class="max-w-3xl"
                />
            </BaseContainer>
        </section>

        <!-- Contact details and instructions -->
        <section class="section" aria-labelledby="contact-details-title">
            <BaseContainer class="grid gap-grid lg:grid-cols-12 lg:items-start">
                <BaseCard as="section" class="lg:col-span-7" aria-labelledby="contact-details-title">
                    <SectionHeading
                        id="contact-details-title"
                        as="h2"
                        title="Send an email"
                        description="Click the button below to open your email application with the address pre-filled, or copy the address and write to me directly."
                    />

                    <div class="mt-6 flex flex-col gap-4">
                        <div>
                            <CtaLink :href="mailtoHref" variant="primary" size="lg">
                                Email {{ site.name }}
                            </CtaLink>
                        </div>

                        <p class="text-small text-body">
                            <span class="font-medium text-heading">Email address:</span>
                            <a :href="`mailto:${site.email}`" class="ml-1 text-primary-dark">{{ site.email }}</a>
                        </p>

                        <p class="text-small text-muted">
                            The button opens your email application. No message is sent or stored by this website.
                        </p>
                    </div>
                </BaseCard>

                <BaseCard as="aside" class="lg:col-span-5" aria-labelledby="contact-notes-title">
                    <h2 id="contact-notes-title" class="text-h4">Good to know</h2>

                    <ul class="mt-4 flex flex-col gap-3 text-small text-body">
                        <li class="flex gap-2">
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>{{ site.availability }}</span>
                        </li>
                        <li class="flex gap-2">
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>Include a short description of your project or question so I can respond clearly.</span>
                        </li>
                        <li class="flex gap-2">
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>No phone number or social profile is listed here because none has been verified for this site.</span>
                        </li>
                        <li class="flex gap-2">
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>There is no on-site contact form or automated message delivery in this version of the site.</span>
                        </li>
                    </ul>
                </BaseCard>
            </BaseContainer>
        </section>
    </div>
</template>
