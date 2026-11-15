<script setup lang="ts">
/**
 * ServicesPage — service categories offered by IT Assistance BD.
 *
 * Reuses `ServiceCard` and the canonical `services` data. Descriptions state
 * what each service covers; there are no prices, timelines, guarantees or
 * invented service packages.
 */
import { BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import ServiceCard from '@/components/portfolio/ServiceCard.vue';
import { services } from '@/data/services';
</script>

<template>
    <div>
        <!-- Page intro -->
        <section class="section bg-surface border-b border-line" aria-labelledby="services-page-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="services-page-title"
                    as="h1"
                    eyebrow="Services"
                    title="What I work on"
                    description="Development, content platforms and supporting design or marketing work. Each area below describes what the service covers — scope and timing are discussed per project."
                    class="max-w-3xl"
                />

                <div class="flex flex-wrap gap-3">
                    <CtaLink to="/contact" variant="primary">Discuss a project</CtaLink>
                </div>
            </BaseContainer>
        </section>

        <!-- Service categories -->
        <section class="section" aria-labelledby="service-categories-title">
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="service-categories-title"
                    as="h2"
                    title="Service categories"
                    description="Seven areas of work, from Laravel and Vue application development to WordPress, digital marketing and graphic design."
                />

                <ul class="grid gap-grid sm:grid-cols-2 lg:grid-cols-3" aria-label="Service categories">
                    <ServiceCard
                        v-for="(service, index) in services"
                        :key="service.title"
                        :service="service"
                        :index="index"
                        as="li"
                    />
                </ul>

                <p class="text-small text-muted max-w-2xl">
                    Need something related? If your project involves any of the areas above, the contact page is the
                    best place to start a conversation.
                </p>

                <div>
                    <CtaLink to="/contact" variant="secondary">Contact</CtaLink>
                </div>
            </BaseContainer>
        </section>
    </div>
</template>
