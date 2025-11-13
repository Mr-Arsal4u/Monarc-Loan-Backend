<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use App\ContactQueryStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ContactQueryController extends Controller
{
    /**
     * Store a newly created contact query.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $contactQuery = ContactQuery::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => ContactQueryStatus::NEW,
                'metadata' => [
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'referer' => $request->header('referer'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully. We will get back to you soon!',
                'data' => [
                    'id' => $contactQuery->id,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Get all contact queries (for admin/dashboard).
     */
    public function index(Request $request): JsonResponse
    {
        $query = ContactQuery::query()
            ->with(['readBy'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by read status
        if ($request->has('is_read')) {
            $query->where('is_read', $request->boolean('is_read'));
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 15);
        $contactQueries = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $contactQueries,
        ]);
    }

    /**
     * Get a specific contact query.
     */
    public function show(string $id): JsonResponse
    {
        $contactQuery = ContactQuery::with(['readBy'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $contactQuery,
        ]);
    }

    /**
     * Mark a contact query as read.
     */
    public function markAsRead(string $id): JsonResponse
    {
        $contactQuery = ContactQuery::findOrFail($id);
        $contactQuery->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Contact query marked as read',
            'data' => $contactQuery->fresh(['readBy']),
        ]);
    }

    /**
     * Archive a contact query.
     */
    public function archive(string $id): JsonResponse
    {
        $contactQuery = ContactQuery::findOrFail($id);
        $contactQuery->archive();

        return response()->json([
            'success' => true,
            'message' => 'Contact query archived',
            'data' => $contactQuery,
        ]);
    }

    /**
     * Delete a contact query.
     */
    public function destroy(string $id): JsonResponse
    {
        $contactQuery = ContactQuery::findOrFail($id);
        $contactQuery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact query deleted successfully',
        ]);
    }
}
