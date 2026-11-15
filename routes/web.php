<?php

use Illuminate\Support\Facades\Route;

/*
 * SPA entry points.
 *
 * Vue Router runs in history mode, so every public page path must return the
 * mount view. Specific routes come first; the catch-all below serves the
 * homepage and secondary pages (/, /about, /services, /projects, /contact).
 *
 * Development-only routes are registered before the catch-all so /dev/ui and
 * /dev/layout remain reachable in local builds only. Framework routes such as
 * /up are registered separately and are not handled here.
 *
 * SEO: /sitemap.xml is served dynamically from the verified public route list
 * (using config('app.url') so no unconfirmed domain is hard-coded).
 */
if (app()->environment('local')) {
    Route::get('/dev/{path?}', function () {
        return view('app');
    })->where('path', '.*');
}

Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim((string) config('app.url'), '/');

    $staticPaths = ['/', '/about', '/services', '/projects', '/contact'];

    $projectSlugs = [
        'ai-kids-video-factory',
        'scholarship-tracker',
        'iiuc-tower-erp',
        'applymate',
        'it-assistance-bd-portfolio',
    ];

    $urls = array_merge($staticPaths, array_map(
        static fn (string $slug): string => '/projects/' . $slug,
        $projectSlugs
    ));

    $lines = [];
    $lines[] = '<?xml version="1.0" encoding="UTF-8"?>';
    $lines[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($urls as $path) {
        $loc = $baseUrl . ($path === '/' ? '/' : $path);
        $lines[] = '  <url>';
        $lines[] = '    <loc>' . htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';
        $lines[] = '    <changefreq>weekly</changefreq>';
        $lines[] = '    <priority>' . ($path === '/' ? '1.0' : '0.8') . '</priority>';
        $lines[] = '  </url>';
    }

    $lines[] = '</urlset>';

    return response(implode("\n", $lines) . "\n", 200, [
        'Content-Type' => 'application/xml; charset=UTF-8',
    ]);
});

Route::get('/{any?}', function () {
    return view('app');
})->where('any', '^(?!dev(?:/|$)).*');