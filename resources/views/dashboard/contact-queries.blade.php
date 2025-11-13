@extends('layouts.dashboard')

@section('title', 'Contact Queries - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Contact Queries</h2>
            <p class="text-slate-600 mt-2">Review and manage customer inquiries</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <div class="text-sm text-slate-600">Total</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <div class="text-sm text-slate-600">New</div>
            <div class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['new'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <div class="text-sm text-slate-600">Read</div>
            <div class="text-2xl font-bold text-green-600 mt-1">{{ $stats['read'] }}</div>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-4">
            <div class="text-sm text-slate-600">Archived</div>
            <div class="text-2xl font-bold text-slate-500 mt-1">{{ $stats['archived'] }}</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg border border-slate-200 p-4 mb-6">
        <form method="GET" action="{{ route('dashboard.contact-queries') }}" class="flex gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-slate-700 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search by name, email, subject..." 
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select name="status" class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>All</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Read Status</label>
                <select name="is_read" class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                    <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Filter</button>
            @if(request()->hasAny(['search', 'status', 'is_read']))
                <a href="{{ route('dashboard.contact-queries') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300">Clear</a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subject</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($contactQueries as $query)
                    <tr class="{{ !$query->is_read ? 'bg-blue-50' : '' }} hover:bg-slate-50">
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#{{ str_pad($query->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">
                            {{ $query->name }}
                            @if(!$query->is_read)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">New</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $query->email }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <div class="max-w-xs truncate" title="{{ $query->subject }}">{{ $query->subject }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'new' => 'bg-blue-100 text-blue-800',
                                    'read' => 'bg-green-100 text-green-800',
                                    'archived' => 'bg-slate-100 text-slate-800',
                                ];
                                $statusColor = $statusColors[$query->status->value] ?? 'bg-slate-100 text-slate-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($query->status->value) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $query->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('dashboard.contact-queries.show', $query->id) }}" 
                                   class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                            No contact queries found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($contactQueries->hasPages())
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $contactQueries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
