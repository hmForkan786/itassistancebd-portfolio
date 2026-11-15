<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (SiteSetting::count() > 0) {
            $this->command?->info('Site settings already seeded; skipping.');
            return;
        }

        $settings = [
            ['key' => 'site.name', 'value' => 'IT Assistance BD', 'type' => 'string', 'is_public' => true],
            ['key' => 'site.role', 'value' => 'Digital Solutions Developer & Creative Problem Solver', 'type' => 'string', 'is_public' => true],
            ['key' => 'site.intro', 'value' => 'I build web applications with Laravel and Vue, connect them to the services they depend on, and support the surrounding brand work: digital marketing and graphic design.', 'type' => 'text', 'is_public' => true],
            ['key' => 'site.availability', 'value' => 'Open to remote collaboration and client projects.', 'type' => 'string', 'is_public' => true],
            ['key' => 'site.email', 'value' => 'hmforkan99@gmail.com', 'type' => 'string', 'is_public' => true],
            ['key' => 'site.capabilities', 'value' => json_encode(['Laravel & Vue development', 'Digital marketing', 'Graphic design', 'Problem solving & management']), 'type' => 'json', 'is_public' => true],
            ['key' => 'site.footer_text', 'value' => 'Portfolio of IT Assistance BD.', 'type' => 'string', 'is_public' => true],
        ];

        foreach ($settings as $s) {
            SiteSetting::create($s);
        }

        $this->command?->info('Seeded ' . count($settings) . ' site settings.');
    }
}