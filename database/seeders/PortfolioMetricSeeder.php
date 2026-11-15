<?php

namespace Database\Seeders;

use App\Models\PortfolioMetric;
use Illuminate\Database\Seeder;

class PortfolioMetricSeeder extends Seeder
{
    public function run(): void
    {
        if (PortfolioMetric::count() > 0) {
            $this->command?->info('Portfolio metrics already seeded; skipping.');
            return;
        }

        $metrics = [
            [
                'metric_key' => 'technologies_used',
                'metric_label' => 'Technologies used',
                'metric_value' => 9,
                'metric_unit' => null,
                'source_type' => 'derived',
                'source_reference' => 'resources/js/data/skills.ts (9 verified tools)',
                'verified' => true,
                'enabled' => true,
                'sort_order' => 0,
            ],
            // No fabricated metrics: completed_projects, happy_clients, client_satisfaction,
            // success_rate, years_experience are NOT seeded because no verified data exists.
            // They can be added by the admin only with verified values.
        ];

        foreach ($metrics as $m) {
            PortfolioMetric::create($m);
        }

        $this->command?->info('Seeded ' . count($metrics) . ' verified metric(s).');
    }
}