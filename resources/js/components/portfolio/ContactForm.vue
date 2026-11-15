<template>
    <section id="contact-form" class="section bg-surface" aria-labelledby="contact-form-title">
        <BaseContainer class="stack-lg max-w-2xl">
            <SectionHeading
                id="contact-form-title"
                as="h2"
                eyebrow="Contact"
                title="Send a message"
                description="Messages are delivered to IT Assistance BD and stored securely. No fabricated confirmations."
                align="center"
            />

            <form class="stack" @submit.prevent="handleSubmit">
                <BaseInput v-model="name" label="Your name" name="name" autocomplete="name" required />
                <BaseInput v-model="email" label="Email" name="email" type="email" autocomplete="email" required />
                <BaseInput v-model="phone" label="Phone (optional)" name="phone" />
                <BaseInput v-model="subject" label="Subject (optional)" name="subject" />
                <BaseTextarea v-model="message" label="Message" name="message" :rows="5" required />
                <!-- honeypot -->
                <input v-model="website" type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" />

                <p v-if="error" class="text-small text-danger" role="alert">{{ error }}</p>
                <p v-if="success" class="text-small text-success">{{ success }}</p>

                <div class="flex flex-wrap gap-3">
                    <BaseButton type="submit" variant="primary" size="lg" :disabled="submitting">
                        {{ submitting ? 'Sending...' : 'Send message' }}
                    </BaseButton>
                    <BaseButton type="button" variant="ghost" size="lg" @click="reset">Reset</BaseButton>
                </div>
            </form>
        </BaseContainer>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { BaseButton, BaseContainer, BaseInput, BaseTextarea, SectionHeading } from '@/components/ui';
import http from '@/services/http';

const name = ref('');
const email = ref('');
const phone = ref('');
const subject = ref('');
const message = ref('');
const website = ref(''); // honeypot
const submitting = ref(false);
const error = ref('');
const success = ref('');

async function handleSubmit(): Promise<void> {
    error.value = '';
    success.value = '';
    if (!name.value.trim() || !message.value.trim() || !email.value.trim()) {
        error.value = 'Please enter your name, email and a short message.';
        return;
    }
    submitting.value = true;
    try {
        await http.post('/public/contact', {
            name: name.value,
            email: email.value,
            phone: phone.value || undefined,
            subject: subject.value || undefined,
            message: message.value,
            source_page: window.location.pathname,
        });
        success.value = 'Message received. Thank you.';
        name.value = '';
        email.value = '';
        phone.value = '';
        subject.value = '';
        message.value = '';
    } catch (e: any) {
        error.value = e?.response?.data?.message ?? 'Failed to send message. Please try again or email directly.';
    } finally {
        submitting.value = false;
    }
}

function reset(): void {
    name.value = '';
    email.value = '';
    phone.value = '';
    subject.value = '';
    message.value = '';
    error.value = '';
    success.value = '';
}
</script>