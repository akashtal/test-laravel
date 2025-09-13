@extends('layouts.app')

@section('title', 'My Purchases - Employee')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">My Purchases</h2>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <button onclick="toggleAddForm()" class="btn btn-primary">Add New Purchase</button>
    </div>
    
    <!-- Add Purchase Form -->
    <div id="addPurchaseForm" style="display: none; margin-bottom: 2rem;">
        <div class="card">
            <div class="card-header">
                <h3>Add New Purchase</h3>
            </div>
            
            <form method="POST" action="{{ route('employee.purchases.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select id="customer_id" 
                            name="customer_id" 
                            class="form-control @error('customer_id') is-invalid @enderror" 
                            required>
                        <option value="">Select Customer</option>
                        @foreach(\App\Models\CustomerMaster::where('created_by', auth()->id())->active()->get() as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
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
                        <option value="">Select Product</option>
                        @foreach(\App\Models\ProductMaster::all() as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
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
                           value="{{ old('invoice_no') }}" 
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
                           value="{{ old('purchase_date', date('Y-m-d')) }}" 
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
                           value="{{ old('value') }}" 
                           required>
                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Create Purchase</button>
                <button type="button" onclick="toggleAddForm()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    
    <!-- Purchases List -->
    <div class="card">
        <div class="card-header">
            <h3>Purchases List</h3>
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
                        <th>Actions</th>
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
                            <td>
                                <a href="{{ route('employee.purchases.edit', $purchase->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('employee.purchases.delete', $purchase->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this purchase?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
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
</div>

<script>
function toggleAddForm() {
    const form = document.getElementById('addPurchaseForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
