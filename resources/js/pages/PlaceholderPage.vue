<script setup lang="ts">
/**
 * Temporary verification page.
 *
 * Confirms that Vue 3, TypeScript, the Vite build pipeline and the design
 * tokens work inside Laravel. It is a status screen, not a portfolio page:
 * real sections are built in a later module.
 */
const appName: string = 'IT Assistance BD Portfolio';

const stack: readonly string[] = [
    'Laravel 12',
    'Vue 3',
    'TypeScript',
    'Vite',
    'Vue Router 4',
    'Pinia',
    'Axios',
    'Tailwind CSS 4',
];
</script>

<template>
    <!-- The layout already provides <main>, so this page renders a section. -->
    <section class="section bg-surface" aria-labelledby="placeholder-title">
        <div class="container-page stack-lg">
            <p class="text-small font-semibold tracking-widest uppercase text-primary-dark">Design system check</p>

            <h1 id="placeholder-title" class="text-h1">{{ appName }}</h1>

            <p class="text-lead max-w-2xl">
                Frontend foundation installed. Portfolio pages are added in a later module.
            </p>

            <ul class="grid-auto text-small text-body">
                <li
                    v-for="item in stack"
                    :key="item"
                    class="rounded-field border border-line bg-white px-4 py-3 font-medium shadow-card"
                >
                    {{ item }}
                </li>
            </ul>

            <p lang="bn" class="text-bn text-muted">
                বাংলা টাইপোগ্রাফি পরীক্ষা — আইটি অ্যাসিস্ট্যান্স বিডি
            </p>
        </div>
    </section>
</template>
