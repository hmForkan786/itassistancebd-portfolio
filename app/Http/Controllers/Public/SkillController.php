<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function index(): JsonResponse
    {
        $skills = Skill::enabled()->get()->groupBy('category');
        return response()->json($skills);
    }
}