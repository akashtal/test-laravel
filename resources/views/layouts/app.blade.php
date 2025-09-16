<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Management')</title>

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
