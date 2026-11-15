import { onBeforeUnmount, onMounted } from 'vue';

/**
 * useScrollReveal — adds a "is-visible" class to elements with [data-reveal]
 * when they enter the viewport. Respects prefers-reduced-motion (no animation).
 *
 * Lightweight: uses a single IntersectionObserver. No dependencies.
 */
export function useScrollReveal(): void {
    let observer: IntersectionObserver | null = null;

    onMounted(() => {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
            return;
        }

        observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer?.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
        );

        document.querySelectorAll('[data-reveal]').forEach((el) => observer?.observe(el));
    });

    onBeforeUnmount(() => {
        observer?.disconnect();
        observer = null;
    });
}