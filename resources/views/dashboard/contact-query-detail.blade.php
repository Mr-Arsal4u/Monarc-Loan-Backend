@extends('layouts.dashboard')

@section('title', 'Contact Query Details - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div class="mb-6">
        <a href="{{ route('dashboard.contact-queries') }}" class="text-blue-600 hover:text-blue-700 mb-4 inline-block">
            ← Back to Contact Queries
        </a>
        <h2 class="text-3xl font-bold text-slate-900">Contact Query Details</h2>
        <p class="text-slate-600 mt-2">Query #{{ str_pad($contactQuery->id, 6, '0', STR_PAD_LEFT) }}</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Query Information -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-slate-900">Query Information</h3>
                    @php
                        $statusColors = [
                            'new' => 'bg-blue-100 text-blue-800',
                            'read' => 'bg-green-100 text-green-800',
                            'replied' => 'bg-purple-100 text-purple-800',
                            'archived' => 'bg-slate-100 text-slate-800',
                        ];
                        $statusColor = $statusColors[$contactQuery->status->value] ?? 'bg-slate-100 text-slate-800';
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                        {{ ucfirst($contactQuery->status->value) }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-slate-600">Subject</label>
                        <p class="text-slate-900 font-semibold mt-1">{{ $contactQuery->subject }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-slate-600">Message</label>
                        <div class="mt-1 p-4 bg-slate-50 rounded-lg text-slate-700 whitespace-pre-wrap">
                            {{ $contactQuery->message }}
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 pt-4 border-t border-slate-200">
                        <div>
                            <label class="text-sm font-medium text-slate-600">Submitted</label>
                            <p class="text-slate-900 mt-1">{{ $contactQuery->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        @if($contactQuery->is_read && $contactQuery->read_at)
                        <div>
                            <label class="text-sm font-medium text-slate-600">Read</label>
                            <p class="text-slate-900 mt-1">
                                {{ $contactQuery->read_at->format('M d, Y h:i A') }}
                                @if($contactQuery->readBy)
                                    <span class="text-slate-600">by {{ $contactQuery->readBy->name }}</span>
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reply Section -->
            @if($contactQuery->status->value === 'replied' && $contactQuery->reply_message)
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Reply</h3>
                <div class="p-4 bg-purple-50 rounded-lg text-slate-700 whitespace-pre-wrap">
                    {{ $contactQuery->reply_message }}
                </div>
                @if($contactQuery->replied_at)
                <p class="text-sm text-slate-600 mt-3">
                    Replied on {{ $contactQuery->replied_at->format('M d, Y h:i A') }}
                    @if($contactQuery->repliedBy)
                        by {{ $contactQuery->repliedBy->name }}
                    @endif
                </p>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Contact Information -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Contact Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-slate-600">Name</label>
                        <p class="text-slate-900 mt-1">{{ $contactQuery->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-600">Email</label>
                        <p class="text-slate-900 mt-1">
                            <a href="mailto:{{ $contactQuery->email }}" class="text-blue-600 hover:text-blue-700">
                                {{ $contactQuery->email }}
                            </a>
                        </p>
                    </div>
                    @if($contactQuery->phone)
                    <div>
                        <label class="text-sm font-medium text-slate-600">Phone</label>
                        <p class="text-slate-900 mt-1">
                            <a href="tel:{{ $contactQuery->phone }}" class="text-blue-600 hover:text-blue-700">
                                {{ $contactQuery->phone }}
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Actions</h3>
                <div class="space-y-2">
                    @if(!$contactQuery->is_read)
                    <form method="POST" action="{{ route('dashboard.contact-queries.show', $contactQuery->id) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="mark_read">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                            Mark as Read
                        </button>
                    </form>
                    @endif

                    @if($contactQuery->status->value !== 'replied')
                    <button onclick="document.getElementById('replyModal').classList.remove('hidden')" 
                            class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">
                        Reply
                    </button>
                    @endif

                    @if($contactQuery->status->value !== 'archived')
                    <form method="POST" action="{{ route('dashboard.contact-queries.show', $contactQuery->id) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="archive">
                        <button type="submit" class="w-full px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 text-sm">
                            Archive
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <!-- Internal Notes -->
            @if($contactQuery->internal_notes)
            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Internal Notes</h3>
                <p class="text-slate-700 text-sm whitespace-pre-wrap">{{ $contactQuery->internal_notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full p-6">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Reply to Query</h3>
        <form method="POST" action="{{ route('dashboard.contact-queries.show', $contactQuery->id) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="action" value="reply">
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Reply Message</label>
                <textarea name="reply_message" rows="6" required
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Type your reply here..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                    Send Reply
                </button>
                <button type="button" onclick="document.getElementById('replyModal').classList.add('hidden')" 
                        class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

