@extends('layouts.app')

@section('title', 'All Purchases - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Purchases</h2>
    </div>
    
    @if($purchases->count() > 0)
        <div class="table-container">
            <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Invoice No</th>
                    <th>Purchase Date</th>
                    <th>Value (₹)</th>
                    <th>Created By Employee</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->customer->name }}</td>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->invoice_no }}</td>
                        <td>{{ $purchase->purchase_date->format('M d, Y') }}</td>
                        <td>₹{{ number_format($purchase->value, 2) }}</td>
                        <td>{{ $purchase->customer->creator->name }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        
        {{ $purchases->links() }}
    @else
        <p>No purchases found.</p>
    @endif
</div>
@endsection
