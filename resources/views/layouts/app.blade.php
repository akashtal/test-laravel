<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Management')</title>
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #5a6fd8;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --success-color: #4ade80;
            --warning-color: #fbbf24;
            --danger-color: #f87171;
            --info-color: #60a5fa;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --border-radius: 0.75rem;
            --border-radius-lg: 1rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--gray-800);
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav {
            display: flex;
            gap: 0.5rem;
        }

        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .nav a:hover::before {
            left: 0;
        }

        .nav a:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info span {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .logout-btn {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Main Content */
        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        /* Cards */
        .card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .card-header {
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.75rem;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.1);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #22c55e);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #f59e0b);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--gray-500), var(--gray-600));
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info-color), #3b82f6);
            color: white;
        }

        .btn-sm {
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
        }

        .btn-lg {
            padding: 1.125rem 2.25rem;
            font-size: 1.125rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            background: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .table th,
        .table td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .table th {
            background: linear-gradient(135deg, var(--gray-50), var(--gray-100));
            font-weight: 700;
            color: var(--gray-800);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: linear-gradient(135deg, var(--gray-50), var(--gray-100));
            transform: scale(1.01);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert::before {
            content: '';
            width: 20px;
            height: 20px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
            border-left-color: var(--success-color);
        }

        .alert-success::before {
            background: var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2, #fecaca);
            color: #991b1b;
            border-left-color: var(--danger-color);
        }

        .alert-danger::before {
            background: var(--danger-color);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fffbeb, #fed7aa);
            color: #92400e;
            border-left-color: var(--warning-color);
        }

        .alert-warning::before {
            background: var(--warning-color);
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .dashboard-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .dashboard-card h3 {
            font-size: 1.125rem;
            color: var(--gray-600);
            margin-bottom: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .dashboard-card .number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.5rem;
            }

            .nav a {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .user-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .dashboard-card {
                padding: 2rem 1.5rem;
            }

            .dashboard-card .number {
                font-size: 2rem;
            }

            .card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .table-container {
                font-size: 0.875rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }

            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }

            .form-control {
                padding: 0.875rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 0.75rem;
            }

            .header {
                padding: 0.75rem 0;
            }

            .logo {
                font-size: 1.5rem;
            }

            .nav {
                flex-direction: column;
                width: 100%;
            }

            .nav a {
                width: 100%;
                text-align: center;
            }

            .main-content {
                padding: 1rem 0;
            }

            .card {
                padding: 1rem;
            }

            .dashboard-card {
                padding: 1.5rem 1rem;
            }

            .dashboard-card .number {
                font-size: 1.75rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .table th,
            .table td {
                padding: 0.5rem 0.25rem;
                font-size: 0.8rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --gray-100: #1f2937;
                --gray-200: #374151;
                --gray-300: #4b5563;
                --gray-400: #6b7280;
                --gray-500: #9ca3af;
                --gray-600: #d1d5db;
                --gray-700: #e5e7eb;
                --gray-800: #f3f4f6;
                --gray-900: #f9fafb;
            }

            body {
                background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
                color: var(--gray-800);
            }

            .card {
                background: #1f2937;
                border-color: var(--gray-300);
            }

            .table-container {
                background: #1f2937;
            }

            .form-control {
                background: #374151;
                border-color: var(--gray-300);
                color: var(--gray-800);
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">Management</div>
            @auth
            <nav class="nav">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.employees') }}">Employees</a>
                    <a href="{{ route('admin.customers') }}">All Customers</a>
                    <a href="{{ route('admin.products') }}">Products</a>
                    <a href="{{ route('admin.purchases') }}">All Purchases</a>
                @else
                    <a href="{{ route('employee.dashboard') }}">Dashboard</a>
                    <a href="{{ route('employee.customers') }}">My Customers</a>
                    <a href="{{ route('employee.purchases') }}">My Purchases</a>
                @endif
            </nav>
            <div class="user-info">
                <span>Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endauth
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
