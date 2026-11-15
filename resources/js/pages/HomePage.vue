<script setup lang="ts">
/**
 * HomePage — the public portfolio landing page.
 *
 * All sections render inside `PortfolioLayout` (which supplies the site header,
 * footer and the single `<main>` landmark). Section ids match the shared
 * navigation hashes so the existing router scroll behaviour and active states
 * work without extra wiring.
 *
 * Content is imported from `resources/js/data/`; this component owns layout and
 * presentation only. It deliberately contains no fake metrics, testimonials,
 * client counts, ratings, employment statistics, demo links or delivery claims.
 */
import { BaseBadge, BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import CtaLink from '@/components/portfolio/CtaLink.vue';
import AchievementStats from '@/components/portfolio/AchievementStats.vue';
import ContactForm from '@/components/portfolio/ContactForm.vue';
import Faq from '@/components/portfolio/Faq.vue';
import ProjectCard from '@/components/portfolio/ProjectCard.vue';
import ServiceCard from '@/components/portfolio/ServiceCard.vue';
import SkillItem from '@/components/portfolio/SkillItem.vue';
import Testimonials from '@/components/portfolio/Testimonials.vue';
import WorkProcess from '@/components/portfolio/WorkProcess.vue';
import { useScrollReveal } from '@/composables/useScrollReveal';
import { aboutPoints, focusAreas, site } from '@/data/site';
import { projects } from '@/data/projects';
import { onMounted, ref } from 'vue';
import { services as staticServices } from '@/data/services';
import { skillGroups as staticSkillGroups } from '@/data/skills';
import http from '@/services/http';
import type { Service } from '@/data/services';
import type { SkillGroup } from '@/data/skills';

const services = ref<Service[]>([...staticServices]);
const skillGroups = ref<SkillGroup[]>([...staticSkillGroups]);

onMounted(async () => {
    try {
        const svcRes = await http.get('/public/services');
        const apiServices = svcRes.data ?? [];
        if (Array.isArray(apiServices) && apiServices.length > 0) {
            services.value = apiServices.map((s: any) => ({ title: s.title, description: s.description ?? '' }));
        }
    } catch {
        // keep static fallback
    }
    try {
        const skillRes = await http.get('/public/skills');
        const grouped = skillRes.data ?? {};
        const apiGroups: SkillGroup[] = Object.keys(grouped).map((cat) => ({
            title: cat,
            description: '',
            items: (grouped[cat] as any[]).map((s) => s.name),
        }));
        if (apiGroups.length > 0) {
            skillGroups.value = apiGroups;
        }
    } catch {
        // keep static fallback
    }
});
import { technologiesUsedCount } from '@/data/stats';

useScrollReveal();

/** Pre-encoded mailto target for the contact call to action. */
const mailtoHref: string = `mailto:${site.email}?subject=${encodeURIComponent('Portfolio enquiry — IT Assistance BD')}`;

/** Status labels shown in the projects legend — always text, never colour alone. */
const projectStatuses: readonly string[] = ['Completed', 'In Progress', 'Prototype', 'Planned'];
</script>

<template>
    <div>
        <!-- Hero: the page's single h1. A subtle surface keeps it distinct without an image. -->
        <section id="home" class="border-b border-line bg-surface" aria-labelledby="hero-title" data-reveal>
            <BaseContainer class="grid gap-grid py-section lg:grid-cols-12 lg:items-center">
                <div class="stack-lg lg:col-span-7">
                    <p class="text-small font-semibold tracking-widest uppercase text-primary-dark">
                        {{ site.name }}
                    </p>

                    <h1 id="hero-title" class="text-display">{{ site.role }}</h1>

                    <p class="text-lead max-w-2xl text-body">{{ site.intro }}</p>

                    <ul class="flex flex-wrap gap-2" aria-label="Core capabilities">
                        <li v-for="capability in site.capabilities" :key="capability">
                            <BaseBadge variant="neutral">{{ capability }}</BaseBadge>
                        </li>
                    </ul>

                    <div class="flex flex-wrap gap-3">
                        <CtaLink to="/#projects" variant="primary" size="lg">View projects</CtaLink>
                        <CtaLink to="/#contact" variant="secondary" size="lg">Start a project</CtaLink>
                        <CtaLink :href="`mailto:${site.email}`" variant="secondary" size="lg">Email me</CtaLink>
                    </div>

                    <p class="text-small text-muted">{{ site.availability }}</p>

                    <ul class="mt-2 flex flex-wrap gap-x-6 gap-y-2 text-tiny text-muted" aria-label="Trust indicators">
                        <li class="flex items-center gap-1.5">
                            <span class="text-primary-dark" aria-hidden="true">✓</span>
                            <span>Remote collaboration</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <span class="text-primary-dark" aria-hidden="true">✓</span>
                            <span>Factual, no invented claims</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <span class="text-primary-dark" aria-hidden="true">✓</span>
                            <span>{{ technologiesUsedCount }} verified tools</span>
                        </li>
                    </ul>
                </div>

                <BaseCard as="aside" class="lg:col-span-5" aria-labelledby="focus-heading">
                    <p
                        id="focus-heading"
                        class="text-tiny font-semibold tracking-widest uppercase text-muted"
                    >
                        Where I can help
                    </p>

                    <ul class="mt-4 flex flex-col gap-4">
                        <li v-for="area in focusAreas" :key="area.title" class="border-b border-line pb-4 last:border-b-0 last:pb-0">
                            <p class="text-small font-semibold text-heading">{{ area.title }}</p>
                            <p class="mt-1 text-small text-body">{{ area.detail }}</p>
                        </li>
                    </ul>
                </BaseCard>
            </BaseContainer>
        </section>

        <!-- About: concise professional introduction, no invented history. -->
        <section id="about" class="section" aria-labelledby="about-title" data-reveal>
            <BaseContainer class="grid gap-grid lg:grid-cols-12 lg:items-start">
                <div class="lg:col-span-5">
                    <SectionHeading
                        id="about-title"
                        as="h2"
                        eyebrow="About"
                        title="A practical approach to building for the web"
                        description="I work on web applications with an emphasis on clear requirements, maintainable code and honest communication — useful whether the work is a small site or a larger application."
                    />
                </div>

                <ul class="grid gap-grid sm:grid-cols-2 lg:col-span-7">
                    <BaseCard
                        v-for="point in aboutPoints"
                        :key="point.title"
                        as="li"
                        class="h-full"
                    >
                        <h3 class="text-h4">{{ point.title }}</h3>
                        <p class="mt-2 text-small text-body">{{ point.detail }}</p>
                    </BaseCard>
                </ul>
            </BaseContainer>
        </section>

        <!-- Services: categories and descriptions only — no prices or guarantees. -->
        <section id="services" class="section bg-surface" aria-labelledby="services-title" data-reveal>
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="services-title"
                    as="h2"
                    eyebrow="Services"
                    title="What I work on"
                    description="Development, content platforms and supporting design or marketing work. Scope and timing are discussed per project."
                    align="center"
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
            </BaseContainer>
        </section>

        <!-- Projects: initiatives with honest status labels (never assumed complete). -->
        <section id="projects" class="section" aria-labelledby="projects-title" data-reveal>
            <BaseContainer class="stack-lg">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <SectionHeading
                        id="projects-title"
                        as="h2"
                        eyebrow="Projects"
                        title="Initiatives in focus"
                        description="Selected initiatives. Each card states its current stage — these are not automatically completed commercial products and no public demo, repository or client information is claimed."
                        class="max-w-3xl"
                    />

                    <ul class="flex flex-wrap gap-2" aria-label="Project status legend">
                        <li v-for="label in projectStatuses" :key="label">
                            <BaseBadge variant="neutral" size="sm">{{ label }}</BaseBadge>
                        </li>
                    </ul>
                </div>

                <ul class="grid gap-grid sm:grid-cols-2 lg:grid-cols-3" aria-label="Project initiatives">
                    <ProjectCard
                        v-for="project in projects"
                        :key="project.name"
                        :project="project"
                        as="li"
                    />
                </ul>
            </BaseContainer>
        </section>

        <!-- Skills: verified tools grouped by area — no percentage or proficiency bars. -->
        <section id="skills" class="section bg-surface" aria-labelledby="skills-title" data-reveal>
            <BaseContainer class="stack-lg">
                <SectionHeading
                    id="skills-title"
                    as="h2"
                    eyebrow="Skills"
                    title="Tools I work with"
                    description="A straightforward list of the technologies and platforms used in my work, grouped by area."
                />

                <div class="grid gap-grid lg:grid-cols-3">
                    <BaseCard
                        v-for="group in skillGroups"
                        :key="group.title"
                        as="section"
                        :aria-labelledby="`skills-${group.title}`"
                    >
                        <h3 :id="`skills-${group.title}`" class="text-h4">{{ group.title }}</h3>
                        <p class="mt-2 text-small text-body">{{ group.description }}</p>

                        <ul class="mt-4 flex flex-wrap gap-2" :aria-label="group.title">
                            <SkillItem v-for="item in group.items" :key="item" :label="item" />
                        </ul>
                    </BaseCard>
                </div>
            </BaseContainer>
        </section>

        <!-- Contact: verified email only. No phone, no social links, no backend form. -->
        <section id="contact" class="section" aria-labelledby="contact-title" data-reveal>
            <BaseContainer>
                <BaseCard class="overflow-hidden bg-surface p-0">
                    <div class="grid gap-grid p-card lg:grid-cols-12 lg:items-center">
                        <div class="stack lg:col-span-7">
                            <SectionHeading
                                id="contact-title"
                                as="h2"
                                eyebrow="Contact"
                                title="Start a conversation"
                                description="If you have a project, a collaboration idea or a question about the work listed above, the simplest way to reach me is by email."
                            />
                        </div>

                        <div class="flex flex-col gap-3 lg:col-span-5 lg:items-start">
                            <CtaLink :href="mailtoHref" variant="primary" size="lg">
                                Email {{ site.name }}
                            </CtaLink>

                            <p class="text-small text-body">
                                <span class="font-medium text-heading">Email:</span>
                                <a :href="`mailto:${site.email}`" class="ml-1 text-primary-dark">{{ site.email }}</a>
                            </p>

                            <p class="text-tiny text-muted">
                                Opens your email application. No phone number or social profile is listed here
                                because none has been verified for this site.
                            </p>
                        </div>
                    </div>
                </BaseCard>
            </BaseContainer>
        </section>

        <!-- Premium additions: data-driven sections that stay hidden when unverified. -->
        <AchievementStats />
        <WorkProcess />
        <Testimonials />
        <Faq />
        <ContactForm />
    </div>
</template>
