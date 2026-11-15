<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PortfolioEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AnalyticsController extends Controller
{
    private array $allowedEvents = [
        'page_view', 'project_view', 'contact_form_submit',
        'project_cta_click', 'contact_cta_click',
    ];

    public function store(Request $request): JsonResponse
    {
        $key = 'analytics-event:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 60)) {
            return response()->json(['message' => 'Rate limited.'], 429);
        }

        $validated = $request->validate([
            'event_name' => ['required', 'string', 'in:' . implode(',', $this->allowedEvents)],
            'page_path' => ['nullable', 'string', 'max:255'],
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
            'referrer_domain' => ['nullable', 'string', 'max:255'],
            'device_type' => ['nullable', 'string', 'max:32'],
        ]);

        // Exclude admin traffic
        if ($request->user() && $request->user()->isAdmin()) {
            return response()->json(['message' => 'Ignored.'], 200);
        }

        $validated['session_hash'] = hash('sha256', $request->session()->getId());
        $validated['occurred_at'] = now();

        PortfolioEvent::create($validated);
        RateLimiter::hit($key, 60);

        return response()->json(['message' => 'Recorded.'], 201);
    }
}