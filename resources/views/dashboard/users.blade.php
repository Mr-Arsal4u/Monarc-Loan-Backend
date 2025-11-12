@extends('layouts.dashboard')

@section('title', 'Users - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div>
        <h2 class="text-3xl font-bold text-slate-900">Users</h2>
        <p class="text-slate-600 mt-2">Manage user accounts and roles</p>
    </div>

    <!-- Search Bar -->
    <div class="mt-8 mb-6">
        <div class="relative">
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input 
                type="text" 
                placeholder="Search by name, email, or role..." 
                class="search-input w-full pl-11 pr-4 py-3 border border-slate-200 rounded-lg focus:outline-none"
                id="search-input"
            >
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="users-table">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Role</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date Joined</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U001</td>
                        <td class="px-6 py-4 text-sm text-slate-700">John Smith</td>
                        <td class="px-6 py-4 text-sm text-slate-600">john.smith@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">Admin</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-active">Active</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-01-15</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U002</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Sarah Johnson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">sarah.j@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">User</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-active">Active</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-03-22</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U003</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Michael Chen</td>
                        <td class="px-6 py-4 text-sm text-slate-600">m.chen@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">Manager</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-active">Active</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-02-10</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U004</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Emily Rodriguez</td>
                        <td class="px-6 py-4 text-sm text-slate-600">emily.r@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">User</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-inactive">Inactive</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-04-05</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U005</td>
                        <td class="px-6 py-4 text-sm text-slate-700">James Wilson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">j.wilson@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">Manager</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-active">Active</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-05-12</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#U006</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Lisa Anderson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">lisa.a@email.com</td>
                        <td class="px-6 py-4"><span class="role-badge">User</span></td>
                        <td class="px-6 py-4"><span class="status-badge status-active">Active</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-06-18</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('search-input');
    const table = document.getElementById('users-table');

    searchInput?.addEventListener('keyup', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush

