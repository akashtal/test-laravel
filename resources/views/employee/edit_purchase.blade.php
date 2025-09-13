@extends('layouts.app')

@section('title', 'Edit Purchase - Employee')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Purchase</h2>
    </div>
    
    <form method="POST" action="{{ route('employee.purchases.update', $purchase->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" 
                    name="customer_id" 
                    class="form-control @error('customer_id') is-invalid @enderror" 
                    required>
                <option value="">Select a customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id', $purchase->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} ({{ $customer->phone }})
                    </option>
                @endforeach
            </select>
            @error('customer_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="product_id" class="form-label">Product</label>
            <select id="product_id" 
                    name="product_id" 
                    class="form-control @error('product_id') is-invalid @enderror" 
                    required>
                <option value="">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $purchase->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="invoice_no" class="form-label">Invoice Number</label>
            <input type="text" 
                   id="invoice_no" 
                   name="invoice_no" 
                   class="form-control @error('invoice_no') is-invalid @enderror" 
                   value="{{ old('invoice_no', $purchase->invoice_no) }}" 
                   required>
            @error('invoice_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" 
                   id="purchase_date" 
                   name="purchase_date" 
                   class="form-control @error('purchase_date') is-invalid @enderror" 
                   value="{{ old('purchase_date', $purchase->purchase_date->format('Y-m-d')) }}" 
                   required>
            @error('purchase_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="value" class="form-label">Value (₹)</label>
            <input type="number" 
                   id="value" 
                   name="value" 
                   step="0.01" 
                   min="0" 
                   class="form-control @error('value') is-invalid @enderror" 
                   value="{{ old('value', $purchase->value) }}" 
                   required>
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Purchase</button>
        <a href="{{ route('employee.purchases') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
