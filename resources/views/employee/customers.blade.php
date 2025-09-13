@extends('layouts.app')

@section('title', 'My Customers - Employee')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">My Customers</h2>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <button onclick="toggleAddForm()" class="btn btn-primary">Add New Customer</button>
    </div>
    
    <!-- Add Customer Form -->
    <div id="addCustomerForm" style="display: none; margin-bottom: 2rem;">
        <div class="card">
            <div class="card-header">
                <h3>Add New Customer</h3>
            </div>
            
            <form method="POST" action="{{ route('employee.customers.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Customer Name</label>
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
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           value="{{ old('phone') }}" 
                           required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email (Optional)</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Address (Optional)</label>
                    <textarea id="address" 
                              name="address" 
                              class="form-control @error('address') is-invalid @enderror" 
                              rows="3">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Create Customer</button>
                <button type="button" onclick="toggleAddForm()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    
    <!-- Customers List -->
    <div class="card">
        <div class="card-header">
            <h3>Customers List</h3>
        </div>
        
        @if($customers->count() > 0)
            <div class="table-container">
                <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
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
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('employee.customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('employee.customers.delete', $customer->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this customer?')">
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
            
            {{ $customers->links() }}
        @else
            <p>No customers found.</p>
        @endif
    </div>
</div>

<script>
function toggleAddForm() {
    const form = document.getElementById('addCustomerForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
