<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = SiteSetting::where('is_public', true)->get(['key', 'value', 'type']);
        return response()->json($settings);
    }
}