<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        if (Service::count() > 0) {
            $this->command?->info('Services already seeded; skipping.');
            return;
        }

        $services = [
            ['title' => 'Web Application Development', 'description' => 'Custom web applications built around a defined workflow, from database design through to the interface.'],
            ['title' => 'Laravel Development', 'description' => 'Laravel backends covering routing, authentication, database migrations, validation and background jobs.'],
            ['title' => 'Vue.js Frontend Development', 'description' => 'Vue 3 and TypeScript interfaces with reusable components, accessible markup and predictable state.'],
            ['title' => 'API Development & Integration', 'description' => 'REST APIs and integrations that move data between applications, including authentication and data mapping.'],
            ['title' => 'WordPress Development', 'description' => 'WordPress sites and theme-level customisation for content-driven pages that non-technical editors can manage.'],
            ['title' => 'Digital Marketing', 'description' => 'Search and social support: content planning, on-page fundamentals and campaign coordination.'],
            ['title' => 'Graphic Design', 'description' => 'Brand-consistent visuals for web, social media and print, prepared for the platform they will be used on.'],
        ];

        foreach ($services as $i => $s) {
            Service::create([
                'title' => $s['title'],
                'slug' => Str::slug($s['title']),
                'description' => $s['description'],
                'enabled' => true,
                'sort_order' => $i,
            ]);
        }

        $this->command?->info('Seeded ' . count($services) . ' services.');
    }
}