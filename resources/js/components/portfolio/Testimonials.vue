<script setup lang="ts">
/**
 * Testimonials — approved client feedback only.
 *
 * Renders nothing when there are no approved testimonials, so no client
 * identity, rating, or review is fabricated. Admin management (create/edit/
 * approve/publish/feature) requires a backend/admin module not yet implemented.
 */
import { computed } from 'vue';
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import { testimonials } from '@/data/testimonials';

const visible = computed(() => testimonials.filter((t) => t.text.trim().length > 0));
const showSection = computed<boolean>(() => visible.value.length > 0);
</script>

<template>
    <section v-if="showSection" id="testimonials" class="section" aria-labelledby="testimonials-title">
        <BaseContainer class="stack-lg">
            <SectionHeading
                id="testimonials-title"
                as="h2"
                eyebrow="Client feedback"
                title="What clients say"
                description="Approved client feedback. Only verified reviews are published."
                align="center"
            />

            <div class="grid gap-grid sm:grid-cols-2 lg:grid-cols-3">
                <BaseCard v-for="(item, index) in visible" :key="index" as="article" class="flex h-full flex-col">
                    <div class="flex items-center gap-1" aria-label="Rating">
                        <span
                            v-for="star in 5"
                            :key="star"
                            aria-hidden="true"
                            :class="star <= item.rating ? 'text-primary-dark' : 'text-line-strong'"
                        >★</span>
                    </div>
                    <p class="mt-4 grow text-small text-body">"{{ item.text }}"</p>
                    <div class="mt-4 border-t border-line pt-3">
                        <p class="text-small font-semibold text-heading">{{ item.name }}</p>
                        <p v-if="item.role" class="text-tiny text-muted">{{ item.role }}</p>
                        <p class="text-tiny text-muted">{{ item.date }}</p>
                    </div>
                </BaseCard>
            </div>
        </BaseContainer>
    </section>
</template>