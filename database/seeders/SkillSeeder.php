<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        if (Skill::count() > 0) {
            $this->command?->info('Skills already seeded; skipping.');
            return;
        }

        $groups = [
            'Languages & frameworks' => ['Laravel', 'PHP', 'Vue.js', 'TypeScript', 'JavaScript'],
            'Data & APIs' => ['MySQL', 'REST API'],
            'Web & content' => ['WordPress', 'HTML/CSS'],
        ];

        $order = 0;
        foreach ($groups as $category => $items) {
            foreach ($items as $name) {
                Skill::create([
                    'name' => $name,
                    'category' => $category,
                    'enabled' => true,
                    'sort_order' => $order++,
                ]);
            }
        }

        $this->command?->info('Seeded ' . $order . ' skills.');
    }
}