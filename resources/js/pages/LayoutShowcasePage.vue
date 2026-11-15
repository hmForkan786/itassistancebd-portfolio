<script setup lang="ts">
/**
 * Layout showcase — internal development verification page.
 *
 * Rendered inside the real `PortfolioLayout`, so the header, main region and
 * footer on this page are the production shell. Content is long enough to test
 * scrolling and footer positioning on short and tall pages. It is not the
 * portfolio homepage and never ships in a production bundle.
 */
import { BaseBadge, BaseCard, BaseContainer, SectionHeading } from '@/components/ui';
import { mainNavigation } from '@/components/layout/navigation';

interface ShowcaseBlock {
    title: string;
    body: string;
}

const blocks: readonly ShowcaseBlock[] = [
    {
        title: 'Header behaviour',
        body: 'The header is sticky, keeps a 64px height on mobile and 80px from the desktop breakpoint, and stays visually separated with the line token. The mobile toggle exposes aria-expanded and aria-controls, and Escape returns focus to it.',
    },
    {
        title: 'Main region',
        body: 'The main element carries id="main-content" and tabindex="-1", so the skip link can move focus straight to the page content. It grows with flex-1, which keeps short pages from pulling the footer upward.',
    },
    {
        title: 'Footer behaviour',
        body: 'The footer uses the footer tokens, repeats the primary navigation and keeps the copyright row on a subtle divider. Social links are intentionally absent until verified profile URLs exist.',
    },
    {
        title: 'Active navigation',
        body: 'Section links resolve to /#about, /#services and so on. Active state compares the current hash, and aria-current mirrors it for assistive technology. Home is active when no hash is present.',
    },
];

const checks: readonly string[] = [
    '1440px and 1024px: desktop navigation visible, hamburger hidden',
    '768px, 390px and 360px: hamburger visible, panel opens below the header',
    'Escape closes the panel and restores focus to the toggle',
    'Selecting a destination closes the panel',
    'No horizontal overflow at any target width',
    'Footer sits at the viewport bottom on short pages',
];
</script>

<template>
    <div class="section bg-surface">
        <BaseContainer class="stack-lg">
            <SectionHeading
                as="h1"
                eyebrow="Internal verification"
                title="Portfolio layout foundation"
                description="This page runs inside the real portfolio shell. The header and footer you see are the components every public page will use."
            >
                <template #actions>
                    <BaseBadge variant="primary">Module 06</BaseBadge>
                    <BaseBadge variant="neutral">Dev only</BaseBadge>
                </template>
            </SectionHeading>

            <div class="grid gap-grid md:grid-cols-2">
                <BaseCard as="section" aria-labelledby="layout-checks-heading">
                    <SectionHeading
                        id="layout-checks-heading"
                        as="h2"
                        title="Verification checklist"
                        description="Manual checks performed at each target viewport."
                    />

                    <ul class="mt-5 flex flex-col gap-2">
                        <li
                            v-for="check in checks"
                            :key="check"
                            class="flex gap-2 text-small text-body"
                        >
                            <span aria-hidden="true" class="text-primary-dark">•</span>
                            <span>{{ check }}</span>
                        </li>
                    </ul>
                </BaseCard>

                <BaseCard as="section" aria-labelledby="layout-nav-heading">
                    <SectionHeading
                        id="layout-nav-heading"
                        as="h2"
                        title="Navigation destinations"
                        description="The same list drives the header and the footer."
                    />

                    <ul class="mt-5 flex flex-col gap-2">
                        <li
                            v-for="item in mainNavigation"
                            :key="item.label"
                            class="flex flex-wrap items-baseline justify-between gap-2 border-b border-line pb-2 text-small last:border-b-0 last:pb-0"
                        >
                            <span class="font-medium text-heading">{{ item.label }}</span>
                            <code class="font-mono text-tiny text-muted">{{ item.to }}</code>
                        </li>
                    </ul>
                </BaseCard>
            </div>

            <!-- Long-form content: forces scrolling so the sticky header and the footer can be observed. -->
            <div class="grid gap-grid md:grid-cols-2">
                <BaseCard
                    v-for="block in blocks"
                    :key="block.title"
                    as="section"
                    hoverable
                >
                    <h2 class="text-h4">{{ block.title }}</h2>
                    <p class="mt-2 text-small text-body">{{ block.body }}</p>
                </BaseCard>
            </div>

            <BaseCard as="section" aria-labelledby="layout-spacing-heading">
                <SectionHeading
                    id="layout-spacing-heading"
                    as="h2"
                    title="Spacing and rhythm"
                    description="Sections use the fluid section token; content stays inside the 1280px container."
                />

                <div class="mt-5 flex flex-col gap-3 text-body">
                    <p>
                        The shell adds no horizontal padding of its own: the header, main content and footer each use the
                        shared container utility, so every edge aligns on the same grid.
                    </p>
                    <p>
                        Long pages keep the footer after the content, while short pages pin it to the bottom of the
                        viewport through the full-height flex column. Both cases are visible by resizing this page or by
                        comparing it with a shorter route.
                    </p>
                    <p>
                        Vertical rhythm comes from the design system — the section utility here, card padding inside
                        each panel, and the grid gap between blocks. No arbitrary spacing values are used.
                    </p>
                </div>
            </BaseCard>

            <div>
                <a href="#main-content" class="text-small font-semibold text-primary-dark">Back to top</a>
            </div>
        </BaseContainer>
    </div>
</template>
