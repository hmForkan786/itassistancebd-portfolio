<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $key = 'contact-submit:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Too many submissions. Try again later.'], 429);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:64'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'source_page' => ['nullable', 'string', 'max:255'],
        ]);

        // Honeypot spam check
        if ($request->filled('website')) {
            RateLimiter::hit($key, 300);
            return response()->json(['message' => 'Submitted.'], 200);
        }

        $validated['status'] = 'unread';
        $validated['submitted_at'] = now();
        $message = ContactMessage::create($validated);

        RateLimiter::hit($key, 300);

        return response()->json([
            'message' => 'Message received. Thank you.',
            'id' => $message->id,
        ], 201);
    }
}