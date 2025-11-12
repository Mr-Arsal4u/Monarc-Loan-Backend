<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arc Loan Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg-dark: #1e293b;
            --bg-light: #f8fafc;
            --border: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f1f5f9;
            color: var(--text-primary);
        }

        .sidebar {
            transition: transform 0.3s ease;
        }

        .sidebar.hidden-mobile {
            transform: translateX(-100%);
        }

        .nav-link {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #dbeafe;
            border-left-color: var(--primary);
            color: var(--primary);
        }

        .stat-card {
            transition: all 0.3s ease;
            background: white;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        table tr:hover {
            background-color: #f0f9ff;
        }

        .search-input {
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.05);
        }

        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background-color: #f3f4f6;
            color: #374151;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .role-badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
            background-color: #dbeafe;
            color: var(--primary);
        }

        .btn-edit {
            background-color: #dbeafe;
            color: var(--primary);
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .btn-view {
            background-color: #dbeafe;
            color: var(--primary);
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .truncate-text {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 64px;
                height: calc(100vh - 64px);
                z-index: 40;
                width: 16rem;
            }

            table {
                font-size: 0.875rem;
            }

            .truncate-text {
                max-width: 150px;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50">
    <!-- Top Navbar -->
    <nav class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center gap-3">
                <button id="menu-toggle" class="md:hidden p-2 hover:bg-slate-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-2xl font-bold text-blue-600">Arc Loan Management</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-3 pl-4 border-l border-slate-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        A
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Admin</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-white border-r border-slate-200 min-h-[calc(100vh-64px)] shadow-sm md:shadow-none">
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:text-slate-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('dashboard.loan-applications') }}" class="nav-link {{ request()->routeIs('dashboard.loan-applications') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:text-slate-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Loan Applications
                </a>
                <a href="{{ route('dashboard.users') }}" class="nav-link {{ request()->routeIs('dashboard.users') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:text-slate-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M12 4.354L9 8.5M12 4.354l3 4.146M3 20.5h18"></path>
                    </svg>
                    Users
                </a>
                <a href="{{ route('dashboard.contact-queries') }}" class="nav-link {{ request()->routeIs('dashboard.contact-queries') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:text-slate-900 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Contact Queries
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            @yield('content')
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('hidden-mobile');
        });

        // Close sidebar when a nav link is clicked on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('hidden-mobile');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

