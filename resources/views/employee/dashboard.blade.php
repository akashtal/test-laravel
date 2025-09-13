@extends('layouts.app')

@section('title', 'Employee Dashboard - Management')

@section('content')
<div class="dashboard-grid">
    <div class="dashboard-card">
        <h3>My Customers</h3>
        <div class="number">{{ $totalCustomers }}</div>
    </div>
    
    <div class="dashboard-card">
        <h3>My Purchases</h3>
        <div class="number">{{ $totalPurchases }}</div>
    </div>
    
    <div class="dashboard-card">
        <h3>Total Value (₹)</h3>
        <div class="number">₹{{ number_format($totalValue, 2) }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Quick Actions</h2>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
        <a href="{{ route('employee.customers') }}" class="btn btn-primary">Manage My Customers</a>
        <a href="{{ route('employee.purchases') }}" class="btn btn-success">Manage My Purchases</a>
    </div>
</div>
@endsection
