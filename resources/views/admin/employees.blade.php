@extends('layouts.app')

@section('title', 'Manage Employees - Admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Manage Employees</h2>
    </div>
    
    <div style="margin-bottom: 2rem;">
        <button onclick="toggleAddForm()" class="btn btn-primary">Add New Employee</button>
    </div>
    
    <!-- Add Employee Form -->
    <div id="addEmployeeForm" style="display: none; margin-bottom: 2rem;">
        <div class="card">
            <div class="card-header">
                <h3>Add New Employee</h3>
            </div>
            
            <form method="POST" action="{{ route('admin.employees.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
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
                    <label for="username" class="form-label">Username</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           class="form-control @error('username') is-invalid @enderror" 
                           value="{{ old('username') }}" 
                           placeholder="Choose a unique username"
                           required>
                    @error('username')
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-control" 
                           required>
                </div>

                <button type="submit" class="btn btn-success">Create Employee</button>
                <button type="button" onclick="toggleAddForm()" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    
    <!-- Employees List -->
    <div class="card">
        <div class="card-header">
            <h3>Employees List</h3>
        </div>
        
        @if($employees->count() > 0)
            <div class="table-container">
                <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="{{ route('admin.employees.delete', $employee->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this employee?')">
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
            
            {{ $employees->links() }}
        @else
            <p>No employees found.</p>
        @endif
    </div>
</div>

<script>
function toggleAddForm() {
    const form = document.getElementById('addEmployeeForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
