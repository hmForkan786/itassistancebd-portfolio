<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::eligible()
            ->orderBy('sort_order')
            ->orderByDesc('review_date')
            ->get();

        $averageRating = $testimonials->count() > 0
            ? round($testimonials->avg('rating'), 2)
            : null;

        return response()->json([
            'testimonials' => $testimonials,
            'average_rating' => $averageRating,
            'count' => $testimonials->count(),
        ]);
    }
}