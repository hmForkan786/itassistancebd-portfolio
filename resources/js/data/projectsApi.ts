import http from '@/services/http';
import type { PortfolioProject, ProjectStatus } from '@/data/projects';

interface DbTechnology { id: number; name: string; sort_order: number; }
interface DbMetric { id: number; metric_key: string; metric_label: string; metric_value: number | null; metric_unit: string | null; verified: boolean; sort_order: number; }
interface DbProject {
    id: number;
    title: string;
    slug: string;
    category: string | null;
    short_description: string | null;
    description: string | null;
    purpose: string | null;
    status: string;
    featured: boolean;
    techStack?: string[];
    technologies?: DbTechnology[];
    metrics?: DbMetric[];
    limitations?: string | null;
    published_at: string | null;
}

function mapProject(p: DbProject): PortfolioProject {
    const techs = p.technologies ? p.technologies.map((t) => t.name) : (p.techStack ?? []);
    const implemented = (p.metrics ?? [])
        .filter((m) => m.metric_key === 'implemented')
        .sort((a, b) => a.sort_order - b.sort_order)
        .map((m) => ({ title: m.metric_label, detail: '' }));
    const planned = (p.metrics ?? [])
        .filter((m) => m.metric_key === 'planned')
        .sort((a, b) => a.sort_order - b.sort_order)
        .map((m) => ({ title: m.metric_label, detail: '' }));
    const limitations = p.limitations ? p.limitations.split('\n').map((s) => s.trim()).filter(Boolean) : [];

    return {
        slug: p.slug,
        name: p.title,
        summary: p.short_description ?? '',
        overview: p.description ?? '',
        purpose: p.purpose ?? '',
        status: (p.status as ProjectStatus) ?? 'planned',
        focus: p.category ?? '',
        techStack: techs,
        implemented,
        plannedScope: planned,
        limitations,
    };
}

export async function fetchProjects(): Promise<PortfolioProject[]> {
    const res = await http.get('/public/projects', { params: { per_page: 50 } });
    const data = res.data?.data ?? res.data ?? [];
    return (Array.isArray(data) ? data : []).map(mapProject);
}

export async function fetchProjectBySlug(slug: string): Promise<PortfolioProject | null> {
    try {
        const res = await http.get(`/public/projects/${slug}`);
        const p = res.data?.project ?? res.data;
        if (!p) return null;
        return mapProject(p);
    } catch {
        return null;
    }
}