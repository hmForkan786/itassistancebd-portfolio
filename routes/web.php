<?php

use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioMetricController as AdminPortfolioMetricController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Public\AnalyticsController as PublicAnalyticsController;
use App\Http\Controllers\Public\ContactController as PublicContactController;
use App\Http\Controllers\Public\PortfolioMetricController as PublicPortfolioMetricController;
use App\Http\Controllers\Public\ProjectController as PublicProjectController;
use App\Http\Controllers\Public\ServiceController as PublicServiceController;
use App\Http\Controllers\Public\SiteSettingController as PublicSiteSettingController;
use App\Http\Controllers\Public\SkillController as PublicSkillController;
use App\Http\Controllers\Public\TestimonialController as PublicTestimonialController;
use Illuminate\Support\Facades\Route;

/*
 * SPA entry points.
 *
 * Vue Router runs in history mode, so every public page path must return the
 * mount view. Specific routes come first; the catch-all below serves the
 * homepage and secondary pages.
 *
 * Development-only routes are registered before the catch-all so /dev/ui and
 * /dev/layout remain reachable in local builds only. Framework routes such as
 * /up are registered separately and are not handled here.
 *
 * SEO: /sitemap.xml is served dynamically from the verified public route list.
 */

// Development-only shell routes (local only).
if (app()->environment('local')) {
    Route::get('/dev/{path?}', function () {
        return view('app');
    })->where('path', '.*');
}

// SEO: dynamic sitemap.
Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim((string) config('app.url'), '/');

    $staticPaths = ['/', '/about', '/services', '/projects', '/contact'];

    $projectSlugs = \App\Models\Project::published()->pluck('slug')->toArray();
    if (empty($projectSlugs)) {
        $projectSlugs = [
            'ai-kids-video-factory',
            'scholarship-tracker',
            'iiuc-tower-erp',
            'applymate',
            'it-assistance-bd-portfolio',
        ];
    }

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

// Public API (no auth required; web middleware for CSRF on POSTs).
Route::prefix('api/public')->group(function () {
    Route::get('projects', [PublicProjectController::class, 'index']);
    Route::get('projects/{slug}', [PublicProjectController::class, 'show']);
    Route::get('services', [PublicServiceController::class, 'index']);
    Route::get('skills', [PublicSkillController::class, 'index']);
    Route::get('testimonials', [PublicTestimonialController::class, 'index']);
    Route::get('metrics', [PublicPortfolioMetricController::class, 'index']);
    Route::get('settings', [PublicSiteSettingController::class, 'index']);
    Route::post('contact', [PublicContactController::class, 'store']);
    Route::post('analytics/event', [PublicAnalyticsController::class, 'store']);
});

// Admin auth (no auth required for login).
Route::prefix('api/admin')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

// Admin API (auth required).
Route::prefix('api/admin')->middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::apiResource('projects', AdminProjectController::class);
    Route::post('projects/{project}/publish', [AdminProjectController::class, 'publish']);
    Route::post('projects/{project}/unpublish', [AdminProjectController::class, 'unpublish']);
    Route::post('projects/{project}/feature', [AdminProjectController::class, 'feature']);

    Route::apiResource('testimonials', AdminTestimonialController::class);
    Route::post('testimonials/{testimonial}/approve', [AdminTestimonialController::class, 'approve']);
    Route::post('testimonials/{testimonial}/reject', [AdminTestimonialController::class, 'reject']);
    Route::post('testimonials/{testimonial}/publish', [AdminTestimonialController::class, 'publish']);
    Route::post('testimonials/{testimonial}/unpublish', [AdminTestimonialController::class, 'unpublish']);
    Route::post('testimonials/{testimonial}/feature', [AdminTestimonialController::class, 'feature']);

    Route::apiResource('metrics', AdminPortfolioMetricController::class);
    Route::post('metrics/{metric}/toggle-enabled', [AdminPortfolioMetricController::class, 'toggleEnabled']);
    Route::post('metrics/{metric}/toggle-verified', [AdminPortfolioMetricController::class, 'toggleVerified']);

    Route::apiResource('services', AdminServiceController::class);
    Route::post('services/{service}/toggle-enabled', [AdminServiceController::class, 'toggleEnabled']);

    Route::apiResource('skills', AdminSkillController::class);
    Route::post('skills/{skill}/toggle-enabled', [AdminSkillController::class, 'toggleEnabled']);

    Route::get('messages', [ContactMessageController::class, 'index']);
    Route::get('messages/{message}', [ContactMessageController::class, 'show']);
    Route::post('messages/{message}/read', [ContactMessageController::class, 'markRead']);
    Route::post('messages/{message}/replied', [ContactMessageController::class, 'markReplied']);
    Route::post('messages/{message}/archive', [ContactMessageController::class, 'archive']);
    Route::patch('messages/{message}/notes', [ContactMessageController::class, 'updateNotes']);
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy']);

    Route::apiResource('settings', AdminSiteSettingController::class);

    Route::get('analytics', [AdminAnalyticsController::class, 'overview']);
});

// SPA catch-all (must be last).
Route::get('/{any?}', function () {
    return view('app');
})->where('any', '^(?!dev(?:/|$)|api(?:/|$)|sitemap\.xml$).*');