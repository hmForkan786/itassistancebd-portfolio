<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioMetric;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioMetricController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = PortfolioMetric::orderBy('sort_order')->orderBy('id');
        if ($search = $request->query('search')) {
            $query->where('metric_label', 'like', "%{$search}%")
                ->orWhere('metric_key', 'like', "%{$search}%");
        }
        return response()->json($query->paginate((int) $request->query('per_page', 50)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateMetric($request);
        $m = PortfolioMetric::create($data);
        return response()->json($m, 201);
    }

    public function show(PortfolioMetric $metric): JsonResponse
    {
        return response()->json($metric);
    }

    public function update(Request $request, PortfolioMetric $metric): JsonResponse
    {
        $data = $this->validateMetric($request);
        $metric->update($data);
        return response()->json($metric);
    }

    public function destroy(PortfolioMetric $metric): JsonResponse
    {
        $metric->delete();
        return response()->json(['message' => 'Metric deleted.']);
    }

    public function toggleEnabled(PortfolioMetric $metric): JsonResponse
    {
        $metric->update(['enabled' => ! $metric->enabled]);
        return response()->json($metric);
    }

    public function toggleVerified(PortfolioMetric $metric): JsonResponse
    {
        $metric->update(['verified' => ! $metric->verified]);
        return response()->json($metric);
    }

    private function validateMetric(Request $request): array
    {
        return $request->validate([
            'metric_key' => ['required', 'string', 'max:64', 'regex:/^[a-z0-9_]+$/'],
            'metric_label' => ['required', 'string', 'max:128'],
            'metric_value' => ['nullable', 'numeric', 'min:0'],
            'metric_unit' => ['nullable', 'string', 'max:32'],
            'source_type' => ['required', 'in:manual,derived'],
            'source_reference' => ['nullable', 'string', 'max:255'],
            'verified' => ['boolean'],
            'enabled' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);
    }
}