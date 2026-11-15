<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PortfolioMetric;
use Illuminate\Http\JsonResponse;

class PortfolioMetricController extends Controller
{
    public function index(): JsonResponse
    {
        $metrics = PortfolioMetric::enabled()->verified()->orderBy('sort_order')->get();
        return response()->json($metrics);
    }
}