<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\PortfolioEvent;
use App\Models\PortfolioMetric;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::count();
        $publishedProjects = Project::whereNotNull('published_at')->where('published_at', '<=', now())->count();
        $draftProjects = Project::whereNull('published_at')->count();
        $completedProjects = Project::where('status', 'completed')->count();

        $testimonials = Testimonial::count();
        $approvedTestimonials = Testimonial::where('approved', true)->where('published', true)->count();

        $eligibleRatings = Testimonial::where('approved', true)->where('published', true)->where('verified', true)->pluck('rating');
        $averageRating = $eligibleRatings->count() > 0 ? round($eligibleRatings->avg(), 2) : null;

        $happyClientsMetric = PortfolioMetric::where('metric_key', 'happy_clients')->where('enabled', true)->where('verified', true)->first();
        $successRateMetric = PortfolioMetric::where('metric_key', 'success_rate')->where('enabled', true)->where('verified', true)->first();

        $unreadMessages = ContactMessage::where('status', 'unread')->count();
        $totalMessages = ContactMessage::count();

        $recentProjects = Project::latest()->take(5)->get(['id', 'title', 'status', 'published_at', 'created_at']);
        $recentTestimonials = Testimonial::latest()->take(5)->get(['id', 'client_name', 'rating', 'approved', 'published', 'created_at']);
        $recentMessages = ContactMessage::latest()->take(5)->get(['id', 'name', 'email', 'subject', 'status', 'submitted_at', 'created_at']);

        return response()->json([
            'stats' => [
                'projects' => $projects,
                'published_projects' => $publishedProjects,
                'draft_projects' => $draftProjects,
                'completed_projects' => $completedProjects,
                'testimonials' => $testimonials,
                'approved_testimonials' => $approvedTestimonials,
                'average_rating' => $averageRating,
                'happy_clients' => $happyClientsMetric?->metric_value,
                'success_rate' => $successRateMetric?->metric_value,
                'contact_messages' => $totalMessages,
                'unread_messages' => $unreadMessages,
            ],
            'recent' => [
                'projects' => $recentProjects,
                'testimonials' => $recentTestimonials,
                'messages' => $recentMessages,
            ],
        ]);
    }
}