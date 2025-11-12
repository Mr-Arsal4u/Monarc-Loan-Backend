@extends('layouts.dashboard')

@section('title', 'Dashboard - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900">Dashboard</h2>
        <p class="text-slate-600 mt-2">Welcome back! Here's your system overview.</p>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <!-- Total Applications Card -->
        <div class="stat-card p-6 rounded-xl border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Applications</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">1,284</p>
                    <p class="text-xs text-green-600 mt-3">↑ 12% from last month</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="stat-card p-6 rounded-xl border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Approved</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">856</p>
                    <p class="text-xs text-green-600 mt-3">↑ 8% from last month</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="stat-card p-6 rounded-xl border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Pending</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">298</p>
                    <p class="text-xs text-amber-600 mt-3">→ No change</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="stat-card p-6 rounded-xl border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Rejected</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">130</p>
                    <p class="text-xs text-red-600 mt-3">↑ 2% from last month</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="stat-card p-6 rounded-xl border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-slate-900 mt-2">542</p>
                    <p class="text-xs text-green-600 mt-3">↑ 5% from last month</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 6a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM5 20a3 3 0 015.856-1.487M5 6a3 3 0 110-6 3 3 0 010 6z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Recent Activity</h3>
            <div class="space-y-4">
                <div class="flex items-start gap-4 pb-4 border-b border-slate-200">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Loan approved for Sarah Johnson</p>
                        <p class="text-xs text-slate-500 mt-1">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 pb-4 border-b border-slate-200">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">New user registered: Michael Chen</p>
                        <p class="text-xs text-slate-500 mt-1">4 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Application review pending: Emily Rodriguez</p>
                        <p class="text-xs text-slate-500 mt-1">1 day ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">System Status</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-slate-700">Database</p>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Operational</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 98%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-slate-700">API Server</p>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Operational</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 99%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-slate-700">Cache Service</p>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">Degraded</span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

