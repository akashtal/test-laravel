@extends('layouts.app')

@section('title', 'Edit Customer - Employee')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Customer</h2>
    </div>
    
    <form method="POST" action="{{ route('employee.customers.update', $customer->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $customer->name) }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" 
                   id="phone" 
                   name="phone" 
                   class="form-control @error('phone') is-invalid @enderror" 
                   value="{{ old('phone', $customer->phone) }}" 
                   required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $customer->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Address</label>
            <textarea id="address" 
                      name="address" 
                      class="form-control @error('address') is-invalid @enderror" 
                      rows="3">{{ old('address', $customer->address) }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Customer</button>
        <a href="{{ route('employee.customers') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
