@extends('layouts.app')

@section('title', 'All Customers - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Customers</h2>
    </div>
    
    @if($customers->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created By</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email ?? 'N/A' }}</td>
                        <td>{{ $customer->address ?? 'N/A' }}</td>
                        <td>{{ $customer->creator->name }}</td>
                        <td>{{ $customer->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $customers->links() }}
    @else
        <p>No customers found.</p>
    @endif
</div>
@endsection
