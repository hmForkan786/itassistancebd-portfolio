<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::with(['images', 'technologies', 'metrics' => fn ($q) => $q->where('verified', true)])
            ->published()
            ->orderBy('sort_order')
            ->orderByDesc('id');

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%{$search}%");
        }
        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }
        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        return response()->json($query->paginate((int) $request->query('per_page', 15)));
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::with(['images', 'technologies', 'metrics' => fn ($q) => $q->where('verified', true)])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $related = Project::published()
            ->where('id', '!=', $project->id)
            ->when($project->category, fn ($q) => $q->where('category', $project->category))
            ->orderBy('sort_order')
            ->take(3)
            ->get(['id', 'title', 'slug', 'short_description', 'status', 'featured']);

        return response()->json([
            'project' => $project,
            'related' => $related,
        ]);
    }
}