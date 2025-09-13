@extends('layouts.app')

@section('title', 'Manage Products - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Products</h2>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <button onclick="toggleAddForm()" class="btn btn-primary">Add New Product</button>
    </div>
    
    <!-- Add Product Form -->
    <div id="addProductForm" style="display: none; margin-bottom: 2rem;">
        <div class="card">
            <div class="card-header">
                <h3>Add New Product</h3>
            </div>
            
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="remarks" class="form-label">Remarks (Optional)</label>
                    <textarea id="remarks" 
                              name="remarks" 
                              class="form-control @error('remarks') is-invalid @enderror" 
                              rows="3">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Create Product</button>
                <button type="button" onclick="toggleAddForm()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    
    <!-- Products List -->
    <div class="card">
        <div class="card-header">
            <h3>Products List</h3>
        </div>
        
        @if($products->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Remarks</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->remarks ?? 'N/A' }}</td>
                            <td>{{ $product->creator->name }}</td>
                            <td>{{ $product->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('admin.products.delete', $product->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $products->links() }}
        @else
            <p>No products found.</p>
        @endif
    </div>
</div>

<script>
function toggleAddForm() {
    const form = document.getElementById('addProductForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
