<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = SiteSetting::orderBy('key');
        if ($search = $request->query('search')) {
            $query->where('key', 'like', "%{$search}%");
        }
        return response()->json($query->paginate((int) $request->query('per_page', 50)));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:128', 'regex:/^[a-z0-9_.-]+$/'],
            'value' => ['nullable', 'string'],
            'type' => ['required', 'in:string,text,boolean,number,json'],
            'is_public' => ['boolean'],
        ]);
        $setting = SiteSetting::create($data);
        return response()->json($setting, 201);
    }

    public function show(SiteSetting $setting): JsonResponse
    {
        return response()->json($setting);
    }

    public function update(Request $request, SiteSetting $setting): JsonResponse
    {
        $data = $request->validate([
            'value' => ['nullable', 'string'],
            'type' => ['in:string,text,boolean,number,json'],
            'is_public' => ['boolean'],
        ]);
        $setting->update($data);
        return response()->json($setting);
    }

    public function destroy(SiteSetting $setting): JsonResponse
    {
        $setting->delete();
        return response()->json(['message' => 'Setting deleted.']);
    }
}