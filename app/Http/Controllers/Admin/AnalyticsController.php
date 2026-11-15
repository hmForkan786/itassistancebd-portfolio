<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioEvent;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function overview(): JsonResponse
    {
        $totalViews = PortfolioEvent::where('event_name', 'page_view')->count();
        $projectViews = PortfolioEvent::where('event_name', 'project_view')->count();
        $contactSubmits = PortfolioEvent::where('event_name', 'contact_form_submit')->count();
        $ctaClicks = PortfolioEvent::whereIn('event_name', ['project_cta_click', 'contact_cta_click'])->count();

        $topProjects = PortfolioEvent::where('event_name', 'project_view')
            ->whereNotNull('project_id')
            ->selectRaw('project_id, count(*) as views')
            ->groupBy('project_id')
            ->orderByDesc('views')
            ->take(10)
            ->get()
            ->map(function ($row) {
                $project = Project::find($row->project_id);
                return [
                    'project_id' => $row->project_id,
                    'title' => $project?->title,
                    'slug' => $project?->slug,
                    'views' => (int) $row->views,
                ];
            });

        $topPages = PortfolioEvent::where('event_name', 'page_view')
            ->selectRaw('page_path, count(*) as views')
            ->groupBy('page_path')
            ->orderByDesc('views')
            ->take(10)
            ->get();

        $daily = PortfolioEvent::selectRaw('DATE(occurred_at) as day, count(*) as count')
            ->groupBy('day')
            ->orderBy('day')
            ->take(30)
            ->get();

        $referrerDomains = PortfolioEvent::whereNotNull('referrer_domain')
            ->selectRaw('referrer_domain, count(*) as count')
            ->groupBy('referrer_domain')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return response()->json([
            'totals' => [
                'page_views' => $totalViews,
                'project_views' => $projectViews,
                'contact_submissions' => $contactSubmits,
                'cta_clicks' => $ctaClicks,
            ],
            'top_projects' => $topProjects,
            'top_pages' => $topPages,
            'daily_trend' => $daily,
            'referrer_domains' => $referrerDomains,
        ]);
    }
}