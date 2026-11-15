<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectTechnology;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Project::with(['images', 'technologies', 'metrics'])
            ->orderBy('sort_order')->orderByDesc('id');

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%{$search}%");
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }
        if ($request->has('published')) {
            $request->boolean('published')
                ? $query->whereNotNull('published_at')
                : $query->whereNull('published_at');
        }

        return response()->json($query->paginate((int) $request->query('per_page', 15)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateProject($request);
        $project = Project::create($data);
        $this->syncTechnologies($project, $request->input('technologies', []));
        $this->syncImages($project, $request->input('images', []));
        $this->syncMetrics($project, $request->input('metrics', []));

        return response()->json($project->load(['images', 'technologies', 'metrics']), 201);
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json($project->load(['images', 'technologies', 'metrics']));
    }

    public function update(Request $request, Project $project): JsonResponse
    {
        $data = $this->validateProject($request, $project->id);
        $project->update($data);
        $this->syncTechnologies($project, $request->input('technologies', []));
        $this->syncImages($project, $request->input('images', []));
        $this->syncMetrics($project, $request->input('metrics', []));

        return response()->json($project->load(['images', 'technologies', 'metrics']));
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted.']);
    }

    public function publish(Project $project): JsonResponse
    {
        $project->update(['published_at' => now()]);
        return response()->json($project);
    }

    public function unpublish(Project $project): JsonResponse
    {
        $project->update(['published_at' => null]);
        return response()->json($project);
    }

    public function feature(Project $project): JsonResponse
    {
        $project->update(['featured' => ! $project->featured]);
        return response()->json($project);
    }

    private function validateProject(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', Rule::unique('projects', 'slug')->ignore($ignoreId)],
            'category' => ['nullable', 'string', 'max:64'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'problem_statement' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'implementation_details' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],\n            'limitations' => ['nullable', 'string'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'client_visibility' => ['boolean'],
            'status' => ['required', Rule::in(['completed', 'in-progress', 'prototype', 'planned'])],
            'featured' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'started_at' => ['nullable', 'date'],
            'completed_at' => ['nullable', 'date'],
            'duration' => ['nullable', 'string', 'max:64'],
            'live_url' => ['nullable', 'url', 'max:500'],
            'github_url' => ['nullable', 'url', 'max:500'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'published_at' => ['nullable', 'date'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        return $validated;
    }

    private function syncTechnologies(Project $project, array $items): void
    {
        $project->technologies()->delete();
        foreach (array_values($items) as $i => $name) {
            if (is_string($name) && trim($name) !== '') {
                $project->technologies()->create(['name' => trim($name), 'sort_order' => $i]);
            }
        }
    }

    private function syncImages(Project $project, array $items): void
    {
        $project->images()->delete();
        foreach (array_values($items) as $i => $img) {
            if (is_array($img) && ! empty($img['path'])) {
                $project->images()->create([
                    'path' => $img['path'],
                    'alt' => $img['alt'] ?? null,
                    'caption' => $img['caption'] ?? null,
                    'sort_order' => $img['sort_order'] ?? $i,
                ]);
            }
        }
    }

    private function syncMetrics(Project $project, array $items): void
    {
        $project->metrics()->delete();
        foreach (array_values($items) as $i => $m) {
            if (is_array($m) && ! empty($m['metric_label'])) {
                $project->metrics()->create([
                    'metric_key' => $m['metric_key'] ?? 'custom',
                    'metric_label' => $m['metric_label'],
                    'metric_value' => $m['metric_value'] ?? null,
                    'metric_unit' => $m['metric_unit'] ?? null,
                    'verified' => (bool) ($m['verified'] ?? false),
                    'sort_order' => $m['sort_order'] ?? $i,
                ]);
            }
        }
    }
}