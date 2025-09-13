@extends('layouts.app')

@section('title', 'Admin Dashboard - Management')

@section('content')
<div class="dashboard-grid">
    <div class="dashboard-card">
        <h3>Total Employees</h3>
        <div class="number">{{ $totalEmployees }}</div>
    </div>
    
    <div class="dashboard-card">
        <h3>Total Customers</h3>
        <div class="number">{{ $totalCustomers }}</div>
    </div>
    
    <div class="dashboard-card">
        <h3>Total Products</h3>
        <div class="number">{{ $totalProducts }}</div>
    </div>
    
    <div class="dashboard-card">
        <h3>Total Purchases</h3>
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
        <a href="{{ route('admin.employees') }}" class="btn btn-primary">Manage Employees</a>
        <a href="{{ route('admin.customers') }}" class="btn btn-success">View All Customers</a>
        <a href="{{ route('admin.products') }}" class="btn btn-warning">Manage Products</a>
        <a href="{{ route('admin.purchases') }}" class="btn btn-danger">View All Purchases</a>
    </div>
</div>
@endsection
