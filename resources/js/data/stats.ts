/**
 * Achievement / statistics metrics for the portfolio.
 *
 * Metrics are shown only when they are verified and approved. Empty or
 * unverified metrics are never displayed and never fabricated. The
 * "technologies used" metric is derived from the verified skills data so it
 * stays honest and in sync with `skills.ts`.
 *
 * Admin management of these metrics requires a backend/admin module that is
 * not yet implemented; until then this file is the single source of truth.
 */
import { skillGroups } from './skills';

/** A single verified statistic. */
export interface StatMetric {
    /** Short label shown under the number. */
    label: string;
    /** Verified numeric value. */
    value: number;
    /** Optional suffix (e.g. "+", "%"). */
    suffix?: string;
    /** Optional note (e.g. "verified in this build"). */
    note?: string;
}

/**
 * Verified achievement metrics.
 *
 * Intentionally empty: no completed-project counts, client counts, satisfaction
 * scores, success rates, or years of experience have been supplied or verified.
 * Do not add unverified numbers. The homepage derives "technologies used" from
 * `skills.ts` instead.
 */
export const statMetrics: readonly StatMetric[] = [];

/** Derived, verified metric: number of distinct tools listed in skills data. */
export const technologiesUsedCount: number = new Set(
    skillGroups.flatMap((group) => group.items),
).size;