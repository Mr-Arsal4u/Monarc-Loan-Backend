@extends('layouts.dashboard')

@section('title', 'Loan Applications - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Loan Applications</h2>
            <p class="text-slate-600 mt-2">Manage and review loan applications</p>
        </div>
        <button class="btn-primary px-6 py-3 text-white rounded-lg font-medium w-full md:w-auto">
            + New Loan Application
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Applicant Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Loan Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Amount</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Submission Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA001</td>
                        <td class="px-6 py-4 text-sm text-slate-700">John Smith</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Home Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$250,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-approved">Approved</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-01</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA002</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Sarah Johnson</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Car Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$35,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-pending">Pending</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-05</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA003</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Michael Chen</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Personal Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$15,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-approved">Approved</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-10-28</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA004</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Emily Rodriguez</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Home Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$320,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-rejected">Rejected</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-02</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA005</td>
                        <td class="px-6 py-4 text-sm text-slate-700">James Wilson</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Business Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$100,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-pending">Pending</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-06</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-edit">Edit</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#LA006</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Lisa Anderson</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Education Loan</td>
                        <td class="px-6 py-4 text-sm text-slate-700">$45,000</td>
                        <td class="px-6 py-4"><span class="status-badge status-approved">Approved</span></td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-10-25</td>
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

