<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Service::orderBy('sort_order')->orderBy('id');
        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%{$search}%");
        }
        if ($request->has('enabled')) {
            $query->where('enabled', $request->boolean('enabled'));
        }
        return response()->json($query->paginate((int) $request->query('per_page', 50)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateService($request);
        $s = Service::create($data);
        return response()->json($s, 201);
    }

    public function show(Service $service): JsonResponse
    {
        return response()->json($service);
    }

    public function update(Request $request, Service $service): JsonResponse
    {
        $data = $this->validateService($request);
        $service->update($data);
        return response()->json($service);
    }

    public function destroy(Service $service): JsonResponse
    {
        $service->delete();
        return response()->json(['message' => 'Service deleted.']);
    }

    public function toggleEnabled(Service $service): JsonResponse
    {
        $service->update(['enabled' => ! $service->enabled]);
        return response()->json($service);
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:128'],
            'featured' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'enabled' => ['boolean'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}