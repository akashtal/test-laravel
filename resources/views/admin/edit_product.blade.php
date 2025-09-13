@extends('layouts.app')

@section('title', 'Edit Product - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Product</h2>
    </div>
    
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $product->name) }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea id="remarks" 
                      name="remarks" 
                      class="form-control @error('remarks') is-invalid @enderror" 
                      rows="3">{{ old('remarks', $product->remarks) }}</textarea>
            @error('remarks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
