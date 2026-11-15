<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Testimonial::with('project:id,title,slug')->orderBy('sort_order')->orderByDesc('id');
        if ($search = $request->query('search')) {
            $query->where('client_name', 'like', "%{$search}%")
                ->orWhere('review_text', 'like', "%{$search}%");
        }
        if ($request->has('approved')) {
            $query->where('approved', $request->boolean('approved'));
        }
        if ($request->has('published')) {
            $query->where('published', $request->boolean('published'));
        }
        return response()->json($query->paginate((int) $request->query('per_page', 15)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateTestimonial($request);
        $t = Testimonial::create($data);
        return response()->json($t->load('project:id,title,slug'), 201);
    }

    public function show(Testimonial $testimonial): JsonResponse
    {
        return response()->json($testimonial->load('project:id,title,slug'));
    }

    public function update(Request $request, Testimonial $testimonial): JsonResponse
    {
        $data = $this->validateTestimonial($request);
        $testimonial->update($data);
        return response()->json($testimonial->load('project:id,title,slug'));
    }

    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted.']);
    }

    public function approve(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['approved' => true]);
        return response()->json($testimonial);
    }

    public function reject(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['approved' => false, 'published' => false]);
        return response()->json($testimonial);
    }

    public function publish(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['published' => true]);
        return response()->json($testimonial);
    }

    public function unpublish(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['published' => false]);
        return response()->json($testimonial);
    }

    public function feature(Testimonial $testimonial): JsonResponse
    {
        $testimonial->update(['featured' => ! $testimonial->featured]);
        return response()->json($testimonial);
    }

    private function validateTestimonial(Request $request): array
    {
        return $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_role' => ['nullable', 'string', 'max:128'],
            'company_name' => ['nullable', 'string', 'max:128'],
            'client_avatar' => ['nullable', 'string', 'max:500'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'review_text' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_date' => ['nullable', 'date'],
            'verified' => ['boolean'],
            'approved' => ['boolean'],
            'published' => ['boolean'],
            'featured' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);
    }
}