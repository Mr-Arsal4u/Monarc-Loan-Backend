@extends('layouts.dashboard')

@section('title', 'Contact Queries - Arc Loan Management')

@section('content')
<div class="p-6 md:p-8">
    <div>
        <h2 class="text-3xl font-bold text-slate-900">Contact Queries</h2>
        <p class="text-slate-600 mt-2">Review and manage customer inquiries</p>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden mt-8">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Message</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ001</td>
                        <td class="px-6 py-4 text-sm text-slate-700">John Smith</td>
                        <td class="px-6 py-4 text-sm text-slate-600">john@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Inquiry about home loan interest rates and available options...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-04</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ002</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Sarah Johnson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">sarah@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Question regarding loan application processing timeline...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-05</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ003</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Michael Chen</td>
                        <td class="px-6 py-4 text-sm text-slate-600">michael@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Request for information about car loan eligibility criteria...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-06</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ004</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Emily Rodriguez</td>
                        <td class="px-6 py-4 text-sm text-slate-600">emily@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Feedback on customer service experience and suggestions for improvement...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-03</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ005</td>
                        <td class="px-6 py-4 text-sm text-slate-700">James Wilson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">james@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Information needed about business loan requirements and documentation...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-02</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">#CQ006</td>
                        <td class="px-6 py-4 text-sm text-slate-700">Lisa Anderson</td>
                        <td class="px-6 py-4 text-sm text-slate-600">lisa@email.com</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="truncate-text">Question about education loan and repayment options available...</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">2024-11-01</td>
                        <td class="px-6 py-4 flex gap-2">
                            <button class="action-btn btn-view">View</button>
                            <button class="action-btn btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

