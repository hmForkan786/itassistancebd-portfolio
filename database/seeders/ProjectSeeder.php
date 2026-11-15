<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        if (Project::count() > 0) {
            $this->command?->info('Projects already seeded; skipping.');
            return;
        }

        $projects = [
            [
                'title' => 'AI Kids Video Factory',
                'slug' => 'ai-kids-video-factory',
                'category' => 'Content automation',
                'short_description' => 'An initiative exploring a repeatable, template-based workflow for producing children\'s video content.',
                'description' => 'AI Kids Video Factory is a planned initiative focused on organising a repeatable workflow for producing children\'s video content from templates and structured inputs.',
                'purpose' => 'To explore a more consistent, step-by-step process for preparing children\'s video content, reducing ad-hoc work where a template-driven flow may help.',
                'status' => 'planned',
                'featured' => false,
                'sort_order' => 0,
                'tech' => [],
                'implemented' => [],
                'planned' => [
                    ['title' => 'Template-based workflow', 'detail' => 'Define reusable templates and a repeatable sequence for assembling video content (planned).'],
                    ['title' => 'Content preparation steps', 'detail' => 'Organise inputs and generation steps in a clearer, trackable flow (planned).'],
                ],
                'limitations' => [
                    'Status is planned: no implementation, demo, repository or release has been verified for this site.',
                    'Technology stack and feature set are not yet confirmed.',
                ],
            ],
            [
                'title' => 'Scholarship Tracker',
                'slug' => 'scholarship-tracker',
                'category' => 'Education tools',
                'short_description' => 'An initiative for keeping scholarship applications, requirements and deadlines in one place.',
                'description' => 'Scholarship Tracker is a planned initiative aimed at bringing scholarship opportunities, application requirements and key dates into a single, easier-to-follow view.',
                'purpose' => 'To make it simpler to track which scholarships to consider, what each one requires and when actions or deadlines are due.',
                'status' => 'planned',
                'featured' => false,
                'sort_order' => 1,
                'tech' => [],
                'implemented' => [],
                'planned' => [
                    ['title' => 'Opportunity tracking', 'detail' => 'Record scholarships with their requirements and important dates in one place (planned).'],
                    ['title' => 'Deadline visibility', 'detail' => 'Surface upcoming deadlines and application steps so they are easier to follow (planned).'],
                ],
                'limitations' => [
                    'Status is planned: no implementation, demo, repository or release has been verified for this site.',
                    'Technology stack and feature set are not yet confirmed.',
                ],
            ],
            [
                'title' => 'IIUC Tower ERP',
                'slug' => 'iiuc-tower-erp',
                'category' => 'Enterprise systems',
                'short_description' => 'An enterprise resource planning initiative covering records and day-to-day operations for IIUC Tower.',
                'description' => 'IIUC Tower ERP is a planned initiative to organise operational records and routine processes for IIUC Tower in a single system.',
                'purpose' => 'To support day-to-day administration by keeping relevant records and operational information structured and easier to manage.',
                'status' => 'planned',
                'featured' => false,
                'sort_order' => 2,
                'tech' => [],
                'implemented' => [],
                'planned' => [
                    ['title' => 'Operational records', 'detail' => 'Centralise selected records related to day-to-day tower operations (planned).'],
                    ['title' => 'Process support', 'detail' => 'Provide structured workflows for routine administrative tasks (planned).'],
                ],
                'limitations' => [
                    'Status is planned: no implementation, demo, repository or release has been verified for this site.',
                    'Technology stack, modules and scope are not yet confirmed.',
                ],
            ],
            [
                'title' => 'ApplyMate',
                'slug' => 'applymate',
                'category' => 'Career tools',
                'short_description' => 'An initiative to make repetitive application and job-search workflows easier to manage.',
                'description' => 'ApplyMate is a planned initiative to help organise repetitive steps in application and job-search workflows so progress is easier to track.',
                'purpose' => 'To reduce manual repetition when managing applications by keeping tasks, statuses and follow-ups in a clearer structure.',
                'status' => 'planned',
                'featured' => false,
                'sort_order' => 3,
                'tech' => [],
                'implemented' => [],
                'planned' => [
                    ['title' => 'Application tracking', 'detail' => 'Keep applications, their states and related notes organised in one place (planned).'],
                    ['title' => 'Workflow support', 'detail' => 'Simplify recurring steps in a job-search or application process (planned).'],
                ],
                'limitations' => [
                    'Status is planned: no implementation, demo, repository or release has been verified for this site.',
                    'Technology stack and feature set are not yet confirmed.',
                ],
            ],
            [
                'title' => 'IT Assistance BD Portfolio',
                'slug' => 'it-assistance-bd-portfolio',
                'category' => 'Portfolio',
                'short_description' => 'This site: a Laravel and Vue portfolio presenting the services, skills and initiatives of IT Assistance BD.',
                'description' => 'This project is the public portfolio website for IT Assistance BD. It presents services, skills and project initiatives in a factual way and is being built incrementally through approved installation modules.',
                'purpose' => 'To provide a clear, professional web presence that describes the work, capabilities and initiatives of IT Assistance BD without invented claims or metrics.',
                'status' => 'in-progress',
                'featured' => true,
                'sort_order' => 4,
                'tech' => ['Laravel 12', 'Vue 3', 'TypeScript', 'Vite', 'Tailwind CSS 4', 'Vue Router', 'Pinia'],
                'implemented' => [
                    ['title' => 'Application foundation', 'detail' => 'Laravel 12 project with a Vue 3 + TypeScript + Vite single-page frontend, routing and state setup.'],
                    ['title' => 'Design system & UI primitives', 'detail' => 'Tailwind CSS 4 token-based styling and a set of reusable, accessible UI components.'],
                    ['title' => 'Layout and public pages', 'detail' => 'Responsive header/footer shell, homepage sections, and secondary About, Services, Projects and Contact pages.'],
                    ['title' => 'Project detail pages', 'detail' => 'Individual project pages sourced from the shared project data (this module).'],
                ],
                'planned' => [
                    ['title' => 'Further approved modules', 'detail' => 'Additional features only as approved by the Project Owner in later modules (planned).'],
                ],
                'limitations' => [
                    'Content is static and file-based (no CMS or database-driven portfolio management).',
                    'No authentication, admin area, backend contact form or external API integrations.',
                    'No public demo links, repositories, screenshots, testimonials or client information are listed.',
                ],
            ],
        ];

        foreach ($projects as $p) {
            $project = Project::create([
                'title' => $p['title'],
                'slug' => $p['slug'],
                'category' => $p['category'],
                'short_description' => $p['short_description'],
                'description' => $p['description'],
                'purpose' => $p['purpose'],
                'status' => $p['status'],
                'featured' => $p['featured'],
                'sort_order' => $p['sort_order'],
                'limitations' => implode("\n", $p['limitations']),
                'published_at' => now(),
            ]);

            foreach ($p['tech'] as $i => $tech) {
                $project->technologies()->create(['name' => $tech, 'sort_order' => $i]);
            }

            foreach ($p['implemented'] as $i => $item) {
                $project->metrics()->create([
                    'metric_key' => 'implemented',
                    'metric_label' => $item['title'],
                    'metric_value' => null,
                    'metric_unit' => null,
                    'verified' => true,
                    'sort_order' => $i,
                ]);
            }
        }

        $this->command?->info('Seeded ' . count($projects) . ' projects.');
    }
}