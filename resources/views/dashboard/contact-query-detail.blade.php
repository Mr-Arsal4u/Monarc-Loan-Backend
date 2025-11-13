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
@endsection

