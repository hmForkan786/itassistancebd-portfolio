<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Skill::orderBy('category')->orderBy('sort_order');
        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }
        if ($request->has('enabled')) {
            $query->where('enabled', $request->boolean('enabled'));
        }
        return response()->json($query->paginate((int) $request->query('per_page', 50)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateSkill($request);
        $s = Skill::create($data);
        return response()->json($s, 201);
    }

    public function show(Skill $skill): JsonResponse
    {
        return response()->json($skill);
    }

    public function update(Request $request, Skill $skill): JsonResponse
    {
        $data = $this->validateSkill($request);
        $skill->update($data);
        return response()->json($skill);
    }

    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();
        return response()->json(['message' => 'Skill deleted.']);
    }

    public function toggleEnabled(Skill $skill): JsonResponse
    {
        $skill->update(['enabled' => ! $skill->enabled]);
        return response()->json($skill);
    }

    private function validateSkill(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'category' => ['required', 'string', 'max:64'],
            'proficiency_label' => ['nullable', 'string', 'max:64'],
            'icon' => ['nullable', 'string', 'max:128'],
            'sort_order' => ['integer', 'min:0'],
            'enabled' => ['boolean'],
        ]);
    }
}