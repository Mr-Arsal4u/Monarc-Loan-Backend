<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use App\ContactQueryStatus;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    /**
     * Display a listing of contact queries in the dashboard.
     */
    public function index(Request $request)
    {
        $query = ContactQuery::query()
            ->with(['readBy', 'repliedBy'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
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

        $contactQueries = $query->paginate(15);
        $stats = [
            'total' => ContactQuery::count(),
            'new' => ContactQuery::where('status', ContactQueryStatus::NEW->value)->count(),
            'read' => ContactQuery::where('is_read', true)->count(),
            'replied' => ContactQuery::where('status', ContactQueryStatus::REPLIED->value)->count(),
            'archived' => ContactQuery::where('status', ContactQueryStatus::ARCHIVED->value)->count(),
        ];

        return view('dashboard.contact-queries', compact('contactQueries', 'stats'));
    }

    /**
     * Show a specific contact query.
     */
    public function show(Request $request, string $id)
    {
        $contactQuery = ContactQuery::with(['readBy', 'repliedBy'])->findOrFail($id);
        
        // Handle actions (mark as read, reply, archive)
        if ($request->isMethod('post')) {
            $action = $request->input('action');
            
            switch ($action) {
                case 'mark_read':
                    if (!$contactQuery->is_read) {
                        $contactQuery->markAsRead();
                    }
                    return redirect()->route('dashboard.contact-queries.show', $id)
                        ->with('success', 'Query marked as read');
                    
                case 'reply':
                    $request->validate([
                        'reply_message' => 'required|string|max:5000',
                    ]);
                    $contactQuery->markAsReplied($request->reply_message);
                    return redirect()->route('dashboard.contact-queries.show', $id)
                        ->with('success', 'Reply sent successfully');
                    
                case 'archive':
                    $contactQuery->archive();
                    return redirect()->route('dashboard.contact-queries.show', $id)
                        ->with('success', 'Query archived');
            }
        }
        
        // Mark as read if not already read (when viewing)
        if (!$contactQuery->is_read) {
            $contactQuery->markAsRead();
        }

        return view('dashboard.contact-query-detail', compact('contactQuery'));
    }
}
