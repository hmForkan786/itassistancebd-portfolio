<script setup lang="ts">
/**
 * ContactForm — client-side form that opens the visitor's email client.
 *
 * There is no backend contact endpoint, so submission builds a mailto: link
 * with the entered subject and message. Validation is client-side only; no
 * message is sent or stored by this website. This keeps the form honest.
 */
import { computed, ref } from 'vue';
import { BaseButton, BaseContainer, BaseInput, BaseTextarea, SectionHeading } from '@/components/ui';
import { site } from '@/data/site';

const name = ref('');
const email = ref('');
const message = ref('');
const submitted = ref(false);
const error = ref('');

const isValid = computed<boolean>(() => name.value.trim().length > 0 && message.value.trim().length > 0);

const mailtoHref = computed<string>(() => {
    const subject = encodeURIComponent(`Portfolio enquiry — ${site.name}`);
    const body = encodeURIComponent(`Name: ${name.value}\nEmail: ${email.value}\n\n${message.value}`);
    return `mailto:${site.email}?subject=${subject}&body=${body}`;
});

const handleSubmit = (): void => {
    error.value = '';
    if (!isValid.value) {
        error.value = 'Please enter your name and a short message.';
        return;
    }
    submitted.value = true;
    window.location.href = mailtoHref.value;
};

const reset = (): void => {
    name.value = '';
    email.value = '';
    message.value = '';
    submitted.value = false;
    error.value = '';
};
</script>

<template>
    <section id="contact-form" class="section bg-surface" aria-labelledby="contact-form-title">
        <BaseContainer class="stack-lg max-w-2xl">
            <SectionHeading
                id="contact-form-title"
                as="h2"
                eyebrow="Contact"
                title="Send a message"
                description="Fill in the form and your email application will open with the message pre-filled. No message is sent or stored by this website."
                align="center"
            />

            <form class="stack" @submit.prevent="handleSubmit">
                <BaseInput v-model="name" label="Your name" name="name" autocomplete="name" required />
                <BaseInput v-model="email" label="Email (optional)" name="email" type="email" autocomplete="email" />
                <BaseTextarea v-model="message" label="Message" name="message" :rows="5" required />

                <p v-if="error" class="text-small text-danger" role="alert">{{ error }}</p>
                <p v-if="submitted" class="text-small text-success">
                    Your email application should have opened. If not, email
                    <a :href="`mailto:${site.email}`" class="font-medium">{{ site.email }}</a> directly.
                </p>

                <div class="flex flex-wrap gap-3">
                    <BaseButton type="submit" variant="primary" size="lg">Open email</BaseButton>
                    <BaseButton type="button" variant="ghost" size="lg" @click="reset">Reset</BaseButton>
                </div>
            </form>
        </BaseContainer>
    </section>
</template>