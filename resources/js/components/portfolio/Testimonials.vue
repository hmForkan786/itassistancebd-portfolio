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
                <BaseCard v-for="item in visible" :key="item.id" as="article" class="flex h-full flex-col">
                    <div class="flex items-center gap-1" aria-label="Rating">
                        <span
                            v-for="star in 5"
                            :key="star"
                            aria-hidden="true"
                            :class="star <= item.rating ? 'text-primary-dark' : 'text-line-strong'"
                        >★</span>
                    </div>
                    <p class="mt-4 grow text-small text-body">"{{ item.review_text }}"</p>
                    <div class="mt-4 border-t border-line pt-3">
                        <p class="text-small font-semibold text-heading">{{ item.client_name }}</p>
                        <p v-if="item.client_role || item.company_name" class="text-tiny text-muted">
                            {{ [item.client_role, item.company_name].filter(Boolean).join(' · ') }}
                        </p>
                        <p v-if="item.review_date" class="text-tiny text-muted">{{ item.review_date }}</p>
                    </div>
                </BaseCard>
            </div>
        </BaseContainer>
    </section>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import http from '@/services/http';

interface ApiTestimonial {
    id: number;
    client_name: string;
    client_role: string | null;
    company_name: string | null;
    review_text: string;
    rating: number;
    review_date: string | null;
}

const testimonials = ref<ApiTestimonial[]>([]);

onMounted(async () => {
    try {
        const res = await http.get('/public/testimonials');
        testimonials.value = res.data.testimonials ?? [];
    } catch {
        testimonials.value = [];
    }
});

const visible = computed(() => testimonials.value);
const showSection = computed<boolean>(() => visible.value.length > 0);
</script>