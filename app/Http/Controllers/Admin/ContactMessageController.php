<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ContactMessage::orderByDesc('created_at');
        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('subject', 'like', "%{$search}%")
                ->orWhere('message', 'like', "%{$search}%");
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }
        return response()->json($query->paginate((int) $request->query('per_page', 20)));
    }

    public function show(ContactMessage $message): JsonResponse
    {
        return response()->json($message);
    }

    public function markRead(ContactMessage $message): JsonResponse
    {
        $message->update(['status' => 'read', 'read_at' => now()]);
        return response()->json($message);
    }

    public function markReplied(ContactMessage $message): JsonResponse
    {
        $message->update(['status' => 'replied', 'read_at' => $message->read_at ?? now()]);
        return response()->json($message);
    }

    public function archive(ContactMessage $message): JsonResponse
    {
        $message->update(['status' => 'archived']);
        return response()->json($message);
    }

    public function updateNotes(Request $request, ContactMessage $message): JsonResponse
    {
        $data = $request->validate(['admin_notes' => ['nullable', 'string']]);
        $message->update($data);
        return response()->json($message);
    }

    public function destroy(ContactMessage $message): JsonResponse
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted.']);
    }
}